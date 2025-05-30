<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex justify-between items-center">
            <h1 class="dashboard-title">Daftar Sesi Konsultasi</h1>
            <a href="<?php echo e(route('sessions.create')); ?>" class="btn-action btn-primary">
                <i class="fas fa-plus icon"></i>
                Tambah Sesi
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
                            <th>Jadwal</th>
                            <th>Topik</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="font-medium"><?php echo e($session->client->name); ?></div>
                                <div class="text-gray-500 text-sm"><?php echo e($session->client->email); ?></div>
                            </td>
                            <td>
                                <div class="font-medium"><?php echo e($session->schedule->date->format('d/m/Y')); ?></div>
                                <div class="text-gray-500 text-sm"><?php echo e($session->schedule->time->format('H:i')); ?></div>
                            </td>
                            <td><?php echo e($session->topic->name); ?></td>
                            <td>
                                <span class="status-badge <?php echo e($session->status == 'completed' ? 'status-completed' :
                                    ($session->status == 'cancelled' ? 'status-cancelled' :
                                    ($session->status == 'in_progress' ? 'status-confirmed' : 'status-pending'))); ?>">
                                    <?php echo e(ucfirst($session->status)); ?>

                                </span>
                            </td>
                            <td class="flex gap-2">
                                <a href="<?php echo e(route('sessions.show', $session)); ?>" class="btn-action btn-secondary">
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </a>
                                <a href="<?php echo e(route('sessions.edit', $session)); ?>" class="btn-action btn-secondary">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <form action="<?php echo e(route('sessions.destroy', $session)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-action btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus sesi ini?')">
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
                <?php echo e($sessions->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TUBES-WAD1\resources\views/sessions/index.blade.php ENDPATH**/ ?>