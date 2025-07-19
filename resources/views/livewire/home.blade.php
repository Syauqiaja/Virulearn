<div>
    <x-flash-message/>
    <div class="bg-primary rounded p-3 text-white position-relative overflow-hidden">
        <!-- Background image positioned absolutely -->
        <img src="{{ asset('assets/images/learning.png') }}" alt=""
            style="position: absolute; right: 0; bottom: 0; height: 100%; object-fit: contain; z-index: 0;" />

        <!-- Content stacked above the image -->
        <div class="position-relative" style="z-index: 1;">
            <h5 class="fw-bold">Halo, {{Auth::user()->name}}</h5>
            <p>
                Selamat datang di Virulearn. Pelajari segala hal <br>tentang tumbuhan di sini
            </p>
            <button class="btn btn-light fw-bold">Mulai Sekarang</button>
        </div>
    </div>
    <div class="row mx-0 mt-3 gap-2">
        <div class="col-md-6 col-sm-12 bg-white rounded p-3">
            <h5 class="fw-bold">Pre Test</h5>
            <p>Kerjakan pretest ini sebelum memulai aktivitas</p>
            <a class="btn btn-info text-white" href="{{ route('exam', ['id' => $pretest->id]) }}">Mulai Pretest</a>
        </div>
        <div class="col-md col-sm-12 {{ $completedActivity == 1 ? 'bg-white' : 'bg-light' }} bg-white rounded p-3">
            <h5 class="fw-bold">Post Test</h5>
            <p>{{ $completedActivity == 1 ? 'Kerjakan posttest ini sebelum memulai aktivitas' : 'Selesaikan seluruh aktivitas terlebih dahulu' }}</p>
            <a class="btn btn-info text-white {{ $completedActivity == 1 ? '' : 'disabled' }}" href="{{ route('exam', ['id' => $posttest->id]) }}">Mulai Posttest</a>
        </div>
    </div>
    <div class="row mt-3">
        @foreach ($activities as $key => $activity)
        <x-activity-item :activity="$activity" :canEdit="false" />
        @endforeach
        @if (count($activities) == 0)
        <div class="m-3 text-center">
            -- Belum ada aktivitas yang didaftarkan --
        </div>
        @endif
    </div>
</div>