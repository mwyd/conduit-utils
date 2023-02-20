<?php

namespace ConduitUtils\Api;

use Psr\Http\Message\ResponseInterface;

final class ShadowpayApi extends AbstractApi
{
    public function __construct(
        string $url,
        private readonly string $origin
    ) {
        parent::__construct($url);
    }

    public function isLogged(bool $httpErrors = false): ResponseInterface
    {
        return $this->client->get("market/is_logged", [
            'headers' => [
                'Accept' => 'application/json',
                'Origin' => $this->origin
            ],
            'http_errors' => $httpErrors
        ]);
    }

    public function getSteamItem(array $query = [], bool $httpErrors = false): ResponseInterface
    {
        return $this->client->get("v2/user/items/steam", [
            'headers' => [
                'Accept' => 'application/json',
                'Origin' => $this->origin
            ],
            'query' => $query,
            'http_errors' => $httpErrors
        ]);
    }
}
