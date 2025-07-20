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
        <x-activity-sidebar :activity="$activity" :activeMaterial="$activeMaterial" :testType="$testType ?? null"/>
        
        <!-- Main Content -->
        <main class="main-content p-0 flex-grow-1 style="max-width: 100%;">
            <div class="d-flex bg-white py-2 px-4 justify-content-between d-none d-md-flex">
                <a class="btn text-center justify-content-start align-items-center d-flex text-primary" href="{{ route('home') }}" wire:navigate>
                    <i class="bi bi-arrow-left-circle me-3 fs-4"></i> {{ $activity->title }}
                </a>
            </div>
            <div class="mt-2 mx-2 mb-3 bg-white py-3 px-5">
                {!! $activeMaterial->content !!}
                <div class="mt-5 d-flex gap-2">
                    @if ($activeMaterial->order > 0)
                        <a class="btn btn-outline-secondary px-5" wire:click='previous'>Kembali</a>
                    @endif
                    @if ($activeMaterial->order + 1 < $activity->materials()->count())
                        <a class="btn btn-primary px-4" wire:click='next'>Selanjutnya <i class="bi bi-chevron-right ms-1"></i></a>
                    @else
                        <a class="btn btn-primary px-5" wire:click='complete'>Selesai <i class="bi bi-check-lg ms-1"></i></a>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>