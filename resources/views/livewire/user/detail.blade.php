<div class="">
    <x-admin-body-header :title="'Profil Pengguna'" :description="'Laporan progress siswa'">
    </x-admin-body-header>

    <div class="row mt-2 mx-0 gap-2">
        <div class="col-md-4 col-sm-12 bg-white rounded p-3">
            <div class="position-relative text-center">
                <div class="position-absolute d-flex justify-content-center" style="bottom: 0; left: 0; right: 0;">
                    @if (Auth::user()->hasRole('admin') ||Auth::user()->id == $user->id)
                        <button class="btn btn-primary badge px-3 rounded-pill" style="bottom: 0;"
                            wire:click="$dispatch('edit-profile', {id: {{$user->id}}})"
                            data-bs-toggle="modal" data-bs-target="#editUserModal">Edit Profil <i class="bi bi-pencil"></i></button>
                    @endif
                </div>
                <img src="{{ $user->photo ? storage_url($user->photo) : asset('assets/default_avatar.jpg') }}" alt=""
                    class="mx-auto d-block rounded-circle" style="height: 128px; width: 128px;">

            </div>

            <div class="justify-content-center mt-3">
                <div class="text-center">
                    <span class="fw-bold fs-4">
                        {{ $user->name }}
                    </span>
                    <br>
                    {{ $user->email }}
                    <br>
                    @if ($user->hasRole('admin'))
                    Admin
                    @else
                    Siswa
                    @endif
                </div>
                <div class="mt-4">
                    <div>
                        <span class="fw-semibold">Aktivitas Diselesaikan</span>
                        <div class="progress mt-2" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" style="width: {{$completedActivity * 100}}%;" aria-valuenow="{{$completedActivity * 100}}"
                                aria-valuemin="0" aria-valuemax="100">{{$completedActivity * 100}}%</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="fw-semibold">Materi Diselesaikan</span>
                        <div class="progress mt-2" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" style="width: {{$completedMaterials * 100}}%;" aria-valuenow="{{$completedMaterials * 100}}"
                                aria-valuemin="0" aria-valuemax="100">{{$completedMaterials * 100}}%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col bg-white rounded p-3 d-flex align-items-center">

            <canvas id="myChart" wire:ignore></canvas>
        </div>
    </div>

    <div class="mt-2 bg-white rounded p-3">
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
        <livewire:user.edit-user-dialog></livewire:user.edit-user-dialog>
    </div>
</div>


@script
<script>
    let datatable;

    window.addEventListener('livewire:navigated', () => {
        let wrapper = document.getElementsByClassName('dataTables_wrapper');
        if (wrapper.length > 0) {
            console.warn('datatable already initialized');
            return;
        }

        datatable = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.datatable') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        console.log('datatable initialized');
    });

    const ctxElement = document.getElementById('myChart');

    let chartData;

    function respondCanvas() {
        const c = $('#myChart');
        const ctx = c.get(0).getContext("2d");
        const $container = c.parent();

        c.attr('width', $container.width());
        c.attr('height', $container.height());

        new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    const GetChartData = function () {
        $.ajax({
            url: "{{ route('user.detail.chart', ['user' => $user->id]) }}",
            method: 'GET',
            dataType: 'json',
            success: function (d) {
                chartData = {
                    labels: d.labels,
                    datasets: [
                        {
                            label: 'Pretest',
                            data: d.data['pretest'],
                            borderWidth: 1
                        },
                        {
                            label: 'Latihan Soal',
                            data: d.data['latsol'],
                            borderWidth: 1
                        },
                        {
                            label: 'Posttest',
                            data: d.data['posttest'],
                            borderWidth: 1
                        }
                    ]
                };

                respondCanvas();
            }
        });
    };

    $(document).ready(function () {
        $(window).resize(respondCanvas);
        GetChartData();
    });
</script>
@endscript