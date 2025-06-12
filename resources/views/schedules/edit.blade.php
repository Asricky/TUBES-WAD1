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
                Edit Jadwal
            </h1>
            <p class="text-gray-600 mt-1">Perbarui informasi Konselor dalam database</p>
        </div>
        <a href="{{ route('clients.index') }}" 
           class="inline-flex items-center gap-2 px-6 py-3 bg   -gray-100 text-gray-700 font-semibold rounded-xl border border-gray-200 hover:bg-gray-200 hover:shadow-lg transform hover:-translate-y-1 transition-all duration-200">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar
        </a>
    </div>

    {{-- Main Form Card --}}
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        {{-- Card Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
            <div class="flex items-center gap-3 text-white">
                <i class="fas fa-calendar-alt text-xl"></i>
                <div>
                    <h2 class="text-xl font-semibold">Formulir Edit Jadwal Konsultasi</h2>
                    <p class="text-blue-100 text-sm">Pastikan semua informasi jadwal diperbarui dengan akurat</p>
                </div>
            </div>
        </div>

        {{-- Form Content --}}
        <div class="p-8">
            <form action="{{ route('schedules.update', $schedule) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="client_id" class="block text-gray-700 text-sm font-bold mb-2">Konselor</label>
                    <select name="client_id" id="client_id" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('client_id') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Konselor</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ (old('client_id', $schedule->client_id) == $client->id) ? 'selected' : '' }}>
                                {{ $client->name }} ({{ $client->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Schedule Information Section --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Jadwal</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        {{-- Date Field --}}
                        <div class="form-group">
                            <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-calendar-day text-green-500 mr-2"></i>
                                Tanggal Konsultasi <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="date" 
                                       name="date" 
                                       id="date" 
                                       value="{{ old('date', $schedule->date->format('Y-m-d')) }}"
                                       class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('date') border-red-300 ring-2 ring-red-200 @enderror"
                                       required>
                                <i class="fas fa-calendar-day absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                            @error('date')
                                <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Time Field --}}
                        <div class="form-group">
                            <label for="time" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-clock text-green-500 mr-2"></i>
                                Waktu Konsultasi <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="time" 
                                       name="time" 
                                       id="time" 
                                       value="{{ old('time', $schedule->time->format('H:i')) }}"
                                       class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('time') border-red-300 ring-2 ring-red-200 @enderror"
                                       required>
                                <i class="fas fa-clock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                            @error('time')
                                <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Status Information Section --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-info-circle text-purple-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Status Konsultasi</h3>
                    </div>

                    <div class="form-group">
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-tag text-purple-500 mr-2"></i>
                            Status <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="status" 
                                    id="status"
                                    class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('status') border-red-300 ring-2 ring-red-200 @enderror"
                                    required>
                                <option value="pending" {{ old('status', $schedule->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status', $schedule->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ old('status', $schedule->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="completed" {{ old('status', $schedule->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            <i class="fas fa-tag absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        @error('status')
                            <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Notes Section --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-sticky-note text-amber-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Catatan Tambahan</h3>
                    </div>

                    <div class="form-group">
                        <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-edit text-amber-500 mr-2"></i>
                            Catatan <span class="text-gray-400 text-xs">(Opsional)</span>
                        </label>
                        <div class="relative">
                            <textarea name="notes" 
                                      id="notes" 
                                      rows="4" 
                                      class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none @error('notes') border-red-300 ring-2 ring-red-200 @enderror"
                                      placeholder="Tambahkan catatan tentang konsultasi ini...">{{ old('notes', $schedule->notes) }}</textarea>
                            <i class="fas fa-edit absolute left-4 top-4 text-gray-400"></i>
                        </div>
                        @error('notes')
                            <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('schedules.index') }}" 
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
    .form-group textarea:focus,
    .form-group select:focus {
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
    
    /* Style for select dropdown */
    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
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