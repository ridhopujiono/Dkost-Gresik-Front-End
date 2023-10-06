<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Rumah Sidqia</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="author" content="Rumah Sidqia">
        <meta name="keywords" content="Rumah Sidqia">
        <meta name="description" content="Rumah Sidqia adalah website kost kostan dengan pilihan kamar yang menarik">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('themes/css/vendor.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('themes/style.css') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">

        @livewireStyles
    </head>

    <body>
        <style>
            @keyframes blink {
                0% {
                    opacity: 0.3;
                    /* Set transparansi menjadi rendah pada awal animasi */
                }

                50% {
                    opacity: 0.6;
                    /* Set transparansi menjadi tinggi di tengah animasi */
                }

                100% {
                    opacity: 1;
                    /* Set transparansi menjadi rendah di akhir animasi */
                }
            }

            .transparent {
                background-color: #f8f8f8 !important;
                animation: blink 2s infinite;
                /* Terapkan animasi dengan durasi 1 detik dan ulang tak terbatas */
            }

            /* CSS untuk indikator loading */
            .loading-indicator {
                display: none;
                /* Sembunyikan secara default */
                justify-content: center;
                align-items: center;
                z-index: 9999;
                width: 100%;
                height: 100%;
                position: absolute;
                background: blur()
            }

            .spinner {
                border: 4px solid rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                border-top: 4px solid #8486fb;
                width: 40px;
                height: 40px;
                animation: spin 0.8s linear infinite;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }
        </style>

        @include('layouts.header')

        @yield('container')

        @include('layouts.footer')

        @livewireScripts
        <script data-navigate-once src="{{ asset('themes/js/jquery-1.11.0.min.js') }}"></script>
        <script data-navigate-once src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        <script data-navigate-once src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
        </script>
        <script data-navigate-once src="{{ asset('themes/js/plugins.js') }}"></script>
        <script data-navigate-once src="{{ asset('themes/js/script.js') }}"></script>
        <script data-navigate-once src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script data-navigate-once src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        @stack('script')


        <script>
            $(document).ready(function() {
                var loginBtn = $("#loginBtn");
                var username = $("#username");

                // Cek jika pengguna sudah login
                @if (auth()->user())
                    loginBtn.hide(); // Sembunyikan tombol "Login Google" jika sudah login
                    username.show(); // Tampilkan nama pengguna
                @else
                    username.hide(); // Sembunyikan nama pengguna jika belum login

                    // Tambahkan efek loading saat tombol "Login Google" diklik
                    loginBtn.click(function() {
                        loginBtn.html("Loading..."); // Mengganti teks tombol dengan "Loading..."
                    });
                @endif
            });
        </script>

    </body>

</html>
