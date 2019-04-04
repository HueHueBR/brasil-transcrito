@if(count($recommendations) > 0)
<section class="recommended-episodes">
    <h1 class="recommended-episodes__title">{{ $title ?? 'Relacionados a esta publicação' }}</h1>

    @include('_partials.post.post-card-list', [
        'title' => '',
        'posts' => $recommendations,
        'hidden' => ['description']
    ])
</section>
@endif
