<?php

namespace ConduitUtils\Api;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as HttpClient;

trait HasShadowpayMarket
{
    protected function shadowpayIsLogged(bool $httpErrors = false) : ResponseInterface
    {
        return (new HttpClient)->get($_ENV['SHADOWPAY_API_URL'] . '/market/is_logged', [
            'headers' => [
                'Accept' => 'application/json',
                'Origin' => $_ENV['SHADOWPAY_ORIGIN']
            ],
            'http_errors' => $httpErrors
        ]);
    }

    protected function getShadowpaySteamItem(array $query = [], bool $httpErrors = false) : ResponseInterface
    {
        return (new HttpClient)->get($_ENV['SHADOWPAY_API_URL'] . '/v2/user/items/steam', [
            'headers' => [
                'Accept'    => 'application/json',
                'Origin'    => $_ENV['SHADOWPAY_ORIGIN']
            ],
            'query'         => $query,
            'http_errors'   => $httpErrors
        ]);
    }
}