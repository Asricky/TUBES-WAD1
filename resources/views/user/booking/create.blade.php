<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary-800 leading-tight">
            {{ __('Book Konsultasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass p-8 rounded-2xl">
                @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h4 class="font-bold text-red-800">Terjadi Kesalahan</h4>
                    </div>
                    <ul class="list-disc list-inside text-sm text-red-700">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                    <p class="text-red-700 font-medium">{{ session('error') }}</p>
                </div>
                @endif

                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-secondary-900 mb-2">Konfirmasi Booking</h3>
                    <p class="text-secondary-600">Pastikan detail jadwal sudah benar sebelum booking.</p>
                </div>

                <!-- Schedule Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-6">
                    <h4 class="font-semibold text-secondary-900 mb-4">Detail Jadwal</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-secondary-600">Konselor:</span>
                            <span class="font-semibold text-secondary-900">{{ $schedule->client->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-secondary-600">Tanggal:</span>
                            <span class="font-semibold text-secondary-900">{{ $schedule->date->format('d F Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-secondary-600">Waktu:</span>
                            <span class="font-semibold text-secondary-900">{{ $schedule->formatted_time }} WIB</span>
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <form action="{{ route('user.booking.store', $schedule) }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <!-- Topic Selection -->
                        <div>
                            <label for="topic_id" class="block text-sm font-bold text-secondary-700 mb-2">
                                Topik Konsultasi <span class="text-red-500">*</span>
                            </label>
                            <select name="topic_id" id="topic_id" required
                                class="w-full rounded-lg border-secondary-300 focus:border-primary-500 focus:ring-primary-500 @error('topic_id') border-red-500 @enderror">
                                <option value="">Pilih Topik</option>
                                @foreach($topics as $topic)
                                    <option value="{{ $topic->id }}" {{ old('topic_id') == $topic->id ? 'selected' : '' }}>
                                        {{ $topic->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('topic_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Summary -->
                        <div>
                            <label for="summary" class="block text-sm font-bold text-secondary-700 mb-2">
                                Deskripsi Masalah (Opsional)
                            </label>
                            <textarea name="summary" id="summary" rows="4" 
                                placeholder="Jelaskan singkat masalah atau hal yang ingin dikonsultasikan..."
                                class="w-full rounded-lg border-secondary-300 focus:border-primary-500 focus:ring-primary-500 @error('summary') border-red-500 @enderror">{{ old('summary') }}</textarea>
                            @error('summary')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-secondary-500">Maksimal 1000 karakter</p>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-4 pt-4">
                            <button type="submit" class="btn-primary flex-1">
                                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Konfirmasi Booking
                            </button>
                            <a href="{{ route('user.jadwal') }}" class="btn-secondary">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
