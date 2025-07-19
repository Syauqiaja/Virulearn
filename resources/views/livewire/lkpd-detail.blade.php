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
                <h5>Lembar Kerja Peserta Didik</h5>
                <p>Download file LKPD di bawah ini, kemudian kerjakan menggunakan form yang telah disediakan</p>
                <p>

                </p>
                <div>
                    <div class="card-body h-100">
                        <h5 class="card-title">File LKPD {{ $activity->title }}</h5>
                        <div class="d-flex justify-content-start mt-2">
                            <a href="{{ storage_url($lkpd->file) }}" target="_blank" class="btn btn-outline-primary">
                                <i class="ms-1 bi bi-file-earmark-richtext"></i>
                                Buka LKPD
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-3 text-center col-md-8 col-sm-12">
                <form wire:submit='save'>
                    <h5 class="h5 fw-bold text-primary">Form Jawaban <i class="text-danger">*</i></h5>
                    <p class="text-center">Isi jawaban anda pada form di bawah ini</p>
                    <div class="mt-3">
                        <textarea name="answer" id="lkpd-answer" wire:model='answer' class="form-control" style="min-height: 300px;">
                            {{ $answer }}
                        </textarea>
                        @error('answer')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="d-flex flex-column mt-2">
                        <button class="btn btn-primary mx-3 py-3 fw-bold" type="submit">Simpan</button>
                    </div>
                    @if ($isCompleted)
                    <div class="d-flex flex-column mt-2">
                        <a class="btn btn-primary mx-3 py-3 fw-bold" href="{{ route('home') }}">Ke Halaman Awal</a>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </main>
    <x-activity-sidebar :activity="$activity" :testType="'lkpd'" />
</div>