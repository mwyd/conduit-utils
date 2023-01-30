<?php

namespace ConduitUtils\Api;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as HttpClient;

trait HasSteamMarketItems
{
    protected function getSteamMarketItems(array $query = [], bool $httpErrors = false): ResponseInterface
    {
        return (new HttpClient)->get($_ENV['STEAM_MARKET_API_URL'] . '/search/render/', [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query' => $query,
            'http_errors' => $httpErrors
        ]);
    }

    protected function getSteamMarketItemListings(string $hashName, string $appId, array $query = [], bool $httpErrors = false): ResponseInterface
    {
        return (new HttpClient)->get($_ENV['STEAM_MARKET_API_URL'] . "/listings/{$appId}/{$hashName}/render/", [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query' => $query,
            'http_errors' => $httpErrors
        ]);
    }
}