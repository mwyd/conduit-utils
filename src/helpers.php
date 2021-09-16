<?php

function array_find_index(array $haystack, \Closure $callback) : int|string
{
    foreach($haystack as $key => $needle)
    {
        if($callback($needle)) return $key;
    }

    return -1;
}

function format_hash_name(string $hashName, string $phase) : string
{
    return str_replace('(', "{$phase} (", $hashName);
}