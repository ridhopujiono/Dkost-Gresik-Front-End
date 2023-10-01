<style>
    .dropdown-menu {
        --bs-dropdown-link-active-bg: #eee;
        color: rgb(68, 68, 68);
    }
</style>
<header>
    <div class="container-fluid">
        <div class="row py-3 border-bottom">

            <div class="col-sm-4 col-lg-3 text-center text-sm-start">
                <div class="main-logo">
                    <a wire:navigate href="{{ url('/') }}">
                        <img src="{{ asset('logo.png') }}" alt="logo" class="img-fluid">
                    </a>
                </div>
            </div>

            <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">

            </div>

            <div
                class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
                <div class="d-flex gap-2">
                    @if (auth()->user())
                        <div class="dropdown" style="cursor: pointer">
                            <div data-bs-toggle="dropdown" aria-expanded="false"
                                class="d-flex gap-2 align-items-center">
                                <span><img src="{{ auth()->user()->profile_picture }}" alt=""
                                        style="width: 32px;border-radius: 9px;"></span>
                                <span id="username" style="font-weight: 500">{{ auth()->user()->name }}</span>
                                <img src="https://res.cloudinary.com/dfy3gxotz/image/upload/c_scale,w_19/v1695665176/icons8-collapse-arrow_pdxcnj.gif"
                                    alt=""
                                    style="
                                        transform: rotate(180deg);
                                    ">
                            </div>


                            <ul class="dropdown-menu dropdown-menu-end mt-3 border-0 shadow-sm">
                                <li><a class="dropdown-item" href="{{ url('dash') }}">Kamar Saya</a></li>
                                <li><a class="dropdown-item" href="{{ url('auth/google/logout') }}"
                                        style="
                                color: #df6e6e;
                                font-weight: 500;
                            ">Logout
                                        <img width="17" height="17"
                                            src="https://img.icons8.com/fluency-systems-regular/48/FA5252/logout-rounded.png"
                                            alt="logout-rounded" /></a></li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ url('auth') }}" class="btn btn-outline-light border-dark text-dark"
                            style="display: flex; gap: 7px;" id="loginBtn">
                            Masuk <img width="24" height="24"
                                src="https://img.icons8.com/cotton/64/login-rounded--v2.png"
                                style="
                                transform: rotate(190deg); " alt="login-logo" />
                        </a>
                        {{-- <a href="{{ url('auth/google') }}" class="btn btn-outline-light border-dark text-dark"
                            style="display: flex; gap: 7px;" id="loginBtn">
                            Login Google <img width="24" height="24"
                                src="https://img.icons8.com/fluency/48/google-logo.png" alt="google-logo" />
                        </a> --}}
                    @endif
                </div>
            </div>


        </div>
    </div>
</header>
