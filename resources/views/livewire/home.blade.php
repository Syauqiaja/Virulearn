<div>
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
    <div class="row mt-3">
        @foreach ($activities as $key => $activity)
            <x-activity-item :activity="$activity" :canEdit="false"/>
        @endforeach
    </div>
</div>
