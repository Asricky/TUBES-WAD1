<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Sesi Konsultasi</title>
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

        <h2 class="text-4xl font-semibold text-center text-gray-900 mb-8">Update Sesi Konsultasi</h2>

        <form action="{{ route('sessions.update', $session->id) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Klien -->
                <div class="mb-4">
                    <label for="client_id" class="block text-lg font-medium text-gray-800 mb-2">Klien</label>
                    <select name="client_id" id="client_id"
                        class="w-full p-4 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 text-gray-700 @error('client_id') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Klien</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $session->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->name }} ({{ $client->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jadwal -->
                <div class="mb-4">
                    <label for="schedule_id" class="block text-lg font-medium text-gray-800 mb-2">Jadwal</label>
                    <select name="schedule_id" id="schedule_id"
                        class="w-full p-4 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 text-gray-700 @error('schedule_id') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Jadwal</option>
                        @foreach($schedules as $schedule)
                            <option value="{{ $schedule->id }}" {{ old('schedule_id', $session->schedule_id) == $schedule->id ? 'selected' : '' }}>
                                {{ $schedule->date->format('d/m/Y') }} {{ $schedule->time->format('H:i') }}
                            </option>
                        @endforeach
                    </select>
                    @error('schedule_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Topik -->
                <div class="mb-4">
                    <label for="topic_id" class="block text-lg font-medium text-gray-800 mb-2">Topik</label>
                    <select name="topic_id" id="topic_id"
                        class="w-full p-4 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 text-gray-700 @error('topic_id') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Topik</option>
                        @foreach($topics as $topic)
                            <option value="{{ $topic->id }}" {{ old('topic_id', $session->topic_id) == $topic->id ? 'selected' : '' }}>
                                {{ $topic->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('topic_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="block text-lg font-medium text-gray-800 mb-2">Status</label>
                    <select name="status" id="status"
                        class="w-full p-4 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 text-gray-700 @error('status') border-red-500 @enderror"
                        required>
                        <option value="scheduled" {{ old('status', $session->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                        <option value="in_progress" {{ old('status', $session->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status', $session->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status', $session->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Ringkasan -->
            <div class="mb-4">
                <label for="summary" class="block text-lg font-medium text-gray-800 mb-2">Ringkasan</label>
                <textarea name="summary" id="summary" rows="4"
                    class="w-full p-4 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 text-gray-700 @error('summary') border-red-500 @enderror"
                    required>{{ old('summary', $session->summary) }}</textarea>
                @error('summary')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan -->
            <div class="mb-4">
                <label for="notes" class="block text-lg font-medium text-gray-800 mb-2">Catatan</label>
                <input type="file" name="notes" id="notes" accept=".pdf,.docx,.jpg,.jpeg,.png,.gif"
                    class="w-full p-4 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 text-gray-700 @error('notes') border-red-500 @enderror">
                @error('notes')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Menampilkan file yang sudah ada jika ada -->
                @if($session->notes)
                    <div class="mt-4">
                        <h4 class="text-sm font-semibold">File Saat Ini:</h4>
                        <!-- Jika file adalah gambar -->
                        @if(in_array(pathinfo($session->notes, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($session->notes) }}" alt="Gambar Lampiran" class="max-w-full max-h-96 mt-2">
                        @elseif(pathinfo($session->notes, PATHINFO_EXTENSION) == 'pdf')
                            <!-- Jika file adalah PDF -->
                            <iframe src="{{ Storage::url($session->notes) }}" width="100%" height="500px" class="mt-2 border-2 rounded-lg"></iframe>
                        @else
                            <!-- Jika file lain -->
                            <a href="{{ Storage::url($session->notes) }}" target="_blank" class="text-blue-600 hover:text-blue-900 mt-2">
                                Lihat File
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-between space-x-2">
                <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-4 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
                    Update
                </button>
            </div>
        </form>
    </div>
    @endsection
</body>

</html>
