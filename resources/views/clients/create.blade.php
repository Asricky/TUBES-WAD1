 <!-- create Konselor -->
@extends('layouts.main')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex items-center justify-between">
            <h1 class="dashboard-title">Tambah Konselor Baru</h1>
            <a href="{{ route('clients.index') }}" class="btn-action btn-secondary">
                <i class="fas fa-arrow-left icon"></i>
                Kembali
            </a>
        </div>
        <a href="{{ route('clients.index') }}" 
           class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-gray-700 transition-all duration-200 transform bg-gray-100 border border-gray-200 rounded-xl hover:bg-gray-200 hover:shadow-lg hover:-translate-y-1">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar
        </a>
    </div>

    {{-- Main Form Card --}}
    <div class="overflow-hidden bg-white border border-gray-100 shadow-xl rounded-2xl">
        {{-- Card Header --}}
        <div class="px-8 py-6 bg-gradient-to-r from-blue-600 to-blue-700">
            <div class="flex items-center gap-3 text-white">
                <i class="text-xl fas fa-edit"></i>
                <div>
                    <h2 class="text-xl font-semibold">Formulir Data Konselor</h2>
                    <p class="text-sm text-blue-100">Pastikan semua informasi yang dimasukkan akurat</p>
                </div>
            </div>
        </div>

        {{-- Form Content --}}
        <div class="p-8">
            <form action="{{ route('clients.store') }}" method="POST" class="space-y-8">
                @csrf
                
                {{-- Personal Information Section --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-lg">
                            <i class="text-blue-600 fas fa-user"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Personal</h3>
                    </div>

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        {{-- Name Field --}}
                        <div class="form-group">
                            <label for="name" class="block mb-2 text-sm font-semibold text-gray-700">
                                <i class="mr-2 text-blue-500 fas fa-user"></i>
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="w-full px-4 py-3 pl-12 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 
                                                {{ $errors->has('name') ? 'border-red-300 ring-2 ring-red-200' : 'border-gray-200' }}"

                                       value="{{ old('name') }}" 
                                       placeholder="Masukkan nama lengkap Konselor"
                                       required>
                                <i class="absolute text-gray-400 transform -translate-y-1/2 fas fa-user left-4 top-1/2"></i>
                            </div>
                            @error('name')
                                <div class="flex items-center gap-2 mt-2 text-sm text-red-600">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Email Field --}}
                        <div class="form-group">
                            <label for="email" class="block mb-2 text-sm font-semibold text-gray-700">
                                <i class="mr-2 text-green-500 fas fa-envelope"></i>
                                Alamat Email <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       class="w-full px-4 py-3 pl-12 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('email') ? 'border-red-300 ring-2 ring-red-200' : 'border-gray-200' }}"
                                       value="{{ old('email') }}" 
                                       placeholder="contoh@email.com"
                                       required>
                                <i class="absolute text-gray-400 transform -translate-y-1/2 fas fa-envelope left-4 top-1/2"></i>
                            </div>
                            @error('email')
                                <div class="flex items-center gap-2 mt-2 text-sm text-red-600">
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
                        <div class="flex items-center justify-center w-8 h-8 bg-purple-100 rounded-lg">
                            <i class="text-purple-600 fas fa-phone"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Kontak</h3>
                    </div>

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        {{-- Phone Field --}}
                        <div class="form-group">
                            <label for="phone" class="block mb-2 text-sm font-semibold text-gray-700">
                                <i class="mr-2 text-purple-500 fas fa-phone"></i>
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       name="phone" 
                                       id="phone" 
                                       class="w-full px-4 py-3 pl-12 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('phone') ? 'border-red-300 ring-2 ring-red-200' : 'border-gray-200' }}"
                                       value="{{ old('phone') }}" 
                                       placeholder="08xxxxxxxxxx"
                                       required>
                                <i class="absolute text-gray-400 transform -translate-y-1/2 fas fa-phone left-4 top-1/2"></i>
                            </div>
                            @error('phone')
                                <div class="flex items-center gap-2 mt-2 text-sm text-red-600">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Address Field --}}
                        <div class="form-group">
                            <label for="address" class="block mb-2 text-sm font-semibold text-gray-700">
                                <i class="mr-2 text-red-500 fas fa-map-marker-alt"></i>
                                Address <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <textarea name="address" 
                                          id="address" 
                                          rows="4" 
                                          class="w-full px-4 py-3 pl-12 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none {{ $errors->has('address') ? 'border-red-300 ring-2 ring-red-200' : 'border-gray-200' }}"
                                          placeholder="Masukkan alamat lengkap Konselor..."
                                          required>{{ old('address') }}</textarea>
                                <i class="absolute text-gray-400 fas fa-map-marker-alt left-4 top-4"></i>
                            </div>
                            @error('address')
                                <div class="flex items-center gap-2 mt-2 text-sm text-red-600">
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
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-amber-100">
                            <i class="fas fa-sticky-note text-amber-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Tambahan</h3>
                    </div>

                    <div class="form-group">
                        <label for="notes" class="block mb-2 text-sm font-semibold text-gray-700">
                            <i class="mr-2 fas fa-sticky-note text-amber-500"></i>
                            Catatan <span class="text-xs text-gray-400">(Opsional)</span>
                        </label>
                        <div class="relative">
                            <textarea name="notes" 
                                      id="notes" 
                                      rows="4" 
                                      class="w-full px-4 py-3 pl-12 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none {{ $errors->has('notes') ? 'border-red-300 ring-2 ring-red-200' : 'border-gray-200' }}"
                                      placeholder="Tambahkan catatan khusus untuk Konselor ini...">{{ old('notes') }}</textarea>
                            <i class="absolute text-gray-400 fas fa-sticky-note left-4 top-4"></i>
                        </div>
                        @error('notes')
                            <div class="flex items-center gap-2 mt-2 text-sm text-red-600">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col justify-end gap-4 pt-6 border-t border-gray-200 sm:flex-row">
                    <a href="{{ route('clients.index') }}" 
                       class="inline-flex items-center justify-center gap-3 px-8 py-4 font-semibold text-gray-700 transition-all duration-200 transform bg-gray-100 border border-gray-200 rounded-xl hover:bg-gray-200 hover:shadow-lg hover:-translate-y-1">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center justify-center gap-3 px-8 py-4 font-semibold text-white transition-all duration-200 transform shadow-lg bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl hover:from-blue-700 hover:to-blue-800 hover:shadow-xl hover:-translate-y-1">
                        <i class="fas fa-save"></i>
                        Simpan Data Konselor
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