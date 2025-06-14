@extends('layouts.main')

@section('content')
<div class="p-6 space-y-10 bg-gray-50 min-h-screen">

    {{-- Stat Cards (Larger Version) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $stats = [
                ['icon' => 'users', 'color' => 'blue', 'label' => 'Total Klien', 'value' => \App\Models\Client::count()],
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
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Jadwal Konsultasi Terbaru --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 pb-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
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
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Klien</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(\App\Models\Schedule::with('client')->latest()->take(5)->get() as $schedule)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">{{ $schedule->client->name }}</div>
                                        <div class="text-gray-500 text-xs">{{ $schedule->client->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-gray-900 flex items-center">
                                    <i class="far fa-calendar-alt mr-2 text-blue-500"></i>
                                    {{ $schedule->date->format('d/m/Y') }} {{ $schedule->time->format('H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{
                                    $schedule->status == 'confirmed' ? 'bg-blue-100 text-blue-800' :
                                    ($schedule->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                    ($schedule->status == 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'))
                                }}">
                                    {{ ucfirst($schedule->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('schedules.show', $schedule) }}" class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200 hover:text-blue-800 transition-all duration-200" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 bg-gray-50 text-right text-sm border-t border-gray-100">
                <a href="{{ route('schedules.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                    <span>Lihat Semua Jadwal</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        {{-- Sesi Konsultasi Terbaru --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 pb-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <div class="p-2 bg-purple-100 rounded-lg text-purple-600">
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
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Klien</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Topik</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach(\App\Models\Session::with(['client', 'topic', 'schedule'])->latest()->take(5)->get() as $session)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">{{ $session->client->name }}</div>
                                        <div class="text-gray-500 text-xs">{{ $session->client->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-gray-900 flex items-center">
                                    <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                                    {{ $session->topic->name }}
                                </div>
                                <div class="text-gray-500 text-xs mt-1 flex items-center">
                                    <i class="far fa-calendar-alt mr-2 text-blue-500"></i>
                                    {{ $session->schedule->date->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{
                                    $session->status == 'scheduled' ? 'bg-purple-100 text-purple-800' :
                                    ($session->status == 'completed' ? 'bg-green-100 text-green-800' :
                                    ($session->status == 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'))
                                }}">
                                    {{ ucfirst($session->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('sessions.show', $session) }}" class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200 hover:text-blue-800 transition-all duration-200" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 bg-gray-50 text-right text-sm border-t border-gray-100">
                <a href="{{ route('sessions.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                    <span>Lihat Semua Sesi</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection