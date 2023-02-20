<?php

namespace ConduitUtils\Api;

use GuzzleHttp\Client;

class AbstractApi
{
    protected Client $client;

    public function __construct(string $url)
    {
        $this->client = new Client([
            'base_url' => $url
        ]);
    }
}
