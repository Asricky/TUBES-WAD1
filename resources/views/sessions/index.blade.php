<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight text-secondary-800">
                {{ __('Sesi Konsultasi') }}
            </h2>
            <a href="{{ route('sessions.create') }}" class="btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Sesi
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 text-green-700 bg-green-100 border-l-4 border-green-500 rounded-r-lg shadow-sm animate-fade-in flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="glass overflow-hidden rounded-2xl">
                <div class="p-6 border-b border-white/20 bg-white/50 backdrop-blur-sm flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-secondary-800">Daftar Sesi Konsultasi</h3>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold text-emerald-700 bg-emerald-100 rounded-full">
                        Total: {{ $sessions->total() }}
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-secondary-500 uppercase bg-secondary-50/80 border-b border-secondary-100">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Konselor</th>
                                <th class="px-6 py-4 font-semibold">Jadwal</th>
                                <th class="px-6 py-4 font-semibold">Topik</th>
                                <th class="px-6 py-4 font-semibold">Status</th>
                                <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($sessions as $session)
                            <tr class="hover:bg-secondary-50/50 transition-colors duration-200 group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white shadow-md bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full">
                                            {{ strtoupper(substr($session->client->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-secondary-900 group-hover:text-primary-600 transition-colors">{{ $session->client->name }}</div>
                                            <div class="text-xs text-secondary-400">{{ $session->client->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-secondary-900 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $session->schedule->date->format('d M Y') }}
                                        </span>
                                        <span class="text-xs text-secondary-500 flex items-center gap-2 mt-1">
                                            <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $session->schedule->time->format('H:i') }} WIB
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-violet-50 text-violet-700 text-xs font-medium">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                        {{ $session->topic->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = [
                                            'completed' => 'bg-green-100 text-green-700 border-green-200',
                                            'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                                            'in_progress' => 'bg-blue-100 text-blue-700 border-blue-200',
                                            'scheduled' => 'bg-yellow-100 text-yellow-700 border-yellow-200'
                                        ];
                                        $statusClass = $statusClasses[$session->status] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                                    @endphp
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full border {{ $statusClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $session->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                        <a href="{{ route('sessions.show', $session) }}" class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 hover:scale-110 transition-all" title="Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        <a href="{{ route('sessions.edit', $session) }}" class="p-2 text-amber-600 bg-amber-50 rounded-lg hover:bg-amber-100 hover:scale-110 transition-all" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('sessions.destroy', $session) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sesi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 hover:scale-110 transition-all" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-secondary-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="p-4 bg-gray-50 rounded-full mb-3">
                                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </div>
                                        <p class="text-lg font-medium">Belum ada data Sesi</p>
                                        <p class="text-sm mt-1">Mulai dengan menambahkan sesi konsultasi baru.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($sessions->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $sessions->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>