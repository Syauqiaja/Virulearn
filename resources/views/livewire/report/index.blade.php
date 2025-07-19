@push('styles')
    <style>
        .btn-white:hover{
            border: 2px solid #a347fe;
        }
        .btn-white{
            border: 2px solid white;
        }
    </style>
@endpush
<div>
    <x-flash-message />
    <x-admin-body-header :title="'Laporan Aktivitas'" :description="'Laporan progress tiap aktivitas'">
    </x-admin-body-header>

    <div class="mt-3 mx-0 row g-2">
        @foreach ($activities as $activity)
            <div class="col-md-6 col-sm-12">
                <a class="btn-white bg-white p-3 rounded row m-0 w-100" style="text-decoration: none;" href="{{ route('report.detail', ['activity' => $activity->id]) }}">
                    <div class="col-3">
                        <img src="{{ storage_url($activity->cover_image) }}" class="" alt="..." style="height: 64px; aspect-ratio: 1; object-fit: cover;">
                    </div>
                    <div class="col-9 text-start">
                        <h6 class="fw-bold">{{$activity->title}}</h6>
                        <p>
                            {{ $activity->description }}
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
    <script>
        
    </script>
@endpush