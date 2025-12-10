<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary-800 leading-tight">
            {{ __('Jadwal Tersedia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 text-green-700 bg-green-100 border-l-4 border-green-500 rounded-r-lg shadow-sm animate-fade-in flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 text-red-700 bg-red-100 border-l-4 border-red-500 rounded-r-lg shadow-sm animate-fade-in flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif
            
            <!-- Filter -->
            <div class="glass p-6 rounded-2xl mb-6">
                <form method="GET" action="{{ route('user.jadwal') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Tanggal</label>
                        <input type="date" name="date" value="{{ request('date') }}" class="w-full rounded-lg border-secondary-300 focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Konselor</label>
                        <select name="client_id" class="w-full rounded-lg border-secondary-300 focus:border-primary-500 focus:ring-primary-500">
                            <option value="">Semua Konselor</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="btn-primary flex-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Cari
                        </button>
                        <a href="{{ route('user.jadwal') }}" class="btn-secondary">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Schedules List -->
            <div class="glass rounded-2xl p-6">
                <h3 class="text-lg font-bold text-secondary-800 mb-4 flex items-center gap-2">
                    <span class="w-2 h-6 bg-blue-500 rounded-full"></span>
                    Daftar Jadwal Konsultasi Tersedia
                </h3>

                @if($schedules->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($schedules as $schedule)
                            <div class="bg-white border border-gray-100 rounded-xl p-5 hover:shadow-md transition-all">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h4 class="font-bold text-lg text-secondary-900">{{ $schedule->client->name }}</h4>
                                        <p class="text-sm text-secondary-500">{{ $schedule->client->email }}</p>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                        Tersedia
                                    </span>
                                </div>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center gap-2 text-secondary-600">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="font-medium">{{ $schedule->date->format('d F Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-secondary-600">
                                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="font-medium">{{ $schedule->formatted_time }} WIB</span>
                                    </div>
                                </div>

                                <a href="{{ route('user.booking.create', $schedule) }}" class="block w-full text-center btn-primary">
                                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Book Sekarang
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($schedules->hasPages())
                        <div class="mt-6">
                            {{ $schedules->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <div class="p-4 bg-gray-50 rounded-full inline-block mb-4">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-secondary-900 mb-2">Tidak Ada Jadwal Tersedia</h3>
                        <p class="text-secondary-600">Belum ada jadwal konsultasi yang tersedia saat ini. Silakan cek kembali nanti.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
