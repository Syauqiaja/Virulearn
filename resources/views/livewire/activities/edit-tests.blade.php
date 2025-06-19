<div>
    <form wire:submit='save'> @csrf
        <x-admin-body-header :title="'Edit ' . $type->name" :description="'Halaman edit ' . $type->name">
            <a class="btn btn-success" wire:click='addQuestion'>Tambah Soal +</a>
            <button class="btn btn-primary" type="submit">Simpan</button>
        </x-admin-body-header>

        <div class="p-3 mx-0">
            <div class="row gap-2">
                <div class="col p-3 bg-white ">
                    @foreach ($questions as $key => $question)
                    <x-question-input-field :id="$key" />
                    @endforeach
                </div>
                <div class="col-12 col-md-4 sticky-top" id="navigation_layout">
                    <div class="bg-white p-3">
                        <h5 class="h5 text-center"> Navigasi Nomor </h5>
                        <hr>
                        <div class="row row-cols-5 gap-2 justify-content-center">
                            @foreach ($questions as $i => $question)
                            <a class="col text-center btn btn-outline-secondary" href="#question_{{ $i }}">
                                {{ $i + 1 }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-white p-3 mt-2">
                        <h5 class="h5 text-center"> Setting  </h5>
                        <hr>
                        <div>
                            <div x-data="{ hour: @entangle('hour').defer, minute: @entangle('minute').defer }" class="align-items-center input-group">
                                <span class="input-group-text">Durasi</span>
                                <input type="number" min="0" max="23" class="form-control text-end" wire:model="hour" placeholder="Jam">
                                <span class="input-group-text">:</span>
                                <input type="number" min="0" max="59" class="form-control text-end" wire:model="minute" placeholder="Menit">
                            </div>

                            @error('hour')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                            @error('minute')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nilai KKM</span>
                            </div>
                            <input type="number" wire:model='kkm' min="10" max="100" class="form-control"aria-describedby="inputGroup-sizing-default" placeholder="Tidak ada KKM">
                        </div>
                        @error('kkm')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>