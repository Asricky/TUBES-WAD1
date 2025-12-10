<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-secondary-50 text-secondary-900 selection:bg-primary-500 selection:text-white overflow-x-hidden">
        
        <!-- Background Elements -->
        <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-primary-400/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-blue-400/10 rounded-full blur-3xl translate-y-1/3 -translate-x-1/3"></div>
        </div>

        <!-- Navbar -->
        <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
            <div class="glass border-b border-white/20 bg-white/70 backdrop-blur-md">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-20 items-center">
                        <div class="flex-shrink-0 flex items-center gap-3">
                            <div class="p-2 bg-gradient-to-br from-primary-600 to-blue-600 rounded-xl shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <span class="font-bold text-2xl tracking-tight text-secondary-900">Tell2U</span>
                        </div>
                        <div class="flex items-center gap-4">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-xl font-medium text-secondary-600 hover:text-primary-600 hover:bg-white transition-all">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl font-medium text-secondary-600 hover:text-primary-600 hover:bg-white transition-all hidden sm:block">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary-600 to-blue-600 text-white font-semibold shadow-lg shadow-primary-500/30 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                                            Mulai Sekarang
                                        </a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="pt-32 pb-16 sm:pt-40 sm:pb-24 lg:pb-32 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-center">
                    <div class="lg:col-span-6 text-center lg:text-left animate-slide-up">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-sm font-semibold mb-6 border border-blue-100">
                            <span class="flex h-2 w-2 rounded-full bg-blue-600"></span>
                            Platform Manajemen Konseling Terpercaya
                        </div>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-secondary-900 mb-6 leading-tight">
                            Solusi Cerdas untuk <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-blue-600">Layanan Konseling</span>
                        </h1>
                        <p class="mt-4 text-xl text-secondary-600 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                            Kelola jadwal, klien, dan sesi konseling Anda dalam satu platform yang aman, efisien, dan mudah digunakan. Fokus pada klien Anda, biarkan kami yang mengurus administrasinya.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-primary-600 to-blue-600 text-white font-bold text-lg shadow-xl shadow-primary-500/30 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 group">
                                Daftar Gratis
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </a>
                            @endif
                            <!-- Added Learn More button for functionality -->
                            <a href="#features" class="px-8 py-4 rounded-xl bg-white text-secondary-700 font-bold text-lg shadow-md border border-secondary-200 hover:bg-secondary-50 hover:border-secondary-300 transition-all duration-300">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                        
                        <div class="mt-10 flex items-center justify-center lg:justify-start gap-8 text-secondary-400 grayscale opacity-70">
                             <!-- Simple logos for trust indicators -->
                             <span class="text-lg font-bold">Trusted by Counselors</span>
                        </div>
                    </div>
                    
                    <div class="lg:col-span-6 mt-16 lg:mt-0 relative">
                        <div class="relative rounded-2xl bg-white/40 backdrop-blur-xl border border-white/50 p-4 shadow-2xl animate-fade-in delay-200">
                             <div class="absolute -top-10 -right-10 w-24 h-24 bg-yellow-400 rounded-full blur-2xl opacity-20 animate-pulse"></div>
                             <div class="rounded-xl overflow-hidden shadow-sm border border-secondary-100 bg-white">
                                <!-- Mockup Interface -->
                                <div class="w-full bg-secondary-50 border-b border-secondary-100 p-3 flex gap-2">
                                    <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                    <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                    <div class="w-3 h-3 rounded-full bg-green-400"></div>
                                </div>
                                <div class="p-6 space-y-4">
                                    <div class="flex justify-between items-center mb-6">
                                        <div class="h-8 w-32 bg-secondary-100 rounded-lg"></div>
                                        <div class="h-8 w-8 bg-blue-100 rounded-full"></div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4 mb-6">
                                        <div class="h-24 bg-primary-50 rounded-xl border border-primary-100 p-4">
                                            <div class="h-4 w-4 bg-primary-200 rounded mb-2"></div>
                                            <div class="h-2 w-16 bg-primary-100 rounded"></div>
                                        </div>
                                        <div class="h-24 bg-blue-50 rounded-xl border border-blue-100 p-4">
                                            <div class="h-4 w-4 bg-blue-200 rounded mb-2"></div>
                                            <div class="h-2 w-16 bg-blue-100 rounded"></div>
                                        </div>
                                        <div class="h-24 bg-secondary-50 rounded-xl border border-secondary-100 p-4">
                                             <div class="h-4 w-4 bg-secondary-200 rounded mb-2"></div>
                                             <div class="h-2 w-16 bg-secondary-100 rounded"></div>
                                        </div>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="h-12 w-full bg-secondary-50 rounded-lg border border-secondary-100"></div>
                                        <div class="h-12 w-full bg-secondary-50 rounded-lg border border-secondary-100"></div>
                                        <div class="h-12 w-full bg-secondary-50 rounded-lg border border-secondary-100"></div>
                                    </div>
                                </div>
                             </div>
                        </div>
                        
                        <!-- Floating Card -->
                        <div class="absolute -bottom-6 -left-6 glass p-4 rounded-xl shadow-xl border-l-4 border-l-green-500 animate-slide-up delay-500">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-green-100 rounded-lg text-green-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-secondary-500 font-medium">Status Update</p>
                                    <p class="text-sm font-bold text-secondary-900">Sesi Terjadwal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Features Section -->
        <section id="features" class="py-20 relative bg-white/50 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl font-bold text-secondary-900 mb-4">Fitur Unggulan</h2>
                    <p class="text-secondary-600 text-lg">Semua yang Anda butuhkan untuk mengelola layanan konseling dengan profesional dan efisien.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="glass p-8 rounded-2xl hover:bg-white transition-all duration-300 group">
                        <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-md">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-secondary-900 mb-3">Manajemen Jadwal</h3>
                        <p class="text-secondary-600 leading-relaxed">
                            Atur jadwal konsultasi dengan mudah. Hindari jadwal bentrok dan pantau ketersediaan waktu secara real-time.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="glass p-8 rounded-2xl hover:bg-white transition-all duration-300 group">
                         <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-md">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-secondary-900 mb-3">Database Konselor</h3>
                        <p class="text-secondary-600 leading-relaxed">
                            Simpan data konselor dengan aman. Akses riwayat interaksi dan informasi penting lainnya kapan saja.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="glass p-8 rounded-2xl hover:bg-white transition-all duration-300 group">
                         <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-md">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-secondary-900 mb-3">Catatan Sesi</h3>
                        <p class="text-secondary-600 leading-relaxed">
                            Dokumentasikan setiap sesi konsultasi. Upload file pendukung dan buat ringkasan hasil pertemuan dengan rapi.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative bg-gradient-to-br from-primary-900 to-blue-900 rounded-3xl overflow-hidden shadow-2xl">
                    <!-- Background Patterns -->
                    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl"></div>
                    
                    <div class="relative z-10 p-12 text-center">
                        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">Siap Meningkatkan Layanan Konseling Anda?</h2>
                        <p class="text-blue-100 text-lg mb-10 max-w-2xl mx-auto">
                            Bergabunglah sekarang dan rasakan kemudahan dalam mengelola sesi konseling. Sistem terintegrasi untuk profesional seperti Anda.
                        </p>
                         @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-block px-10 py-4 bg-white text-primary-900 font-bold text-lg rounded-xl shadow-lg hover:bg-blue-50 transform hover:-translate-y-1 transition-all duration-300">
                            Daftar Sekarang - Gratis
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white border-t border-secondary-100 pt-16 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-2">
                        <div class="p-1.5 bg-gradient-to-br from-primary-600 to-blue-600 rounded-lg">
                             <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        <span class="font-bold text-xl text-secondary-900">Tell2U</span>
                    </div>
                    <p class="text-secondary-500 text-sm">
                        &copy; {{ date('Y') }} Tell2U. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>
