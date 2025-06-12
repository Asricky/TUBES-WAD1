@extends('layouts.main')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex justify-between items-center">
            <h1 class="dashboard-title">Daftar Sesi Konsultasi</h1>
            <a href="{{ route('sessions.create') }}" class="btn-action btn-primary">
                <i class="fas fa-plus icon"></i>
                Tambah Sesi
            </a>
        </div>
    </div>

    <div class="content-card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Daftar Sesi Konsultasi -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-200 rounded-lg shadow-sm text-sm text-gray-700">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="p-3 text-left">Konselor</th>
                            <th class="p-3 text-left">Jadwal</th>
                            <th class="p-3 text-left">Topik</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessions as $session)
                        <tr class="hover:bg-gray-100">
                            <td class="p-3">
                                <div class="font-medium">{{ $session->client->name }}</div>
                                <div class="text-sm text-gray-500">{{ $session->client->email }}</div>
                            </td>
                            <td class="p-3">
                                <div class="font-medium">{{ $session->schedule->date->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $session->schedule->time->format('H:i') }}</div>
                            </td>
                            <td class="p-3">{{ $session->topic->name }}</td>
                            <td class="p-3">
                                <span class="status-badge {{ 
                                    $session->status == 'completed' ? 'status-completed' :
                                    ($session->status == 'cancelled' ? 'status-cancelled' :
                                    ($session->status == 'in_progress' ? 'status-confirmed' : 'status-pending'))
                                }}">
                                    {{ ucfirst($session->status) }}
                                </span>
                            </td>
                            <td class="p-3 flex justify-center gap-2">
                                <a href="{{ route('sessions.show', $session) }}" class="btn-action btn-secondary">
                                    <i class="fas fa-eye icon"></i>
                                    Detail
                                </a>
                                <a href="{{ route('sessions.edit', $session) }}" class="btn-action btn-secondary">
                                    <i class="fas fa-edit icon"></i>
                                    Edit
                                </a>
                                <form action="{{ route('sessions.destroy', $session) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus sesi ini?')">
                                        <i class="fas fa-trash icon"></i>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $sessions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
