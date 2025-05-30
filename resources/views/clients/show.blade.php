@extends('layouts.main')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex justify-between items-center">
            <h1 class="dashboard-title">Detail Klien</h1>
            <div>
                <a href="{{ route('clients.edit', $client) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Edit
                </a>
                <a href="{{ route('clients.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="card-body">
            <h3 class="text-xl font-bold mb-4">Detail Klien</h3>
            
            <!-- Client Information Table -->
            <div class="overflow-x-auto mb-8">
                <table class="min-w-full divide-y divide-gray-200 shadow-lg rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Field</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Information</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Nama</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $client->name }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Email</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $client->email }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">No. HP</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $client->phone }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Alamat</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $client->address }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Catatan</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $client->notes ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Jadwal Konsultasi -->
            <div class="mt-8">
                <h3 class="text-xl font-bold mb-4">Jadwal Konsultasi</h3>
                @if($client->schedules->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 shadow-lg rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($client->schedules as $schedule)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $schedule->date->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $schedule->time->format('H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $schedule->status }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('schedules.show', $schedule) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">Belum ada jadwal konsultasi.</p>
                @endif
            </div>

            <!-- Riwayat Konsultasi -->
            <div class="mt-8">
                <h3 class="text-xl font-bold mb-4">Riwayat Konsultasi</h3>
                @if($client->sessions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 shadow-lg rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Topik</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($client->sessions as $session)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $session->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $session->topic->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $session->status }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('sessions.show', $session) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">Belum ada riwayat konsultasi.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
