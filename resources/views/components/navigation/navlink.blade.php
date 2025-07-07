@props(['active' => false, 'icon' => null, 'navigate' => true])
@php
    $classes = ($active ?? false) ? 'nav-link active' : 'nav-link link-primary';
@endphp

<li class="nav-item">
    <a @if ($navigate)
         wire:navigate
    @endif {{ $attributes->merge(['class' => $classes . ' d-flex align-items-center']) }} aria-current="page">
        @if ($icon != null)
            <i class="bi {{ $icon }} fs-3 me-2"></i>
        @endif
        {{ $slot }}
    </a>
</li>
