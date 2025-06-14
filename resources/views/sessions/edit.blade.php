<!DOCTYPE html>
<html lang="id">

@section('content')
<div class="p-6 space-y-6 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
                Update Sesi Konsultasi
            </h1>
            <p class="text-gray-600 mt-1">Perbarui informasi sesi konsultasi dalam database</p>
        </div>
        <a href="{{ route('sessions.index') }}" 
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
                <i class="fas fa-calendar-alt text-xl"></i>
                <div>
                    <h2 class="text-xl font-semibold">Formulir Update Sesi Konsultasi</h2>
                    <p class="text-blue-100 text-sm">Pastikan semua informasi sesi diperbarui dengan akurat</p>
                </div>
            </div>
        </div>

        {{-- Form Content --}}
        <div class="p-8">
            <form action="{{ route('sessions.update', $session->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')
                
                {{-- Client Information Section --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Konselor</h3>
                    </div>

        <form action="{{ route('sessions.update', $session->id) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Konselor -->
                <div class="mb-4">
                    <label for="client_id" class="block text-lg font-medium text-gray-800 mb-2">Konselor</label>
                    <select name="client_id" id="client_id"
                        class="w-full p-4 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 text-gray-700 @error('client_id') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Konselor</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $session->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->name }} ({{ $client->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
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

                    <div class="form-group">
                        <label for="schedule_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar-day text-green-500 mr-2"></i>
                            Pilih Jadwal <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="schedule_id" 
                                    id="schedule_id" 
                                    class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('schedule_id') border-red-300 ring-2 ring-red-200 @enderror"
                                    required>
                                <option value="">Pilih Jadwal</option>
                                @foreach($schedules as $schedule)
                                    <option value="{{ $schedule->id }}" {{ old('schedule_id', $session->schedule_id) == $schedule->id ? 'selected' : '' }}>
                                        {{ $schedule->date->format('d/m/Y') }} {{ $schedule->time->format('H:i') }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fas fa-calendar-day absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        @error('schedule_id')
                            <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Topic Information Section --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-comment-dots text-purple-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Topik</h3>
                    </div>

                    <div class="form-group">
                        <label for="topic_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-tag text-purple-500 mr-2"></i>
                            Pilih Topik <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="topic_id" 
                                    id="topic_id" 
                                    class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('topic_id') border-red-300 ring-2 ring-red-200 @enderror"
                                    required>
                                <option value="">Pilih Topik</option>
                                @foreach($topics as $topic)
                                    <option value="{{ $topic->id }}" {{ old('topic_id', $session->topic_id) == $topic->id ? 'selected' : '' }}>
                                        {{ $topic->name }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fas fa-tag absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        @error('topic_id')
                            <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Status Information Section --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-info-circle text-amber-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Status Konsultasi</h3>
                    </div>

                    <div class="form-group">
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-tag text-amber-500 mr-2"></i>
                            Status <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="status" 
                                    id="status"
                                    class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('status') border-red-300 ring-2 ring-red-200 @enderror"
                                    required>
                                <option value="scheduled" {{ old('status', $session->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                <option value="in_progress" {{ old('status', $session->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status', $session->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', $session->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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

                {{-- Summary Section --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-alt text-emerald-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Ringkasan Konsultasi</h3>
                    </div>

            <!-- Catatan -->
            <div class="mb-4">
                <label for="notes" class="block text-lg font-medium text-gray-800 mb-2">Catatan</label>
                <input type="file" name="notes" id="notes" accept=".pdf,.docx,.jpg,.jpeg,.png,.gif"
                    class="w-full p-4 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 text-gray-700 @error('notes') border-red-500 @enderror">
                @error('notes')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Menampilkan file yang sudah ada jika ada -->
                @if($session->notes)
                    <div class="mt-4">
                        <h4 class="text-sm font-semibold">File Saat Ini:</h4>
                        <!-- Jika file adalah gambar -->
                        @if(in_array(pathinfo($session->notes, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($session->notes) }}" alt="Gambar Lampiran" class="max-w-full max-h-96 mt-2">
                        @elseif(pathinfo($session->notes, PATHINFO_EXTENSION) == 'pdf')
                            <!-- Jika file adalah PDF -->
                            <iframe src="{{ Storage::url($session->notes) }}" width="100%" height="500px" class="mt-2 border-2 rounded-lg"></iframe>
                        @else
                            <!-- Jika file lain -->
                            <a href="{{ Storage::url($session->notes) }}" target="_blank" class="text-blue-600 hover:text-blue-900 mt-2">
                                Lihat File
                            </a>
                        @endif
                    </div>
                @endif
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
                                      placeholder="Tambahkan catatan tentang sesi konsultasi ini...">{{ old('notes', $session->notes) }}</textarea>
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
                    <a href="{{ route('sessions.index') }}" 
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