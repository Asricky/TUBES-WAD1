<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight text-secondary-800">
                {{ __('Daftar Topik Konsultasi') }}
            </h2>
            <a href="{{ route('topics.create') }}" class="btn-primary">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Topik
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($topics as $topic)
                <div class="glass flex flex-col h-full hover:scale-[1.02] transition-transform duration-300">
                    <div class="p-6 flex-grow">
                        <div class="flex items-start justify-between mb-4">
                            <div class="p-3 bg-violet-100 text-violet-600 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                            </div>
                            <span class="px-2 py-1 text-xs font-medium text-violet-600 bg-violet-50 rounded-full border border-violet-100">
                                {{ $topic->sessions->count() }} Sesi
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-secondary-900 mb-2">{{ $topic->name }}</h3>
                        <p class="text-secondary-600 text-sm line-clamp-3">{{ $topic->description }}</p>
                    </div>
                    
                    <div class="px-6 py-4 bg-secondary-50/50 border-t border-white/20 flex gap-2">
                        <a href="{{ route('topics.show', $topic) }}" class="flex-1 btn-secondary text-sm justify-center">
                            Detail
                        </a>
                        <a href="{{ route('topics.edit', $topic) }}" class="flex-1 btn-secondary text-sm justify-center">
                            Edit
                        </a>
                        <form action="{{ route('topics.destroy', $topic) }}" method="POST" class="flex-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus topik ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full glass p-12 text-center rounded-2xl">
                    <div class="w-16 h-16 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada topik</h3>
                    <p class="text-gray-500 mt-1">Mulai dengan menambahkan topik konsultasi baru.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $topics->links() }}
            </div>
        </div>
    </div>
</x-app-layout>