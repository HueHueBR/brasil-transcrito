<article class="content">
    @include('_partials.post.cover.main')
    @include('_partials.post.player')
    <section class="paragraphs-list">
        @yield('content')

        @include('_partials.post.commented')
    </section>

    @include('_partials.post.comments')

    @include('_partials.post.recommendations.main', [
        'recommendations' => $page->recommended ?? []
    ])
</article>
