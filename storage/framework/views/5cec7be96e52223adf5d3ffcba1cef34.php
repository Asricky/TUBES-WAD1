<?php $__env->startSection('content'); ?>
<div class="p-6 space-y-6 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">

    
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                <i class="fas fa-calendar-alt text-blue-600"></i>
                Daftar Jadwal
            </h1>
            <p class="text-gray-600 mt-1">Kelola jadwal Anda dengan rapi dan efisien</p>
        </div>
        <a href="<?php echo e(route('schedules.create')); ?>"
           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-blue-800 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
            <i class="fas fa-plus-circle"></i>
            Tambah Jadwal
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 rounded-r-xl shadow-md animate-pulse">
            <div class="flex items-center gap-3">
                <i class="fas fa-check-circle text-green-600 text-lg"></i>
                <span class="font-medium"><?php echo e(session('success')); ?></span>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
            <div class="flex items-center justify-between text-white">
                <div class="flex items-center gap-3">
                    <i class="fas fa-calendar-week text-xl"></i>
                    <span class="font-semibold text-lg">Data Jadwal</span>
                </div>
                <div class="text-sm opacity-90">
                    Total: <span class="font-bold"><?php echo e($schedules->total() ?? count($schedules)); ?></span> jadwal
                </div>
            </div>
        </div>

        
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user text-blue-500"></i>
                                Konselor
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-calendar-day text-green-500"></i>
                                Tanggal
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock text-purple-500"></i>
                                Waktu
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-info-circle text-red-500"></i>
                                Status
                            </div>
                        </th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center justify-center gap-2">
                                <i class="fas fa-cogs text-gray-500"></i>
                                Aksi
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="group hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-300 hover:shadow-md">
                        <td class="px-6 py-5 text-gray-800 font-medium">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                    <?php echo e(strtoupper(substr($schedule->client->name, 0, 1))); ?>

                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">
                                        <?php echo e($schedule->client->name); ?>

                                    </div>
                                    <div class="text-sm text-gray-500"><?php echo e($schedule->client->email ?? ''); ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-calendar-day text-gray-400 text-sm"></i>
                                <span class="text-gray-700 group-hover:text-gray-900 transition-colors">
                                    <?php echo e($schedule->date->format('d/m/Y')); ?>

                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5 font-mono">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock text-gray-400 text-sm"></i>
                                <span class="text-gray-700 group-hover:text-gray-900 transition-colors">
                                    <?php echo e($schedule->time->format('H:i')); ?>

                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <?php
                                $statusClasses = [
                                    'completed' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    'in_progress' => 'bg-blue-100 text-blue-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800'
                                ];
                                $statusIcons = [
                                    'completed' => 'fa-check-circle',
                                    'cancelled' => 'fa-times-circle',
                                    'in_progress' => 'fa-spinner',
                                    'pending' => 'fa-clock'
                                ];
                                $statusKey = strtolower($schedule->status);
                            ?>
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo e($statusClasses[$statusKey] ?? 'bg-gray-100 text-gray-800'); ?>">
                                    <i class="fas <?php echo e($statusIcons[$statusKey] ?? 'fa-info-circle'); ?> mr-1"></i>
                                    <?php echo e(ucfirst(str_replace('_', ' ', $schedule->status))); ?>

                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center gap-2">
                                
                                <a href="<?php echo e(route('schedules.show', $schedule)); ?>"
                                   class="group/btn relative inline-flex items-center justify-center w-10 h-10 text-blue-600 bg-blue-50 rounded-xl border border-blue-200 hover:bg-blue-600 hover:text-white hover:shadow-lg transform hover:scale-110 transition-all duration-200"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                    <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover/btn:opacity-100 transition-opacity whitespace-nowrap">
                                        Detail
                                    </span>
                                </a>
                                
                                <a href="<?php echo e(route('schedules.edit', $schedule)); ?>"
                                   class="group/btn relative inline-flex items-center justify-center w-10 h-10 text-amber-600 bg-amber-50 rounded-xl border border-amber-200 hover:bg-amber-500 hover:text-white hover:shadow-lg transform hover:scale-110 transition-all duration-200"
                                   title="Edit Jadwal">
                                    <i class="fas fa-edit text-sm"></i>
                                    <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover/btn:opacity-100 transition-opacity whitespace-nowrap">
                                        Edit
                                    </span>
                                </a>
                                
                                <form action="<?php echo e(route('schedules.destroy', $schedule)); ?>" method="POST" class="inline-block"
                                      onsubmit="return confirm('⚠️ Apakah Anda yakin ingin menghapus jadwal ini?\n\nTindakan ini tidak dapat dibatalkan!')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                            class="group/btn relative inline-flex items-center justify-center w-10 h-10 text-red-600 bg-red-50 rounded-xl border border-red-200 hover:bg-red-600 hover:text-white hover:shadow-lg transform hover:scale-110 transition-all duration-200"
                                            title="Hapus Jadwal">
                                        <i class="fas fa-trash text-sm"></i>
                                        <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover/btn:opacity-100 transition-opacity whitespace-nowrap">
                                            Hapus
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        
        <?php if($schedules->isEmpty()): ?>
        <div class="text-center py-16">
            <div class="max-w-sm mx-auto">
                <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-times text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada jadwal</h3>
                <p class="text-gray-500 mb-6">Silakan tambahkan jadwal baru</p>
                <a href="<?php echo e(route('schedules.create')); ?>"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus"></i>
                    Tambah Jadwal
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>

    
    <?php if(!$schedules->isEmpty()): ?>
    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold"><?php echo e($schedules->firstItem()); ?></span> - 
                <span class="font-semibold"><?php echo e($schedules->lastItem()); ?></span> dari 
                <span class="font-semibold"><?php echo e($schedules->total()); ?></span> data
            </div>
            <div class="pagination-wrapper">
                <?php echo e($schedules->links()); ?>

            </div>
        </div>
    </div>
    <?php endif; ?>

</div>


<style>
    /* Custom pagination styling */
    .pagination-wrapper .pagination {
        display: flex;
        gap: 0.25rem;
    }
    
    .pagination-wrapper .page-link {
        padding: 0.5rem 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        color: #374151;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .pagination-wrapper .page-link:hover {
        background-color: #3b82f6;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
    }
    
    .pagination-wrapper .page-item.active .page-link {
        background-color: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }
    
    /* Smooth animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    tbody tr {
        animation: fadeIn 0.3s ease-out;
    }
    
    /* Responsive improvements */
    @media (max-width: 768px) {
        .overflow-x-auto {
            -webkit-overflow-scrolling: touch;
        }
        
        table th, table td {
            min-width: 120px;
        }
        
        .group/btn span {
            display: none;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ADMIN\Documents\Kuliah\SEMESTER 4\PENGEMBANGAN APLIKASI WEBSITE\TUBES-WAD1\resources\views/schedules/index.blade.php ENDPATH**/ ?>