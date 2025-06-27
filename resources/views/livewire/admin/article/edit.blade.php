<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
        <form wire:submit='store'>
            <div class="modal-header">
                <h5 class="modal-title" id="createNewModalLabel">Tambahkan Artikel Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='resetInput'></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="col-form-label">Judul Artikel</label>
                    <input type="text" class="form-control" id="title" wire:model='title'>
                    @error('title')
                        <small class="text-danger d-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="overview" class="col-form-label">Overview</label>
                    <textarea class="form-control" id="overview" wire:model='overview'></textarea>
                    @error('overview')
                        <small class="text-danger d-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="url" class="col-form-label">Link URL</label>
                    <textarea class="form-control" id="url" wire:model='url'></textarea>
                    @error('url')
                        <small class="text-danger d-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input class="form-control" id="thumbnail" type="file" wire:model='thumbnail'>
                    @error('thumbnail')
                        <small class="text-danger d-block">{{$message}}</small>
                    @enderror
                </div>
                @if ($previousThumbnail)
                    <div class="mt-2">
                        <p class="mb-1">File saat ini:</p>
                        <img src="{{ storage_url($previousThumbnail) }}" alt="preview" style="max-width: 200px;">
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