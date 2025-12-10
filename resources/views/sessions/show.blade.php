<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-secondary-800">
            {{ __('Detail Sesi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <!-- Session Card -->
            <div class="glass p-8 rounded-2xl relative overflow-hidden">
                 <div class="absolute -top-24 -right-12 w-64 h-64 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
                 
                 <div class="relative z-10 flex flex-col md:flex-row gap-8 items-start">
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl shadow-lg flex items-center justify-center text-white flex-col">
                             <div class="text-2xl font-bold">{{ $session->schedule->date->format('d') }}</div>
                             <div class="text-xs uppercase tracking-wider">{{ $session->schedule->date->format('M') }}</div>
                        </div>
                    </div>
                    <div class="flex-grow space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-2xl font-bold text-secondary-900">Sesi Konsultasi</h3>
                                <p class="text-secondary-500 flex items-center gap-2 mt-1">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $session->client->name }}
                                </p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('sessions.edit', $session) }}" class="btn-secondary text-sm">
                                    Edit
                                </a>
                                <a href="{{ route('sessions.index') }}" class="btn-secondary text-sm">
                                    Kembali
                                </a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-4 border-t border-gray-100">
                            <div>
                                <h4 class="text-xs font-bold text-secondary-400 uppercase tracking-wider mb-1">Topik</h4>
                                <div class="text-sm font-semibold bg-violet-50 text-violet-700 px-3 py-1 rounded-full inline-block">
                                   {{ $session->topic->name }}
                                </div>
                            </div>

                            <div>
                                <h4 class="text-xs font-bold text-secondary-400 uppercase tracking-wider mb-1">Waktu</h4>
                                <div class="flex items-center gap-2 text-secondary-800 font-medium">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $session->schedule->time->format('H:i') }} WIB
                                </div>
                            </div>
                            
                            <div>
                                <h4 class="text-xs font-bold text-secondary-400 uppercase tracking-wider mb-1">Status</h4>
                                @php
                                    $statusClasses = [
                                        'completed' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                        'in_progress' => 'bg-blue-100 text-blue-700',
                                        'scheduled' => 'bg-yellow-100 text-yellow-700'
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$session->status] ?? 'bg-gray-100' }}">
                                    {{ ucfirst(str_replace('_', ' ', $session->status)) }}
                                </span>
                            </div>

                             <div>
                                <h4 class="text-xs font-bold text-secondary-400 uppercase tracking-wider mb-1">Email Konselor</h4>
                                <div class="text-sm text-secondary-700 truncate" title="{{ $session->client->email }}">
                                    {{ $session->client->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Summary & Notes -->
                <div class="lg:col-span-2 space-y-6">
                     <div class="glass p-6 rounded-2xl">
                        <h4 class="text-lg font-bold text-secondary-800 mb-4 flex items-center gap-2">
                             <span class="w-2 h-6 bg-orange-500 rounded-full"></span>
                             Ringkasan Sesi
                        </h4>
                        <div class="bg-orange-50/50 p-4 rounded-xl border border-orange-100 text-secondary-800 leading-relaxed">
                            {{ $session->summary }}
                        </div>
                     </div>

                     @if($session->notes)
                     <div class="glass p-6 rounded-2xl">
                        <h4 class="text-lg font-bold text-secondary-800 mb-4 flex items-center gap-2">
                             <span class="w-2 h-6 bg-blue-500 rounded-full"></span>
                             File Catatan / Dokumen
                        </h4>
                        
                        <div class="bg-secondary-50 p-4 rounded-xl border border-secondary-200">
                            @php
                                $extension = pathinfo($session->notes, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                $isPdf = strtolower($extension) === 'pdf';
                            @endphp

                            @if($isImage)
                                <img src="{{ Storage::url($session->notes) }}" alt="Catatan Sesi" class="max-w-full h-auto rounded-lg shadow-sm border border-gray-200">
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

                <!-- Attachments List (Future Proofing) -->
                @if($session->attachments && $session->attachments->count() > 0)
                <div class="lg:col-span-1">
                    <div class="glass p-6 rounded-2xl">
                        <h4 class="text-lg font-bold text-secondary-800 mb-4 flex items-center gap-2">
                             <span class="w-2 h-6 bg-purple-500 rounded-full"></span>
                             Lampiran Lain
                        </h4>
                        <div class="space-y-3">
                            @foreach($session->attachments as $attachment)
                            <div class="flex items-center justify-between p-3 bg-white border border-gray-100 rounded-xl hover:shadow-sm transition-all">
                                <div class="flex items-center gap-3 overflow-hidden">
                                     <div class="p-2 bg-purple-50 text-purple-600 rounded-lg flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-sm font-medium text-secondary-900 truncate">{{ $attachment->name }}</div>
                                        <div class="text-xs text-secondary-500">{{ $attachment->file_size ?? 'Unknown size' }}</div>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($attachment->path) }}" target="_blank" class="text-secondary-400 hover:text-primary-600" title="Download">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0l-4 4m4-4v12"></path></svg>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
