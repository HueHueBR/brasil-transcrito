@php
$favicon = function (string $size) use ($page): string {
    return $page->getBaseUrl() . '/assets/images/icons/favicon-' . $size . '.png';
};
@endphp

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $page->googleAnalyticsId }}"></script>
        <script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', '{{ $page->googleAnalyticsId }}');</script>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $page->googleTagManagerId }}');</script>
        <!-- End Google Tag Manager -->

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="theme-color" content="#169F2E">

        <link rel="icon" href="{{ $favicon('32x32') }}" size="32x32">
        <link rel="icon" href="{{ $favicon('192x192') }}" size="192x192">
        <link rel="apple-touch-icon-precomposed" href="{{ $favicon('180x180') }}">
        <meta name="msapplication-TileImage" content="{{ $favicon('270x270') }}" />

        @yield('head')
    </head>
    <body>
        @yield('body')
        @yield('footer')
    </body>
</html>
