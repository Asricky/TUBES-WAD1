<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-secondary-800">
            {{ __('Dokumen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="glass overflow-hidden rounded-2xl flex flex-col items-center justify-center py-20 text-center">
                <div class="p-4 bg-blue-50 text-blue-500 rounded-full mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-secondary-900 mb-2">Modul Dokumen</h3>
                <p class="text-secondary-600 max-w-md">
                    Fitur manajemen dokumen dan lampiran sedang dalam pengembangan. Silakan kembali lagi nanti.
                </p>
                <div class="mt-8">
                    <a href="{{ route('dashboard') }}" class="btn-primary">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
