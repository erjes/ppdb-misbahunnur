@php
    $classes = ($active ?? false)
        ? 'inline-flex items-center px-3 py-2 rounded-md text-sm font-medium text-white bg-red-600 border border-red-600 focus:outline-none transition duration-150 ease-in-out'
        : 'inline-flex items-center px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-green-700 focus:outline-none focus:text-white focus:bg-green-700 transition duration-150 ease-in-out';
@endphp
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>