<?php

require __DIR__ . "/vendor/autoload.php";

use ConduitUtils\Agent\BmAgent;

use ConduitUtils\Api\BuffApi;
use ConduitUtils\Api\ConduitApi;
use ConduitUtils\Api\NbpApi;

use function ConduitUtils\{create_logger, env, load_env};

//TODO: implement container
//TODO: build bootstrap
//TODO: tests? :V

$logger = create_logger('buff-agent', 'log/buff_agent.log');

set_exception_handler(function (\Throwable $e) use ($logger) {
    $logger->error($e->getMessage(), [
        'exception' => $e
    ]);
});

load_env(__DIR__);

$ws = new BmAgent(
    $logger,
    new NbpApi(env('NPB_EXCHANGE_RATES_API_URL')),
    new ConduitApi(env('CONDUIT_API_URL'), env('CONDUIT_API_TOKEN')),
    new BuffApi(env('BUFF_MARKET_API_URL')),
    [
        'start' => 0,
        'per_page' => 50,
        'limit' => 20000,
        'request_delay' => 20
    ]
);

$ws->run();