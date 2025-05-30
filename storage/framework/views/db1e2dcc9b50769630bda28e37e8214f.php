<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Detail Klien</h2>
                <div>
                    <a href="<?php echo e(route('clients.edit', $client)); ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Edit
                    </a>
                    <a href="<?php echo e(route('clients.index')); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Nama</h3>
                        <p class="text-gray-900"><?php echo e($client->name); ?></p>
                    </div>

                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Email</h3>
                        <p class="text-gray-900"><?php echo e($client->email); ?></p>
                    </div>

                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">No. HP</h3>
                        <p class="text-gray-900"><?php echo e($client->phone); ?></p>
                    </div>

                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Alamat</h3>
                        <p class="text-gray-900"><?php echo e($client->address); ?></p>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-gray-600 text-sm font-bold">Catatan</h3>
                        <p class="text-gray-900"><?php echo e($client->notes ?? '-'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Jadwal Konsultasi -->
            <div class="mt-8">
                <h3 class="text-xl font-bold mb-4">Jadwal Konsultasi</h3>
                <?php if($client->schedules->count() > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $client->schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($schedule->date->format('d/m/Y')); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($schedule->time->format('H:i')); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($schedule->status); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="<?php echo e(route('schedules.show', $schedule)); ?>" class="text-blue-600 hover:text-blue-900">Detail</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Belum ada jadwal konsultasi.</p>
                <?php endif; ?>
            </div>

            <!-- Riwayat Konsultasi -->
            <div class="mt-8">
                <h3 class="text-xl font-bold mb-4">Riwayat Konsultasi</h3>
                <?php if($client->sessions->count() > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Topik</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $client->sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($session->created_at->format('d/m/Y')); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($session->topic->name); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo e($session->status); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="<?php echo e(route('sessions.show', $session)); ?>" class="text-blue-600 hover:text-blue-900">Detail</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Belum ada riwayat konsultasi.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?> <?php /**PATH C:\xampp\htdocs\TUBES-WAD1\resources\views/clients/show.blade.php ENDPATH**/ ?>