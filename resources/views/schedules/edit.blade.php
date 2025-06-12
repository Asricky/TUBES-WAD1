<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-4">
                <h2 class="text-2xl font-bold">Edit Jadwal Konsultasi</h2>
            </div>

            <form action="{{ route('schedules.update', $schedule) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="client_id" class="block text-gray-700 text-sm font-bold mb-2">Konselor</label>
                    <select name="client_id" id="client_id" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('client_id') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Konselor</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ (old('client_id', $schedule->client_id) == $client->id) ? 'selected' : '' }}>
                                {{ $client->name }} ({{ $client->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal</label>
                    <input type="date" name="date" id="date" value="{{ old('date', $schedule->date->format('Y-m-d')) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('date') border-red-500 @enderror"
                        required>
                    @error('date')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="time" class="block text-gray-700 text-sm font-bold mb-2">Waktu</label>
                    <input type="time" name="time" id="time" value="{{ old('time', $schedule->time->format('H:i')) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('time') border-red-500 @enderror"
                        required>
                    @error('time')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <select name="status" id="status"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror"
                        required>
                        <option value="pending" {{ old('status', $schedule->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ old('status', $schedule->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ old('status', $schedule->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ old('status', $schedule->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Catatan</label>
                    <textarea name="notes" id="notes" rows="3"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('notes') border-red-500 @enderror">{{ old('notes', $schedule->notes) }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('schedules.index') }}" class="text-gray-600 hover:text-gray-800">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout> 