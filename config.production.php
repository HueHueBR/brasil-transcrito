<?php

$config = [
    'production' => true,
    'baseUrl' => 'https://brasiltranscrito.huehue.eu',
];

return array_merge(
    $config,
    require __DIR__ . '/config/google-analytics.production.php',
    [
        'meta' => require __DIR__ . '/config/meta.production.php',
    ]
);
