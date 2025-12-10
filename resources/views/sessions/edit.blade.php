<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-secondary-800">
            {{ __('Edit Sesi Konsultasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="glass p-8 rounded-2xl relative overflow-hidden">
                <div class="absolute -top-24 -right-12 w-64 h-64 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex items-center justify-between mb-8 relative z-10">
                    <div>
                        <h3 class="text-2xl font-bold text-secondary-900">Edit Sesi</h3>
                        <p class="text-secondary-500 text-sm mt-1">Perbarui informasi sesi konsultasi.</p>
                    </div>
                    <a href="{{ route('sessions.index') }}" class="btn-secondary flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                </div>

                <form action="{{ route('sessions.update', $session) }}" method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-2">
                        <label for="client_id" class="text-sm font-semibold text-secondary-700">Detail Konselor <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="client_id" id="client_id" class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 transition-shadow appearance-none" required>
                                <option value="">-- Pilih Konselor --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $session->client_id) == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }} ({{ $client->email }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('client_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="topic_id" class="text-sm font-semibold text-secondary-700">Topik Konsultasi <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="topic_id" id="topic_id" class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 transition-shadow appearance-none" required>
                                    <option value="">-- Pilih Topik --</option>
                                    @foreach($topics as $topic)
                                        <option value="{{ $topic->id }}" {{ old('topic_id', $session->topic_id) == $topic->id ? 'selected' : '' }}>
                                            {{ $topic->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                             @error('topic_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                         <div class="space-y-2">
                            <label for="schedule_id" class="text-sm font-semibold text-secondary-700">Jadwal Sesi <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="schedule_id" id="schedule_id" class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 transition-shadow appearance-none" required>
                                    <option value="">-- Pilih Jadwal --</option>
                                    @foreach($schedules as $schedule)
                                        <option value="{{ $schedule->id }}" {{ old('schedule_id', $session->schedule_id) == $schedule->id ? 'selected' : '' }}>
                                            {{ $schedule->date->format('d/m/Y') }} - {{ $schedule->time->format('H:i') }} ({{ $schedule->client->name }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                             @error('schedule_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                         <label for="status" class="text-sm font-semibold text-secondary-700">Status Sesi <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="status" id="status" class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 transition-shadow appearance-none" required>
                                    <option value="scheduled" {{ old('status', $session->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                    <option value="in_progress" {{ old('status', $session->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ old('status', $session->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status', $session->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                             @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="summary" class="text-sm font-semibold text-secondary-700">Ringkasan Sesi <span class="text-red-500">*</span></label>
                        <textarea name="summary" id="summary" rows="4" class="w-full rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 transition-shadow" required>{{ old('summary', $session->summary) }}</textarea>
                        @error('summary') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="notes" class="text-sm font-semibold text-secondary-700">Upload Catatan Baru <span class="text-gray-400 font-normal">(Biarkan kosong jika tidak ingin mengubah)</span></label>
                        <input type="file" name="notes" id="notes" accept=".pdf,.jpg,.jpeg,.png" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm text-secondary-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all">
                        @if($session->notes)
                            <div class="mt-2 text-xs text-emerald-600 bg-emerald-50 inline-block px-2 py-1 rounded border border-emerald-100">
                                File saat ini: {{ basename($session->notes) }}
                            </div>
                        @endif
                         @error('notes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('sessions.index') }}" class="btn-secondary">Batal</a>
                        <button type="submit" class="btn-primary bg-emerald-600 hover:bg-emerald-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Perbarui Sesi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>