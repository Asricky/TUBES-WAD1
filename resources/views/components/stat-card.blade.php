@props(['icon', 'label', 'value', 'color'])

<div class="bg-white shadow rounded-lg p-4">
    <div class="flex items-center space-x-2 text-gray-700 font-semibold">
        <i class="fas fa-{{ $icon }} text-{{ $color }}-500"></i>
        <span>{{ $label }}</span>
    </div>
    <div class="text-2xl font-bold mt-2 text-gray-800">{{ $value }}</div>
</div>
