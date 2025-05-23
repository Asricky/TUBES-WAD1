@extends('layouts.main')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex justify-between items-center">
            <h1 class="dashboard-title">Daftar Topik Konsultasi</h1>
            <a href="{{ route('topics.create') }}" class="btn-action btn-primary">
                <i class="fas fa-plus icon"></i>
                Tambah Topik
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($topics as $topic)
        <div class="content-card hover:shadow-lg transition-shadow duration-300">
            <div class="card-body">
                <div class="flex-1 mb-4">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $topic->name }}</h3>
                    <p class="text-gray-600">{{ $topic->description }}</p>
                </div>
                
                <div class="border-t border-gray-200 pt-4">
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="fas fa-comments mr-2"></i>
                        <span>{{ $topic->sessions->count() }} Sesi Konsultasi</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('topics.show', $topic) }}" class="btn-action btn-secondary text-sm flex-1">
                            <i class="fas fa-eye icon"></i>
                            Lihat Detail
                        </a>
                        <a href="{{ route('topics.edit', $topic) }}" class="btn-action btn-secondary text-sm flex-1">
                            <i class="fas fa-edit icon"></i>
                            Edit Topik
                        </a>
                        <form action="{{ route('topics.destroy', $topic) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-danger text-sm w-full" 
                                onclick="return confirm('Apakah Anda yakin ingin menghapus topik ini?')">
                                <i class="fas fa-trash icon"></i>
                                Hapus Topik
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($topics->isEmpty())
    <div class="content-card">
        <div class="card-body text-center py-8">
            <i class="fas fa-folder-open text-4xl text-gray-400 mb-3"></i>
            <p class="text-gray-500">Belum ada topik konsultasi yang tersedia.</p>
        </div>
    </div>
    @endif

    <div class="mt-4">
        {{ $topics->links() }}
    </div>
</div>
@endsection 