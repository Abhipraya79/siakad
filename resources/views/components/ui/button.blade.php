@props(['type' => 'button', 'color' => 'primary'])

@php
    $colors = [
        'primary' => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500',
        'danger' => 'bg-red-600 hover:bg-red-700 focus:ring-red-500',
        'success' => 'bg-green-600 hover:bg-green-700 focus:ring-green-500',
        'secondary' => 'bg-gray-600 hover:bg-gray-700 focus:ring-gray-500'
    ];
@endphp

<button type="{{ $type }}" 
        {{ $attributes->merge(['class' => 'px-4 py-2 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 ' . $colors[$color]]) }}>
    {{ $slot }}
</button>