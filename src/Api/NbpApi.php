<?php

namespace ConduitUtils\Api;

use Psr\Http\Message\ResponseInterface;

final class NbpApi extends AbstractApi
{
    public function getPlnExchangeRate(string $currencyIso, bool $httpErrors = false): ResponseInterface
    {
        return $this->client->get("exchangerates/rates/A/" . $currencyIso . "?format=json", [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http_errors' => $httpErrors
        ]);
    }
}
