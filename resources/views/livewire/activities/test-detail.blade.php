<div class="row g-0">
  <main class="col-md-9 col-lg-10">
    <div class="bg-white py-2 px-4">

      <a class="btn text-center justify-content-start align-items-center d-flex text-primary"
        href="{{ route('home') }}" wire:navigate>
        <i class="bi bi-arrow-left-circle me-3 fs-4"></i> {{ $activity->title }}
      </a>
    </div>
    <div class="py-3 px-5 d-flex row gap-2 align-items-start justify-content-center">
      <div class="col p-3 bg-white">
        <x-test-rules :exam="$exam"/>
      </div>
        <div class="bg-white p-3 text-center col-md-6 col-sm-12">
            <h5 class="h5 fw-bold text-primary">{{strtoupper($testType->value)}}</h5>
            <p class="text-center">{{$activity->title}}</p>
            <div class="mt-3">
              <div class="row">
                <div class="col-4 text-center justify-content-center">
                  <p>Jenis</p>
                  <div class="d-flex flex-column">
                    <span class="bg-light rounded p-2 mx-3 h5">
                      {{Str::title($testType->value)}}
                    </span1>
                  </div>
                </div>

                <div class="col-4 text-center justify-content-center">
                  <p>Total Soal</p>
                  <div class="d-flex flex-column">
                    <span class="bg-light rounded p-2 mx-3 h5">
                      {{ $exam->questions()->count() }}
                    </span1>
                  </div>
                </div>

                <div class="col-4 text-center justify-content-center">
                  <p>Durasi</p>
                  <div class="d-flex flex-column">
                    <span class="bg-light rounded p-2 mx-3 h5">
                      {{ $exam->duration ?? '-' }}
                    </span1>
                  </div>
                </div>
              </div>
            </div>
            @if ($examResults != null)
              <div class="mt-3">
                  <table class="table table-stripped">
                      <tr>
                          <td>No</td>
                          <td>Skor</td>
                          <td>Tanggal</td>
                          <td>Keterangan</td>
                      </tr>
                      @foreach ($examResults as $key => $examResult)
                      <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{number_format($examResult->point * 100, 0)."%"}}</td>
                        <td>{{$examResult->created_at->format('d M Y')}}</td>
                        <td>{!!$examResult->point * 100 >= ($exam->kkm ?? 100) ? '<span class="text-success">Lulus</span>' : '<span class="text-danger">Gagal</span>'!!}</td>
                      </tr>
                      @endforeach
                  </table>
              </div>
            @endif
            <div class="d-flex flex-column mt-4">
              <a class="btn btn-{{$isCompleted ? 'outline-' : ''}}primary mx-3 py-3 fw-bold" href="{{ route('exam', ['id' => $exam->id]) }}">Mulai {{Str::title($testType->value)}}</a>
            </div>
            @if ($isCompleted)
                @if ($testType == \App\Livewire\Activities\TestType::PRETEST)
                  <div class="d-flex flex-column mt-2">
                    <a class="btn btn-primary mx-3 py-3 fw-bold" href="{{ route('activities.detail', ['id' => $activity->id]) }}">Baca Materi</a>
                  </div>
                @elseif($testType == \App\Livewire\Activities\TestType::LATSOL)
                  <div class="d-flex flex-column mt-2">
                    <a class="btn btn-primary mx-3 py-3 fw-bold" href="{{ route('activities.test', ['id'=>$activity->id, 'type' => \App\Livewire\Activities\TestType::POSTTEST->value]) }}">Buka Post-Test</a>
                  </div>
                @elseif($testType == \App\Livewire\Activities\TestType::POSTTEST)
                  <div class="d-flex flex-column mt-2">
                    <a class="btn btn-primary mx-3 py-3 fw-bold" href="{{ route('home') }}">Ke Halaman Awal</a>
                  </div>
                @endif
            @endif
        </div>
    </div>
  </main>
  <x-activity-sidebar :activity="$activity" :testType="$testType"/>
</div>