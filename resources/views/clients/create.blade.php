@extends('layouts.main')

@section('content')
<div class="dashboard-container space-y-6">

    {{-- Header Halaman --}}
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <h1 class="dashboard-title">Tambah Konselor Baru</h1>
            <p class="text-sm text-gray-500 mt-1">Isi detail di bawah ini untuk mendaftarkan konselor baru.</p>
        </div>
        <a href="{{ route('clients.index') }}" 
           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white text-gray-700 font-semibold rounded-lg border border-gray-300 shadow-sm hover:bg-gray-50 hover:text-blue-600 transform hover:-translate-y-0.5 transition-all duration-200">
            <i class="fas fa-arrow-left text-sm"></i>
            Kembali ke Daftar
        </a>
    </div>

    {{-- Formulir Utama --}}
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            {{-- Header Kartu --}}
            <div class="bg-gradient-to-r from-gray-800 to-gray-700 px-6 py-5">
                <div class="flex items-center gap-4 text-white">
                    <i class="fas fa-user-plus text-2xl text-blue-300"></i>
                    <div>
                        <h2 class="text-lg font-bold">Formulir Data Konselor</h2>
                        <p class="text-sm text-gray-300">Pastikan semua informasi yang dimasukkan akurat.</p>
                    </div>
                </div>
            </div>

            {{-- Konten Form dengan Seksi --}}
            <div class="p-6 sm:p-8 space-y-8">

                {{-- Seksi Informasi Personal --}}
                <div class="space-y-6">
                    <div class="section-header">
                        <i class="fas fa-user-circle text-blue-500"></i>
                        <h3 class="section-title">Informasi Personal</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Field Nama Lengkap --}}
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="text" name="name" id="name" class="form-input @error('name') input-error @enderror" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                            </div>
                            @error('name')<p class="error-message">{{ $message }}</p>@enderror
                        </div>
                        
                        {{-- Field Email --}}
                        <div class="form-group">
                            <label for="email" class="form-label">Alamat Email <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="email" name="email" id="email" class="form-input @error('email') input-error @enderror" value="{{ old('email') }}" placeholder="contoh@email.com" required>
                            </div>
                            @error('email')<p class="error-message">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
                
                {{-- Seksi Informasi Kontak --}}
                <div class="space-y-6">
                    <div class="section-header">
                        <i class="fas fa-address-book text-blue-500"></i>
                        <h3 class="section-title">Informasi Kontak</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Field Nomor Telepon --}}
                        <div class="form-group">
                            <label for="phone" class="form-label">Nomor Telepon <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="tel" name="phone" id="phone" class="form-input @error('phone') input-error @enderror" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required>
                            </div>
                            @error('phone')<p class="error-message">{{ $message }}</p>@enderror
                        </div>

                        {{-- Field Alamat --}}
                        <div class="form-group md:col-span-2">
                            <label for="address" class="form-label">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <div class="relative">
                                 <i class="fas fa-map-marker-alt input-icon top-4"></i>
                                <textarea name="address" id="address" rows="4" class="form-input resize-y @error('address') input-error @enderror" placeholder="Masukkan alamat lengkap..." required>{{ old('address') }}</textarea>
                            </div>
                            @error('address')<p class="error-message">{{ $message }}</p>@enderror
                        </div>
                    </div> 
                </div>

                {{-- Seksi Informasi Tambahan --}}
                 <div class="space-y-6">
                    <div class="section-header">
                        <i class="fas fa-sticky-note text-blue-500"></i>
                        <h3 class="section-title">Informasi Tambahan</h3>
                    </div>
                    <div>
                        {{-- Field Catatan --}}
                        <div class="form-group">
                            <label for="notes" class="form-label">Catatan <span class="text-gray-400 text-xs font-normal">(Opsional)</span></label>
                            <div class="relative">
                                <i class="fas fa-pencil-alt input-icon top-4"></i>
                                <textarea name="notes" id="notes" rows="4" class="form-input resize-y @error('notes') input-error @enderror" placeholder="Tambahkan catatan khusus untuk konselor ini...">{{ old('notes') }}</textarea>
                            </div>
                            @error('notes')<p class="error-message">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

            </div>

            {{-- Footer Form dengan Tombol Aksi --}}
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex justify-end gap-3">
                    <a href="{{ route('clients.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    /* Styling untuk Header Seksi */
    .section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem; /* 12px */
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e5e7eb; /* border-gray-200 */
    }
    .section-title {
        font-size: 1.125rem; /* text-lg */
        font-weight: 600; /* font-semibold */
        color: #1f2937; /* text-gray-800 */
    }

    /* Styling Grup Form */
    .form-group {
        width: 100%;
    }
    .form-label {
        display: block;
        margin-bottom: 0.5rem; /* mb-2 */
        font-size: 0.875rem; /* text-sm */
        font-weight: 600; /* font-semibold */
        color: #374151; /* text-gray-700 */
    }
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.75rem; /* py-3 px-4 pl-11 */
        border: 1px solid #d1d5db; /* border-gray-300 */
        border-radius: 0.75rem; /* rounded-xl */
        background-color: #f9fafb; /* bg-gray-50 */
        transition: all 0.2s ease-in-out;
    }
    .form-input:focus {
        outline: none;
        border-color: #2563eb; /* focus:border-blue-600 */
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }
    .input-icon {
        position: absolute;
        left: 1rem; /* left-4 */
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af; /* text-gray-400 */
        pointer-events: none;
    }
    .input-icon.top-4 {
        top: 1rem;
        transform: translateY(0);
    }
    
    /* Styling untuk Error State */
    .input-error {
        border-color: #ef4444; /* border-red-500 */
    }
    .input-error:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
    }
    .error-message {
        margin-top: 0.5rem; /* mt-2 */
        font-size: 0.875rem; /* text-sm */
        color: #dc2626; /* text-red-600 */
    }

    /* Styling Tombol Aksi */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.625rem 1.25rem; /* px-5 py-2.5 */
        font-weight: 600; /* font-semibold */
        border-radius: 0.5rem; /* rounded-lg */
        border: 1px solid transparent;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
    }
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .btn-primary {
        background-color: #2563eb; /* bg-blue-600 */
        color: white;
    }
    .btn-primary:hover {
        background-color: #1d4ed8; /* hover:bg-blue-700 */
    }
    .btn-secondary {
        background-color: #e5e7eb; /* bg-gray-200 */
        color: #374151; /* text-gray-700 */
        border-color: #d1d5db; /* border-gray-300 */
    }
    .btn-secondary:hover {
        background-color: #d1d5db;
        border-color: #9ca3af;
    }
</style>
@endpush
