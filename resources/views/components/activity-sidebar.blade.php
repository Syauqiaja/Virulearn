@props(['activeMaterial' => null, 'testType' => null])

<div id="sidebarMenu" class="col-md-3 col-lg-2 d-block d-flex flex-column bg-white sidebar position-fixed h-100 p-3"
    style="right: 0;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <span class="fs-5">Daftar Modul {{$this->activity->id}}</span>
    </a>
    <hr>
    <ul class="nav nav-pills mb-auto flex-column">
      @foreach ($this->activity->materials as $key => $material)
      <x-detail-activity-navitem :key="$key" :material="$material" :isActive="$material->userProgress != null"
        :isSelected="$material->id == $this->activeMaterial?->id" :activityId="$this->activity->id" />
      @endforeach

      <li class="nav-item d-flex flex-column mt-5">
        <a class="{{ $this->activity->latsol->first()->isCompleted() ? "btn btn".($testType == \App\Livewire\Activities\TestType::LATSOL->value ? '' : '-outlined')."-success" : "btn btn".($testType == \App\Livewire\Activities\TestType::LATSOL->value ? '' : '-outlined')."-secondary" }} {{ $this->activity->materials()->orderBy('order', 'desc')->first()->userProgress()->first()?->is_completed == true ? "" : "disabled" }}" 
          aria-current="page" 
          href="{{ route('activities.test', ['activity' => $this->activity->id]) }}">
          <i class="bi bi-file-earmark-medical"></i> Latihan Soal
        </a>
      </li>
       <li class="nav-item d-flex flex-column mt-1">
        <a class="{{ $this->activity->lkpd->isCompleted() ? "btn btn".($testType == 'lkpd' ? '' : '-outlined')."-success" : "btn btn".($testType == 'lkpd' ? '' : '-outlined')."-secondary" }} {{ $this->activity->materials()->orderBy('order', 'desc')->first()->userProgress()->first()?->is_completed == true ? "" : "disabled" }}" 
            aria-current="page" 
            href="{{ route('activities.lkpd', ['id' => $this->activity->id]) }}">
          <i class="bi bi-file-earmark-medical"></i> LKPD
        </a>
      </li>
    </ul>
    <hr>
  </div>