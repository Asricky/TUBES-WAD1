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
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Klien</th>
                            <th>Jadwal</th>
                            <th>Topik</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessions as $session)
                        <tr>
                            <td>
                                <div class="font-medium">{{ $session->client->name }}</div>
                                <div class="text-gray-500 text-sm">{{ $session->client->email }}</div>
                            </td>
                            <td>
                                <div class="font-medium">{{ $session->schedule->date->format('d/m/Y') }}</div>
                                <div class="text-gray-500 text-sm">{{ $session->schedule->time->format('H:i') }}</div>
                            </td>
                            <td>{{ $session->topic->name }}</td>
                            <td>
                                <span class="status-badge {{ 
                                    $session->status == 'completed' ? 'status-completed' :
                                    ($session->status == 'cancelled' ? 'status-cancelled' :
                                    ($session->status == 'in_progress' ? 'status-confirmed' : 'status-pending'))
                                }}">
                                    {{ ucfirst($session->status) }}
                                </span>
                            </td>
                            <td class="flex gap-2">
                                <a href="{{ route('sessions.show', $session) }}" class="btn-action btn-secondary">
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </a>
                                <a href="{{ route('sessions.edit', $session) }}" class="btn-action btn-secondary">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <form action="{{ route('sessions.destroy', $session) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus sesi ini?')">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $sessions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 