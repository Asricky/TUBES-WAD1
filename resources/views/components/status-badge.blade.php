@props(['status'])

@php
    $colors = [
        'completed' => 'bg-green-100 text-green-800 border border-green-200',
        'cancelled' => 'bg-red-100 text-red-800 border border-red-200',
        'confirmed' => 'bg-blue-100 text-blue-800 border border-blue-200',
        'in_progress' => 'bg-indigo-100 text-indigo-800 border border-indigo-200',
        'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
        'scheduled' => 'bg-purple-100 text-purple-800 border border-purple-200',
        'rescheduled' => 'bg-orange-100 text-orange-800 border border-orange-200',
    ];
    
    $icons = [
        'completed' => 'fa-check-circle',
        'cancelled' => 'fa-times-circle',
        'confirmed' => 'fa-calendar-check',
        'in_progress' => 'fa-spinner',
        'pending' => 'fa-clock',
        'scheduled' => 'fa-calendar-alt',
        'rescheduled' => 'fa-calendar-week',
    ];
@endphp

<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $colors[$status] ?? 'bg-gray-100 text-gray-700 border border-gray-200' }}">
    <i class="fas {{ $icons[$status] ?? 'fa-circle' }} mr-1"></i>
    {{ ucfirst(str_replace('_', ' ', $status)) }}
</span>