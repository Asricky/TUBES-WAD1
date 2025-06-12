<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Detail Jadwal Konsultasi</h2>
                <div>
                    <a href="{{ route('schedules.edit', $schedule) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Edit
                    </a>
                    <a href="{{ route('schedules.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Konselor</h3>
                        <p class="text-gray-900">{{ $schedule->client->name }}</p>
                        <p class="text-gray-500 text-sm">{{ $schedule->client->email }}</p>
                    </div>

                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Tanggal</h3>
                        <p class="text-gray-900">{{ $schedule->date->format('d/m/Y') }}</p>
                    </div>

                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Waktu</h3>
                        <p class="text-gray-900">{{ $schedule->time->format('H:i') }}</p>
                    </div>

                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Status</h3>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($schedule->status == 'completed') bg-green-100 text-green-800
                            @elseif($schedule->status == 'cancelled') bg-red-100 text-red-800
                            @elseif($schedule->status == 'confirmed') bg-blue-100 text-blue-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst($schedule->status) }}
                        </span>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-gray-600 text-sm font-bold">Catatan</h3>
                        <p class="text-gray-900">{{ $schedule->notes ?? '-' }}</p>
                    </div>
                </div>
            </div>

            @if($schedule->session)
            <div class="mt-8">
                <h3 class="text-xl font-bold mb-4">Sesi Konsultasi Terkait</h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-gray-600 text-sm font-bold">Topik</h3>
                            <p class="text-gray-900">{{ $schedule->session->topic->name }}</p>
                        </div>

                        <div>
                            <h3 class="text-gray-600 text-sm font-bold">Status</h3>
                            <p class="text-gray-900">{{ ucfirst($schedule->session->status) }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <h3 class="text-gray-600 text-sm font-bold">Ringkasan</h3>
                            <p class="text-gray-900">{{ $schedule->session->summary ?? '-' }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <a href="{{ route('sessions.show', $schedule->session) }}" class="text-blue-600 hover:text-blue-900">
                                Lihat Detail Sesi →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout> 