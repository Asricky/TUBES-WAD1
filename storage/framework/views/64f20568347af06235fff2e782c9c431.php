<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(config('app.name', 'Sistem Konsultasi Online')); ?></title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Vite Assets -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="<?php echo e(url('/')); ?>" class="navbar-brand">
                <i class="fas fa-comments"></i>
                Konsultasi
            </a>
            
            <button class="mobile-menu-button" id="mobileMenuButton">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="nav-menu" id="navMenu">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                    <a href="<?php echo e(route('clients.index')); ?>" class="nav-link <?php echo e(request()->routeIs('clients.*') ? 'active' : ''); ?>">
                        <i class="fas fa-users"></i>
                        Klien
                    </a>
                    <a href="<?php echo e(route('schedules.index')); ?>" class="nav-link <?php echo e(request()->routeIs('schedules.*') ? 'active' : ''); ?>">
                        <i class="fas fa-calendar"></i>
                        Jadwal
                    </a>
                    <a href="<?php echo e(route('sessions.index')); ?>" class="nav-link <?php echo e(request()->routeIs('sessions.*') ? 'active' : ''); ?>">
                        <i class="fas fa-comments"></i>
                        Sesi Konsultasi
                    </a>
                    <a href="<?php echo e(route('topics.index')); ?>" class="nav-link <?php echo e(request()->routeIs('topics.*') ? 'active' : ''); ?>">
                        <i class="fas fa-tags"></i>
                        Topik
                    </a>
                    
                    <div class="nav-dropdown">
                        <button class="nav-dropdown-button" id="userMenuButton">
                            <i class="fas fa-user"></i>
                            <?php echo e(Auth::user()->name); ?>

                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="nav-dropdown-content" id="userMenuDropdown">
                            <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
                                <i class="fas fa-user-edit"></i>
                                Profile
                            </a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="nav-link <?php echo e(request()->routeIs('login') ? 'active' : ''); ?>">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </a>
                    <a href="<?php echo e(route('register')); ?>" class="nav-link <?php echo e(request()->routeIs('register') ? 'active' : ''); ?>">
                        <i class="fas fa-user-plus"></i>
                        Register
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-error">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo e(date('Y')); ?> Sistem Konsultasi Online. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const navMenu = document.getElementById('navMenu');
        
        mobileMenuButton.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });

        // User dropdown toggle
        const userMenuButton = document.getElementById('userMenuButton');
        const userMenuDropdown = document.getElementById('userMenuDropdown');
        
        if (userMenuButton) {
            userMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                userMenuDropdown.classList.toggle('show');
            });
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.nav-dropdown')) {
                const dropdowns = document.querySelectorAll('.nav-dropdown-content');
                dropdowns.forEach(dropdown => {
                    dropdown.classList.remove('show');
                });
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.navbar')) {
                navMenu.classList.remove('active');
            }
        });
    </script>
</body>
</html> <?php /**PATH C:\Users\ADMIN\Documents\Kuliah\SEMESTER 4\PENGEMBANGAN APLIKASI WEBSITE\TUBES-WAD1\resources\views/layouts/main.blade.php ENDPATH**/ ?>