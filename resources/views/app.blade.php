<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preload" as="image" href="/images/Header_welcome.avif" fetchpriority="high">
    <!-- Fonts -->

    <link rel="preload" as="font" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        type="font/woff2" crossorigin>
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <div id="app" data-page="{{ json_encode($page) }}">
        @inertia
    </div>

    @include('cookie-consent::dialogContents')

    <!-- Scripts -->

    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
