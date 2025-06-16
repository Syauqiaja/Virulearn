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
                        <x-question-input-field :id="$key"/>
                    @endforeach
                </div>
                <div class="col-12 col-md-4 sticky-top" id="navigation_layout">
                    <div class="bg-white p-3">
                        <h4 class="h4 text-center"> Navigasi Nomor </h4>
                        <hr>
                        <div class="row row-cols-5 gap-2 justify-content-center">
                            @foreach ($questions as $i => $question)
                                <a class="col text-center btn btn-outline-secondary" href="#question_{{ $i }}">
                                    {{ $i + 1 }}
                                </a>
                    @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>