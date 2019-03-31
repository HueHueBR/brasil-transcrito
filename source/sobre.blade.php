@extends('_layouts.master')

@section('head')
    <title>Sobre o Brasil Transcrito</title>

    <meta name="description" content="{{ $page->meta['description'] }}">
    <meta name="author" content="{{ $page->baseUrl }}">
    <meta name="publisher" content="{{ $page->baseUrl }}">

    <meta name="og:title" content="{{ $page->meta['title'] }}">
    <meta name="og:description" content="{{ $page->meta['description'] }}">
    <meta name="og:image" content="{{ $page->baseUrl . $page->assets->logo }}">
    <meta name="og:url" content="{{ $page->baseUrl }}">

    <meta name="twitter:card" content="{{ $page->meta['twitter']['card'] }}">
    <meta name="twitter:site" content="{{ $page->meta['twitter']['account'] }}">
    <meta name="twitter:creator" content="{{ $page->meta['twitter']['account'] }}">
    <meta name="twitter:title" content="{{ $page->meta['title'] }}">
    <meta name="twitter:description" content="{{ $page->meta['description'] }}">
    <meta name="twitter:image" content="{{ $page->baseUrl . $page->assets->logo }}">
    <meta name="twitter:url" content="{{ $page->baseUrl }}">

    <link rel="canonical" href="{{ $page->baseUrl }}">

@section('body')
    @include('_partials.layout.header.navbar')

    <article class="content">
        <h1 class="heading heading__primary">
            Sobre o Brasil Transcrito
        </h1>

        <br>

        <section class="paragraphs-list">
            <p class="paragraph">
                O projeto <a href="{{ $page->getBaseUrl() }}">Brasil Transcrito</a> é um esforço independente para
                transcrever obras jornalísticas e documentos de algumas décadas atrás, disponíveis em forma digital
                porém não indexáveis por mecanismos de busca por se encontrarem no formato "imagem".
            </p>

            <p class="paragraph">
                Trata-se de um <strong>projeto acessível, gratuito e colaborativo</strong> para tornar disponível de
                forma simples para que internautas possam navegar pela história do Brasil.
            </p>

            <h2 class="heading heading__secondary">
                Direitos autorais e intelectuais
            </h2>
            <p class="paragraph">
                Os conteúdos disponíveis no site dentro da categoria
                <a href="{{ $page->getCategoryLink('transcricao') }}">Transcrição</a>
                são de autoria de terceiros, publicados em jornais e disponibilizados online. O o projeto Brasil
                Transcrito não alega possuir nenhum autoral ou intelectual em qualquer publicação dentro desta
                categoria.
            </p>
        </section>

    </article>


    @include('_partials.layout.sidemenu.sidemenu')
    @include('_partials.layout.footer.footer')

    <link rel="stylesheet" href="{{ $page->getBaseUrl() }}/assets/build/css/main.css">
    <script src="{{ $page->getBaseUrl() }}/assets/build/js/main.js" async></script>
@endsection
