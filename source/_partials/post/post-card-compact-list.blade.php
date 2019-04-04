@php
$hidden = $hidden ?? [];
$show = function (string $field) use ($hidden) {
    return !in_array($field, $hidden);
};

$field = function (string $name, string $value, string $default = '') use ($show) {
    if (false === $show($name)) {
        return null;
    }

    return $value ? $value : $default;
};
@endphp

@if(count($posts) > 0)
<section class="post-card-compact-list">
    @if($title)
    <h1 class="post-card-compact-list__title post-card-compact-list__title--separated">
        {{ $title }}
    </h1>
    @endif

    <ul class="post-card-compact-list__list">
        @foreach($posts as $post)
            <li>
                @include('_partials.post.post-card-compact', [
                    'episode' => [
                        'url' => $field('url', $post->getUrl(), '#'),
                        'image' => $field('image', $page->baseUrl . $post->cover['url']),
                        'timestamp' => $field('timestamp', $post->date),
                        'title' => $field(
                            'title',
                            "{$post->title}"
                        ),
                        'description' => $field('description', $post->description),
                    ],
                ])
            </li>
        @endforeach
    </ul>
</section>
@endif
