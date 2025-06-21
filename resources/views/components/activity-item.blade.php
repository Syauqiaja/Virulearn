@php
    use App\Livewire\Activities\TestType;

    $image_url = storage_url($activity->cover_image);
@endphp

<div class="col-md-5 col-12">
    <div class="card">
        <a href="{{ route('activities.detail', ['id' => $activity->id]) }}">
        <div class="position-relative">
        @if ($activity->postTests()->first()->isCompleted())
                <span class="badge rounded-pill bg-success position-absolute px-4 py-2" style="z-index: 1; bottom: 8px; right: 8px;">Selesai <i class="bi bi-check-circle"></i></span>
            @endif
                        <img src="{{ $image_url }}"
                            class="card-img-top object-fit-cover" alt="..." style="height: 230px;">
        </div>
        </a>
        <div class="card-body">
            <h5 class="card-title fw-bold">{{$activity->title}}</h5>
            <p class="card-text" style="font-size: small;">{{$activity->description}}</p>
        </div>
        @if ($canEdit)
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex gap-3">
                    <div class="flex-grow-1">Materi 6 Halaman</div> 
                    <a class="btn btn-outline-primary py-1 rounded-pill" href="{{ route('activities.material.edit', ['id' => $activity->id]) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg> <small>Edit Materi</small></a>
                </li>

                <li class="list-group-item d-flex gap-3">
                    <div class="flex-grow-1">90 Soal Pre-test</div> <a class="btn btn-outline-primary py-1 rounded-pill" href="{{ route('activities.tests.edit', ['type' => TestType::PRETEST->value, 'id' => $activity->id]) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg> <small>Edit Pre-test</small></a>
                </li>

                <li class="list-group-item d-flex gap-3">
                    <div class="flex-grow-1">100 Soal Latsol</div> <a class="btn btn-outline-primary py-1 rounded-pill" href="{{ route('activities.tests.edit', ['type' => TestType::LATSOL->value, 'id' => $activity->id]) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg> <small>Edit Latsol</small></a>
                </li>

                <li class="list-group-item d-flex gap-3">
                    <div class="flex-grow-1">80 Soal Post-test</div> <a class="btn btn-outline-primary py-1 rounded-pill" href="{{ route('activities.tests.edit', ['type' => TestType::POSTTEST->value, 'id' => $activity->id]) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg><small> Edit Post-test</small></a>
                </li>
            </ul>
            <div class="card-body d-flex gap-2">
                <a class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                        viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 
                        1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 
                        2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 
                        1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 
                        12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 
                        1.172 8z" />
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 
                        3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                    </svg> Lihat
                </a>
                <a class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                    </svg> Edit Aktivitas
                </a>
                
                <form action="{{ route('activities.delete', ['id' => $activity->id]) }}" method="post" class="ms-auto"> @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash3"></i> Hapus
                    </button>
                </form>
            </div>
        @else
            <div class="d-flex justify-content-end px-3 py-3">
                <a class="btn btn-light text-bold" href="{{ route('activities.detail', ['id' => $activity->id]) }}">Pelajari <i class="bi bi-arrow-right-circle ms-2"></i></a>
            </div>
        @endif
    </div>
</div>