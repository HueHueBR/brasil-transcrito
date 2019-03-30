@if(count($recommendations) > 0)
<section class="recommended-episodes">
    <h1 class="recommended-episodes__title">{{ $title ?? 'Para você continuar entendendo' }}</h1>

    @include('_partials.post.episode-card-list', [
        'title' => '',
        'episodes' => $recommendations,
        'hidden' => ['description']
    ])
</section>
@endif
