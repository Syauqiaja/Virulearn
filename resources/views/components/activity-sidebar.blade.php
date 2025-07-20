@props(['activeMaterial' => null, 'testType' => null, 'activity' => null])

<nav id="sidebarMenu" class="sidebar bg-white p-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Desktop Header -->
        <span class="fs-5 fw-semibold d-none d-md-block">Daftar Modul {{ $activity->id }}</span>
        
        <!-- Mobile Header with Close Button -->
        <div class="d-md-none w-100 d-flex justify-content-between align-items-center">
            <span class="fs-5 fw-semibold">Daftar Modul {{ $activity->id }}</span>
            <button class="btn btn-sm btn-outline-secondary" id="sidebarCloseBtn" aria-label="Close sidebar">
                <i class="bi bi-x fs-5"></i>
            </button>
        </div>
    </div>
    
    <hr>
    
    <!-- Materials Navigation -->
    <ul class="nav nav-pills mb-auto flex-column">
        @foreach ($activity->materials as $key => $material)
            <x-detail-activity-navitem 
                :key="$key" 
                :material="$material" 
                :isActive="$material->userProgress != null"
                :isSelected="$material->id == $activeMaterial?->id" 
                :activityId="$activity->id" />
        @endforeach
        
        <!-- Latihan Soal -->
        <li class="nav-item d-flex flex-column mt-5">
            <a class="{{ $activity->latsol->first()->isCompleted()
                    ? 'btn btn' . ($testType == \App\Livewire\Activities\TestType::LATSOL->value ? '' : '-outlined') . '-success'
                    : 'btn btn' . ($testType == \App\Livewire\Activities\TestType::LATSOL->value ? '' : '-outlined') . '-secondary' }}
                {{ $activity->materials()->orderBy('order', 'desc')->first()->userProgress()->first()?->is_completed == true ? '' : 'disabled' }}"
                href="{{ route('activities.test', ['activity' => $activity->id]) }}">
                <i class="bi bi-file-earmark-medical"></i> Latihan Soal
            </a>
        </li>
        
        <!-- LKPD -->
        <li class="nav-item d-flex flex-column mt-1">
            <a class="{{ $activity->lkpd->isCompleted()
                    ? 'btn btn' . ($testType == 'lkpd' ? '' : '-outlined') . '-success'
                    : 'btn btn' . ($testType == 'lkpd' ? '' : '-outlined') . '-secondary' }}
                {{ $activity->materials()->orderBy('order', 'desc')->first()->userProgress()->first()?->is_completed == true ? '' : 'disabled' }}"
                href="{{ route('activities.lkpd', ['id' => $activity->id]) }}">
                <i class="bi bi-file-earmark-medical"></i> LKPD
            </a>
        </li>
    </ul>
    
    <hr>
</nav>