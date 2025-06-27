@props(['active' => false])
@php
    $classes = ($active ?? false) ? 'nav-link active' : 'nav-link link-primary'
@endphp
<li class="nav-item">
    <a wire:navigate {{ $attributes->merge(['class' => $classes]) }} aria-current="page">
        <svg class="bi me-2" width="16" height="16">
        </svg>

        {{ $slot }}
    </a>
</li>