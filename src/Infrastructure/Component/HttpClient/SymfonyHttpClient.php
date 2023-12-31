<?php

namespace App\Infrastructure\Component\HttpClient;

use App\Domain\Component\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;

class SymfonyHttpClient implements HttpClientInterface
{
    public function __construct(private \Symfony\Contracts\HttpClient\HttpClientInterface $httpClient)
    {
    }

    public function request(string $method, string $path, array $body): array
    {
        $response = $this->httpClient->request($method, $path, $body);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new \RuntimeException($response->getContent());
        }

        return $response->toArray();
    }

    public function withOptions(array $array): void
    {
        $this->httpClient = $this->httpClient->withOptions($array);
    }
}
