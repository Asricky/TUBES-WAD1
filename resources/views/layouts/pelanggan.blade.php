<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- Jika pakai Laravel Mix --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
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
