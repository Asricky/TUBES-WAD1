<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary-800 leading-tight">
            {{ __('Dashboard Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-primary-600 to-blue-600 rounded-3xl shadow-xl p-8 text-white relative overflow-hidden animate-fade-in">
                <div class="absolute inset-0 bg-white/10 backdrop-blur-3xl opacity-20"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-blue-100 text-lg max-w-2xl">
                        Kelola jadwal konsultasi Anda dengan mudah dan efisien.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('user.jadwal') }}" class="inline-block px-6 py-3 bg-white text-primary-700 font-semibold rounded-xl shadow-lg hover:bg-blue-50 transition-all duration-300">
                            Lihat Jadwal Tersedia
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Sessions -->
                <div class="glass p-6 rounded-2xl border-l-4 border-primary-500">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-primary-100 rounded-xl text-primary-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <span class="text-3xl font-bold text-secondary-900">{{ $totalSessions }}</span>
                    </div>
                    <h4 class="text-sm font-semibold text-secondary-500 uppercase tracking-wider">Total Konsultasi</h4>
                </div>

                <!-- Completed Sessions -->
                <div class="glass p-6 rounded-2xl border-l-4 border-emerald-500">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-emerald-100 rounded-xl text-emerald-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-3xl font-bold text-secondary-900">{{ $completedSessions }}</span>
                    </div>
                    <h4 class="text-sm font-semibold text-secondary-500 uppercase tracking-wider">Selesai</h4>
                </div>

                <!-- Upcoming Schedules -->
                <div class="glass p-6 rounded-2xl border-l-4 border-blue-500">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-100 rounded-xl text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-3xl font-bold text-secondary-900">{{ $upcomingSchedules }}</span>
                    </div>
                    <h4 class="text-sm font-semibold text-secondary-500 uppercase tracking-wider">Jadwal Mendatang</h4>
                </div>

                <!-- This Month -->
                <div class="glass p-6 rounded-2xl border-l-4 border-violet-500">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-violet-100 rounded-xl text-violet-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-3xl font-bold text-secondary-900">{{ $thisMonthSessions }}</span>
                    </div>
                    <h4 class="text-sm font-semibold text-secondary-500 uppercase tracking-wider">Bulan Ini</h4>
                </div>
            </div>

            <!-- Upcoming Sessions -->
            @if($upcomingSessions->count() > 0)
            <div class="glass rounded-2xl p-6">
                <h4 class="text-lg font-bold text-secondary-800 mb-4 flex items-center gap-2">
                    <span class="w-2 h-8 bg-blue-500 rounded-full"></span>
                    Jadwal Konsultasi Mendatang
                </h4>
                <div class="space-y-4">
                    @foreach($upcomingSessions as $session)
                    <div class="bg-white border border-gray-100 rounded-xl p-5 hover:shadow-md transition-all">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-secondary-900">{{ $session->client->name }}</h5>
                                    <p class="text-sm text-secondary-500">{{ $session->topic->name }}</p>
                                    <p class="text-xs text-secondary-400 mt-1">
                                        {{ $session->schedule->date->format('d M Y') }} • {{ $session->schedule->formatted_time }} WIB
                                    </p>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                {{ ucfirst($session->status) }}
                            </span>
                        </div>

                        @if($session->meet_link)
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            @if($session->canAccessMeetLink())
                                <div class="flex items-center justify-between gap-3">
                                    <a href="{{ $session->meet_link }}" target="_blank" class="flex-1 btn-primary text-center text-sm py-3">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        Join Meeting
                                    </a>
                                    <form action="{{ route('user.booking.cancel', $session) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin membatalkan booking ini?');">
                                        @csrf
                                        <button type="submit" class="btn-secondary text-sm py-3 px-4">
                                            Cancel
                                        </button>
                                    </form>
                                </div>
                            @else
                                @php
                                    $meetInfo = $session->getMeetingTimeInfo();
                                    $accessFrom = $meetInfo['access_from'];
                                @endphp
                                <div class="flex items-center justify-between gap-3">
                                    <div class="flex-1 bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-center">
                                        <p class="text-xs text-gray-500 mb-1.5">Link meeting tersedia mulai:</p>
                                        <p class="text-sm font-semibold text-gray-700">{{ $accessFrom->format('d M Y, H:i') }} WIB</p>
                                    </div>
                                    <form action="{{ route('user.booking.cancel', $session) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin membatalkan booking ini?');">
                                        @csrf
                                        <button type="submit" class="btn-secondary text-sm py-3 px-4">
                                            Cancel
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Recent Sessions -->
            @if($recentSessions->count() > 0)
            <div class="glass rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-bold text-secondary-800 flex items-center gap-2">
                        <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                        Riwayat Konsultasi Terakhir
                    </h4>
                    <a href="{{ route('user.riwayat') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                        Lihat Semua →
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="text-xs text-secondary-500 uppercase bg-secondary-50/50">
                            <tr>
                                <th class="px-4 py-3 text-left">Konselor</th>
                                <th class="px-4 py-3 text-left">Topik</th>
                                <th class="px-4 py-3 text-left">Tanggal</th>
                                <th class="px-4 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($recentSessions as $session)
                            <tr class="hover:bg-secondary-50/50 transition-colors">
                                <td class="px-4 py-3 font-medium text-secondary-900">{{ $session->client->name }}</td>
                                <td class="px-4 py-3 text-secondary-600">{{ $session->topic->name }}</td>
                                <td class="px-4 py-3 text-secondary-500">{{ $session->schedule->date->format('d M Y') }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusClasses = [
                                            'completed' => 'bg-green-100 text-green-700',
                                            'cancelled' => 'bg-red-100 text-red-700',
                                            'booked' => 'bg-blue-100 text-blue-700',
                                            'in_progress' => 'bg-orange-100 text-orange-700',
                                        ];
                                    @endphp
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$session->status] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ ucfirst($session->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="glass rounded-2xl p-12 text-center">
                <div class="p-4 bg-gray-50 rounded-full inline-block mb-4">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-secondary-900 mb-2">Belum Ada Konsultasi</h3>
                <p class="text-secondary-600 mb-6">Mulai booking jadwal konsultasi untuk mendapatkan dukungan.</p>
                <a href="{{ route('user.jadwal') }}" class="btn-primary">
                    Lihat Jadwal Tersedia
                </a>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
