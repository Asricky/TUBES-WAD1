<?php $__env->startSection('content'); ?>
<div class="p-6 space-y-10 bg-gray-50 min-h-screen">

    <div class="stats-grid">
        <!-- Total Konselor -->
        <div class="stat-card">
            <div class="stat-label">
                <i class="fas fa-users icon"></i>
                Total Konselor
            </div>
            <div class="stat-value"><?php echo e(\App\Models\Client::count()); ?></div>
        </div>

        <!-- Jadwal Hari Ini -->
        <div class="stat-card">
            <div class="stat-label">
                <i class="fas fa-calendar-day icon"></i>
                Jadwal Hari Ini
            </div>
            <div class="stat-value"><?php echo e(\App\Models\Schedule::whereDate('date', today())->count()); ?></div>
        </div>

        <!-- Total Sesi -->
        <div class="stat-card">
            <div class="stat-label">
                <i class="fas fa-comments icon"></i>
                Total Sesi
            </div>
            <div class="stat-value"><?php echo e(\App\Models\Session::count()); ?></div>
        </div>

        <!-- Total Topik -->
        <div class="stat-card">
            <div class="stat-label">
                <i class="fas fa-tags icon"></i>
                Total Topik
            </div>
            <div class="stat-value"><?php echo e(\App\Models\Topic::count()); ?></div>
        </div>
    </div>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php
            $stats = [
                ['icon' => 'users', 'color' => 'blue', 'label' => 'Total Konselor', 'value' => \App\Models\Client::count()],
                ['icon' => 'calendar-day', 'color' => 'green', 'label' => 'Jadwal Hari Ini', 'value' => \App\Models\Schedule::whereDate('date', today())->count()],
                ['icon' => 'comments', 'color' => 'purple', 'label' => 'Total Sesi', 'value' => \App\Models\Session::count()],
                ['icon' => 'tags', 'color' => 'yellow', 'label' => 'Total Topik', 'value' => \App\Models\Topic::count()],
            ];
        ?>

        <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-6 border border-gray-100 hover:border-<?php echo e($stat['color']); ?>-200">
                <div class="text-4xl text-<?php echo e($stat['color']); ?>-500">
                    <i class="fas fa-<?php echo e($stat['icon']); ?>"></i>
                </div>
                <div>
                    <div class="text-lg text-gray-500"><?php echo e($stat['label']); ?></div>
                    <div class="text-2xl font-bold text-gray-800"><?php echo e($stat['value']); ?></div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 pb-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <span>Jadwal Konsultasi Terbaru</span>
                    </h2>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th>Konselor</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__currentLoopData = \App\Models\Schedule::with('client')->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900"><?php echo e($schedule->client->name); ?></div>
                                        <div class="text-gray-500 text-xs"><?php echo e($schedule->client->email); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-gray-900 flex items-center">
                                    <i class="far fa-calendar-alt mr-2 text-blue-500"></i>
                                    <?php echo e($schedule->date->format('d M Y')); ?>

                                </div>
                                <div class="text-gray-500 text-sm flex items-center mt-1">
                                    <i class="far fa-clock mr-2 text-green-500"></i>
                                    <?php echo e($schedule->time->format('H:i')); ?>

                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $schedule->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($schedule->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="<?php echo e(route('schedules.show', $schedule)); ?>" class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200 hover:text-blue-800 transition-all duration-200" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 bg-gray-50 text-right text-sm border-t border-gray-100">
                <a href="<?php echo e(route('schedules.index')); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                    <span>Lihat Semua Jadwal</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 pb-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <div class="p-2 bg-purple-100 rounded-lg text-purple-600">
                            <i class="fas fa-comments"></i>
                        </div>
                        <span>Sesi Konsultasi Terbaru</span>
                    </h2>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Konselor</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Topik</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__currentLoopData = \App\Models\Session::with(['client', 'topic', 'schedule'])->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900"><?php echo e($session->client->name); ?></div>
                                        <div class="text-gray-500 text-xs"><?php echo e($session->client->email); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-gray-900 flex items-center">
                                    <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                                    <?php echo e($session->topic->name); ?>

                                </div>
                                <div class="text-gray-500 text-xs mt-1 flex items-center">
                                    <i class="far fa-calendar-alt mr-2 text-blue-500"></i>
                                    <?php echo e($session->schedule->date->format('d M Y')); ?>

                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $session->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($session->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="<?php echo e(route('sessions.show', $session)); ?>" class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200 hover:text-blue-800 transition-all duration-200" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 bg-gray-50 text-right text-sm border-t border-gray-100">
                <a href="<?php echo e(route('sessions.index')); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                    <span>Lihat Semua Sesi</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Sesi Terbaru -->
    <div class="content-card">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fas fa-comments icon"></i>
                Sesi Konsultasi Terbaru
            </h2>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Konselor</th>
                            <th>Topik</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = \App\Models\Session::with(['client', 'topic', 'schedule'])->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="font-medium"><?php echo e($session->client->name); ?></div>
                                <div class="text-gray-500 text-sm"><?php echo e($session->client->email); ?></div>
                            </td>
                            <td><?php echo e($session->topic->name); ?></td>
                            <td>
                                <span class="status-badge <?php echo e($session->status == 'completed' ? 'status-completed' :
                                    ($session->status == 'cancelled' ? 'status-cancelled' :
                                    ($session->status == 'in_progress' ? 'status-confirmed' : 'status-pending'))); ?>">
                                    <?php echo e(ucfirst($session->status)); ?>

                                </span>
                            </td>
                            <td><?php echo e($session->schedule->date->format('d/m/Y')); ?></td>
                            <td>
                                <a href="<?php echo e(route('sessions.show', $session)); ?>" class="btn-action btn-secondary">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ADMIN\Documents\Kuliah\SEMESTER 4\PENGEMBANGAN APLIKASI WEBSITE\TUBES-WAD1\resources\views/dashboard.blade.php ENDPATH**/ ?>