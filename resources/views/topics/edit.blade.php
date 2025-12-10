<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-secondary-800">
            {{ __('Edit Topik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="glass p-8 rounded-2xl relative overflow-hidden">
                <div class="absolute -top-24 -right-12 w-64 h-64 bg-violet-400/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex items-center justify-between mb-8 relative z-10">
                    <div>
                        <h3 class="text-2xl font-bold text-secondary-900">Edit Topik</h3>
                        <p class="text-secondary-500 text-sm mt-1">Perbarui informasi topik konsultasi.</p>
                    </div>
                    <a href="{{ route('topics.index') }}" class="btn-secondary flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                </div>

                <form action="{{ route('topics.update', $topic) }}" method="POST" class="space-y-6 relative z-10">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-semibold text-secondary-700">Nama Topik <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $topic->name) }}" class="w-full rounded-xl border-gray-200 focus:border-violet-500 focus:ring-violet-500 transition-shadow" required>
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="text-sm font-semibold text-secondary-700">Deskripsi <span class="text-red-500">*</span></label>
                        <textarea name="description" id="description" rows="4" class="w-full rounded-xl border-gray-200 focus:border-violet-500 focus:ring-violet-500 transition-shadow" required>{{ old('description', $topic->description) }}</textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('topics.index') }}" class="btn-secondary">Batal</a>
                        <button type="submit" class="btn-primary bg-violet-600 hover:bg-violet-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Perbarui Topik
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>