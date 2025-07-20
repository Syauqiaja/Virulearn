<div class="container-fluid p-0">
    <!-- Mobile Sidebar Toggle (Mobile only) -->
    <div id="mobileSidebarToggle" class="d-md-none bg-white border-bottom px-3 py-2 w-100">
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-outline-primary" type="button" id="sidebarToggleBtn" aria-label="Toggle navigation">
                <i class="bi bi-list fs-4"></i>
            </button>
            <a class="btn text-center justify-content-start align-items-center d-flex text-primary" href="{{ route('home') }}" wire:navigate>
                <i class="bi bi-arrow-left-circle me-2 fs-4"></i> {{ $activity->title }}
            </a>
        </div>
    </div>
    
    <!-- Sidebar Backdrop (Mobile only) -->
    <div class="sidebar-backdrop d-md-none" id="sidebarBackdrop"></div>
    
    <div class="d-flex">
        <!-- Activity Sidebar Component -->
        <x-activity-sidebar :activity="$activity" :testType="'lkpd'" />
        
        <!-- Main Content -->
        <main class="main-content p-0 flex-grow-1" style="max-width: 100%;">
            <div class="bg-white py-2 px-4 d-none d-md-flex">
                <a class="btn text-center justify-content-start align-items-center d-flex text-primary"
                   href="{{ route('home') }}" wire:navigate>
                    <i class="bi bi-arrow-left-circle me-3 fs-4"></i> {{ $activity->title }}
                </a>
            </div>
            
            <div class="py-3 px-2 px-md-5 d-flex row gap-2 align-items-start justify-content-center">
                <div class="col-md col-sm-12">
                    <div class="p-3 bg-white">
                        <h5>Lembar Kerja Peserta Didik</h5>
                        <p>Download file LKPD di bawah ini, kemudian kerjakan menggunakan form yang telah disediakan</p>
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
                    
                    <div class="p-3 bg-white mt-2">
                        <p>Anda bisa melihat nilai jawaban yang anda dapatkan di sini, setelah jawaban dikoreksi oleh guru.</p>
                        <h5>Skor : <span class="{{ $point ? ($point > $lkpd->kkm ? 'text-success' : 'text-warning') : ''}}"> {{$point ? $point : '- belum dikoreksi -'}}</span></h5>
                    </div>
                </div>
                
                <div class="bg-white p-3 text-center col-md-8 col-sm-12">
                    <form wire:submit='save'>
                        <h5 class="h5 fw-bold text-primary">Form Jawaban <i class="text-danger">*</i></h5>
                        <p class="text-center">Isi jawaban anda pada form di bawah ini</p>
                        <div class="mt-3">
                            <textarea name="answer" id="lkpd-answer" wire:model='answer' class="form-control" style="min-height: 300px;">{{ $answer }}</textarea>
                            @error('answer')
                                <div class="text-danger mt-1">{{ $message }}</div>
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
    </div>
</div>