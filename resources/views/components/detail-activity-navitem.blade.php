@php
    $classes = 'btn';
    $classes = $isSelected ? $classes." btn-primary" : $classes." btn-outline-primary";
    $classes = $isActive ? $classes : $classes." disabled";
@endphp

<li class="nav-item d-flex flex-column mt-2">
    <a {{ $attributes->merge(['class' => $classes]) }}
        aria-current="page" href="{{ route('activities.detail', ['id' => $activityId, 'm' => $material->id]) }}">
        Materi {{ $key + 1 }}
    </a>
</li>