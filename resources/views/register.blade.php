@extends('layouts.main')
@section('container')
    <style>
        .form-floating>.form-control-plaintext~label::after,
        .form-floating>.form-control:focus~label::after,
        .form-floating>.form-control:not(:placeholder-shown)~label::after,
        .form-floating>.form-select~label::after {
            background: #eee !important;
            margin-bottom: 5px;
        }

        .form-floating>.form-control-plaintext:focus,
        .form-floating>.form-control-plaintext:not(:placeholder-shown),
        .form-floating>.form-control:focus,
        .form-floating>.form-control:not(:placeholder-shown) {
            padding-top: 1.825rem;
        }

        .form-floating>label {
            display: flex;
            align-items: center
        }

        .form-control {
            background: #eee;
            border: 1px solid #dcdcdc;
        }

        /* Media query untuk layar Android dengan lebar kurang dari 768px (misalnya, ponsel) */
        @media only screen and (max-width: 767px) {
            .login-ilustration {
                display: none;
            }
        }
    </style>
    <div class=" d-flex align-items-center justify-content-end">
        <div class="container">
            <div class="row">
                <div class="col-md-8 login-ilustration">
                    <img src="https://cdn.dribbble.com/users/1466634/screenshots/5409874/media/f131f32ad8d6a1064b7beedacff9844e.png?resize=700x700&vertical=center"
                        alt="">
                </div>
                <div class="col-md">
                    <h1>Buat Akun</h1>
                    <p>Hai, Silahkan lengkapi formulir pendaftaran!.</p>

                    @livewire('auth.register-form')

                </div>
            </div>
        </div>
    </div>
@endsection
