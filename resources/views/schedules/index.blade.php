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
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-container">
                <table class="min-w-full table-auto border border-gray-200 rounded-lg shadow-sm text-sm text-gray-700">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="p-3 text-left">Konselor</th>
                            <th class="p-3 text-left">Tanggal</th>
                            <th class="p-3 text-left">Waktu</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $schedule)
                        <tr class="hover:bg-gray-100">
                            <td class="p-3">{{ $schedule->client->name }}</td>
                            <td class="p-3">{{ $schedule->date->format('d/m/Y') }}</td>
                            <td class="p-3">{{ $schedule->time->format('H:i') }}</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full text-xs 
                                    {{ $schedule->status == 'Pending' ? 'bg-yellow-400 text-yellow-800' : ($schedule->status == 'Completed' ? 'bg-green-400 text-green-800' : 'bg-red-400 text-red-800') }}">
                                    {{ $schedule->status }}
                                </span>
                            </td>
                            <td class="p-3 flex justify-center gap-2">
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
