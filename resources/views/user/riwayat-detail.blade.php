<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-secondary-800 leading-tight">
                {{ __('Detail Konsultasi') }}
            </h2>
            <a href="{{ route('user.riwayat') }}" class="btn-secondary text-sm">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Session Detail Card -->
            <div class="glass p-8 rounded-2xl relative overflow-hidden mb-6">
                <div class="absolute -top-24 -right-12 w-64 h-64 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="relative z-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="text-xs font-bold text-secondary-400 uppercase tracking-wider mb-2">Konselor</h4>
                            <p class="text-lg font-semibold text-secondary-900">{{ $session->client->name }}</p>
                            <p class="text-sm text-secondary-500">{{ $session->client->email }}</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-secondary-400 uppercase tracking-wider mb-2">Topik</h4>
                            <span class="inline-block bg-violet-50 text-violet-700 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $session->topic->name }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6 border-t border-gray-100">
                        <div>
                            <h4 class="text-xs font-bold text-secondary-400 uppercase tracking-wider mb-1">Tanggal</h4>
                            <div class="flex items-center gap-2 text-secondary-800 font-medium">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $session->schedule->date->format('d M Y') }}
                            </div>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-secondary-400 uppercase tracking-wider mb-1">Waktu</h4>
                            <div class="flex items-center gap-2 text-secondary-800 font-medium">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $session->schedule->formatted_time }} WIB
                            </div>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-secondary-400 uppercase tracking-wider mb-1">Status</h4>
                            @php
                                $statusClasses = [
                                    'completed' => 'bg-green-100 text-green-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                    'booked' => 'bg-blue-100 text-blue-700',
                                    'in_progress' => 'bg-orange-100 text-orange-700',
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$session->status] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst(str_replace('_', ' ', $session->status)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meet Link Section -->
            @if($session->meet_link)
            <div class="glass p-6 rounded-2xl mb-6">
                <h4 class="text-lg font-bold text-secondary-800 mb-4 flex items-center gap-2">
                    <span class="w-2 h-6 bg-purple-500 rounded-full"></span>
                    Link Meeting
                </h4>
                
                @if($session->canAccessMeetLink())
                    <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="font-semibold text-green-900">Meeting tersedia sekarang!</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ $session->meet_link }}" target="_blank" class="flex-1 btn-primary text-center py-3">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                Join Meeting
                            </a>
                            @if($session->status === 'booked')
                            <form action="{{ route('user.booking.cancel', $session) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan booking ini?');">
                                @csrf
                                <button type="submit" class="btn-secondary py-3 px-6">Cancel Booking</button>
                            </form>
                            @endif
                        </div>
                    </div>
                @elseif($session->status === 'booked')
                    @php
                        $meetInfo = $session->getMeetingTimeInfo();
                    @endphp
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex-1">
                                <p class="text-sm text-blue-800 mb-2">Link meeting akan tersedia pada:</p>
                                <p class="text-lg font-bold text-blue-900">{{ $meetInfo['access_from']->format('d M Y, H:i') }} WIB</p>
                                <p class="text-xs text-blue-600 mt-1.5">(15 menit sebelum jadwal dimulai)</p>
                            </div>
                        </div>
                        <form action="{{ route('user.booking.cancel', $session) }}" method="POST" class="mt-4" onsubmit="return confirm('Yakin ingin membatalkan booking ini?');">
                            @csrf
                            <button type="submit" class="btn-secondary w-full py-3">Cancel Booking</button>
                        </form>
                    </div>
                @elseif($session->status === 'completed')
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 text-center">
                        <p class="text-gray-600 py-2">Konsultasi telah selesai.</p>
                    </div>
                @elseif($session->status === 'cancelled')
                    <div class="bg-red-50 border border-red-200 rounded-xl p-5 text-center">
                        <p class="text-red-600 font-semibold py-2">Booking telah dibatalkan.</p>
                    </div>
                @endif
            </div>
            @endif

            <!-- Summary -->
            @if($session->summary)
            <div class="glass p-6 rounded-2xl mb-6">
                <h4 class="text-lg font-bold text-secondary-800 mb-4 flex items-center gap-2">
                    <span class="w-2 h-6 bg-orange-500 rounded-full"></span>
                    Ringkasan
                </h4>
                <div class="bg-orange-50/50 p-4 rounded-xl border border-orange-100 text-secondary-800 leading-relaxed">
                    {{ $session->summary }}
                </div>
            </div>
            @endif

            <!-- Notes -->
            @if($session->notes)
            <div class="glass p-6 rounded-2xl">
                <h4 class="text-lg font-bold text-secondary-800 mb-4 flex items-center gap-2">
                    <span class="w-2 h-6 bg-blue-500 rounded-full"></span>
                    Catatan Konselor
                </h4>
                <div class="bg-secondary-50 p-4 rounded-xl border border-secondary-200">
                    @php
                        $extension = pathinfo($session->notes, PATHINFO_EXTENSION);
                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                        $isPdf = strtolower($extension) === 'pdf';
                    @endphp

                    @if($isImage)
                        <img src="{{ Storage::url($session->notes) }}" alt="Catatan" class="max-w-full h-auto rounded-lg shadow-sm border border-gray-200">
                    @elseif($isPdf)
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe src="{{ Storage::url($session->notes) }}" class="w-full h-[500px] rounded-lg border border-gray-200"></iframe>
                        </div>
                        <div class="mt-2 text-right">
                            <a href="{{ Storage::url($session->notes) }}" target="_blank" class="text-sm text-blue-600 hover:underline">Buka PDF di tab baru &nearr;</a>
                        </div>
                    @else
                        <div class="flex items-center gap-4 p-4 bg-white rounded-lg border border-gray-200">
                            <div class="p-3 bg-gray-100 rounded-lg">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">File Lampiran</p>
                                <a href="{{ Storage::url($session->notes) }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 font-medium hover:underline">
                                    Download File
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
