<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-secondary-800">
            {{ __('Detail Konselor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Card -->
            <div class="glass p-8 rounded-2xl relative overflow-hidden">
                 <div class="absolute -top-24 -right-12 w-64 h-64 bg-primary-400/10 rounded-full blur-3xl pointer-events-none"></div>
                 
                 <div class="relative z-10 flex flex-col md:flex-row gap-8 items-start">
                    <div class="flex-shrink-0">
                        <div class="w-32 h-32 bg-gradient-to-br from-primary-500 to-indigo-600 rounded-2xl shadow-lg flex items-center justify-center text-white text-5xl font-bold">
                             {{ strtoupper(substr($client->name, 0, 1)) }}
                        </div>
                    </div>
                    <div class="flex-grow space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-3xl font-bold text-secondary-900">{{ $client->name }}</h3>
                                <p class="text-secondary-500 flex items-center gap-2 mt-1">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    {{ $client->email }}
                                </p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('clients.edit', $client) }}" class="btn-secondary text-sm">
                                    Edit Profil
                                </a>
                                <a href="{{ route('clients.index') }}" class="btn-secondary text-sm">
                                    Kembali
                                </a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                            <div>
                                <h4 class="text-sm font-semibold text-secondary-500 uppercase tracking-wider mb-1">Informasi Kontak</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-3 text-secondary-800">
                                        <div class="p-2 bg-violet-100 text-violet-600 rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        </div>
                                        <span>{{ $client->phone }}</span>
                                    </div>
                                     <div class="flex items-start gap-3 text-secondary-800">
                                        <div class="p-2 bg-red-100 text-red-600 rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <span>{{ $client->address }}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-secondary-500 uppercase tracking-wider mb-1">Catatan Tambahan</h4>
                                <p class="text-secondary-700 bg-secondary-50 p-4 rounded-xl border border-secondary-100 h-full">
                                    {{ $client->notes ?? 'Tidak ada catatan tambahan.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Schedules -->
                <div class="glass p-6 rounded-2xl">
                     <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-bold text-secondary-800 flex items-center gap-2">
                             <span class="w-2 h-6 bg-blue-500 rounded-full"></span>
                             Jadwal Konsultasi
                        </h4>
                    </div>
                    
                    @if($client->schedules->count() > 0)
                        <div class="space-y-3">
                            @foreach($client->schedules as $schedule)
                                <div class="flex items-center justify-between p-3 bg-white border border-gray-100 rounded-xl hover:shadow-sm transition-all">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div>
                                            <div class="font-medium text-secondary-900">{{ $schedule->date->format('d M Y') }}</div>
                                            <div class="text-xs text-secondary-500">{{ $schedule->time->format('H:i') }} WIB</div>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">{{ ucfirst($schedule->status) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-secondary-400">
                             <p>Belum ada jadwal.</p>
                        </div>
                    @endif
                </div>

                <!-- Sessions -->
                <div class="glass p-6 rounded-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-bold text-secondary-800 flex items-center gap-2">
                             <span class="w-2 h-6 bg-emerald-500 rounded-full"></span>
                             Riwayat Sesi
                        </h4>
                    </div>

                    @if($client->sessions->count() > 0)
                        <div class="space-y-3">
                            @foreach($client->sessions as $session)
                                <div class="flex items-center justify-between p-3 bg-white border border-gray-100 rounded-xl hover:shadow-sm transition-all">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                                        </div>
                                        <div>
                                            <div class="font-medium text-secondary-900">{{ $session->topic->name }}</div>
                                            <div class="text-xs text-secondary-500">{{ $session->created_at->format('d M Y') }}</div>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $session->status === 'completed' ? 'bg-green-100 text-green-700' : 
                                           ($session->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                        {{ ucfirst($session->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-secondary-400">
                             <p>Belum ada sesi.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
