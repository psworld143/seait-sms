<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'SEAIT'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom Styles -->
    <style>
        :root {
            --seait-dark: #1a365d;
            --seait-orange: #ed8936;
            --seait-blue: #3182ce;
        }
        
        .text-seait-dark { color: var(--seait-dark); }
        .text-seait-orange { color: var(--seait-orange); }
        .text-seait-blue { color: var(--seait-blue); }
        
        .bg-seait-dark { background-color: var(--seait-dark); }
        .bg-seait-orange { background-color: var(--seait-orange); }
        .bg-seait-blue { background-color: var(--seait-blue); }
    </style>
</head>
<body class="font-sans antialiased">
    <div id="app">
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.footer')
    </div>

    @stack('scripts')
</body>
</html>
