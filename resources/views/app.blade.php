<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
    @if (isset($page['props']['servicesJsonLd']))
        <script type="application/ld+json">
            {!! json_encode(
                $page['props']['servicesJsonLd'],
                JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
            ) !!}
        </script>
    @endif

    @if (isset($page['props']['howToJsonLd']))
        <script type="application/ld+json">
            {!! json_encode(
                $page['props']['howToJsonLd'],
                JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
            ) !!}
        </script>
    @endif
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
