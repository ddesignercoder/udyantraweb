@props([
    'variant' => 'primary',
    'type' => 'button',
    'disabled' => false,
    'href' => null,
    'as' => null,
])

@php
    // Decide tag
    $tag = $as ?? ($href ? 'a' : 'button');

    // Variants
    $variants = [
        'primary'   => 'bg-primary text-white border-borderButn',
        'secondary' => 'bg-white text-gray-900 border border-borderBase',
        'success'   => 'bg-green-600 text-white border-green-600',
        'danger'    => 'bg-red-600 text-white border-red-600',
    ];

    $variantClasses = $variants[$variant] ?? $variants['primary'];

    // Base styles
    $baseClasses = 'inline-flex justify-center items-center px-8 py-3.5 font-medium text-base rounded-full border transition-all duration-200 cursor-pointer';

    // Interaction
    $interactionClasses = $disabled
        ? 'opacity-50 cursor-not-allowed pointer-events-none'
        : 'shadow-hard hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 active:shadow-none active:translate-x-0.5 active:translate-y-0.5';

    $classes = "$baseClasses $variantClasses $interactionClasses";
@endphp

@if ($tag === 'a')
    <a
        href="{{ $href }}"
        {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
