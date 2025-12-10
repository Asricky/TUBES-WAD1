<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-secondary-800">
            {{ __('Tambah Konselor Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="glass p-8 rounded-2xl relative overflow-hidden">
                <!-- Background Decoration -->
                <div class="absolute -top-24 -right-12 w-64 h-64 bg-primary-400/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex items-center justify-between mb-8 relative z-10">
                    <div>
                        <h3 class="text-2xl font-bold text-secondary-900">Formulir Data Konselor</h3>
                        <p class="text-secondary-500 text-sm mt-1">Lengkapi informasi di bawah ini untuk menambahkan konselor baru.</p>
                    </div>
                    <a href="{{ route('clients.index') }}" class="btn-secondary flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                </div>

                <form action="{{ route('clients.store') }}" method="POST" class="space-y-6 relative z-10">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-semibold text-secondary-700">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full rounded-xl border-gray-200 focus:border-primary-500 focus:ring-primary-500 transition-shadow" placeholder="Nama lengkap konselor" required>
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-semibold text-secondary-700">Alamat Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full rounded-xl border-gray-200 focus:border-primary-500 focus:ring-primary-500 transition-shadow" placeholder="email@contoh.com" required>
                             @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Telepon -->
                        <div class="space-y-2">
                            <label for="phone" class="text-sm font-semibold text-secondary-700">Nomor Telepon <span class="text-red-500">*</span></label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="w-full rounded-xl border-gray-200 focus:border-primary-500 focus:ring-primary-500 transition-shadow" placeholder="08xxxxxxxxxx" required>
                             @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="space-y-2">
                        <label for="address" class="text-sm font-semibold text-secondary-700">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="address" id="address" rows="3" class="w-full rounded-xl border-gray-200 focus:border-primary-500 focus:ring-primary-500 transition-shadow" placeholder="Alamat domisili saat ini" required>{{ old('address') }}</textarea>
                         @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Catatan -->
                    <div class="space-y-2">
                        <label for="notes" class="text-sm font-semibold text-secondary-700">Catatan <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <textarea name="notes" id="notes" rows="3" class="w-full rounded-xl border-gray-200 focus:border-primary-500 focus:ring-primary-500 transition-shadow" placeholder="Catatan tambahan...">{{ old('notes') }}</textarea>
                         @error('notes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('clients.index') }}" class="btn-secondary">Batal</a>
                        <button type="submit" class="btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>