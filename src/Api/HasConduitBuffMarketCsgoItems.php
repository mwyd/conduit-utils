<?php

namespace ConduitUtils\Api;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as HttpClient;

trait HasConduitBuffMarketCsgoItems
{
    protected function getConduitBuffMarketCsgoItems(array $query = [], bool $httpErrors = false) : ResponseInterface
    {
        return (new HttpClient)->get($_ENV['CONDUIT_API_URL'] . "/v1/buff-market-csgo-items", [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query'         => $query,
            'http_errors'   => $httpErrors
        ]);
    }

    protected function updateConduitBuffMarketCsgoItem(string $hashName, array $formData, bool $httpErrors = false) : ResponseInterface
    {
        return (new HttpClient)->put($_ENV['CONDUIT_API_URL'] . "/v1/buff-market-csgo-items/{$hashName}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $_ENV['CONDUIT_API_TOKEN'],
                'Accept' => 'application/json'
            ],
            'form_params' => $formData,
            'http_errors' => $httpErrors
        ]);
    }
}