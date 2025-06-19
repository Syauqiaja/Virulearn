<div class="row g-0">
  <main class="col-md-9 col-lg-10">
    <div class="bg-white py-2 px-4">
      <button class="btn text-center justify-content-center align-items-center d-flex text-primary"
        x-on:click="history.back()">
        <i class="bi bi-arrow-left-circle me-3 fs-4"></i> {{ $activity->title }}
      </button>
    </div>
    <div class="mt-2 mx-2 mb-3 bg-white py-3 px-5">
      {!! $activeMaterial->content !!}
      <div class="mt-5 d-flex gap-2">
        <button class="btn btn-outline-secondary px-5" wire:click='previous'>Kembali</button>
        @if ($activeMaterial->order +1 < $activity->materials()->count())
          <button class="btn btn-primary px-4 " wire:click='next'>Selanjutnya <i
              class="bi bi-chevron-right ms-1"></i></button>
          @else
          <button class="btn btn-primary px-5" wire:click='complete'>Selesai <i
              class="bi bi-check-lg ms-1"></i></button>
          @endif
      </div>
    </div>
  </main>
  <div id="sidebarMenu" class="col-md-3 col-lg-2 d-block d-flex flex-column bg-white sidebar position-fixed h-100 p-3"
    style="right: 0;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <span class="fs-5">Daftar Modul</span>
    </a>
    <hr>
    <ul class="nav nav-pills mb-auto flex-column">
      <li class="nav-item d-flex flex-column mb-4">
        <a class="btn btn-outline-secondary" aria-current="page">
          <i class="bi bi-file-earmark-medical"></i> Pre-Test
        </a>
      </li>
      @foreach ($activity->materials as $key => $material)
      <x-detail-activity-navitem :key="$key" :material="$material" :isActive="$material->userProgress != null"
        :isSelected="$material->id == $activeMaterial->id" />
      @endforeach

      <li class="nav-item d-flex flex-column mt-5">
        <a class="btn btn-outline-secondary" aria-current="page">
          <i class="bi bi-file-earmark-medical"></i> Latihan Soal
        </a>
      </li><li class="nav-item d-flex flex-column mt-2">
        <a class="btn btn-outline-secondary" aria-current="page">
          <i class="bi bi-file-earmark-medical"></i> Post-Test
        </a>
      </li>
    </ul>
    <hr>
  </div>
</div>