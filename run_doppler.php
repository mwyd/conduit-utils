<?php

require __DIR__ . "/vendor/autoload.php";

use ConduitUtils\Agent\SdAgent;
use ConduitUtils\Api\ConduitApi;
use ConduitUtils\Api\SteamApi;

use function ConduitUtils\{create_logger, env, load_env};

$logger = create_logger('doppler-agent', 'log/doppler_agent.log');

set_exception_handler(function (\Throwable $e) use ($logger) {
    $logger->error($e->getMessage(), [
        'exception' => $e
    ]);
});

load_env(__DIR__);

$ws = new SdAgent(
    $logger,
    new ConduitApi(env('CONDUIT_API_URL'), env('CONDUIT_API_TOKEN')),
    new SteamApi(env('STEAM_MARKET_API_URL')),
    [
        'start' => 0,
        'per_page' => 10,
        'limit' => 50,
        'page_delay' => 10,
        'request_delay' => 60
    ]
);

$ws->run();