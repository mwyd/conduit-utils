<?php

namespace ConduitUtils\Api;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as HttpClient;

trait HasNbpExchangeRates
{
    protected function getPlnExchangeRate(string $currencyIso, bool $httpErrors = false) : ResponseInterface
    {
        return (new HttpClient)->get($_ENV['NPB_EXCHANGE_RATES_API_URL'] . "/rates/A/" . $currencyIso . "?format=json", [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http_errors'   => $httpErrors
        ]);
    }
}