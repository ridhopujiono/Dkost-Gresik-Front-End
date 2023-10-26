<div>
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <h5 class="m-0 ms-2">Kamar Saya</h5>
                <p class="az-dashboard-text mb-3">
                    Ini adalah daftar kamar yang anda pesan.
                </p>
            </div>
            <!-- az-content-body -->
        </div>
        <div class="container">
            <div class="row w-100">
                @forelse ($rooms as $room)
                    <div class="col-md-3 mb-2">
                        <a wire:navigate href="{{ url('dash/room') . '/' . $room['id'] . '/' . $room['room_id'] }}">
                            <div class="card text-start">
                                <div class="d-flex position-absolute ms-2">
                                    <span
                                        class="btn {{ $room['payment_status'] == 'lunas' ? 'btn-success' : 'btn-danger' }} mt-2 text-capitalize">{{ $room['payment_status'] == 'lunas' ? 'Lunas' : 'Belum Lunas' }}</span>
                                </div>
                                <img src="{{ $room['room']['room_images'][0]['image'] }}" alt=""
                                    style="
                                            width: 100%;
                                            height: 200px;
                                            object-fit: cover;
                                            border-radius: 5px;
                                            "
                                    class="card-image" />
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title m- mb-1">{{ $room['room']['room_name'] }}</h5>
                                    <span class="text-dark">Jatuh Tempo:
                                        {{ \Carbon\Carbon::parse($room['contract_end'])->format('d-m-Y') }}</span>
                                </div>
                            </div>
                        </a>

                    </div>
                @empty
                    <div class="alert alert-secondary">Belum ada kamar yang diterima</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
