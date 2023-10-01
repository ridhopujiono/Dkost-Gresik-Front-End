<div>

    @if (session('success'))
        <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true"
            style="
                position: fixed;
                z-index: 1000;
                right: 20px;
                top: 20px;
            ">
            <div class="toast-header">
                <img src="https://img.icons8.com/material-outlined/24/40C057/double-tick.png" class="rounded me-2"
                    alt="...">
                <strong class="me-auto">Sukses</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    @elseif(session('error'))
        <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true"
            style="
                position: fixed;
                z-index: 1000;
                right: 20px;
                top: 20px;
            ">
            <div class="toast-header">
                <img src="https://img.icons8.com/material-rounded/24/FA5252/error--v1.png" class="rounded me-2"
                    alt="...">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <h1>Masuk</h1>
    <p>Hai, Silahkan masukan Email dan Password anda untuk melanjutkan proses login!.</p>

    <form wire:submit.prevent='authenticate'>
        <div class="form-floating mb-2 mt-5">
            <input type="email" wire:model='email' class="form-control" id="floatingInput"
                placeholder="name@example.com" style="background: #eee;border: 1px solid #dcdcdc;">
            <label for="floatingInput"><img class="me-1" width="24" height="24"
                    src="https://img.icons8.com/sf-ultralight/25/new-post.png" alt="email" />Email
                address</label>
        </div>
        <div class="form-floating">
            <input type="password" wire:model='password' class="form-control" id="floatingPassword"
                placeholder="Password" style="background: #eee;border: 1px solid #dcdcdc;">
            <label for="floatingPassword"><img class="me-1" width="27" height="27"
                    src="https://img.icons8.com/sf-ultralight/25/password.png" alt="password" />Password</label>
        </div>
        <div class="form-check mt-3" style="display: flex;align-items: center;gap: 0.5rem;">
            <input class="form-check-input border" type="checkbox" wire:model='remember' id="flexCheckDefault"
                style="border: 2px solid #c7c7c7 !important;">
            <label class="form-check-label" for="flexCheckDefault">
                Ingat Saya
            </label>
        </div>

        <div class="d-flex gap-2 mt-3">
            <button class="btn rounded-pill" style="background: #686afc;color: white;">Masuk
                Sekarang</button>
            <a href='{{ url('register') }}' wire:navigate class="btn btn-light rounded-pill shadow-sm">Buat Akun
                ?</a>
        </div>
</div>
</div>
