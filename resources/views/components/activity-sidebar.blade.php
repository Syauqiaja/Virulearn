@props(['activeMaterial' => null])
@php
    $tests = [];
    $isCompleted = [];
    $classes = [];
    foreach (\App\Livewire\Activities\TestType::cases() as $type) {
      if($type == \App\Livewire\Activities\TestType::UNDEFINED) continue;

      $tests[$type->value] = $this->activity->tests($type)->first();
      $isCompleted[$type->value] = $tests[$type->value]->isCompleted();
      if($isCompleted[$type->value]){
        $classes[$type->value] = "btn btn-success";
      }else{
        $classes[$type->value] = $this->testType == $type ? 'btn btn-secondary' : 'btn btn-outline-secondary';
      }
    }
@endphp

<div id="sidebarMenu" class="col-md-3 col-lg-2 d-block d-flex flex-column bg-white sidebar position-fixed h-100 p-3"
    style="right: 0;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <span class="fs-5">Daftar Modul {{$this->activity->id}}</span>
    </a>
    <hr>
    <ul class="nav nav-pills mb-auto flex-column">
      <li class="nav-item d-flex flex-column mb-4">
        <a class="{{ $classes[\App\Livewire\Activities\TestType::PRETEST->value] }}"  aria-current="page" href="{{ route('activities.test', ['id' => $this->activity->id, 'type' => \App\Livewire\Activities\TestType::PRETEST]) }}">
          <i class="bi bi-file-earmark-medical"></i> Pre-Test
        </a>
      </li>
      @foreach ($this->activity->materials as $key => $material)
      <x-detail-activity-navitem :key="$key" :material="$material" :isActive="$material->userProgress != null"
        :isSelected="$material->id == $this->activeMaterial?->id" :activityId="$this->activity->id" />
      @endforeach

      <li class="nav-item d-flex flex-column mt-5">
        <a class="{{ $classes[\App\Livewire\Activities\TestType::LATSOL->value] }} {{ $this->activity->materials()->orderBy('order', 'desc')->first()->userProgress()->first()?->is_completed == true ? "" : "disabled" }}" aria-current="page" href="{{ route('activities.test', ['id' => $this->activity->id, 'type' => \App\Livewire\Activities\TestType::LATSOL]) }}">
          <i class="bi bi-file-earmark-medical"></i> Latihan Soal
        </a>
      </li><li class="nav-item d-flex flex-column mt-2">
        <a class="{{ $classes[\App\Livewire\Activities\TestType::POSTTEST->value] }} {{ $this->activity->latsol()->first()->isCompleted() ? '' : 'disabled' }}" aria-current="page" href="{{ route('activities.test', ['id' => $this->activity->id, 'type' => \App\Livewire\Activities\TestType::POSTTEST]) }}">
          <i class="bi bi-file-earmark-medical"></i> Post-Test
        </a>
      </li>
    </ul>
    <hr>
  </div>