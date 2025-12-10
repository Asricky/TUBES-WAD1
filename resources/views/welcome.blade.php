<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }} - Konsultasi Online Profesional</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; overflow-x: hidden; position: relative; }
            body::before { content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: linear-gradient(45deg, transparent 0%, rgba(255,255,255,0.05) 25%, transparent 50%, rgba(255,255,255,0.05) 75%, transparent 100%); animation: shimmer 15s linear infinite; pointer-events: none; }
            @keyframes shimmer { 0% { transform: translateX(-50%) translateY(-50%) rotate(0deg); } 100% { transform: translateX(-50%) translateY(-50%) rotate(360deg); } }
            nav { position: fixed; top: 0; left: 0; right: 0; z-index: 100; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(102, 126, 234, 0.1); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); }
            .nav-container { max-width: 1200px; margin: 0 auto; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
            .logo { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; }
            .logo-icon { width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.25rem; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3); }
            .logo-text { font-size: 1.5rem; font-weight: 700; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
            .nav-links { display: flex; gap: 1rem; align-items: center; }
            .btn { padding: 0.75rem 1.75rem; border-radius: 12px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; }
            .btn-secondary { background: transparent; color: #667eea; border: 2px solid transparent; }
            .btn-secondary:hover { color: #764ba2; background: rgba(102, 126, 234, 0.05); }
            .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3); }
            .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4); }
            .hero { padding: 8rem 2rem 4rem; max-width: 1200px; margin: 0 auto; position: relative; z-index: 1; }
            .hero-content { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
            .hero-text { animation: slideUp 0.8s ease-out; }
            @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
            .badge { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: rgba(255, 255, 255, 0.95); border-radius: 50px; font-size: 0.875rem; font-weight: 600; color: #667eea; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); }
            .badge-dot { width: 8px; height: 8px; background: #667eea; border-radius: 50%; animation: pulse 2s ease-in-out infinite; }
            @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
            h1 { font-size: 3.5rem; font-weight: 800; line-height: 1.2; color: white; margin-bottom: 1.5rem; }
            .gradient-text { background: linear-gradient(135deg, #fff 0%, #f0f0ff 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
            .hero-description { font-size: 1.25rem; color: rgba(255, 255, 255, 0.9); line-height: 1.8; margin-bottom: 2.5rem; }
            .hero-buttons { display: flex; gap: 1rem; flex-wrap: wrap; }
            .btn-large { padding: 1rem 2rem; font-size: 1.125rem; }
            .btn-white { background: white; color: #667eea; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); }
            .btn-white:hover { transform: translateY(-2px); box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15); }
            .hero-image { position: relative; animation: fadeIn 1s ease-out 0.3s both; }
            @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
            .mockup-card { background: white; border-radius: 24px; padding: 2rem; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2), 0 0 100px rgba(102, 126, 234, 0.15); position: relative; overflow: hidden; }
            .mockup-card::before { content: ''; position: absolute; top: -50%; right: -50%; width: 200px; height: 200px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); border-radius: 50%; animation: float 6s ease-in-out infinite; }
            @keyframes float { 0%, 100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-20px) rotate(180deg); } }
            .mockup-header { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; }
            .mockup-dot { width: 12px; height: 12px; border-radius: 50%; }
            .dot-red { background: #ef4444; }
            .dot-yellow { background: #f59e0b; }
            .dot-green { background: #10b981; }
            .stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem; }
            .stat-card { background: linear-gradient(135deg, #f8f9ff 0%, #f0f2ff 100%); padding: 1.5rem 1rem; border-radius: 16px; border: 2px solid rgba(102, 126, 234, 0.1); text-align: center; transition: transform 0.3s ease; }
            .stat-card:hover { transform: translateY(-5px); }
            .stat-number { font-size: 2rem; font-weight: 700; color: #667eea; margin-bottom: 0.25rem; }
            .stat-label { font-size: 0.875rem; color: #64748b; font-weight: 500; }
            .features { background: rgba(255, 255, 255, 0.95); padding: 6rem 2rem; position: relative; }
            .section-title { text-align: center; max-width: 700px; margin: 0 auto 4rem; }
            .section-title h2 { font-size: 2.5rem; font-weight: 800; color: #1e293b; margin-bottom: 1rem; }
            .section-title p { font-size: 1.125rem; color: #64748b; line-height: 1.7; }
            .features-grid { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; }
            .feature-card { background: white; padding: 2.5rem; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 2px solid transparent; transition: all 0.3s ease; }
            .feature-card:hover { border-color: #667eea; transform: translateY(-8px); box-shadow: 0 12px 30px rgba(102, 126, 234, 0.15); }
            .feature-icon { width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; font-size: 1.75rem; transition: transform 0.3s ease; }
            .feature-card:hover .feature-icon { transform: scale(1.1); }
            .icon-blue { background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #2563eb; }
            .icon-purple { background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%); color: #7c3aed; }
            .icon-green { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #059669; }
            .feature-card h3 { font-size: 1.5rem; font-weight: 700; color: #1e293b; margin-bottom: 1rem; }
            .feature-card p { color: #64748b; line-height: 1.7; }
            .cta { background: linear-gradient(135deg, #1e3a8a 0%, #4338ca 100%); padding: 6rem 2rem; text-align: center; position: relative; overflow: hidden; }
            .cta::before { content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); animation: rotate 20s linear infinite; }
            @keyframes rotate { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
            .cta-content { max-width: 800px; margin: 0 auto; position: relative; z-index: 1; }
            .cta h2 { font-size: 2.5rem; font-weight: 800; color: white; margin-bottom: 1.5rem; }
            .cta p { font-size: 1.25rem; color: rgba(255, 255, 255, 0.9); margin-bottom: 2.5rem; line-height: 1.7; }
            footer { background: rgba(255, 255, 255, 0.95); padding: 3rem 2rem 2rem; border-top: 2px solid rgba(102, 126, 234, 0.1); }
            .footer-content { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 2rem; }
            .footer-content p { color: #64748b; }
            @media (max-width: 768px) { .hero-content { grid-template-columns: 1fr; gap: 3rem; } h1 { font-size: 2.5rem; } .hero-description { font-size: 1.125rem; } .nav-links .btn-secondary { display: none; } .stat-grid { grid-template-columns: 1fr; } }
        </style>
    </head>
    <body>
        <nav>
            <div class="nav-container">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('images/tell2u_logo.png') }}" alt="Tell2U Logo" style="height: 55px; width: auto;">
                </a>
                <div class="nav-links">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary"><i class="fas fa-th-large"></i> Dashboard</a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary"><i class="fas fa-rocket"></i> Mulai Sekarang</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <section class="hero">
            <div class="hero-content">
                <div class="hero-text">
                    <div class="badge"><span class="badge-dot"></span> Platform Konsultasi #1 di Indonesia</div>
                    <h1>Kelola Konseling<br><span class="gradient-text">Lebih Profesional</span></h1>
                    <p class="hero-description">Sistem manajemen konsultasi all-in-one yang membantu Anda fokus pada klien. Jadwal otomatis, notifikasi real-time, dan laporan lengkap dalam satu platform.</p>
                    <div class="hero-buttons">
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-white btn-large"><i class="fas fa-rocket"></i> Daftar Gratis Sekarang</a>
                        @endif
                        <a href="#features" class="btn btn-primary btn-large"><i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="hero-image">
                    <div class="mockup-card">
                        <div class="mockup-header">
                            <div class="mockup-dot dot-red"></div>
                            <div class="mockup-dot dot-yellow"></div>
                            <div class="mockup-dot dot-green"></div>
                        </div>
                        <div class="stat-grid">
                            <div class="stat-card"><div class="stat-number">150+</div><div class="stat-label">Konselor</div></div>
                            <div class="stat-card"><div class="stat-number">2.5K</div><div class="stat-label">Sesi/Bulan</div></div>
                            <div class="stat-card"><div class="stat-number">98%</div><div class="stat-label">Kepuasan</div></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="features">
            <div class="section-title">
                <h2>Fitur Unggulan</h2>
                <p>Semua yang Anda butuhkan untuk mengelola layanan konseling dengan profesional dan efisien</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon icon-blue"><i class="fas fa-calendar-check"></i></div>
                    <h3>Manajemen Jadwal</h3>
                    <p>Atur jadwal konsultasi dengan mudah. Sistem otomatis mencegah double booking dan mengirimkan reminder ke klien.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon icon-purple"><i class="fas fa-users"></i></div>
                    <h3>Database Klien</h3>
                    <p>Simpan data klien dengan aman. Akses riwayat konsultasi dan catatan penting kapan saja, di mana saja.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon icon-green"><i class="fas fa-video"></i></div>
                    <h3>Video Conference</h3>
                    <p>Meeting link otomatis dibuat untuk setiap sesi. Akses tersedia 15 menit sebelum konsultasi dimulai.</p>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="cta-content">
                <h2>Siap Meningkatkan Layanan Konseling Anda?</h2>
                <p>Bergabunglah dengan ratusan konselor profesional yang telah mempercayai Tell2U untuk mengelola praktik mereka.</p>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-white btn-large"><i class="fas fa-rocket"></i> Mulai Gratis Sekarang</a>
                @endif
            </div>
        </section>

        <footer>
            <div class="footer-content">
                <div class="logo">
                    <img src="{{ asset('images/tell2u_logo.png') }}" alt="Tell2U Logo" style="height: 45px; width: auto;">
                </div>
                <p>&copy; {{ date('Y') }} Tell2U. All rights reserved.</p>
            </div>
        </footer>

        <script>
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            });
        </script>
    </body>
</html>
