@extends('layouts.main')
@section('container')
    {{-- <section class="py-3"
        style="background-image: url({{ asset('themes/images/background-pattern.jpg') }};background-repeat: no-repeat;background-size: cover;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="banner-blocks">

                        <div class="banner-ad large bg-info block-1" style="background-color: #696cff1a !important;">

                            <div class="swiper main-swiper">
                                <div class="swiper-wrapper">

                                    <div class="swiper-slide">
                                        <div class="row banner-content p-5">
                                            <div class="content-wrapper col-md-6">
                                                <div class="categories my-3">100% natural</div>
                                                <h3 class="display-4">Fresh Smoothie & Summer Juice</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                    Dignissim massa diam elementum.</p>
                                            </div>
                                            <div class="img-wrapper col-md-6"
                                                style="display: flex;justify-content: center;align-items: center;">
                                                <img src="{{ asset('assets/bed/white.png') }}" class="img-fluid"
                                                    style="max-width: 110% !important">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="row banner-content p-5">
                                            <div class="content-wrapper col-md-6">
                                                <div class="categories mb-3 pb-3">100% natural</div>
                                                <h3 class="banner-title">Fresh Smoothie & Summer Juice</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                    Dignissim massa diam elementum.</p>
                                            </div>
                                            <div class="img-wrapper col-md-6"
                                                style="display: flex;justify-content: center;align-items: center;">
                                                <img src="{{ asset('assets/bed/white.png') }}" class="img-fluid"
                                                    style="max-width: 110% !important">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="row banner-content p-5">
                                            <div class="content-wrapper col-md-6">
                                                <div class="categories mb-3 pb-3">100% natural</div>
                                                <h3 class="banner-title">Heinz Tomato Ketchup</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                    Dignissim massa diam elementum.</p>
                                            </div>
                                            <div class="img-wrapper col-md-6"
                                                style="display: flex;justify-content: center;align-items: center;">
                                                <img src="{{ asset('assets/bed/white.png') }}" class="img-fluid"
                                                    style="max-width: 110% !important">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-pagination"></div>

                            </div>
                        </div>

                        <div class="banner-ad bg-success-subtle block-2">
                            <div class="row banner-content p-5">
                                <div class="content-wrapper col-md-6">
                                    <h3 class="banner-title">Heinz Tomato Ketchup</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Dignissim massa diam elementum.</p>

                                </div>
                                <div class="img-wrapper col-md-6"
                                    style="display: flex;justify-content: center;align-items: center;">
                                    <img src="{{ asset('assets/bed/green.png') }}" class="img-fluid"
                                        style="max-width: 110% !important">
                                </div>
                            </div>
                        </div>

                        <div class="banner-ad bg-danger block-3">
                            <div class="row banner-content p-5">
                                <div class="content-wrapper col-md-6">

                                    <h3 class="banner-title">Heinz Tomato Ketchup</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Dignissim massa diam elementum.</p>
                                </div>
                                <div class="img-wrapper col-md-6"
                                    style="display: flex;justify-content: center;align-items: center;">
                                    <img src="{{ asset('assets/bed/pink.png') }}" class="img-fluid"
                                        style="max-width: 110% !important">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- / Banner Blocks -->

                </div>
            </div>
        </div>
    </section> --}}

    <section class="py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="bootstrap-tabs product-tabs">
                        <div class="tabs-header d-flex justify-content-between border-bottom my-2">
                            <h3>Kamar Kos</h3>
                        </div>
                        @livewire('room-search')
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
