<section class="content">
    <h1 class="heading heading__primary">
        Última Transcrição
    </h1>

    @include('_partials.post.post-card', [
        'post' => [
            'title' => $latestPost->title,
            'description' => $latestPost->description,
            'url' => $latestPost->getUrl(),
            'image' => $latestPost->cover['url'],
            'timestamp' => $latestPost->date,
        ],
    ])

    @include('_partials.post.recommendations.main', [
       'title' => 'Transcrições',
       'recommendations' => $latestTranscriptions,
    ])
</section>
