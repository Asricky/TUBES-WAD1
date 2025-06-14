@extends('layouts.main')

@section('content')
<div class="min-h-screen p-6 space-y-10 bg-gray-50">

    <div class="stats-grid">
        <!-- Total Konselor -->
        <div class="stat-card">
            <div class="stat-label">
                <i class="fas fa-users icon"></i>
                Total Konselor 
            </div>
            <div class="stat-value">{{ \App\Models\Client::count() }}</div>
        </div>

        <!-- Jadwal Hari Ini -->
        <div class="stat-card">
            <div class="stat-label">
                <i class="fas fa-calendar-day icon"></i>
                Jadwal Hari Ini
            </div>
            <div class="stat-value">{{ \App\Models\Schedule::whereDate('date', today())->count() }}</div>
        </div>

        <!-- Total Sesi -->
        <div class="stat-card">
            <div class="stat-label">
                <i class="fas fa-comments icon"></i>
                Total Sesi Konsultasi
            </div>
            <div class="stat-value">{{ \App\Models\Session::count() }}</div>
        </div>

        <!-- Total Topik -->
        <div class="stat-card">
            <div class="stat-label">
                <i class="fas fa-tags icon"></i>
                Total Topik
            </div>
            <div class="stat-value">{{ \App\Models\Topic::count() }}</div>
        </div>
    </div>

    {{-- Stat Cards (Larger Version) --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @php
            $stats = [
                ['icon' => 'users', 'color' => 'blue', 'label' => 'Total Konselor', 'value' => \App\Models\Client::count()],
                ['icon' => 'calendar-day', 'color' => 'green', 'label' => 'Jadwal Hari Ini', 'value' => \App\Models\Schedule::whereDate('date', today())->count()],
                ['icon' => 'comments', 'color' => 'purple', 'label' => 'Total Sesi', 'value' => \App\Models\Session::count()],
                ['icon' => 'tags', 'color' => 'yellow', 'label' => 'Total Topik', 'value' => \App\Models\Topic::count()],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-6 border border-gray-100 hover:border-{{ $stat['color'] }}-200">
                <div class="text-4xl text-{{ $stat['color'] }}-500">
                    <i class="fas fa-{{ $stat['icon'] }}"></i>
                </div>
                <div>
                    <div class="text-lg text-gray-500">{{ $stat['label'] }}</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $stat['value'] }}</div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Side-by-side Tables --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        {{-- Jadwal Konsultasi Terbaru --}}
        <div class="overflow-hidden bg-white shadow-md rounded-xl">
            <div class="p-6 pb-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="flex items-center gap-3 text-xl font-bold text-gray-800">
                        <div class="p-2 text-blue-600 bg-blue-100 rounded-lg">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <span>Jadwal Konsultasi Terbaru</span>
                    </h2>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th>Konselor</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(\App\Models\Schedule::with('client')->latest()->take(5)->get() as $schedule)
                        <tr>
                            <td>
                                <div class="font-medium">{{ $schedule->client->name }}</div>
                                <div class="text-sm text-gray-500">{{ $schedule->client->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center text-gray-900">
                                    <i class="mr-2 text-blue-500 far fa-calendar-alt"></i>
                                    {{ $schedule->date->format('d M Y') }}
                                </div>
                                <div class="flex items-center mt-1 text-sm text-gray-500">
                                    <i class="mr-2 text-green-500 far fa-clock"></i>
                                    {{ $schedule->time->format('H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-status-badge :status="$schedule->status" />
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <a href="{{ route('schedules.show', $schedule) }}" class="inline-flex items-center justify-center w-8 h-8 text-blue-600 transition-all duration-200 bg-blue-100 rounded-full hover:bg-blue-200 hover:text-blue-800" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 text-sm text-right border-t border-gray-100 bg-gray-50">
                <a href="{{ route('schedules.index') }}" class="inline-flex items-center font-medium text-blue-600 transition-colors duration-200 hover:text-blue-800">
                    <span>Lihat Semua Jadwal</span>
                    <i class="ml-2 fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Sesi Konsultasi Terbaru --}}
        <div class="overflow-hidden bg-white shadow-md rounded-xl">
            <div class="p-6 pb-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="flex items-center gap-3 text-xl font-bold text-gray-800">
                        <div class="p-2 text-purple-600 bg-purple-100 rounded-lg">
                            <i class="fas fa-comments"></i>
                        </div>
                        <span>Sesi Konsultasi Terbaru</span>
                    </h2>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase">Konselor</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase">Topik</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold tracking-wider text-right text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(\App\Models\Session::with(['client', 'topic', 'schedule'])->latest()->take(5)->get() as $session)
                        <tr class="transition-colors duration-150 hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-purple-600 bg-purple-100 rounded-full">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">{{ $session->client->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $session->client->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center text-gray-900">
                                    <i class="mr-2 text-yellow-500 fas fa-lightbulb"></i>
                                    {{ $session->topic->name }}
                                </div>
                                <div class="flex items-center mt-1 text-xs text-gray-500">
                                    <i class="mr-2 text-blue-500 far fa-calendar-alt"></i>
                                    {{ $session->schedule->date->format('d M Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-status-badge :status="$session->status" />
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <a href="{{ route('sessions.show', $session) }}" class="inline-flex items-center justify-center w-8 h-8 text-blue-600 transition-all duration-200 bg-blue-100 rounded-full hover:bg-blue-200 hover:text-blue-800" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 text-sm text-right border-t border-gray-100 bg-gray-50">
                <a href="{{ route('sessions.index') }}" class="inline-flex items-center font-medium text-blue-600 transition-colors duration-200 hover:text-blue-800">
                    <span>Lihat Semua Sesi</span>
                    <i class="ml-2 fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Sesi Terbaru -->
    <div class="content-card">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fas fa-comments icon"></i>
                Sesi Konsultasi Terbaru
            </h2>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Konsoler</th>
                            <th>Topik</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Session::with(['client', 'topic', 'schedule'])->latest()->take(5)->get() as $session)
                        <tr>
                            <td>
                                <div class="font-medium">{{ $session->client->name }}</div>
                                <div class="text-sm text-gray-500">{{ $session->client->email }}</div>
                            </td>
                            <td>{{ $session->topic->name }}</td>
                            <td>
                                <span class="status-badge {{ 
                                    $session->status == 'completed' ? 'status-completed' :
                                    ($session->status == 'cancelled' ? 'status-cancelled' :
                                    ($session->status == 'in_progress' ? 'status-confirmed' : 'status-pending'))
                                }}">
                                    {{ ucfirst($session->status) }}
                                </span>
                            </td>
                            <td>{{ $session->schedule->date->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('sessions.show', $session) }}" class="btn-action btn-secondary">
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
</div>
@endsection