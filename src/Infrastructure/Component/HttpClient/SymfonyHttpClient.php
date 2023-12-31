<?php

namespace App\Infrastructure\Component\HttpClient;

use App\Domain\Component\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class SymfonyHttpClient implements HttpClientInterface
{
    public function __construct(private \Symfony\Contracts\HttpClient\HttpClientInterface $httpClient, private CacheInterface $cache)
    {
    }

    public function request(string $method, string $path, array $body): array
    {
        $cacheKey = hash('sha256', json_encode($body));
        $responseContent = $this->cache->get($cacheKey, function (ItemInterface $item) use ($method, $path, $body): string {
            $item->expiresAfter(3600 * 24 * 10);

            $response = $this->httpClient->request($method, $path, $body);

            if ($response->getStatusCode() !== Response::HTTP_OK) {
                throw new \RuntimeException($response->getContent());
            }

            return $response->getContent();
        });

        return json_decode($responseContent, true);
    }

    public function withOptions(array $array): void
    {
        $this->httpClient = $this->httpClient->withOptions($array);
    }
}
