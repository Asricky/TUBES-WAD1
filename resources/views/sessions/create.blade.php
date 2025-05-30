<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sesi Konsultasi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white">
@extends('layouts.main')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex justify-between items-center">
            <h1 class="dashboard-title">Tambah Sesi Konsultasi Baru</h1>
            <a href="{{ route('sessions.index') }}" class="btn-action btn-secondary">
                <i class="fas fa-arrow-left icon"></i>
                Kembali
            </a>
        </div>
    </div>
    <div class="container mx-auto mt-10">
        <div class="bg-purple">
            <h2 class="text-4xl font-semibold text-white text-center mb-6">Tambah Sesi Konsultasi</h2>

            <form action="{{ route('sessions.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Klien -->
                    <div class="mb-4">
                        <label for="client_id" class="block text-lg font-medium text-black mb-2">Klien</label>
                        <select name="client_id" id="client_id" 
                            class="w-full p-4 rounded-lg border-2 border-transparent focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 bg-white text-gray-700 text-lg shadow-lg @error('client_id') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Klien</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
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
                        <label for="schedule_id" class="block text-lg font-medium text-black mb-2">Jadwal</label>
                        <select name="schedule_id" id="schedule_id" 
                            class="w-full p-4 rounded-lg border-2 border-transparent focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 bg-white text-gray-700 text-lg shadow-lg @error('schedule_id') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Jadwal</option>
                            @foreach($schedules as $schedule)
                                <option value="{{ $schedule->id }}" {{ old('schedule_id') == $schedule->id ? 'selected' : '' }}>
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
                        <label for="topic_id" class="block text-lg font-medium text-black mb-2">Topik</label>
                        <select name="topic_id" id="topic_id" 
                            class="w-full p-4 rounded-lg border-2 border-transparent focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 bg-white text-gray-700 text-lg shadow-lg @error('topic_id') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Topik</option>
                            @foreach($topics as $topic)
                                <option value="{{ $topic->id }}" {{ old('topic_id') == $topic->id ? 'selected' : '' }}>
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
                        <label for="status" class="block text-lg font-medium text-black mb-2">Status</label>
                        <select name="status" id="status"
                            class="w-full p-4 rounded-lg border-2 border-transparent focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 bg-white text-gray-700 text-lg shadow-lg @error('status') border-red-500 @enderror"
                            required>
                            <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Ringkasan -->
                <div class="mb-4">
                    <label for="summary" class="block text-lg font-medium text-black mb-2">Ringkasan</label>
                    <textarea name="summary" id="summary" rows="4"
                        class="w-full p-4 rounded-lg border-2 border-transparent focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 bg-white text-gray-700 text-lg shadow-lg @error('summary') border-red-500 @enderror"
                        required>{{ old('summary') }}</textarea>
                    @error('summary')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catatan -->
                <div class="mb-4">
                    <label for="notes" class="block text-lg font-medium text-black mb-2">Catatan</label>
                    <textarea name="notes" id="notes" rows="4"
                        class="w-full p-4 rounded-lg border-2 border-transparent focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-300 bg-white text-gray-700 text-lg shadow-lg @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between space-x-2">
                    <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
                        Simpan
                    </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
