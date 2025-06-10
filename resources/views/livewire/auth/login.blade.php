<div class="p-5 justify-content-center d-flex flex-column">
    <form wire:submit='login'>
        <h3 class="text-center">Masuk ke akun anda</h3>
        <div class="mt-4">
            <label for="email " class="fw-bold form-label">Email</label>
            <input type="email" id="email" class="form-control" aria-describedby="passwordHelpBlock" wire:model='email'
                placeholder="Masukkan email anda" required>
            @error('email')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mt-3">
            <label for="password " class="fw-bold form-label">Password</label>
            <div class="input-group mb-3">
                <input class="form-control password" id="password" class="block mt-1 w-full" type="password"
                    name="password" required placeholder="Masukkan password anda" wire:model='password'/>
                <span class="input-group-text">
                    <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer"></i>
                </span>
            </div>
        @error('password')
            <small class="text-danger">{{$message}}</small>
        @enderror
        </div>
        <x-flash-message/>
        <div class="mt-5 text-center  d-flex flex-column">
            <button class="btn btn-primary">
                Masuk
            </button>
            <div class="mt-2">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
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
</script>
@endscript