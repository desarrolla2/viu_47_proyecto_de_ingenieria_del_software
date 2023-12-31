<?php

namespace App\Infrastructure\Reader\Service\ChatGPT;

use App\Domain\Component\HttpClient\HttpClientInterface;
use App\Domain\Reader\Entity\AgreementInterface;
use App\Domain\Reader\Entity\Person;
use App\Domain\Reader\Entity\ResidentialLeaseAgreement;
use App\Domain\Reader\Service\ProcessorInterface;
use App\Domain\Reader\ValueObject\Text;
use Symfony\Component\HttpFoundation\Request;

readonly class DavinciProcessor implements ProcessorInterface
{
    const ENDPOINT = 'https://api.openai.com/v1/chat/completions';

    public function __construct(private HttpClientInterface $httpClient)
    {
        $this->httpClient->withOptions(['auth_bearer' => $this->getBearer(),]);
    }

    public function execute(Text $text): AgreementInterface
    {
        $response = $this->request(
            sprintf(
                'En el siguiente contrato:\n\n %s \n\nIndica nombres y apellidos de los propietarios en el sigiente formato:\npropietario: nombre y apellidos, dni\n\nA continuación Indica nombres y apellidos de los inquilinos en el sigiente formato:\inquilino: nombre y apellidos, dni',
                $text->content()
            )
        );
        $agreement = new ResidentialLeaseAgreement();
        $message = $this->getMessage($response);
        $lines = explode(PHP_EOL, $message);
        foreach ($lines as $line) {
            if (str_contains($line, 'propietario:')) {
                $line = str_replace('propietario:', '', $line);
                $agreement->addLandLord($this->person($line));
            }
            if (str_contains($line, 'inquilino:')) {
                $line = str_replace('inquilino:', '', $line);
                $agreement->addTenant($this->person($line));
            }
        }
        dump($agreement);

        return $agreement;
    }

    public function score(Text $text): int
    {
        $response = $this->request(sprintf('En el siguiente contrato:\n\n %s \n\nResponde sólamente SI o NO, ¿Se trata de un contrato de arrendamiento de una vivienda?', $text->content()));

        $message = $this->getMessage($response);

        if (str_contains($message, 'si')) {
            return 100;
        }

        return 0;
    }

    protected function getBearer(): string
    {
        return 'sk-';
    }

    private function getMessage(array $response): string
    {
        $message = array_values($response['choices'])[0]['message']['content'];

        return $this->normalize($message);
    }

    private function normalize(string $message): string
    {
        $message = mb_strtolower($message);

        return str_replace(['á', 'é', 'í', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], $message);
    }

    private function person(string $line): Person
    {
        $line = str_replace('dni', '', $line);
        $line = explode(',', $line);

        return new Person(trim($line[0]), trim($line[1]));
    }

    private function request(string $content): array
    {
        $json = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'Eres un abogado. Responde a cada pregunta con precisión y pocas palabras',],
                ['role' => 'user', 'content' => $content,],
            ],
        ];

        dump(json_encode($json));

        return $this->httpClient->request(Request::METHOD_POST, self::ENDPOINT, [
            'json' => $json,
        ]);
    }
}
