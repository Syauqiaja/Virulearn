<div class="container-fluid p-0">
    <!-- Mobile Sidebar Toggle (Mobile only) -->
    <div id="mobileSidebarToggle" class="d-md-none bg-white border-bottom px-3 py-2 w-100">
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-outline-primary" type="button" id="sidebarToggleBtn" aria-label="Toggle navigation">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div class="d-flex align-items-center">
                @if ($activity)
                <span class="text-primary fw-bold">{{ $activity->title }}</span>
                @else
                <span class="text-primary fw-bold">{{ $testType->name }}</span>
                @endif
                @if ($exam->duration != null)
                <span class="ms-3 text-success small">00:00:00</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar Backdrop (Mobile only) -->
    <div class="sidebar-backdrop d-md-none" id="sidebarBackdrop"></div>

    <div class="d-flex">
        <!-- Exam Sidebar -->
        <nav id="sidebarMenu" class="sidebar bg-white p-3">
            <div class="d-flex justify-content-between align-items-center mt-5 mt-md-0">
                <!-- Desktop Header -->
                <span class="fs-5 fw-bold d-none d-md-block">{{strtoupper($testType->value)}}</span>

                <!-- Mobile Header with Close Button -->
                <div class="d-md-none w-100 d-flex justify-content-between align-items-center">
                    <a class="btn text-center justify-content-start align-items-center d-flex text-primary"
                        href="{{ route('home') }}" wire:navigate>
                        <i class="bi bi-arrow-left-circle me-2 fs-4"></i> Halaman Awal
                    </a>
                </div>
            </div>

            <hr>

            <ul class="nav nav-pills mb-auto flex-column">
                <div class="d-flex align-items-start justify-content-start flex-wrap gap-2">
                    @for ($i = 0; $i < count($exam->questions); $i++)
                        @php
                        $classes = "btn";
                        if(isset($answers[$i])){
                        $classes = $classes." btn-primary";
                        }else{
                        $classes = $activeIndex == $i ? $classes." btn-secondary" : $classes." btn-outline-secondary";
                        }
                        @endphp
                        <button class="{{ $classes }}" style="height: 48px; width: 48px;"
                            wire:click='switchIndex({{ $i }})'>
                            {{ $i + 1 }}
                        </button>
                        @endfor
                </div>
            </ul>

            <hr>
        </nav>

        <!-- Main Content -->
        <main class="main-content p-0 flex-grow-1" style="max-width: 100%;">
            <div class="bg-white py-2 px-4 d-flex align-items-center d-none d-md-flex">
                <button class="btn text-center justify-content-center align-items-center d-flex text-primary"
                    x-on:click="history.back()">
                    @if ($activity)
                    <i class="bi bi-arrow-left-circle me-3 fs-4"></i> {{ $activity->title }}
                    @else
                    <i class="bi bi-arrow-left-circle me-3 fs-4"></i> Halaman awal
                    @endif
                </button>
                @if ($exam->duration != null)
                <div class="ms-auto fs-5">
                    Waktu Tersisa <span class="ms-3 text-success">00:00:00</span>
                </div>
                @endif
            </div>

            <div class="py-3 px-5 bg-white m-2 row">
                <div class="col-md-6 col-sm-12 d-flex row gap-2 align-items-start justify-content-center">
                    <div class="mt-2">
                        <h5>Soal Nomor {{$activeIndex + 1}}</h5>
                        <h6>{{$questions[$activeIndex]->question_text}}</h6>
                    </div>
                    <div class="mt-2">
                        @foreach (['A', 'B', 'C', 'D'] as $key => $option)
                        <div class="mt-2">
                            <input type="radio" wire:key="answer-{{ $activeIndex }}-{{ $option }}" class="btn-check"
                                name="answer_{{ $activeIndex }}" id="answer_{{ $activeIndex }}_{{ $key }}"
                                autocomplete="off" wire:change="saveAnswer('{{ $activeIndex }}')" value="{{ $option }}"
                                wire:model="selectedAnswer">

                            <label class="btn btn-outline-primary" for="answer_{{ $activeIndex }}_{{ $key }}"
                                style="height: 40px; width: 40px;">{{$option}}</label>
                            <label style="cursor:pointer;" for="answer_{{ $activeIndex }}_{{ $key }}" class="fs-6 ms-2">
                                {{$questions[$activeIndex]->toArray()['answer_'.strtolower($option)]}}
                            </label>
                        </div>
                        @endforeach
                        <div class="mt-5 d-flex flex-wrap gap-2 justify-content-between">
                            @if ($activeIndex > 0)
                            <button class="btn btn-outline-secondary px-5" wire:click='prev'>Sebelumnya</button>
                            @else
                            <button class="btn btn-outline-secondary px-5 disabled">Sebelumnya</button>
                            @endif
                            @if (isset($answers[$activeIndex]) && $activeIndex < count($questions) - 1) <button
                                class="btn btn-primary px-5" wire:click='next'>Selanjutnya</button>
                                @elseif($activeIndex == count($questions) - 1)
                                <button class="btn btn-primary px-5" wire:click='save'>Selesai</button>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>