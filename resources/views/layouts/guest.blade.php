<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-C48T62CFEM"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-C48T62CFEM');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $blogname->option_value }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        @include('navigations.guest_nav')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-screen-xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{-- {{ $header }} --}}
                <h1>{{ $blogname->option_value }} - {{ $blogdescription->option_value }} </h1>
            </div>
        </header>

        <!-- Page Content -->
        <div class="py-12">
            <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
