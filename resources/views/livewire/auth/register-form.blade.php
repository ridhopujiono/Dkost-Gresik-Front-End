<div>
    <form wire:submit.prevent='store'>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <div class="form-floating mb-2 mt-5">
                <input wire:model='name' type="text" class="form-control @error('name') is-invalid @enderror"
                    id="floatingInput" placeholder="Sandika Galih">
                <label for="floatingInput"><img class="me-1" width="24" height="24"
                        src="https://img.icons8.com/sf-ultralight/25/employee-card.png" alt="email" />Nama
                    Lengkap</label>
            </div>

        </div>
        <div>
            <div class="form-floating mb-2">
                <input wire:model='email' type="email" class="form-control @error('email') is-invalid @enderror"
                    id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput"><img class="me-1" width="24" height="24"
                        src="https://img.icons8.com/sf-ultralight/25/new-post.png" alt="email" />Email</label>

            </div>
        </div>

        <div>
            <div class="form-floating mb-2">
                <input wire:model='password' type="password"
                    class="form-control @error('password') is-invalid @enderror" id="floatingPassword"
                    placeholder="Kata Sandi">
                <label for="floatingPassword"><img class="me-1" width="27" height="27"
                        src="https://img.icons8.com/sf-ultralight/25/password.png" alt="password" />Kata Sandi</label>
            </div>
        </div>
        <div class="form-floating">
            <input wire:model='password_confirmation' type="password"
                class="form-control @error('password_confirmation') is-invalid @enderror" id="floatingPassword"
                placeholder="Ulangi Kata Sandi">
            <label for="floatingPassword"><img class="me-1" width="27" height="27"
                    src="https://img.icons8.com/sf-ultralight/25/password.png" alt="password" />Ulangi Kata
                Sandi</label>
        </div>

        <div class="d-flex gap-2 mt-5">
            <button type='submit' class="btn rounded-pill"
                style="
            background: #686afc;
            color: white;">Buat
                Akun Sekarang <span class="spinner-border spinner-border-sm ms-2 d-none"
                    wire:loading.class.remove='d-none' wire:loading.attr='disabled' role="status"
                    aria-hidden="true"></span></button>
            <a class="btn btn-light rounded-pill shadow-sm" href='{{ url('auth') }}' wire:navigate>Sudah Punya Akun
                ?</a>
        </div>
    </form>
</div>
