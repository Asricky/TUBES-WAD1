@extends('layouts.main')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex justify-between items-center">
            <h1 class="dashboard-title">Edit Klien</h1>
            <a href="{{ route('clients.update', $client) }}" class="btn-action btn-secondary">
                <i class="fas fa-arrow-left icon"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="content-card">
        <div class="card-body">
            <form action="{{ route('clients.update', $client) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-input @error('name') is-invalid @enderror" 
                            value="{{ old('name', $client->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-input @error('email') is-invalid @enderror" 
                            value="{{ old('email', $client->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">No. HP</label>
                        <input type="text" name="phone" id="phone" class="form-input @error('phone') is-invalid @enderror" 
                            value="{{ old('phone', $client->phone) }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea name="address" id="address" rows="3" class="form-input @error('address') is-invalid @enderror" 
                            required>{{ old('address', $client->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group md:col-span-2">
                        <label for="notes" class="form-label">Catatan (Opsional)</label>
                        <textarea name="notes" id="notes" rows="3" class="form-input @error('notes') is-invalid @enderror">{{ old('notes', $client->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Edit Jadwal Konsultasi -->
                    <div class="form-group md:col-span-2">
                        <label for="schedule" class="form-label">Jadwal Konsultasi</label>
                        <input type="datetime-local" name="schedule[]" id="schedule" class="form-input"
                            value="{{ old('schedule', $client->schedules->first()->date ?? '') }}">
                    </div>

                    <!-- Edit Riwayat Konsultasi -->
                    <div class="form-group md:col-span-2">
                        <label for="session" class="form-label">Riwayat Konsultasi</label>
                        <textarea name="session[]" id="session" rows="3" class="form-input">{{ old('session', $client->sessions->first()->notes ?? '') }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <a href="{{ route('clients.index') }}" class="btn-action btn-secondary">
                        <i class="fas fa-times icon"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn-action btn-primary">
                        <i class="text-gray-600 hover:text-gray-800"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
