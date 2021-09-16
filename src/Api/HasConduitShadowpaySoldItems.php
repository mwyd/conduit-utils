<?php

namespace ConduitUtils\Api;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as HttpClient;

trait HasConduitShadowpaySoldItems
{
    protected function createConduitShadowpaySoldItem(array $formData, bool $httpErrors = false) : ResponseInterface
    {
        return (new HttpClient)->post($_ENV['CONDUIT_API_URL'] . '/v1/shadowpay-sold-items', [
            'headers' => [
                'Authorization' => 'Bearer ' . $_ENV['CONDUIT_API_TOKEN'],
                'Accept' => 'application/json'
            ],
            'form_params'   => $formData,
            'http_errors'   => $httpErrors
        ]);
    }
}