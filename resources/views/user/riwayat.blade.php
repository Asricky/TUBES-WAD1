<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary-800 leading-tight">
            {{ __('Riwayat Konsultasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass rounded-2xl p-6">
                <h3 class="text-lg font-bold text-secondary-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-emerald-500 rounded-full"></span>
                    Riwayat Konsultasi Saya
                </h3>

                @if($sessions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-secondary-500 uppercase bg-secondary-50/80">
                                <tr>
                                    <th class="px-6 py-4">Konselor</th>
                                    <th class="px-6 py-4">Topik</th>
                                    <th class="px-6 py-4">Tanggal</th>
                                    <th class="px-6 py-4">Waktu</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($sessions as $session)
                                <tr class="hover:bg-secondary-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-secondary-900">{{ $session->client->name }}</div>
                                        <div class="text-xs text-secondary-400">{{ $session->client->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-violet-50 text-violet-700 text-xs font-medium">
                                            {{ $session->topic->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-secondary-600">
                                        {{ $session->schedule->date->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-secondary-600">
                                        {{ $session->schedule->formatted_time }} WIB
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusClasses = [
                                                'completed' => 'bg-green-100 text-green-700',
                                                'cancelled' => 'bg-red-100 text-red-700',
                                                'in_progress' => 'bg-blue-100 text-blue-700',
                                                'scheduled' => 'bg-yellow-100 text-yellow-700'
                                            ];
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$session->status] ?? 'bg-gray-100' }}">
                                            {{ ucfirst(str_replace('_', ' ', $session->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('user.riwayat.show', $session) }}" 
                                           class="inline-block p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-all" 
                                           title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($sessions->hasPages())
                        <div class="mt-6">
                            {{ $sessions->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <div class="p-4 bg-gray-50 rounded-full inline-block mb-4">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-secondary-900 mb-2">Belum Ada Riwayat</h3>
                        <p class="text-secondary-600 mb-6">Anda belum pernah melakukan konsultasi.</p>
                        <a href="{{ route('user.jadwal') }}" class="btn-primary">
                            Lihat Jadwal Tersedia
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
