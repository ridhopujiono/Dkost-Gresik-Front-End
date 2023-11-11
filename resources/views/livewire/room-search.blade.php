<div>
    <div class="tab-content" id="nav-tabContent">
        <div class="search-bar row bg-light p-2 my-2 rounded-4">
            <div class="col-md-2 d-none d-md-block">
                <select wire:model='room_type' class="form-select  form-control-lg border-0 bg-transparent">
                    <option value=''>Semua kategori</option>
                    <option value="campur">Campur</option>
                    <option value="putra">Putra</option>
                    <option value="putri">Putri</option>
                </select>
            </div>
            <div class="col-9 col-md-9">
                <form id="search-form" class="text-center" wire:submit.prevent='doSearch'>
                    <input wire:model='search' type="text"
                        class="form-control form-control-lg border-0 bg-transparent" placeholder="Cari kamar" />
                </form>
            </div>
            <div class="col-1 d-flex justify-content-center align-items-center">
                <svg wire:click='doSearch' style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
                </svg>
            </div>
        </div>
        <div class="tab-pane fade show active" style="position: relative" id="nav-all" role="tabpanel"
            aria-labelledby="nav-all-tab">

            <div id="loading" class="loading-indicator" style="position: absolute"
                wire:loading.class='d-flex transparent'>
                <div class="spinner"></div>
            </div>

            <div class="product-grid row row-cols-md-5 mt-4">
                @forelse ($rooms as $room)
                    <div class="col-md">
                        <div class="product-item">
                            <div class="d-flex position-absolute ms-2">
                                <span
                                    class="badge bg-secondary text-dark me-1 mt-2 text-capitalize">{{ $room['room_type'] }}</span>
                            </div>
                            <figure>
                                <a href="{{ url('room') }}/{{ $room['id'] }}" wire:navigate>
                                    <img src="{{ isset($room['room_images'][0]['image']) ? $room['room_images'][0]['image'] : 'https://placehold.co/500x250' }}"
                                        class="tab-image"
                                        style="width: 100%;height: 250px;object-fit: cover; border-radius: 5px">
                                </a>
                            </figure>
                            <div class="d-flex justify-content-between flex-row mb-1">
                                <span class="qty"
                                    style="
                                        text-transform: capitalize;
                                        text-overflow: ellipsis;
                                        overflow: hidden;
                                        color: #414141
                                    "><a
                                        style="text-decoration: none !important"
                                        href="{{ url('room') }}/{{ $room['id'] }}"
                                        wire:navigate>{{ $room['room_name'] }}</a></span>

                                @if ($room['is_reserved'])
                                    <span style="font-size: 11px; color: red" class="fw-semibold">Penuh</span>
                                @else
                                    <span class="text-success" style="font-size: 11px">Tersedia</span>
                                @endif
                            </div>
                            <h3
                                style="font-size: 13px !important;line-height: 12px; margin-bottom: 7px;text-overflow: ellipsis;
                                overflow: hidden;">
                                {{ $room['location']['location_name'] }}</h3>
                            <span class="qty">
                                @php
                                    $roomFacilities = $room['room_facilities'];
                                    $totalFacilities = count($roomFacilities);
                                    $displayedFacilities = array_slice($roomFacilities, 0, 2);
                                    $remainingFacilities = array_slice($roomFacilities, 2);
                                @endphp
                                <ul style="padding: 0;">
                                    @foreach ($displayedFacilities as $room_facility)
                                        <li class="badge bg-secondary text-dark">
                                            {{ $room_facility['facility']['facility_name'] }}</li>
                                    @endforeach

                                    @if ($totalFacilities > 3)
                                        <li class="badge bg-secondary text-dark">
                                            +{{ count($remainingFacilities) }} lainnya
                                        </li>
                                    @endif
                                </ul>
                            </span>
                            {{-- <span class="qty">1 Unit</span> --}}
                            <span class="price"
                                style='font-size: 16px; letter-spacing: 0.5px'>{{ 'Rp. ' . number_format($room['price'], 2, ',', '.') }}
                                <span class="fw-normal text-lowercase"
                                    style="
                                        font-size: 14px;
                                    ">
                                    / bulan</span> </span>
                        </div>
                    </div>
                @empty
                    <div class="d-flex flex-column gap-3 justify-content-center align-items-center w-100"
                        style="height: 300px">
                        <img src="{{ asset('assets/gif/not_found.gif') }}" style="width: 150px" alt="">
                        <p>Pencarian kamar tidak ditemukan.</p>
                    </div>
                @endforelse

                @if ($nextPageUrl != null)
                    <div class="d-flex justify-content-center w-100 mt-3">
                        <button class="btn bg-transparent" wire:click='loadMoreData'
                            style="
                            border: 1px solid #4f4f4f;
                            width: 200px;
                            color: #4f4f4f;
                            ">Lebih
                            banyak</button>
                    </div>
                @endif

            </div>

        </div>

    </div>
</div>
