<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Detail Sesi Konsultasi</h2>
                <div>
                    <a href="{{ route('sessions.edit', $session) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Edit
                    </a>
                    <a href="{{ route('sessions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Klien</h3>
                        <p class="text-gray-900">{{ $session->client->name }}</p>
                        <p class="text-gray-500 text-sm">{{ $session->client->email }}</p>
                    </div>

                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Jadwal</h3>
                        <p class="text-gray-900">{{ $session->schedule->date->format('d/m/Y') }}</p>
                        <p class="text-gray-500 text-sm">{{ $session->schedule->time->format('H:i') }}</p>
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
            </div>

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
                            <a href="{{ route('attachments.download', $attachment) }}" class="text-blue-600 hover:text-blue-900">
                                Download
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout> 