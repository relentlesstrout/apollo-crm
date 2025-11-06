@props([
    'active' => false,
    'variant' => 'desktop',
])

@php
    $baseClasses = $variant === 'mobile'
        ? 'block border-l-4 py-2 pr-4 pl-3 text-base font-medium'
        : 'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium';

    $stateClasses = $active
        ? ($variant === 'mobile'
            ? 'border-indigo-600 bg-indigo-50 text-indigo-700'
            : 'border-indigo-600 text-gray-900')
        : ($variant === 'mobile'
            ? 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800'
            : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700');
@endphp

<a {{ $attributes->class("$baseClasses $stateClasses") }} @if($active) aria-current="page" @endif>
    {{ $slot }}
</a>
