<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Detail Klien</h2>
                <div>
                    <a href="{{ route('clients.edit', $client) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Edit
                    </a>
                    <a href="{{ route('clients.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Nama</h3>
                        <p class="text-gray-900">{{ $client->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Email</h3>
                        <p class="text-gray-900">{{ $client->email }}</p>
                    </div>

                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">No. HP</h3>
                        <p class="text-gray-900">{{ $client->phone }}</p>
                    </div>

                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Alamat</h3>
                        <p class="text-gray-900">{{ $client->address }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-gray-600 text-sm font-bold">Catatan</h3>
                        <p class="text-gray-900">{{ $client->notes ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Jadwal Konsultasi -->
            <div class="mt-8">
                <h3 class="text-xl font-bold mb-4">Jadwal Konsultasi</h3>
                @if($client->schedules->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
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
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->date->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->time->format('H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->status }}</td>
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
                        <table class="min-w-full divide-y divide-gray-200">
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
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $session->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $session->topic->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $session->status }}</td>
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
</x-app-layout> 