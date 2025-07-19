<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
        <form wire:submit='store'>
            <div class="modal-header">
                <h5 class="modal-title" id="createNewModalLabel">Buat Aktivitas Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="col-form-label">Judul Aktivitas</label>
                    <input type="text" class="form-control" id="title" wire:model='title'>
                    @error('title')
                        <small class="text-danger d-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="col-form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" wire:model='description'></textarea>
                    @error('description')
                        <small class="text-danger d-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cover_image" class="form-label">Thumbnail</label>
                    <input class="form-control" id="cover_image" type="file" wire:model='cover_image'>
                    @error('cover_image')
                        <small class="text-danger d-block">{{$message}}</small>
                    @enderror
                </div>
                @if ($previousImage)
                    <div class="mt-2">
                        <p class="mb-1">File saat ini:</p>
                        <img src="{{ storage_url($previousImage) }}" alt="preview" style="max-width: 200px;">
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click='resetInput'>Tutup</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
            </div>
        </form>
    </div>
</div>