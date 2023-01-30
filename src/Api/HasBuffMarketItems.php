<?php

namespace ConduitUtils\Api;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as HttpClient;

trait HasBuffMarketItems
{
    protected function getBuffMarketItemListings(array $query = [], bool $httpErrors = false): ResponseInterface
    {
        return (new HttpClient)->get($_ENV['BUFF_MARKET_API_URL'] . "/goods/sell_order", [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query' => $query,
            'http_errors' => $httpErrors
        ]);
    }
}