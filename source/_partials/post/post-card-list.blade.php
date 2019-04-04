@php
$hidden = $hidden ?? [];
$show = function (string $field) use ($hidden) {
    return !in_array($field, $hidden);
};

$field = function (string $name, string $value, ?int $size = null) use ($show) {
    if (false === $show($name)) {
        return null;
    }

    if ($size) {
        return substr($value, 0, $size) . '(...)';
    }

    return $value ?? null;
};
@endphp

@if(count($posts) > 0)
<section class="post-card-list">
    @if($title)
    <h1 class="post-card-list__title">
        {{ $title  }}
    </h1>
    @endif

    <ul class="post-card-list__list">
        @foreach($posts as $post)
            <li class="post-card-list__list-item">
                @include('_partials.post.post-card', [
                    'classes' => [
                        'post-card--no-padding',
                    ],
                    'post' => [
                        'url' => $field('url', $post->getUrl()) ?? '#',
                        'image' => $field('image', $page->baseUrl . $post->cover['url']),
                        'timestamp' => $field('timestamp', $post->date),
                        'title' => $field('title', $post->title),
                        'description' => $field('description', $post->description, 120),
                    ],
                ])
            </li>
        @endforeach
    </ul>
</section>
@endif
