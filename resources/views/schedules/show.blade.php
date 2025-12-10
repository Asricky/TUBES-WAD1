<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-secondary-800">
            {{ __('Detail Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <!-- Schedule Card -->
            <div class="glass p-8 rounded-2xl relative overflow-hidden">
                 <div class="absolute -top-24 -right-12 w-64 h-64 bg-blue-400/10 rounded-full blur-3xl pointer-events-none"></div>
                 
                 <div class="relative z-10 flex flex-col md:flex-row gap-8 items-start">
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-lg flex items-center justify-center text-white flex-col">
                             <div class="text-2xl font-bold">{{ $schedule->date->format('d') }}</div>
                             <div class="text-xs uppercase tracking-wider">{{ $schedule->date->format('M') }}</div>
                        </div>
                    </div>
                    <div class="flex-grow space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-2xl font-bold text-secondary-900">Jadwal Konsultasi</h3>
                                <p class="text-secondary-500 flex items-center gap-2 mt-1">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $schedule->client->name }}
                                </p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('schedules.edit', $schedule) }}" class="btn-secondary text-sm">
                                    Edit
                                </a>
                                <a href="{{ route('schedules.index') }}" class="btn-secondary text-sm">
                                    Kembali
                                </a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4 border-t border-gray-100">
                            <div>
                                <h4 class="text-sm font-semibold text-secondary-500 uppercase tracking-wider mb-1">Waktu</h4>
                                <div class="flex items-center gap-2 text-secondary-800 font-medium">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $schedule->formatted_time }} WIB
                                </div>
                            </div>
                            
                            <div>
                                <h4 class="text-sm font-semibold text-secondary-500 uppercase tracking-wider mb-1">Status</h4>
                                @php
                                    $statusClasses = [
                                        'completed' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                        'confirmed' => 'bg-blue-100 text-blue-700',
                                        'pending' => 'bg-yellow-100 text-yellow-700'
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$schedule->status] ?? 'bg-gray-100' }}">
                                    {{ ucfirst($schedule->status) }}
                                </span>
                            </div>

                             <div>
                                <h4 class="text-sm font-semibold text-secondary-500 uppercase tracking-wider mb-1">Kontak Konselor</h4>
                                <div class="text-sm text-secondary-700">
                                    {{ $schedule->client->email }}
                                </div>
                            </div>
                        </div>
                        
                        @if($schedule->notes)
                        <div class="pt-4 border-t border-gray-100">
                             <h4 class="text-sm font-semibold text-secondary-500 uppercase tracking-wider mb-2">Catatan</h4>
                             <p class="text-secondary-700 bg-secondary-50 p-3 rounded-lg">{{ $schedule->notes }}</p>
                        </div>
                        @endif
                    </div>
                 </div>
            </div>

            <!-- Linked Session -->
            @if($schedule->session)
            <div class="glass p-6 rounded-2xl">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-bold text-secondary-800 flex items-center gap-2">
                            <span class="w-2 h-6 bg-green-500 rounded-full"></span>
                            Sesi Terkait
                    </h4>
                    <a href="{{ route('sessions.show', $schedule->session) }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium hover:underline">
                        Lihat Detail Sesi &rarr;
                    </a>
                </div>
                
                <div class="bg-white border border-gray-100 rounded-xl p-4 flex items-center justify-between">
                    <div>
                        <div class="text-sm text-secondary-500 mb-1">Topik</div>
                        <div class="font-bold text-secondary-900">{{ $schedule->session->topic->name }}</div>
                    </div>
                    <div>
                         <div class="text-sm text-secondary-500 mb-1">Status Sesi</div>
                         <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">
                            {{ ucfirst($schedule->session->status) }}
                         </span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>