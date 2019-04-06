<?php

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

$config = [
    'production' => false,
    'baseUrl' => 'http://localhost:3000',
    'menu' => [
        'items' => [
            'Sobre' => '/sobre',
//            'Todos' => '/categoria/todos',
            'Transcrições' => '/categoria/transcricao',
        ],
        'social' => [
//            'Facebook' => 'https://www.facebook.com/Brasil Transcrito',
//            'Instagram' => 'https://www.instagram.com/Brasil Transcrito',
//            'Twitter' => 'https://www.twitter.com/Brasil Transcrito',
        ],
    ],
    'assets' => [
        'logo' => '/assets/images/logo.png',
        'icons' => [
            'menu' => '/assets/images/icons/menu.svg',
        ],
    ],
];

return array_merge(
    $config,
    require __DIR__ . '/config/functions.php',
    require __DIR__ . '/config/google-analytics.php',
    [
        'meta' => require __DIR__ . '/config/meta.php',
        'feed' => require __DIR__ . '/config/feed.php',
        'collections' => require __DIR__ . '/config/collections.php',
    ]
);
