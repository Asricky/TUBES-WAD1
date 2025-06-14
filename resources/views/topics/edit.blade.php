@extends('layouts.main')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex items-center justify-between">
            <h1 class="dashboard-title">Update Topik</h1>
            <a href="{{ route('topics.index') }}" class="btn-action btn-secondary">
                <i class="fas fa-arrow-left icon"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="content-card">
        <div class="card-body">
            <form method="POST" action="{{ route('topics.update', $topic) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="form-label">Nama Topik</label>
                    <input type="text" id="name" name="name" class="form-input @error('name') is-invalid @enderror" value="{{ old('name', $topic->name) }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" rows="4" class="form-input @error('description') is-invalid @enderror" required>{{ old('description', $topic->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="btn-action btn-primary">
                        <i class="fas fa-save icon"></i>
                        Save Changes
                    </button>
                    <a href="{{ route('topics.index') }}" class="btn-action btn-secondary">
                        <i class="fas fa-times icon"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 