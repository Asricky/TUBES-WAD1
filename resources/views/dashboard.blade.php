@extends('layouts.main')

@section('content')
<div class="p-6 space-y-10 bg-gray-50 min-h-screen">

    {{-- Header --}}
   <div class="relative w-full h-56 rounded-xl overflow-hidden shadow">
    <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=1200&q=80"
         alt="Konseling Background"
         class="absolute inset-0 w-full h-full object-cover brightness-75">

    <div class="relative z-10 flex flex-col justify-center items-start h-full px-6 md:px-10">
        <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-md">Dashboard Konselor</h1>
        <p class="text-white mt-2 text-sm md:text-base drop-shadow-md">Selamat datang kembali! Pantau aktivitas terbaru di bawah ini.</p>
    </div>
</div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-stat-card icon="users" color="blue" label="Total Klien" :value="\App\Models\Client::count()" />
        <x-stat-card icon="calendar-day" color="green" label="Jadwal Hari Ini" :value="\App\Models\Schedule::whereDate('date', today())->count()" />
        <x-stat-card icon="comments" color="purple" label="Total Sesi" :value="\App\Models\Session::count()" />
        <x-stat-card icon="tags" color="yellow" label="Total Topik" :value="\App\Models\Topic::count()" />
    </div>

    {{-- Jadwal Konsultasi Terbaru --}}
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-calendar text-blue-500"></i> Jadwal Konsultasi Terbaru
            </h2>
            <a href="{{ route('schedules.index') }}" class="text-blue-600 text-sm hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-600 font-semibold text-left">
                    <tr>
                        <th class="px-4 py-2">Klien</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Waktu</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @foreach(\App\Models\Schedule::with('client')->latest()->take(5)->get() as $schedule)
                    <tr>
                        <td class="px-4 py-2">
                            <div class="font-medium text-gray-800">{{ $schedule->client->name }}</div>
                            <div class="text-gray-500 text-xs">{{ $schedule->client->email }}</div>
                        </td>
                        <td class="px-4 py-2">{{ $schedule->date->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">{{ $schedule->time->format('H:i') }}</td>
                        <td class="px-4 py-2">
                            <x-status-badge :status="$schedule->status" />
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('schedules.show', $schedule) }}" class="text-blue-600 hover:underline">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Sesi Konsultasi Terbaru --}}
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-comments text-purple-500"></i> Sesi Konsultasi Terbaru
            </h2>
            <a href="{{ route('sessions.index') }}" class="text-blue-600 text-sm hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-600 font-semibold text-left">
                    <tr>
                        <th class="px-4 py-2">Klien</th>
                        <th class="px-4 py-2">Topik</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @foreach(\App\Models\Session::with(['client', 'topic', 'schedule'])->latest()->take(5)->get() as $session)
                    <tr>
                        <td class="px-4 py-2">
                            <div class="font-medium text-gray-800">{{ $session->client->name }}</div>
                            <div class="text-gray-500 text-xs">{{ $session->client->email }}</div>
                        </td>
                        <td class="px-4 py-2">{{ $session->topic->name }}</td>
                        <td class="px-4 py-2">
                            <x-status-badge :status="$session->status" />
                        </td>
                        <td class="px-4 py-2">{{ $session->schedule->date->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('sessions.show', $session) }}" class="text-blue-600 hover:underline">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
