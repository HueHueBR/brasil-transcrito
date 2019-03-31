@php
$episodes = [
    'Entrevistas' => $latestEpisodesPerCategory['Entrevista'],
    'Drops' => $latestEpisodesPerCategory['Drops'],
    'News' => $latestEpisodesPerCategory['News'],
];

@endphp

<section class="content">
    <h1 class="heading heading__primary">
        Última Transcrição
    </h1>

    @include('_partials.post.episode-card', [
        'episode' => [
            'title' => $latestPost->title,
            'description' => $latestPost->description,
            'url' => $latestPost->getUrl(),
            'image' => $latestPost->cover['url'],
            'timestamp' => $latestPost->date,
        ],
    ])
</section>
