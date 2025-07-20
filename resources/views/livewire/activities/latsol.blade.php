<div class="container-fluid p-0">
    <!-- Mobile Sidebar Toggle (Mobile only) -->
    <div id="mobileSidebarToggle" class="d-md-none bg-white border-bottom px-3 py-2 w-100">
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-outline-primary" type="button" id="sidebarToggleBtn" aria-label="Toggle navigation">
                <i class="bi bi-list fs-4"></i>
            </button>
            <a class="btn text-center justify-content-start align-items-center d-flex text-primary" href="{{ route('home') }}" wire:navigate>
                <i class="bi bi-arrow-left-circle me-2 fs-4"></i> Halaman Awal
            </a>
        </div>
    </div>
    
    <!-- Sidebar Backdrop (Mobile only) -->
    <div class="sidebar-backdrop d-md-none" id="sidebarBackdrop"></div>
    
    <div class="d-flex">
        <!-- Activity Sidebar Component -->
        <x-activity-sidebar :activity="$activity" :testType="\App\Livewire\Activities\TestType::LATSOL->value"/>
        
        <!-- Main Content -->
        <main class="main-content p-2 flex-grow-1" style="max-width: 100%;">
            <div class="bg-white py-2 px-4 d-none d-md-flex">
                <a class="btn text-center justify-content-start align-items-center d-flex text-primary"
                   href="{{ route('home') }}" wire:navigate>
                    <i class="bi bi-arrow-left-circle me-3 fs-4"></i> Halaman Awal
                </a>
            </div>
            
            <div class="py-3 m-0 d-flex row gap-2 align-items-start justify-content-center">
                <div class="col p-3 bg-white">
                    <x-test-rules :exam="$exam"/>
                </div>
                
                <div class="bg-white p-3 text-center col-md-6 col-sm-12">
                    <h5 class="h5 fw-bold text-primary">{{strtoupper($testType->value)}}</h5>
                    
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-4 text-center justify-content-center">
                                <p>Jenis</p>
                                <div class="d-flex flex-column">
                                    <span class="bg-light rounded p-2 mx-3 h5">
                                        {{Str::title($testType->value)}}
                                    </span>
                                </div>
                            </div>
                            <div class="col-4 text-center justify-content-center">
                                <p>Total Soal</p>
                                <div class="d-flex flex-column">
                                    <span class="bg-light rounded p-2 mx-3 h5">
                                        {{ $exam->questions()->count() }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-4 text-center justify-content-center">
                                <p>Durasi</p>
                                <div class="d-flex flex-column">
                                    <span class="bg-light rounded p-2 mx-3 h5">
                                        {{ $exam->duration ?? '-' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if ($examResults != null)
                        <div class="mt-3">
                            <table class="table table-striped">
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
                        <a class="btn btn-{{$isCompleted ? 'outline-' : ''}}primary mx-3 py-3 fw-bold" href="{{ route('exam', ['id' => $exam->id]) }}">
                            Mulai {{Str::title($testType->value)}}
                        </a>
                    </div>
                    
                    @if ($isCompleted)
                        <div class="d-flex flex-column mt-2">
                            <a class="btn btn-primary mx-3 py-3 fw-bold" href="{{ route('home') }}">Ke Halaman Awal</a>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>