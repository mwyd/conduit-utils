<?php

namespace ConduitUtils\Api;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

final class ShadowpayApi
{
    private Client $client;

    public function __construct(
        private readonly string $token,
        array $options
    ) {
        $this->client = new Client($options);
    }

    public function isLogged(bool $httpErrors = false): ResponseInterface
    {
        return $this->client->get('market/is_logged', [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http_errors' => $httpErrors
        ]);
    }

    public function getSteamItem(array $query = [], bool $httpErrors = false): ResponseInterface
    {
        return $this->client->get('v2/user/items/steam', [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query' => ['token' => $this->token] + $query,
            'http_errors' => $httpErrors
        ]);
    }
}
