<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <Link rel="icon" href="{{ asset('images/logo_telu.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-secondary-900 antialiased bg-secondary-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="animate-slide-up">
                <a href="/">
                    <x-application-logo class="w-24 h-24 fill-current text-primary-600 drop-shadow-lg" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-8 py-8 bg-white/80 backdrop-blur-xl shadow-2xl overflow-hidden sm:rounded-2xl border border-white/40 transform transition-all hover:scale-[1.01]">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
