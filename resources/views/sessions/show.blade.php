<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sesi Konsultasi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    @extends('layouts.main')

    @section('content')
    <div class="container mx-auto my-10 p-6 bg-white rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('sessions.index') }}" class="btn-action btn-secondary flex items-center space-x-2 text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>

        <h2 class="text-4xl font-semibold text-center text-gray-900 mb-8">Detail Sesi Konsultasi</h2>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold">Detail Sesi Konsultasi</h2>
                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Konselor</h3>
                        <p class="text-gray-900">{{ $session->client->name }}</p>
                        <p class="text-gray-500 text-sm">{{ $session->client->email }}</p>
                    </div>

                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Jadwal</h3>
                        <p class="text-gray-900">{{ \Carbon\Carbon::parse($session->schedule->date)->format('d/m/Y') }}</p>
                        <p class="text-gray-500 text-sm">{{ \Carbon\Carbon::parse($session->schedule->time)->format('H:i') }}</p>
                    </div>

                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Topik</h3>
                        <p class="text-gray-900">{{ $session->topic->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Status</h3>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($session->status == 'completed') bg-green-100 text-green-800
                            @elseif($session->status == 'cancelled') bg-red-100 text-red-800
                            @elseif($session->status == 'in_progress') bg-blue-100 text-blue-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst($session->status) }}
                        </span>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-gray-600 text-sm font-bold">Ringkasan</h3>
                        <p class="text-gray-900">{{ $session->summary }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-gray-600 text-sm font-bold">Catatan</h3>
                        <p class="text-gray-900">{{ $session->notes ?? '-' }}</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Konselor -->
                        <div>
                            <h3 class="text-gray-600 text-sm font-bold">Konselor</h3>
                            <p class="text-gray-900">{{ $session->client->name }}</p>
                            <p class="text-gray-500 text-sm">{{ $session->client->email }}</p>
                        </div>

                        <!-- Jadwal -->
                        <div>
                            <h3 class="text-gray-600 text-sm font-bold">Jadwal</h3>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($session->schedule->date)->format('d/m/Y') }}</p>
                            <p class="text-gray-500 text-sm">{{ \Carbon\Carbon::parse($session->schedule->time)->format('H:i') }}</p>
                        </div>

                        <!-- Topik -->
                        <div>
                            <h3 class="text-gray-600 text-sm font-bold">Topik</h3>
                            <p class="text-gray-900">{{ $session->topic->name }}</p>
                        </div>

                        <!-- Status -->
                        <div>
                            <h3 class="text-gray-600 text-sm font-bold">Status</h3>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($session->status == 'completed') bg-green-100 text-green-800
                                @elseif($session->status == 'cancelled') bg-red-100 text-red-800
                                @elseif($session->status == 'in_progress') bg-blue-100 text-blue-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ ucfirst($session->status) }}
                            </span>
                        </div>

                        <!-- Ringkasan -->
                        <div class="md:col-span-2">
                            <h3 class="text-gray-600 text-sm font-bold">Ringkasan</h3>
                            <p class="text-gray-900">{{ $session->summary }}</p>
                        </div>

                        <!-- Catatan -->
                        <div class="md:col-span-2">
                            <h3 class="text-gray-600 text-sm font-bold">Catatan</h3>
                            @if($session->notes)
                                <!-- Menampilkan file gambar -->
                                @if(in_array(pathinfo($session->notes, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ Storage::url($session->notes) }}" alt="Gambar Lampiran" class="max-w-full max-h-96 mt-2">
                                <!-- Menampilkan file PDF -->
                                @elseif(pathinfo($session->notes, PATHINFO_EXTENSION) == 'pdf')
                                    <iframe src="{{ Storage::url($session->notes) }}" width="100%" height="500px" class="mt-2 border-2 rounded-lg"></iframe>
                                @else
                                    <a href="{{ Storage::url($session->notes) }}" target="_blank" class="text-blue-600 hover:text-blue-900 mt-2">
                                        Lihat atau Download
                                    </a>
                                @endif
                            @else
                                <p class="text-gray-500">Tidak ada catatan.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Lampiran Section -->
                @if($session->attachments->count() > 0)
                <div class="mt-8">
                    <h3 class="text-xl font-bold mb-4">Lampiran</h3>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="grid grid-cols-1 gap-4">
                            @foreach($session->attachments as $attachment)
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-900">{{ $attachment->name }}</p>
                                    <p class="text-gray-500 text-sm">{{ $attachment->file_type }} - {{ $attachment->file_size }}</p>
                                </div>

                                <!-- Cek tipe file dan tampilkan sesuai tipe -->
                                @if(in_array(pathinfo($attachment->name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ Storage::url($attachment->path) }}" alt="Gambar Lampiran" class="max-w-full max-h-96 rounded-lg mt-2">
                                @elseif(pathinfo($attachment->name, PATHINFO_EXTENSION) == 'pdf')
                                    <iframe src="{{ Storage::url($attachment->path) }}" width="100%" height="500px" class="mt-2 border-2 rounded-lg"></iframe>
                                @else
                                    <a href="{{ Storage::url($attachment->path) }}" class="text-blue-600 hover:text-blue-900 mt-2">
                                        Lihat atau Download
                                    </a>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endsection
</body>

</html>
