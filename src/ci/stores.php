<?php

declare(strict_types = 1);

$stores = [];

$stores['DE'] = [
    'queuePools' => [
        'synchronizationPool' => [
            'DE-connection',
        ],
    ],
    'locales' => [
        'de' => 'de_DE',
    ],
    'countries' => [
        'DE',
        'AT',
        'NO',
        'CH',
        'ES',
        'GB',
    ],
];
$stores['AT']['queuePools']['synchronizationPool'] = ['DE-connection'];
$stores['US']['queuePools']['synchronizationPool'] = ['DE-connection'];

return $stores;
