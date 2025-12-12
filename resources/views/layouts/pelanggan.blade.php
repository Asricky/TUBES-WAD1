<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Pelanggan - Tell2U</title>
    <Link rel="icon" href="{{ asset('images/tell2u_logo.png') }}" type="image/png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="bg-blue-600 text-white p-4 shadow">
        <div class="container mx-auto flex justify-between">
            <div>
                <a href="{{ route('pelanggan.dashboard') }}" class="font-bold text-lg">Dashboard Pelanggan</a>
            </div>
            <div>
                <a href="{{ route('pelanggan.dashboard') }}" class="mr-4">Dashboard</a>
                <a href="{{ route('pelanggan.jadwal') }}" class="mr-4">Jadwal</a>
                <a href="{{ route('pelanggan.status') }}" class="mr-4">Status</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="underline">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>
