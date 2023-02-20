<?php

namespace ConduitUtils\Api;

use Psr\Http\Message\ResponseInterface;

final class BuffApi extends AbstractApi
{
    public function getMarketItemListings(array $query = [], bool $httpErrors = false): ResponseInterface
    {
        return $this->client->get("goods/sell_order", [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'query' => $query,
            'http_errors' => $httpErrors
        ]);
    }
}
