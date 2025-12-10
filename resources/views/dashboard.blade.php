<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-3xl shadow-xl p-8 text-white relative overflow-hidden animate-fade-in">
                <div class="absolute inset-0 bg-white/10 backdrop-blur-3xl opacity-20"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-primary-100 text-lg max-w-2xl">
                        Selamat datang kembali di Tell2U. Kelola data konseling, jadwal, dan klien Anda dengan mudah dan efisien.
                    </p>
                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('schedules.index') }}" class="px-6 py-3 bg-white text-primary-700 font-semibold rounded-xl shadow-lg hover:bg-primary-50 transition-all duration-300 transform hover:-translate-y-1">
                            Lihat Jadwal
                        </a>
                        <a href="{{ route('clients.index') }}" class="px-6 py-3 bg-primary-700/50 text-white font-semibold rounded-xl border border-white/20 hover:bg-primary-600/50 transition-all duration-300">
                            Data Konselor
                        </a>
                    </div>
                </div>
                <!-- Decorative Circle -->
                <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -top-24 -right-12 w-48 h-48 bg-primary-400/20 rounded-full blur-2xl"></div>
            </div>

            <!-- Quick Stats/Access Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Data Konselor -->
                <a href="{{ route('clients.index') }}" class="glass p-6 rounded-2xl border-l-4 border-primary-500 hover:border-l-8 transition-all duration-300 hover:shadow-lg group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-primary-100 rounded-xl group-hover:bg-primary-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                    <h4 class="text-lg font-semibold text-secondary-800">Data Konselor</h4>
                    <p class="text-secondary-500 text-sm mt-1">Kelola data dosen dan teman sebaya</p>
                </a>

                <!-- Jadwal Konsultasi -->
                <a href="{{ route('schedules.index') }}" class="glass p-6 rounded-2xl border-l-4 border-blue-500 hover:border-l-8 transition-all duration-300 hover:shadow-lg group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-100 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <h4 class="text-lg font-semibold text-secondary-800">Jadwal Konsultasi</h4>
                    <p class="text-secondary-500 text-sm mt-1">Atur jadwal ketersediaan waktu</p>
                </a>

                <!-- Sesi Konsultasi -->
                <a href="{{ route('sessions.index') }}" class="glass p-6 rounded-2xl border-l-4 border-emerald-500 hover:border-l-8 transition-all duration-300 hover:shadow-lg group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-emerald-100 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                        </div>
                    </div>
                    <h4 class="text-lg font-semibold text-secondary-800">Sesi Konsultasi</h4>
                    <p class="text-secondary-500 text-sm mt-1">Riwayat dan daftar sesi aktif</p>
                </a>

                <!-- Topik Konsultasi -->
                <a href="{{ route('topics.index') }}" class="glass p-6 rounded-2xl border-l-4 border-violet-500 hover:border-l-8 transition-all duration-300 hover:shadow-lg group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-violet-100 rounded-xl group-hover:bg-violet-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                    </div>
                    <h4 class="text-lg font-semibold text-secondary-800">Topik Konsultasi</h4>
                    <p class="text-secondary-500 text-sm mt-1">Kategori permasalahan</p>
                </a>
            </div>

            <!-- Recent Activity using Real Data -->
             <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Sessions -->
                <div class="glass rounded-2xl p-6">
                    <h4 class="text-lg font-bold text-secondary-800 mb-4 flex items-center gap-2">
                        <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                        Sesi Terbaru
                    </h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-secondary-500 uppercase bg-secondary-50/50">
                                <tr>
                                    <th class="px-4 py-3">Konselor</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse(\App\Models\Session::with('client')->latest()->take(5)->get() as $session)
                                <tr class="hover:bg-secondary-50 transition-colors">
                                    <td class="px-4 py-3 font-medium text-secondary-900">{{ $session->client->name }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $session->status === 'completed' ? 'bg-green-100 text-green-700' : 
                                               ($session->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                            {{ ucfirst($session->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-secondary-500">{{ $session->schedule?->date ? $session->schedule->date->format('d M') : '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-center text-secondary-500">Belum ada sesi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                 <!-- Recent Schedules -->
                 <div class="glass rounded-2xl p-6">
                    <h4 class="text-lg font-bold text-secondary-800 mb-4 flex items-center gap-2">
                        <span class="w-2 h-8 bg-blue-500 rounded-full"></span>
                        Jadwal Terbaru
                    </h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-secondary-500 uppercase bg-secondary-50/50">
                                <tr>
                                    <th class="px-4 py-3">Konselor</th>
                                    <th class="px-4 py-3">Waktu</th>
                                    <th class="px-4 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse(\App\Models\Schedule::with('client')->latest()->take(5)->get() as $schedule)
                                <tr class="hover:bg-secondary-50 transition-colors">
                                    <td class="px-4 py-3 font-medium text-secondary-900">{{ $schedule->client->name }}</td>
                                    <td class="px-4 py-3 text-secondary-500">
                                        {{ $schedule->date->format('d M') }} {{ $schedule->formatted_time }}
                                    </td>
                                    <td class="px-4 py-3">
                                         <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $schedule->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ ucfirst($schedule->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-center text-secondary-500">Belum ada jadwal.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>