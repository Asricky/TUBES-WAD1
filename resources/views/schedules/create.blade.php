@extends('layouts.main')

@section('content')
<style>
    .custom-form-container {
        width: 95% !important;
    }

    .custom-form-container input,
    .custom-form-container select,
    .custom-form-container textarea {
        width: 95% !important;  
        padding: 12px 16px;  
        font-size: 1rem;  
        box-sizing: border-box;
    }

    .custom-form-container .mb-6 {
        margin-bottom: 1.5rem;
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex justify-between items-center">
            <h1 class="dashboard-title">Tambah Jadwal Konsultasi</h1>
            <a href="{{ route('schedules.index') }}" class="btn-action btn-secondary">
                <i class="fas fa-arrow-left icon"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="content-card custom-form-container">
        <div class="card-body custom-form-container">
            <form action="{{ route('schedules.store') }}" method="POST">
                @csrf

                <!-- Konselor -->
                <div class="mb-6">
                    <label for="client_id" class="block text-gray-700 text-sm font-bold mb-2">Konselor</label>
                    <select name="client_id" id="client_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('client_id') border-red-500 @enderror" required>
                        <option value="">Pilih Konselor</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }} ({{ $client->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal -->
                <div class="mb-6">
                    <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}" class="block w-full py-3 px-4 mt-1 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('date') border-red-500 @enderror" required>
                    @error('date')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Waktu -->
                <div class="mb-6">
                    <label for="time" class="block text-sm font-medium text-gray-700">Waktu</label>
                    <input type="time" name="time" id="time" value="{{ old('time') }}" class="block w-full py-3 px-4 mt-1 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('time') border-red-500 @enderror" required>
                    @error('time')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="block w-full py-3 px-4 mt-1 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('status') border-red-500 @enderror" required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catatan -->
                <div class="mb-6">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="notes" id="notes" rows="5" class="block w-full py-3 px-4 mt-1 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Simpan dan Batal -->
                <div class="flex justify-end gap-2 mt-6">
                    <a href="{{ route('schedules.index') }}" class="btn-action btn-secondary">
                        <i class="fas fa-times icon"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn-action btn-primary">
                        <i class="fas fa-save icon"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
