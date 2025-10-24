@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block w-full ps-4 pe-4 py-2 border-l-4 border-red-500 text-start text-base font-semibold text-white bg-green-700 focus:outline-none focus:bg-green-600 focus:border-red-600 transition duration-150 ease-in-out'
        : 'block w-full ps-4 pe-4 py-2 border-l-4 border-transparent text-start text-base font-semibold text-white hover:bg-green-600 hover:border-green-500 focus:outline-none focus:bg-green-600 focus:border-green-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>