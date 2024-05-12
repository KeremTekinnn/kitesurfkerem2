@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center p-3 border-b-2 border-indigo-400 text-sm font-medium leading-5 focus:outline-none focus:border-indigo-700 transition-all duration-300 ease-in-out rounded'
            : 'inline-flex items-center p-3 border-b-2 border-transparent text-sm font-medium leading-5 hover:text-white hover:bg-orange-500 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition-all duration-300 ease-in-out rounded';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
