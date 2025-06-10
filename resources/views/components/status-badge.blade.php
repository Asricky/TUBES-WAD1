@props(['status'])

@php
    $colors = [
        'completed' => 'bg-green-100 text-green-800',
        'cancelled' => 'bg-red-100 text-red-800',
        'confirmed' => 'bg-blue-100 text-blue-800',
        'in_progress' => 'bg-blue-100 text-blue-800',
        'pending' => 'bg-yellow-100 text-yellow-800',
    ];
@endphp

<span class="px-2 py-1 rounded-full text-xs font-medium {{ $colors[$status] ?? 'bg-gray-100 text-gray-700' }}">
    {{ ucfirst(str_replace('_', ' ', $status)) }}
</span>
