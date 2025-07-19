<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
        <form wire:submit='save'>
            <div class="modal-header">
                <h5 class="modal-title" id="createNewModalLabel">Edit Point LKPD</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="text-center mb-3">{{$user->name ?? 'User'}}</h6>
                <h6>Jawaban Siswa</h6>
                <p>
                    {{ $userLkpd->answer ?? '' }}
                </p>
                <div class="mb-3" style="max-width: 128px;">
                    <label for="point" class="col-form-label">Point</label>
                    <input type="number" class="form-control" id="point" wire:model='point'/>
                    @error('point')
                        <small class="text-danger d-block">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click='resetInput'>Tutup</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
            </div>
        </form>
    </div>
</div>