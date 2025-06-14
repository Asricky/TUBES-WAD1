@extends('layouts.main')

@section('content')
<div class="p-6 space-y-6 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-user-edit text-xl"></i>
                </div>
                Edit Data Konselor
            </h1>
            <p class="text-gray-600 mt-1">Perbarui informasi Konselor dalam database</p>
        </div>
        <a href="{{ route('clients.index') }}" 
           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl border border-gray-200 hover:bg-gray-200 hover:shadow-lg transform hover:-translate-y-1 transition-all duration-200">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar
        </a>
    </div>

    {{-- Main Form Card --}}
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        {{-- Card Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
            <div class="flex items-center gap-3 text-white">
                <i class="fas fa-edit text-xl"></i>
                <div>
                    <h2 class="text-xl font-semibold">Formulir Edit Data Konselor</h2>
                    <p class="text-blue-100 text-sm">Pastikan semua informasi yang diperbarui akurat</p>
                </div>
            </div>
        </div>

        {{-- Form Content --}}
        <div class="p-8">
            <form action="{{ route('clients.update', $client) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')
                
                {{-- Personal Information Section --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Personal</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        {{-- Name Field --}}
                        <div class="form-group">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-blue-500 mr-2"></i>
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('name') border-red-300 ring-2 ring-red-200 @enderror" 
                                       value="{{ old('name', $client->name) }}" 
                                       placeholder="Masukkan nama lengkap Konselor"
                                       required>
                                <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                            @error('name')
                                <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Email Field --}}
                        <div class="form-group">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope text-green-500 mr-2"></i>
                                Alamat Email <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('email') border-red-300 ring-2 ring-red-200 @enderror" 
                                       value="{{ old('email', $client->email) }}" 
                                       placeholder="contoh@email.com"
                                       required>
                                <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                            @error('email')
                                <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Contact Information Section --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-phone text-purple-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Kontak</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        {{-- Phone Field --}}
                        <div class="form-group">
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-purple-500 mr-2"></i>
                                Nomor Telepon <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       name="phone" 
                                       id="phone" 
                                       class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('phone') border-red-300 ring-2 ring-red-200 @enderror" 
                                       value="{{ old('phone', $client->phone) }}" 
                                       placeholder="08xxxxxxxxxx"
                                       required>
                                <i class="fas fa-phone absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                            @error('phone')
                                <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Address Field --}}
                        <div class="form-group">
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <textarea name="address" 
                                          id="address" 
                                          rows="4" 
                                          class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none @error('address') border-red-300 ring-2 ring-red-200 @enderror" 
                                          placeholder="Masukkan alamat lengkap Konselor..."
                                          required>{{ old('address', $client->address) }}</textarea>
                                <i class="fas fa-map-marker-alt absolute left-4 top-4 text-gray-400"></i>
                            </div>
                            @error('address')
                                <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Additional Information Section --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-sticky-note text-amber-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Tambahan</h3>
                    </div>

                    <div class="form-group">
                        <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-sticky-note text-amber-500 mr-2"></i>
                            Catatan <span class="text-gray-400 text-xs">(Opsional)</span>
                        </label>
                        <div class="relative">
                            <textarea name="notes" 
                                      id="notes" 
                                      rows="4" 
                                      class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none @error('notes') is-invalid @enderror" 
                                      placeholder="Tambahkan catatan khusus untuk Konselor ini...">{{ old('notes', $client->notes) }}</textarea>
                            <i class="fas fa-sticky-note absolute left-4 top-4 text-gray-400"></i>
                        </div>
                        @error('notes')
                            <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Schedule & Session Information Section --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Konsultasi</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        {{-- Schedule Field --}}
                        <div class="form-group">
                            <label for="schedule" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-calendar text-green-500 mr-2"></i>
                                Jadwal Konsultasi <span class="text-gray-400 text-xs">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <input type="datetime-local" 
                                       name="schedule[]" 
                                       id="schedule" 
                                       class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                       value="{{ old('schedule', $client->schedules->first()->date ?? '') }}">
                                <i class="fas fa-calendar absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        {{-- Session Field --}}
                        <div class="form-group">
                            <label for="session" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-clipboard text-teal-500 mr-2"></i>
                                Riwayat Konsultasi <span class="text-gray-400 text-xs">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <textarea name="session[]" 
                                          id="session" 
                                          rows="4" 
                                          class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" 
                                          placeholder="Tambahkan catatan riwayat konsultasi...">{{ old('session', $client->sessions->first()->notes ?? '') }}</textarea>
                                <i class="fas fa-clipboard absolute left-4 top-4 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('clients.index') }}" 
                       class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-gray-100 text-gray-700 font-semibold rounded-xl border border-gray-200 hover:bg-gray-200 hover:shadow-lg transform hover:-translate-y-1 transition-all duration-200">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-blue-800 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

{{-- Custom Styles --}}
<style>
    /* Enhanced form styling */
    .form-group input:focus,
    .form-group textarea:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        transform: translateY(-1px);
    }
    
    /* Smooth animations */
    .form-group {
        transition: all 0.2s ease;
    }
    
    .form-group:hover {
        transform: translateY(-1px);
    }
    
    /* Custom scrollbar for textareas */
    textarea::-webkit-scrollbar {
        width: 4px;
    }
    
    textarea::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    
    textarea::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    
    textarea::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* Responsive improvements */
    @media (max-width: 640px) {
        .p-8 {
            padding: 1.5rem;
        }
        
        .gap-6 {
            gap: 1rem;
        }
    }
</style>
@endsection