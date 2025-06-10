<div class="row mb-5">
    <div class="col-auto">
        <div class="border rounded bg-light text-center d-flex align-items-center justify-content-center"
            style="height: 38px; width: 38px;">
            {{ $id }}
        </div>
    </div>
    <div class="col">
        <input type="email" class="form-control ms-0" id="question_{{ $id }}" placeholder="Masukkan soal di sini">
        <div class="mt-2 row mx-0">
            <div style="height: 38px; width: 38px;" class="p-0">
                <input type="radio" class="btn-check" name="options_{{ $id }}" id="optionA-{{ $id }}" autocomplete="off" checked value="a">
                <label class="btn btn-outline-primary" for="optionA-{{ $id }}">A</label>
            </div>
            <div class="col-4">
                <input type="email" class="form-control" id="answer_a_{{ $id }}" placeholder="Jawaban">
            </div>
        </div>
        <div class="mt-2 row mx-0">
            <div style="height: 38px; width: 38px;" class="p-0">
                <input type="radio" class="btn-check" name="options_{{ $id }}" id="optionB-{{ $id }}" autocomplete="off" value="b">
                <label class="btn btn-outline-primary" for="optionB-{{ $id }}">B</label>
            </div>
            <div class="col-4">
                <input type="email" class="form-control" id="answer_b_{{ $id }}" placeholder="Jawaban">
            </div>
        </div>
        <div class="mt-2 row mx-0">
            <div style="height: 38px; width: 38px;" class="p-0">
                <input type="radio" class="btn-check" name="options_{{ $id }}" id="optionC-{{ $id }}" autocomplete="off" value="c">
                <label class="btn btn-outline-primary" for="optionC-{{ $id }}">C</label>
            </div>
            <div class="col-4">
                <input type="email" class="form-control" id="answer_c_{{ $id }}" placeholder="Jawaban">
            </div>
        </div>
        <div class="mt-2 row mx-0">
            <div style="height: 38px; width: 38px;" class="p-0">
                <input type="radio" class="btn-check" name="options_{{ $id }}" id="optionD-{{ $id }}" autocomplete="off" value="d">
                <label class="btn btn-outline-primary" for="optionD-{{ $id }}">D</label>
            </div>
            <div class="col-4">
                <input type="email" class="form-control" id="answer_d_{{ $id }}" placeholder="Jawaban">
            </div>
        </div>
    </div>
</div>