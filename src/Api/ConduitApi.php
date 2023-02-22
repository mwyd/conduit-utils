<?php

namespace ConduitUtils\Api;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

final class ConduitApi
{
    private Client $client;

    public function __construct(
        private readonly string $token,
        array $options
    ) {
        $this->client = new Client($options);
    }

    public function getSteamMarketCsgoItems(array $query = [], bool $httpErrors = false): ResponseInterface
    {
        return $this->client->get('v1/steam-market-csgo-items', [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query' => $query,
            'http_errors' => $httpErrors
        ]);
    }

    public function getSteamMarketCsgoItem(string $hashName, bool $httpErrors = false): ResponseInterface
    {
        return $this->client->get("v1/steam-market-csgo-items/{$hashName}", [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http_errors' => $httpErrors
        ]);
    }

    public function createShadowpaySoldItem(array $formData, bool $httpErrors = false): ResponseInterface
    {
        return $this->client->post('v1/shadowpay-sold-items', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json'
            ],
            'form_params' => $formData,
            'http_errors' => $httpErrors
        ]);
    }
}
