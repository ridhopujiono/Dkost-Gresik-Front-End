<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
                @if (session('error') == 'Maaf email anda belum terverifikasi')
                    Maaf email anda belum terverifikasi. <a wire:navigate href="{{ url('email/verify') }}">Tekan
                        disini</a>
                @else
                    {{ session('error') }}
                @endif
            </div>
        </div>
    @endif


    {{-- @endif --}}
    <section id="selling-product" class="single-product mt-0 mt-md-5">
        <div class="container-fluid">
            <div class="row g-5">
                <div class="container mt-5">
                    <div class="carousel-container position-relative row">

                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-md-7 mb-3">
                                    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($room['room_images'] as $index => $image)
                                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                    <img src="{{ $image['image'] }}" alt="Gambar 1">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <!-- Thumbnails -->
                                        <div class="carousel-thumbnail d-flex justify-content-center gap-2 mt-3">
                                            @foreach ($room['room_images'] as $index => $image)
                                                <a href="#myCarousel" data-bs-slide-to="{{ $index }}">
                                                    <img src="{{ $image['image'] }}">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="product-info">
                                        <div class="element-header">
                                            <h2 itemprop="name" class="display-6">{{ $room['room_name'] }}</h2>
                                            <h4 itemprop="name" class="display-7">
                                                {{ $room['location']['location_name'] }}</h2>
                                        </div>
                                        <div class="product-price pt-3 pb-3">
                                            <strong class="text-primary display-6 fw-bold"
                                                style="
                                                color: #4b4dbd !important;
                                            ">{{ 'Rp. ' . number_format($room['price'], 2, ',', '.') }}</strong>
                                        </div>
                                        <p>{{ $room['description'] }}</p>
                                        <div class="cart-wrap py-2">
                                            <div class="color-options product-select">
                                                <div class="color-toggle" data-option-index="0">
                                                    <h6 class="item-title text-uppercase text-dark">Tipe Ruangan:</h6>
                                                    <ul class="select-list list-unstyled d-flex">
                                                        <li class="select-item pe-3"
                                                            data-val="{{ $room['room_type'] }}"
                                                            title="{{ $room['room_type'] }}">
                                                            <a href="#"
                                                                class="btn btn-light text-capitalize">{{ $room['room_type'] }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="color-options product-select">
                                                <div class="color-toggle" data-option-index="0">
                                                    <h6 class="item-title text-uppercase text-dark">Fasilitas:</h6>
                                                    <ul class="select-list list-unstyled d-flex flex-wrap gap-1">
                                                        @foreach ($room['room_facilities'] as $room_facility)
                                                            <li class="select-item pe-3"
                                                                data-val="{{ $room_facility['facility']['facility_name'] }}"
                                                                title="{{ $room_facility['facility']['facility_name'] }}">
                                                                <a href="#"
                                                                    class="btn btn-light">{{ $room_facility['facility']['facility_name'] }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="color-options product-select d-flex gap-3">
                                                <div class="color-toggle" data-option-index="0">
                                                    <h6 class="item-title text-uppercase text-dark">Pilih Tanggal:</h6>
                                                    <input type="text" wire:model='date' class="form-control is_date"
                                                        style="
                                                        border: 1px solid #a8a8a8;
                                                        width: 100% !important;
                                                    ">
                                                </div>
                                                <div class="color-toggle" data-option-index="0">
                                                    <h6 class="item-title text-uppercase text-dark">Nomor Whatsapp:</h6>
                                                    <input type="text" wire:model='phone' class="form-control"
                                                        style="
                                                        border: 1px solid #a8a8a8;
                                                        width: 100% !important;
                                                    ">
                                                </div>
                                            </div>

                                            @if ($room['stock'] == 0)
                                                <div class="alert alert-danger p-2 mt-3">Kamar sudah penuh</div>
                                            @endif
                                            <div class="d-flex gap-3 {{ $room['stock'] != 0 ? 'mt-4' : '' }}">
                                                @if ($room['stock'] == 0)
                                                    <button wire:click='reservation("full_booked")'
                                                        class="btn btn-dark text-white shadow-lg py-2"
                                                        style="border-radius: 20px">Hubungi
                                                        Saya
                                                        Nanti</button>
                                                @else
                                                    <button wire:click='reservation("booking")'
                                                        class="btn btn-dark shadow-lg py-2"
                                                        style="border-radius: 20px">Ajukan Sewa</button>
                                                @endif
                                                <a href="#map" class="btn btn-light text-dark shadow-lg py-2"
                                                    style="border-radius: 20px">Lokasi <img width="24"
                                                        height="24"
                                                        src="https://img.icons8.com/color/48/google-maps-new.png"
                                                        alt="google-maps-new" /> </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- /row -->
                </div> <!-- /container -->
                <div id='map' wire:ignore style="height: 600px;">
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script>
            $(".is_date").flatpickr({
                minDate: "today",
                dateFormat: "Y-m-d",
            });
        </script>
        <script>
            // initialize the map on the "map" div with a given center and zoom
            var map = L.map('map', {
                scrollWheelZoom: true, //disable zoom melalui scroll pada mouse
                zoomControl: true //disable zoom control (static)
            });

            var layerGroup = L.layerGroup();
            //set base maps menggunakan google maps
            L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                attribution: 'Map &copy; <a href="https://maps.google.com/">Google Maps</a>',
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                maxZoom: 20
            }).addTo(map);
            var markerIcon = L.icon({
                iconUrl: "{{ url('marker.png') }}",
                iconSize: [50, 50], // size of the icon
            });

            //style untuk geojson, silahkan ubah sesuai kebutuhan
            function style(feature) {
                return {
                    fillColor: '#ff7800',
                    weight: 2,
                    opacity: 1,
                    color: '#ff7800',
                    dashArray: '3',
                    fillOpacity: 0.7
                };
            }

            function addMarker(val) {
                if (map.hasLayer(layerGroup)) {
                    layerGroup.clearLayers();
                }

                var marker = L.marker(val, {
                    icon: markerIcon
                });
                layerGroup.addLayer(marker);
                map.addLayer(layerGroup);

                // Mendapatkan elemen input dengan id "latitudeInput"
                var latitudeInput = document.getElementById("latitudeInput");


                // Mengisi nilai input dengan nilai baru
                latitudeInput.value = val.lat;
                var inputEvent = new Event("input", {
                    bubbles: true,
                    cancelable: true,
                });
                latitudeInput.dispatchEvent(inputEvent);

                // Mendapatkan elemen input dengan id "longitudeInput"
                var longitudeInput = document.getElementById("longitudeInput");
                longitudeInput.value = val.lng;

                // Memicu event "input" pada elemen input untuk memperbarui model Livewire
                var inputEvent = new Event("input", {
                    bubbles: true,
                    cancelable: true,
                });
                longitudeInput.dispatchEvent(inputEvent);
            }
            // Tambahkan kode ini untuk menampilkan marker saat komponen dimuat

            var lat = {{ $room['location']['latitude'] }};
            var lng = {{ $room['location']['longitude'] }};
            var initialLocation = L.latLng(lat, lng);
            map.setView(initialLocation, 20);
            addMarker(initialLocation);
        </script>
    @endpush
</div>
