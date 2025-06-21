<div class="row g-0">
  <main class="col-md-9 col-lg-10">
    <div class="bg-white py-2 px-4">
      <a class="btn text-center justify-content-start align-items-center d-flex text-primary"
        href="{{ route('home') }}" wire:navigate>
        <i class="bi bi-arrow-left-circle me-3 fs-4"></i> {{ $activity->title }}
      </a>
    </div>
    <div class="mt-2 mx-2 mb-3 bg-white py-3 px-5">
      {!! $activeMaterial->content !!}
      <div class="mt-5 d-flex gap-2">
        @if ($activeMaterial->order > 0)
            
        <a class="btn btn-outline-secondary px-5" wire:click='previous'>Kembali</a>
        @endif
        @if ($activeMaterial->order +1 < $activity->materials()->count())
          <a class="btn btn-primary px-4 " wire:click='next'>Selanjutnya <i
              class="bi bi-chevron-right ms-1"></i></a>
          @else
          <a class="btn btn-primary px-5" wire:click='complete'>Selesai <i
              class="bi bi-check-lg ms-1"></i></a>
          @endif
      </div>
    </div>
  </main>
  <x-activity-sidebar :activity="$activity"/>
</div>