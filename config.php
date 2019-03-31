<?php

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

return [
    'production' => false,
    'baseUrl' => 'http://192.168.178.42:3000',
    'googleAnalyticsId' => 'GA-TEST-ID',
    'googleTagManagerId' => 'GTM-TEST-ID',
    'meta' => [
        'creatorName' => 'Brasil Transcrito',
        'title' => 'Brasil Transcrito',
        'subtitle' => '',
        'description' => 'Brasil Transcrito',
        'category' => 'Science &amp; Medicine',
        'image' => 'http://Brasil Transcrito.com/wp-content/uploads/powerpress/favcom.png',
        'email' => 'amdnsk@gmail.com',
        'twitter' => [
            'card' => 'summary_large_image',
            'account' => '@BrasilTranscrito',
        ],
        'schemas' => [
            'author' => [
                '@type' => 'Organization',
                'name' => 'Brasil Transcrito',
                'logo' => 'http://Brasil Transcrito.com/wp-content/uploads/powerpress/favcom.png',
                'contactPoint' => [
                    'email' => 'aquiehbrporra@gmail.com',
                    'contactType' => 'Customer Service',
                ],
                'sameAs' => [
                    'https://www.facebook.com/Brasil Transcrito',
                    'https://www.instagram.com/Brasil Transcrito',
                    'https://www.twitter.com/Brasil Transcrito',
                    'https://www.linkedin.com/company/Brasil Transcrito',
                ],
            ],
        ],
    ],
    'menu' => [
        'items' => [
            'Sobre' => '/sobre',
            'Todos' => '/categoria/todos',
            'Transcrições' => '/categoria/transcricao',
            'News' => '/categoria/news',
            'Drops' => '/categoria/drops',
        ],
        'social' => [
            'Facebook' => 'https://www.facebook.com/Brasil Transcrito',
            'Instagram' => 'https://www.instagram.com/Brasil Transcrito',
            'Twitter' => 'https://www.twitter.com/Brasil Transcrito',
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
