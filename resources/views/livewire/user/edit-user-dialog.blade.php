<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
        <form wire:submit='store'>
            <div class="modal-header">
                <h5 class="modal-title" id="createNewModalLabel">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" class="form-control" id="email" wire:model='email' disabled>
                    @error('email')
                        <small class="text-danger d-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="col-form-label">Nama</label>
                    <input type="text" class="form-control" id="name" wire:model='name'>
                    @error('name')
                        <small class="text-danger d-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Thumbnail</label>
                    <input class="form-control" id="photo" type="file" wire:model='photo'>
                    @error('photo')
                        <small class="text-danger d-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" wire:model='isAdmin' id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Tetapkan sebagai admin
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
            </div>
        </form>
    </div>
</div>