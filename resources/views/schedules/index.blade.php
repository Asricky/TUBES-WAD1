@extends('layouts.main')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex justify-between items-center">
            <h1 class="dashboard-title">Daftar Jadwal</h1>
            <a href="{{ route('schedules.create') }}" class="btn-action btn-primary">
                <i class="fas fa-plus icon"></i>
                Tambah Jadwal
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
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $schedule)
                        <tr>
                            <td>
                                <div class="font-medium">{{ $schedule->client->name }}</div>
                                <div class="text-gray-500 text-sm">{{ $schedule->client->email }}</div>
                            </td>
                            <td>{{ $schedule->date->format('d/m/Y') }}</td>
                            <td>{{ $schedule->time->format('H:i') }}</td>
                            <td>
                                <span class="status-badge {{ 
                                    $schedule->status == 'completed' ? 'status-completed' :
                                    ($schedule->status == 'cancelled' ? 'status-cancelled' :
                                    ($schedule->status == 'confirmed' ? 'status-confirmed' : 'status-pending'))
                                }}">
                                    {{ ucfirst($schedule->status) }}
                                </span>
                            </td>
                            <td class="flex gap-2">
                                <a href="{{ route('schedules.show', $schedule) }}" class="btn-action btn-secondary">
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </a>
                                <a href="{{ route('schedules.edit', $schedule) }}" class="btn-action btn-secondary">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
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
                {{ $schedules->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 