<a title="{{ $post['title'] }}" role="article" href="{{ $post['url'] ?? '#' }}" class="post-card-compact">
    <div class="post-card-compact__cover-container">
        <div class="post-card-compact__cover-image-container">
            @if($post['image'])
                @include('_partials.components.image', [
                    'url' => $post['image'],
                    'alt' => $post['title'],
                    'title' => $post['title'],
                    'classes' => [
                        'post-card-compact__cover-image'
                    ],
                ])
            @endif
        </div>

        <div class="post-card-compact__description-container">
            @if($post['title'])
            <h2 class="post-card-compact__title">
                {{ $post['title'] }}
            </h2>
            @endif

            @if($post['timestamp'])
            <time  class="post-card-compact__release-date" datetime="{{ date('Y-m-d', $post['timestamp']) }}">
                {{ strftime('%d de %B de %Y', $post['timestamp']) }}
            </time>
            @endif

        </div>
    </div>

    @if($post['description'])
    <p class="paragraph">{{ $post['description'] }}</p>
    @endif
</a>
