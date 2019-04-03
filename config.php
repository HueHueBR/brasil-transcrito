<?php

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

return [
    'production' => false,
    'baseUrl' => 'http://localhost:3000',
    'googleAnalyticsId' => 'GA-TEST-ID',
    'googleTagManagerId' => 'GTM-TEST-ID',
    'meta' => require __DIR__ . '/config/meta.php',
    'feed' => require __DIR__ . '/config/feed.php',
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
    'collections' => [
        'posts' => [
            'path' => new \BrasilTranscrito\Slug\Post(),
            'sort' => ['-date'],
        ],
    ],

    // Helper methods
    'url' => new \BrasilTranscrito\Helper\Url(),
    'getCategoryLink' => function (\TightenCo\Jigsaw\PageVariable $page, string $name) {
        return $page->getBaseUrl() . '/categoria/' . $name;
    },

    'assets' => [
        'logo' => '/assets/images/logo.png',
        'icons' => [
            'menu' => '/assets/images/icons/menu.svg',
        ],
    ],
];
