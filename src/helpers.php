<?php

declare(strict_types=1);

namespace ConduitUtils;

use Dotenv\Dotenv;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

function format_hash_name(string $hashName, string $phase): string
{
    return str_replace('(', "{$phase} (", $hashName);
}

function create_logger(string $name, string $file): LoggerInterface
{
    $logger = new Logger($name);
    $logger->pushHandler(new StreamHandler($file));

    return $logger;
}

function env(string $key, mixed $default = null): mixed
{
    return $_ENV[$key] ?? $default;
}

function load_env(string $path): void
{
    $dotenv = Dotenv::createImmutable($path);
    $dotenv->load();
}
