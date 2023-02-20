<?php

namespace ConduitUtils\Api;

use Psr\Http\Message\ResponseInterface;

final class ConduitApi extends AbstractApi
{
    public function __construct(
        string $url,
        private readonly ?string $token = null
    ) {
        parent::__construct($url);
    }

    public function getBuffMarketCsgoItems(array $query = [], bool $httpErrors = false): ResponseInterface
    {
        return $this->client->get("v1/buff-market-csgo-items", [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query' => $query,
            'http_errors' => $httpErrors
        ]);
    }

    public function updateBuffMarketCsgoItem(string $hashName, array $formData, bool $httpErrors = false): ResponseInterface
    {
        return $this->client->put("v1/buff-market-csgo-items/{$hashName}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json'
            ],
            'form_params' => $formData,
            'http_errors' => $httpErrors
        ]);
    }

    public function getSteamMarketCsgoItems(array $query = [], bool $httpErrors = false): ResponseInterface
    {
        return $this->client->get("v1/steam-market-csgo-items", [
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

    public function upsertSteamMarketCsgoItem(array $formData, bool $httpErrors = false): void
    {
        $res = $this->updateSteamMarketCsgoItem($formData['hash_name'], [
            'volume' => $formData['volume'],
            'price' => $formData['price']
        ], $httpErrors);

        $data = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

        if (!$data->success && $data->error_message == 'not_found') {
            $this->createSteamMarketCsgoItem($formData, $httpErrors);
        }
    }

    public function createSteamMarketCsgoItem(array $formData, bool $httpErrors = false): ResponseInterface
    {
        return $this->client->post("v1/steam-market-csgo-items", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json'
            ],
            'form_params' => $formData,
            'http_errors' => $httpErrors
        ]);
    }

    public function updateSteamMarketCsgoItem(string $hashName, array $formData, bool $httpErrors = false): ResponseInterface
    {
        return $this->client->put("v1/steam-market-csgo-items/{$hashName}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json'
            ],
            'form_params' => $formData,
            'http_errors' => $httpErrors
        ]);
    }

    public function createShadowpaySoldItem(array $formData, bool $httpErrors = false): ResponseInterface
    {
        return $this->client->post("v1/shadowpay-sold-items", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json'
            ],
            'form_params' => $formData,
            'http_errors' => $httpErrors
        ]);
    }
}
