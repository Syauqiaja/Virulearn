<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
        <form wire:submit='save'>
            <div class="modal-header">
                <h5 class="modal-title" id="createNewModalLabel">Edit LKPD</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="text-center mb-3">{{$activity->title ?? 'Activity Title'}}</h6>
                <div class="mb-3">
                    <label for="kkm" class="col-form-label">KKM</label>
                    <input type="number" class="form-control" id="kkm" wire:model='kkm'/>
                    @error('kkm')
                        <small class="text-danger d-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <input class="form-control" id="file" type="file" wire:model='file'>
                    @error('file')
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