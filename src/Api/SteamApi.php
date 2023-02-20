<?php

namespace ConduitUtils\Api;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;

final class SteamApi extends AbstractApi
{
    public function getMarketItems(array $query = [], bool $httpErrors = false): ResponseInterface
    {
        return $this->client->get("search/render/", [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query' => $query,
            'http_errors' => $httpErrors
        ]);
    }

    public function getMarketItemListings(string $hashName, string $appId, array $query = [], bool $httpErrors = false): ResponseInterface
    {
        return $this->client->get("listings/{$appId}/{$hashName}/render/", [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query' => $query,
            'http_errors' => $httpErrors
        ]);
    }
}
