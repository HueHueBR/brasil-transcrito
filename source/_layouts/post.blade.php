@extends('_layouts.master')

@section('head')
    <title>
        {{ $page->title }} | {{ $page->meta['title'] }}
    </title>
    
    <meta name="description" content="{{ $page->description }}">
    <meta name="keywords" content="{{ implode(',', $page->tags ?? []) }}">
    <meta name="author" content="{{ $page->baseUrl }}">
    <meta name="publisher" content="{{ $page->baseUrl }}">

    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ $page->description }}">
    <meta property="og:image" content="{{ $page->getBaseUrl() . $page->cover['url'] }}">
    <meta property="og:url" content="{{ $page->getUrl() }}">

    <meta name="twitter:card" content="{{ $page->meta['twitter']['card'] }}">
    <meta name="twitter:site" content="{{ $page->meta['twitter']['account'] }}">
    <meta name="twitter:creator" content="{{ $page->meta['twitter']['account'] }}">
    <meta name="twitter:title" content="{{ $page->title }}">
    <meta name="twitter:description" content="{{ $page->description }}">
    <meta name="twitter:image" content="{{ $page->getBaseUrl() . $page->cover['url'] }}">
    <meta name="twitter:url" content="{{ $page->getUrl() }}">

    <link rel="canonical" href="{{ $page->getUrl() }}">
@endsection

@section('body')
    @include('_partials.layout.header.navbar')

    @include('_partials.post.main')

    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js" async></script>
@endsection
