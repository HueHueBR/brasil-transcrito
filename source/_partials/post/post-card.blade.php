<a title="{{ $post['title'] }}" role="article" href="{{ $post['url'] ?? '#' }}" class="post-card {{ implode(' ', array_filter($classes ?? [], 'is_string')) }}">
    @if($post['image'])
        <div class="post-card__cover-container">
            @include('_partials.components.image', [
                'url' => $post['image'],
                'alt' => $post['title'],
                'title' => $post['title'],
                'classes' => array_merge([
                    'post-card__cover',
                ], $classes['image'] ?? []),
            ])
        </div>
    @endif

    @if($post['title'])
    <h2 class="post-card__title">
        {{ $post['title'] }}
    </h2>
    @endif

    @if($post['timestamp'])
    <time  class="post-card__release-date" datetime="{{ date('Y-m-d', $post['timestamp']) }}">
        {{ strftime('%d de %B de %Y', $post['timestamp']) }}
    </time>
    @endif

    @if($post['description'])
    <p class="paragraph paragraph--justified">{{ $post['description'] }}</p>
    @endif
</a>
