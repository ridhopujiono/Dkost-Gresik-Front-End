<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90680653-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag("js", new Date());

            gtag("config", "UA-90680653-2");
        </script>

        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Meta -->
        <meta name="description" content="Rumah Sidqia Dashboard" />
        <meta name="author" content="Rumah Sidqia" />

        <title>{{ $title }}</title>

        <!-- vendor css -->
        <link data-navigate-once href="{{ asset('dashboard/lib/typicons.font/typicons.css') }}" rel="stylesheet" />

        <!-- azia CSS -->
        <link data-navigate-once rel="stylesheet" href="{{ asset('dashboard/css/azia.css') }}" />
        {{-- Livewire CSS --}}
        @livewireStyles
        <link data-navigate-once href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css"
            rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">

    </head>

    <body style="background: #f9f9f9">
        <style>
            #calendar a {
                color: #555555
            }

            .fc .fc-daygrid-day.fc-day-today {
                background-color: rgb(111 66 193 / 25%);
            }

            .sidqia-logo {
                width: 170px
            }

            @media only screen and (max-width: 768px) {
                .sidqia-logo {
                    margin-top: 10px;
                    width: 70px
                }
            }
        </style>
        <div class="az-header">
            <div class="container">
                <div class="az-header-left">
                    <a class="az-logo"><span></span> <img height="50px" src="{{ asset('logo.png') }}"
                            alt=""></a>
                    <a id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
                </div>
                <!-- az-header-left -->
                <div class="az-header-menu">
                    <div class="az-header-menu-header">
                        <a wire:navigate href="{{ url('/') }}" class="az-logo"><span></span> <img
                                class="sidqia-logo" src="{{ asset('logo.png') }}" alt=""></a>
                        <a wire:navigate href="" class="close">&times;</a>
                    </div>
                    <!-- az-header-menu-header -->
                    <ul class="nav">
                        <li class="nav-item {{ Request::is('dash') ? 'active' : '' }}">
                            <a wire:navigate href="{{ url('dash') }}" class="nav-link"><i
                                    class="typcn typcn-chart-area-outline"></i> Dashboard</a>
                        </li>
                        <li
                            class="nav-item {{ Request::is('dash/room') || Request::is('dash/room/*') ? 'active' : '' }}">
                            <a wire:navigate href="{{ url('dash/room') }}" class="nav-link"><i
                                    class="typcn typcn-equals-outline"></i> Kamar Saya</a>
                        </li>
                        <li class="nav-item {{ Request::is('dash/notification') ? 'active' : '' }}">
                            <a wire:navigate href="{{ url('dash/notification') }}" class="nav-link"><i
                                    class="typcn typcn-bell"></i> Notifikasi</a>
                        </li>
                    </ul>
                </div>
                <!-- az-header-menu -->
                <div class="az-header-right">
                    <!-- az-header-message -->
                    <!-- az-header-notification -->
                    <div class="dropdown az-profile-menu">
                        <a href="#" class="az-img-user"><img src="{{ auth()->user()->profile_picture }}"
                                alt="" /></a>
                        <div class="dropdown-menu">
                            <div class="az-dropdown-header d-sm-none">
                                <a wire:navigate href="" class="az-header-arrow"><i
                                        class="icon ion-md-arrow-back"></i></a>
                            </div>
                            <div class="az-header-profile">
                                <div class="az-img-user">
                                    <img src="{{ auth()->user()->profile_picture }}" alt="" />
                                </div>
                                <!-- az-img-user -->
                                <h6>{{ auth()->user()->name }}</h6>
                                <span class='text-capitalize'>{{ auth()->user()->level }}</span>
                            </div>
                            <!-- az-header-profile -->
                            <a href="{{ url('/') }}" class="dropdown-item"
                                style="display: flex;justify-content: center;border-top: 1px solid #eee;"><i
                                    class="typcn typcn-home"></i> Halaman Awal</a>
                            <a href="{{ url('auth/google/logout') }}" class="dropdown-item"
                                style="display: flex;justify-content: center;border-top: 1px solid #eee;"><i
                                    class="typcn typcn-power-outline"></i> Logout</a>

                        </div>
                        <!-- dropdown-menu -->
                    </div>
                </div>
                <!-- az-header-right -->
            </div>
            <!-- container -->
        </div>
        <!-- az-header -->

        @yield('container')

        <!-- az-content -->

        <script data-navigate-once src='https://code.jquery.com/jquery-3.7.0.js'></script>
        <script data-navigate-once src="{{ asset('dashboard/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <script data-navigate-once src="{{ asset('dashboard/js/azia.js') }}"></script>
        <script data-navigate-once src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
        @livewireScripts
        @stack('script')

        <script></script>
    </body>

</html>
