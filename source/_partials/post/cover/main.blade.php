<header class="episode__cover">
    @include('_partials.components.image', [
        'url' => $page->getBaseUrl() . $page->cover['url'],
        'alt' => $page->cover['title'],
        'title' => $page->cover['title'],
        'classes' => [
            'episode__cover__image'
        ],
    ])

    <h1 class="heading heading__primary">
        {{ $page->title }}
    </h1>

    <small class="episode__cover__details">
        <time property="na:datePublished" datetime="{{ $page->date }}" pubdate="pubdate">
            {{ date('d \d\e F \d\e Y', $page->date) }}
        </time>
        | em <a class="episode__cover__details--bold link" href="{{ $page->baseUrl }}/categoria/{{ strtolower($page->category) }}">{{ $page->category }}</a>
    </small>
</header>
