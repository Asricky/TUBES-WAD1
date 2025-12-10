<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Tell2U') }}</title>
        <Link rel="icon" href="{{ asset('images/tell2u_logo.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="font-sans antialiased text-secondary-900 bg-secondary-50">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/50 backdrop-blur-sm shadow-sm border-b border-white/20">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <footer class="bg-white border-t border-gray-100 py-6 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-secondary-400 text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Tell2U') }}. All rights reserved.
                </div>
            </footer>
        </div>
    </body>
</html>
