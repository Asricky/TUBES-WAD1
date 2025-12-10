<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-secondary-800">
            {{ __('Edit Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="glass p-8 rounded-2xl relative overflow-hidden">
                <div class="absolute -top-24 -right-12 w-64 h-64 bg-blue-400/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex items-center justify-between mb-8 relative z-10">
                    <div>
                        <h3 class="text-2xl font-bold text-secondary-900">Edit Jadwal</h3>
                        <p class="text-secondary-500 text-sm mt-1">Perbarui informasi jadwal konsultasi.</p>
                    </div>
                    <a href="{{ route('schedules.index') }}" class="btn-secondary flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                </div>

                <form action="{{ route('schedules.update', $schedule) }}" method="POST" class="space-y-6 relative z-10">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-2">
                        <label for="client_id" class="text-sm font-semibold text-secondary-700">Pilih Konselor <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="client_id" id="client_id" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-shadow appearance-none" required>
                                <option value="">-- Pilih Konselor --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $schedule->client_id) == $client->id ? 'selected' : '' }}>
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
                            <label for="date" class="text-sm font-semibold text-secondary-700">Tanggal <span class="text-red-500">*</span></label>
                            <input type="date" name="date" id="date" value="{{ old('date', $schedule->date->format('Y-m-d')) }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-shadow" required>
                            @error('date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="time" class="text-sm font-semibold text-secondary-700">Waktu <span class="text-red-500">*</span></label>
                            <input type="time" name="time" id="time" value="{{ old('time', $schedule->time->format('H:i')) }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-shadow" required>
                            @error('time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="status" class="text-sm font-semibold text-secondary-700">Status <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="status" id="status" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-shadow appearance-none" required>
                                <option value="pending" {{ old('status', $schedule->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status', $schedule->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ old('status', $schedule->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="completed" {{ old('status', $schedule->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="notes" class="text-sm font-semibold text-secondary-700">Catatan <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <textarea name="notes" id="notes" rows="3" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-shadow">{{ old('notes', $schedule->notes) }}</textarea>
                        @error('notes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('schedules.index') }}" class="btn-secondary">Batal</a>
                        <button type="submit" class="btn-primary bg-blue-600 hover:bg-blue-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Perbarui Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>