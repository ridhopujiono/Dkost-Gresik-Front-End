@extends('layouts.main')
@section('container')
    <style>
        .carousel {
            position: relative;
        }

        .carousel-item img {
            object-fit: cover;
            height: 500px;
            width: auto;
        }

        #carousel-thumbs {
            background: rgba(255, 255, 255, .3);
            bottom: 0;
            left: 0;
            padding: 0 50px;
            right: 0;
        }

        #carousel-thumbs img {
            border: 5px solid transparent;
            cursor: pointer;
        }

        #carousel-thumbs img:hover {
            border-color: rgba(255, 255, 255, .3);
        }

        #carousel-thumbs .selected img {
            border-color: #fff;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
        }

        .carousel-thumbnail a img {
            object-fit: cover;
            height: 50px;
        }

        @media all and (max-width: 767px) {
            .carousel-container #carousel-thumbs img {
                border-width: 3px;
            }

            .carousel-item img {
                object-fit: cover;
                height: 300px;
                width: auto;
            }

            .carousel-thumbnail a img {
                height: 30px;
            }
        }

        @media all and (min-width: 576px) {
            .carousel-container #carousel-thumbs {
                position: absolute;
            }
        }

        @media all and (max-width: 576px) {
            .carousel-container #carousel-thumbs {
                background: #ccccce;
            }

            .carousel-item img {
                object-fit: cover;
                height: 300px;
                width: auto;
            }

            .carousel-thumbnail a img {
                height: 30px;
            }
        }
    </style>
    @livewire('room-detail', ['roomId' => $roomId])
@endsection
