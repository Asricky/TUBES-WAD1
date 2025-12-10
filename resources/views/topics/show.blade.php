<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-secondary-800">
            {{ __('Detail Topik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <!-- Topic Info -->
            <div class="glass p-8 rounded-2xl relative overflow-hidden">
                 <div class="absolute -top-24 -right-12 w-64 h-64 bg-violet-400/10 rounded-full blur-3xl pointer-events-none"></div>
                 
                 <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-center gap-4">
                             <div class="p-4 bg-violet-100 text-violet-600 rounded-2xl">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-3xl font-bold text-secondary-900">{{ $topic->name }}</h3>
                                <p class="text-secondary-500">Dibuat pada {{ $topic->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('topics.edit', $topic) }}" class="btn-secondary">
                                Edit
                            </a>
                            <a href="{{ route('topics.index') }}" class="btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </div>

                    <div class="bg-white/50 backdrop-blur-sm rounded-xl p-6 border border-white/40">
                        <h4 class="text-sm font-semibold text-secondary-500 uppercase tracking-wider mb-2">Deskripsi</h4>
                        <p class="text-secondary-800 leading-relaxed">{{ $topic->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Related Sessions -->
            <div class="glass p-6 rounded-2xl">
                <div class="flex items-center justify-between mb-6">
                    <h4 class="text-lg font-bold text-secondary-800 flex items-center gap-2">
                            <span class="w-2 h-6 bg-violet-500 rounded-full"></span>
                            Sesi Terkait
                    </h4>
                    <span class="px-3 py-1 bg-violet-100 text-violet-700 rounded-full text-xs font-semibold">{{ $topic->sessions->count() }} Sesi</span>
                </div>

                @if($topic->sessions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-secondary-500 uppercase bg-secondary-50/50">
                                <tr>
                                    <th class="px-4 py-3">Klien</th>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($topic->sessions as $session)
                                <tr class="hover:bg-secondary-50 transition-colors">
                                    <td class="px-4 py-3 font-medium text-secondary-900">
                                        {{ $session->client->name }}
                                        <div class="text-xs text-secondary-500 font-normal">{{ $session->client->email }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-secondary-600">{{ $session->created_at->format('d M Y, H:i') }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $session->status === 'completed' ? 'bg-green-100 text-green-700' : 
                                               ($session->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                            {{ ucfirst($session->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('sessions.show', $session) }}" class="text-primary-600 hover:text-primary-800 font-medium">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12 text-secondary-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <p>Belum ada sesi konsultasi untuk topik ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
