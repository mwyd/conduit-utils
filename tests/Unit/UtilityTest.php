<?php

use function ConduitUtils\format_hash_name;

it('formats hash name', function (string $hashName, string $phase, string $expected) {
    $formatted = format_hash_name($hashName, $phase);

    expect($formatted)->toBe($expected);
})->with([
    'phase 1' => ['Glock-18 | Gamma Doppler (Factory New)', 'Phase 1', 'Glock-18 | Gamma Doppler Phase 1 (Factory New)'],
    'phase 2' => ['Glock-18 | Gamma Doppler (Factory New)', 'Phase 2', 'Glock-18 | Gamma Doppler Phase 2 (Factory New)'],
    'phase 3' => ['Glock-18 | Gamma Doppler (Factory New)', 'Phase 3', 'Glock-18 | Gamma Doppler Phase 3 (Factory New)'],
    'phase 4' => ['Glock-18 | Gamma Doppler (Factory New)', 'Phase 4', 'Glock-18 | Gamma Doppler Phase 4 (Factory New)']
]);