<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-4">
                <h2 class="text-2xl font-bold">Edit Sesi Konsultasi</h2>
            </div>

            <form action="{{ route('sessions.update', $session) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="client_id" class="block text-gray-700 text-sm font-bold mb-2">Klien</label>
                    <select name="client_id" id="client_id" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('client_id') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Klien</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $session->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->name }} ({{ $client->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="schedule_id" class="block text-gray-700 text-sm font-bold mb-2">Jadwal</label>
                    <select name="schedule_id" id="schedule_id" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('schedule_id') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Jadwal</option>
                        @foreach($schedules as $schedule)
                            <option value="{{ $schedule->id }}" {{ old('schedule_id', $session->schedule_id) == $schedule->id ? 'selected' : '' }}>
                                {{ $schedule->date->format('d/m/Y') }} {{ $schedule->time->format('H:i') }}
                            </option>
                        @endforeach
                    </select>
                    @error('schedule_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="topic_id" class="block text-gray-700 text-sm font-bold mb-2">Topik</label>
                    <select name="topic_id" id="topic_id" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('topic_id') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Topik</option>
                        @foreach($topics as $topic)
                            <option value="{{ $topic->id }}" {{ old('topic_id', $session->topic_id) == $topic->id ? 'selected' : '' }}>
                                {{ $topic->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('topic_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <select name="status" id="status"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror"
                        required>
                        <option value="scheduled" {{ old('status', $session->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                        <option value="in_progress" {{ old('status', $session->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status', $session->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status', $session->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="summary" class="block text-gray-700 text-sm font-bold mb-2">Ringkasan</label>
                    <textarea name="summary" id="summary" rows="3"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('summary') border-red-500 @enderror"
                        required>{{ old('summary', $session->summary) }}</textarea>
                    @error('summary')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Catatan</label>
                    <textarea name="notes" id="notes" rows="3"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('notes') border-red-500 @enderror">{{ old('notes', $session->notes) }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('sessions.index') }}" class="text-gray-600 hover:text-gray-800">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout> 