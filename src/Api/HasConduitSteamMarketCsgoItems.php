<?php

namespace ConduitUtils\Api;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as HttpClient;

trait HasConduitSteamMarketCsgoItems
{
    protected function getConduitSteamMarketCsgoItems(array $query = [], bool $httpErrors = false) : ResponseInterface
    {
        return (new HttpClient)->get($_ENV['CONDUIT_API_URL'] . "/v1/steam-market-csgo-items", [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query'         => $query,
            'http_errors'   => $httpErrors
        ]);
    }

    protected function getConduitSteamMarketCsgoItem(string $hashName, bool $httpErrors = false) : ResponseInterface
    {
        return (new HttpClient)->get($_ENV['CONDUIT_API_URL'] . "/v1/steam-market-csgo-items/{$hashName}", [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http_errors' => $httpErrors
        ]);
    }

    protected function upsertConduitSteamMarketCsgoItem(array $formData, bool $httpErrors = false) : void
    {
        $res = $this->updateConduitSteamMarketCsgoItem($formData['hash_name'], [
            'volume'    => $formData['volume'],
            'price'     => $formData['price']
        ], $httpErrors);

        $data = json_decode(json: $res->getBody(), flags: \JSON_THROW_ON_ERROR);

        if(!$data->success && $data->error_message == 'not_found')
        {
            $this->createConduitSteamMarketCsgoItem($formData, $httpErrors);
        }
    }

    protected function createConduitSteamMarketCsgoItem(array $formData, bool $httpErrors = false) : ResponseInterface
    {
        return (new HttpClient)->post($_ENV['CONDUIT_API_URL'] . '/v1/steam-market-csgo-items', [
            'headers' => [
                'Authorization' => 'Bearer ' . $_ENV['CONDUIT_API_TOKEN'],
                'Accept' => 'application/json'
            ],
            'form_params' => $formData,
            'http_errors' => $httpErrors
        ]);
    }

    protected function updateConduitSteamMarketCsgoItem(string $hashName, array $formData, bool $httpErrors = false) : ResponseInterface
    {
        return (new HttpClient)->put($_ENV['CONDUIT_API_URL'] . "/v1/steam-market-csgo-items/{$hashName}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $_ENV['CONDUIT_API_TOKEN'],
                'Accept' => 'application/json'
            ],
            'form_params' => $formData,
            'http_errors' => $httpErrors
        ]);
    }
}