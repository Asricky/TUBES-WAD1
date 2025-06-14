@extends('layouts.main')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="flex items-center justify-between">
            <h1 class="dashboard-title">Konselor List</h1>
            <a href="{{ route('clients.create') }}" class="btn-action btn-primary">
                <i class="fas fa-plus icon"></i>
                Add Konselor
            </a>
        </div>
        <a href="{{ route('clients.create') }}"
           class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-white transition-all duration-200 transform shadow-lg bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl hover:from-blue-700 hover:to-blue-800 hover:shadow-xl hover:-translate-y-1">
            <i class="fas fa-plus-circle"></i>
            Add New Konselor 
        </a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="px-6 py-4 text-green-800 border-l-4 border-green-500 shadow-md bg-gradient-to-r from-green-50 to-emerald-50 rounded-r-xl animate-pulse">
            <div class="flex items-center gap-3">
                <i class="text-lg text-green-600 fas fa-check-circle"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif



    {{-- Enhanced Table --}}
    <div class="overflow-hidden bg-white border border-gray-100 shadow-xl rounded-2xl">
        {{-- Table Header Stats --}}
        <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700">
            <div class="flex items-center justify-between text-white">
                <div class="flex items-center gap-3">
                    <i class="text-xl fas fa-table"></i>
                    <span class="text-lg font-semibold">Data Konselor</span>
                </div>
                <div class="text-sm opacity-90">
                    Total: <span class="font-bold">{{ $clients->total() ?? count($clients) }}</span> Konselor
                </div>
            </div>
        </div>

        {{-- Table Content --}}
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-700 uppercase">
                            <div class="flex items-center gap-2">
                                <i class="text-blue-500 fas fa-user"></i>
                                Konselor Name
                            </div>
                        </th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-700 uppercase">
                            <div class="flex items-center gap-2">
                                <i class="text-green-500 fas fa-envelope"></i>
                                Email
                            </div>
                        </th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-700 uppercase">
                            <div class="flex items-center gap-2">
                                <i class="text-purple-500 fas fa-phone"></i>
                                Telephone Number
                            </div>
                        </th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-700 uppercase">
                            <div class="flex items-center gap-2">
                                <i class="text-red-500 fas fa-map-marker-alt"></i>
                                Alamat
                            </div>
                        </th>
                        <th class="px-6 py-4 text-sm font-semibold tracking-wider text-center text-gray-700 uppercase">
                            <div class="flex items-center justify-center gap-2">
                                <i class="text-gray-500 fas fa-cogs"></i>
                                Aksi
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($clients as $client)
                    <tr class="transition-all duration-300 group hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:shadow-md">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white rounded-full shadow-lg bg-gradient-to-br from-blue-500 to-purple-600">
                                    {{ strtoupper(substr($client->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 transition-colors group-hover:text-blue-700">
                                        {{ $client->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">ID: #{{ $client->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <i class="text-sm text-gray-400 fas fa-envelope"></i>
                                <span class="text-gray-700 transition-colors group-hover:text-gray-900">{{ $client->email }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <i class="text-sm text-gray-400 fas fa-phone"></i>
                                <span class="font-mono text-gray-700 transition-colors group-hover:text-gray-900">{{ $client->phone }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <i class="text-sm text-gray-400 fas fa-map-marker-alt"></i>
                                <span class="max-w-xs text-gray-700 truncate transition-colors group-hover:text-gray-900" title="{{ $client->address }}">
                                    {{ $client->address }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center gap-2">
                                {{-- Detail Button --}}
                                <a href="{{ route('clients.show', $client) }}"
                                   class="relative inline-flex items-center justify-center w-10 h-10 text-blue-600 transition-all duration-200 transform border border-blue-200 group/btn bg-blue-50 rounded-xl hover:bg-blue-600 hover:text-white hover:shadow-lg hover:scale-110"
                                   title="Lihat Detail">
                                    <i class="text-sm fas fa-eye"></i>
                                    <span class="absolute px-2 py-1 text-xs text-white transition-opacity transform -translate-x-1/2 bg-gray-800 rounded opacity-0 -top-8 left-1/2 group-hover/btn:opacity-100 whitespace-nowrap">
                                        Detail
                                    </span>
                                </a>

                                {{-- Edit Button --}}
                                <a href="{{ route('clients.edit', $client) }}"
                                   class="relative inline-flex items-center justify-center w-10 h-10 transition-all duration-200 transform border group/btn text-amber-600 bg-amber-50 rounded-xl border-amber-200 hover:bg-amber-500 hover:text-white hover:shadow-lg hover:scale-110"
                                   title="Edit Data">
                                    <i class="text-sm fas fa-edit"></i>
                                    <span class="absolute px-2 py-1 text-xs text-white transition-opacity transform -translate-x-1/2 bg-gray-800 rounded opacity-0 -top-8 left-1/2 group-hover/btn:opacity-100 whitespace-nowrap">
                                        Edit
                                    </span>
                                </a>

                                {{-- Delete Button --}}
                                <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('⚠️ Apakah Anda yakin ingin menghapus data Konselor {{ $client->name }}?\n\nTindakan ini tidak dapat dibatalkan!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="relative inline-flex items-center justify-center w-10 h-10 text-red-600 transition-all duration-200 transform border border-red-200 group/btn bg-red-50 rounded-xl hover:bg-red-600 hover:text-white hover:shadow-lg hover:scale-110"
                                            title="Hapus Data">
                                        <i class="text-sm fas fa-trash"></i>
                                        <span class="absolute px-2 py-1 text-xs text-white transition-opacity transform -translate-x-1/2 bg-gray-800 rounded opacity-0 -top-8 left-1/2 group-hover/btn:opacity-100 whitespace-nowrap">
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
        @if($clients->isEmpty())
        <div class="py-16 text-center">
            <div class="max-w-sm mx-auto">
                <div class="flex items-center justify-center w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full">
                    <i class="text-4xl text-gray-400 fas fa-users"></i>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-gray-700">Belum ada data Konselor</h3>
                <p class="mb-6 text-gray-500">Mulai dengan menambahkan Konselor pertama Anda</p>
                <a href="{{ route('clients.create') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 font-medium text-white transition-colors bg-blue-600 rounded-xl hover:bg-blue-700">
                    <i class="fas fa-plus"></i>
                    Tambah Konselor Pertama
                </a>
            </div>
        </div>
        @endif
    </div>

    {{-- Enhanced Pagination --}}
    @if(!$clients->isEmpty())
    <div class="p-6 bg-white border border-gray-100 shadow-lg rounded-2xl">
        <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
            <div class="text-sm text-gray-600">
                Menampilkan <span class="font-semibold">{{ $clients->firstItem() }}</span> - 
                <span class="font-semibold">{{ $clients->lastItem() }}</span> dari 
                <span class="font-semibold">{{ $clients->total() }}</span> data
            </div>
            <div class="pagination-wrapper">
                {{ $clients->links() }}
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