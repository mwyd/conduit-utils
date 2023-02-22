<?php

use function ConduitUtils\load_env;

uses()
    ->beforeAll(function () {
        load_env(__DIR__ . '/../');
    })
    ->in('Integration/Api');
