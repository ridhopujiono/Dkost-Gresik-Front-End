@extends('layouts.main')
@section('container')
    <div class="row align-items-center justify-content-end py-5">
        <div class="row px-4">
            <div class="col-md-5 text-center login-ilustration">
                <img src="https://www.nicepng.com/png/full/960-9602830_email-verification-email-verify-icon-png.png"
                    alt="" style="width: 200px">
            </div>
            <div class="col-md">
                <h4>Verfikasi Email</h4>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif
                <span class="text-success">Berhasil mengirim link verfikasi ke email.</span> <br>
                Mohon cek email untuk link verifikasi. Jika anda tidak menerima email tekan
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Kirim Lagi</button>.
                </form>
            </div>
        </div>
    </div>
@endsection
