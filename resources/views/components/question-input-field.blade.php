<div class="row mb-5">
    <div class="col-auto">
        <div class="border rounded bg-light text-center d-flex align-items-center justify-content-center"
            style="height: 38px; width: 38px;">
            {{ $id + 1 }}
        </div>
    </div>
    <div class="col">
        <div class="d-flex">
            <input type="text" class="form-control ms-0 me-1" id="question_{{ $id }}" wire:model='questions.{{ $id }}'
                placeholder="Masukkan soal di sini">

            <a class="btn btn-outline-danger text-center d-flex align-items-center justify-content-center"
                style="height: 38px; width: 38px;" wire:click='delete({{ $id }})'>
                X
            </a>
        </div>

        @error("questions.$id")
            <small class="text-danger d-block">{{str_replace(".$id", "", $message)}}</small>
        @enderror

        @foreach (['A','B','C','D'] as $key => $value)
            <div class="mt-2 row mx-0">
                <div style="height: 38px; width: 38px;" class="p-0">
                    <input id="option{{ $value }}-{{ $id }}" type="radio" class="btn-check" name="option{{ $value }}-{{ $id }}"
                        wire:model='options.{{ $id }}' autocomplete="off" value="{{ $value }}">
                    <label class="btn btn-outline-primary" for="option{{ $value }}-{{ $id }}">{{$value}}</label>
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" id="answer_{{ $value }}_{{ $id }}"
                        wire:model='answers.{{ $id }}.{{ $value }}' placeholder="Jawaban {{ $value }}" />
                </div>
            </div>
            @error("answers.$id.$key")
            <small class="text-danger d-block">{{str_replace(".$id", "", $message)}}</small>
            @enderror
        @endforeach
        @error("options.$id")
            <small class="text-danger d-block">{{str_replace(".$id", "", $message)}}</small>
        @enderror
    </div>
</div>