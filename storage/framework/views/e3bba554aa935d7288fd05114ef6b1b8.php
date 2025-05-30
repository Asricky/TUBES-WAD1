<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex justify-between items-center">
            <h1 class="dashboard-title">Daftar Jadwal</h1>
            <a href="<?php echo e(route('schedules.create')); ?>" class="btn-action btn-primary">
                <i class="fas fa-plus icon"></i>
                Tambah Jadwal
            </a>
        </div>
    </div>

    <div class="content-card">
        <div class="card-body">
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

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
                        <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            <td class="flex gap-2">
                                <a href="<?php echo e(route('schedules.show', $schedule)); ?>" class="btn-action btn-secondary">
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </a>
                                <a href="<?php echo e(route('schedules.edit', $schedule)); ?>" class="btn-action btn-secondary">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <form action="<?php echo e(route('schedules.destroy', $schedule)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-action btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <?php echo e($schedules->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TUBES-WAD1\resources\views/schedules/index.blade.php ENDPATH**/ ?>