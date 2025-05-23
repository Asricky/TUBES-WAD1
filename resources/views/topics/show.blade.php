@extends('layouts.main')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex justify-between items-center">
            <h1 class="dashboard-title">Detail Topik Konsultasi</h1>
            <div class="flex gap-2">
                <a href="{{ route('topics.index') }}" class="btn-action btn-secondary">
                    <i class="fas fa-arrow-left icon"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid gap-6">
        <!-- Informasi Topik -->
        <div class="content-card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h2 class="card-title">
                        <i class="fas fa-info-circle icon"></i>
                        Informasi Topik
                    </h2>
                    <div class="flex gap-2">
                        <a href="{{ route('topics.edit', $topic) }}" class="btn-action btn-secondary">
                            <i class="fas fa-edit icon"></i>
                            Edit Topik
                        </a>
                        <form action="{{ route('topics.destroy', $topic) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-danger" 
                                onclick="return confirm('Apakah Anda yakin ingin menghapus topik ini?')">
                                <i class="fas fa-trash icon"></i>
                                Hapus Topik
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="grid gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Nama Topik</h3>
                        <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">{{ $topic->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi</h3>
                        <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">{{ $topic->description }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Dibuat Pada</h3>
                            <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">
                                <i class="fas fa-calendar icon"></i>
                                {{ $topic->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Terakhir Diperbarui</h3>
                            <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">
                                <i class="fas fa-clock icon"></i>
                                {{ $topic->updated_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sesi Konsultasi Terkait -->
        <div class="content-card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-comments icon"></i>
                    Sesi Konsultasi Terkait
                </h2>
            </div>
            <div class="card-body">
                @if($topic->sessions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full table">
                            <thead>
                                <tr>
                                    <th>Klien</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topic->sessions as $session)
                                <tr>
                                    <td>
                                        <div class="font-medium">{{ $session->client->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $session->client->email }}</div>
                                    </td>
                                    <td>{{ $session->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="status-badge {{ 
                                            $session->status == 'completed' ? 'status-completed' :
                                            ($session->status == 'cancelled' ? 'status-cancelled' :
                                            ($session->status == 'in_progress' ? 'status-confirmed' : 'status-pending'))
                                        }}">
                                            {{ ucfirst($session->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('sessions.show', $session) }}" class="btn-action btn-secondary">
                                            <i class="fas fa-eye icon"></i>
                                            Detail Sesi
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-calendar-times text-4xl text-gray-400 mb-3"></i>
                        <p class="text-gray-500">Belum ada sesi konsultasi untuk topik ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 