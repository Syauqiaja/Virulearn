<div class="p-5 justify-content-center d-flex flex-column">
    <form wire:submit='register'>
        <h3 class="text-center">Buat akun baru</h3>
        <div class="mt-4">
            <label for="name " class="fw-bold form-label">Name</label>
            <input type="text" id="name" class="form-control" wire:model='name'
                placeholder="Masukkan nama" required>
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mt-3">
            <label for="email " class="fw-bold form-label">Email</label>
            <input type="email" id="email" class="form-control" wire:model='email'
                placeholder="Masukkan email" required>
            @error('email')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mt-3">
            <label for="password " class="fw-bold form-label">Password</label>
            <div class="input-group mb-3">
                <input class="form-control password" id="password" class="block mt-1 w-full" type="password"
                    name="password" required placeholder="Masukkan password" wire:model='password'/>
                <span class="input-group-text">
                    <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer"></i>
                </span>
            </div>
        @error('password')
            <small class="text-danger">{{$message}}</small>
        @enderror
        </div>

        <div class="mt-3">
            <label for="passwordConfirmation " class="fw-bold form-label">Password Confirmation</label>
            <div class="input-group mb-3">
                <input class="form-control password" id="passwordConfirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required placeholder="Konfirmasi password" wire:model='password_confirmation'/>
                <span class="input-group-text">
                    <i class="bi bi-eye-slash" id="togglePasswordConfirmation" style="cursor: pointer"></i>
                </span>
            </div>
        @error('password_confirmation')
            <small class="text-danger">{{$message}}</small>
        @enderror
        </div>
        <x-flash-message/>
        <div class="mt-5 text-center  d-flex flex-column">
            <button class="btn btn-primary" type="submit">
                Daftar
            </button>
            <div class="mt-2">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
            </div>
        </div>
    </form>
</div>

@script
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        this.className = type == "password" ? "bi bi-eye-slash" : "bi bi-eye";
    });
    document.getElementById('togglePasswordConfirmation').addEventListener('click', function () {
        const passwordInput = document.getElementById('passwordConfirmation');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        this.className = type == "password" ? "bi bi-eye-slash" : "bi bi-eye";
    });
</script>
@endscript