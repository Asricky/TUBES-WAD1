<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex justify-between items-center">
            <h1 class="dashboard-title">Daftar Klien</h1>
            <a href="<?php echo e(route('clients.create')); ?>" class="btn-action btn-primary">
                <i class="fas fa-plus icon"></i>
                Tambah Klien
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
                <table class="min-w-full table-auto border border-gray-200 rounded-lg shadow-sm text-sm text-gray-700">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="p-3 text-left">Nama</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">No. HP</th>
                            <th class="p-3 text-left">Alamat</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="p-3"><?php echo e($client->name); ?></td>
                            <td class="p-3"><?php echo e($client->email); ?></td>
                            <td class="p-3"><?php echo e($client->phone); ?></td>
                            <td class="p-3"><?php echo e($client->address); ?></td>
                            <td class="p-3 flex justify-center gap-2">
                                <a href="<?php echo e(route('clients.show', $client)); ?>" class="btn-action btn-secondary">
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </a>
                                <a href="<?php echo e(route('clients.edit', $client)); ?>" class="btn-action btn-secondary">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <form action="<?php echo e(route('clients.destroy', $client)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-action btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                <?php echo e($clients->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\TUBES-WAD1\resources\views/clients/index.blade.php ENDPATH**/ ?>