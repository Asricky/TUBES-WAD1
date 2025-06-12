@extends('layouts.main')

@section('content')
<div class="p-6 space-y-6 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                <i class="fas fa-calendar-check text-blue-600"></i>
                Daftar Sesi Konsultasi
            </h1>
            <p class="text-gray-600 mt-1">Kelola sesi konsultasi dengan Konselor Anda</p>
        </div>
        <a href="{{ route('sessions.create') }}"
           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-blue-800 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
            <i class="fas fa-plus-circle"></i>
            Tambah Sesi
        </a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 rounded-r-xl shadow-md animate-pulse">
            <div class="flex items-center gap-3">
                <i class="fas fa-check-circle text-green-600 text-lg"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

            <!-- Tabel Daftar Sesi Konsultasi -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-200 rounded-lg shadow-sm text-sm text-gray-700">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="p-3 text-left">Konselor</th>
                            <th class="p-3 text-left">Jadwal</th>
                            <th class="p-3 text-left">Topik</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessions as $session)
                        <tr class="hover:bg-gray-100">
                            <td class="p-3">
                                <div class="font-medium">{{ $session->client->name }}</div>
                                <div class="text-sm text-gray-500">{{ $session->client->email }}</div>
                            </td>
                            <td class="p-3">
                                <div class="font-medium">{{ $session->schedule->date->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $session->schedule->time->format('H:i') }}</div>
                            </td>
                            <td class="p-3">{{ $session->topic->name }}</td>
                            <td class="p-3">
                                <span class="status-badge {{ 
                                    $session->status == 'completed' ? 'status-completed' :
                                    ($session->status == 'cancelled' ? 'status-cancelled' :
                                    ($session->status == 'in_progress' ? 'status-confirmed' : 'status-pending'))
                                }}">
                                    {{ ucfirst($session->status) }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2 mt-1">
                                <i class="fas fa-clock text-gray-400 text-sm"></i>
                                <span class="text-gray-700 group-hover:text-gray-900 transition-colors">
                                    {{ $session->schedule->time->format('H:i') }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-comment-dots text-gray-400 text-sm"></i>
                                <span class="text-gray-700 group-hover:text-gray-900 transition-colors">
                                    {{ $session->topic->name }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            @php
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
                            @endphp
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusClasses[$session->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    <i class="fas {{ $statusIcons[$session->status] ?? 'fa-info-circle' }} mr-1"></i>
                                    {{ ucfirst(str_replace('_', ' ', $session->status)) }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center gap-2">
                                {{-- Detail Button --}}
                                <a href="{{ route('sessions.show', $session) }}"
                                   class="group/btn relative inline-flex items-center justify-center w-10 h-10 text-blue-600 bg-blue-50 rounded-xl border border-blue-200 hover:bg-blue-600 hover:text-white hover:shadow-lg transform hover:scale-110 transition-all duration-200"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                    <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover/btn:opacity-100 transition-opacity whitespace-nowrap">
                                        Detail
                                    </span>
                                </a>

                                {{-- Edit Button --}}
                                <a href="{{ route('sessions.edit', $session) }}"
                                   class="group/btn relative inline-flex items-center justify-center w-10 h-10 text-amber-600 bg-amber-50 rounded-xl border border-amber-200 hover:bg-amber-500 hover:text-white hover:shadow-lg transform hover:scale-110 transition-all duration-200"
                                   title="Edit Data">
                                    <i class="fas fa-edit text-sm"></i>
                                    <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover/btn:opacity-100 transition-opacity whitespace-nowrap">
                                        Edit
                                    </span>
                                </a>

                                {{-- Delete Button --}}
                                <form action="{{ route('sessions.destroy', $session) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('⚠️ Apakah Anda yakin ingin menghapus sesi ini?\n\nTindakan ini tidak dapat dibatalkan!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="group/btn relative inline-flex items-center justify-center w-10 h-10 text-red-600 bg-red-50 rounded-xl border border-red-200 hover:bg-red-600 hover:text-white hover:shadow-lg transform hover:scale-110 transition-all duration-200"
                                            title="Hapus Data">
                                        <i class="fas fa-trash text-sm"></i>
                                        <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover/btn:opacity-100 transition-opacity whitespace-nowrap">
                                            Hapus
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Empty State --}}
        @if($sessions->isEmpty())
        <div class="text-center py-16">
            <div class="max-w-sm mx-auto">
                <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-times text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada sesi konsultasi</h3>
                <p class="text-gray-500 mb-6">Mulai dengan menjadwalkan sesi pertama Anda</p>
                <a href="{{ route('sessions.create') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus"></i>
                    Buat Sesi Pertama
                </a>
            </div>
        </div>
        @endif
    </div>

    {{-- Enhanced Pagination --}}
    @if(!$sessions->isEmpty())
    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold">{{ $sessions->firstItem() }}</span> - 
                <span class="font-semibold">{{ $sessions->lastItem() }}</span> dari 
                <span class="font-semibold">{{ $sessions->total() }}</span> data
            </div>
            <div class="pagination-wrapper">
                {{ $sessions->links() }}
            </div>
        </div>
    </div>
    @endif

</div>

{{-- Custom Styles --}}
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
@endsection