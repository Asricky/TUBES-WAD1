<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1 class="dashboard-title">Dashboard</h1>
    </div>

    <div class="stats-grid">
        <!-- Total Klien -->
        <div class="stat-card">
            <div class="stat-label">
                <i class="fas fa-users icon"></i>
                Total Klien
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

    <!-- Jadwal Terbaru -->
    <div class="content-card">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fas fa-calendar icon"></i>
                Jadwal Konsultasi Terbaru
            </h2>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Klien</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = \App\Models\Schedule::with('client')->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="font-medium"><?php echo e($schedule->client->name); ?></div>
                                <div class="text-gray-500 text-sm"><?php echo e($schedule->client->email); ?></div>
                            </td>
                            <td><?php echo e($schedule->date->format('d/m/Y')); ?></td>
                            <td><?php echo e($schedule->time->format('H:i')); ?></td>
                            <td>
                                <span class="status-badge <?php echo e($schedule->status == 'completed' ? 'status-completed' :
                                    ($schedule->status == 'cancelled' ? 'status-cancelled' :
                                    ($schedule->status == 'confirmed' ? 'status-confirmed' : 'status-pending'))); ?>">
                                    <?php echo e(ucfirst($schedule->status)); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('schedules.show', $schedule)); ?>" class="btn-action btn-secondary">
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
                            <th>Klien</th>
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

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TUBES-WAD1\resources\views/dashboard.blade.php ENDPATH**/ ?>