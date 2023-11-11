<div>
    <div>

        <style>
            .nav-tabs .nav-link.active {
                background-color: #f9f9f9;
                border-left: 1px solid #cdd4e0;
                border-right: 1px solid #cdd4e0;
                border-top: 1px solid #cdd4e0;
            }

            .nav-tabs {
                border-bottom-width: 1px;
            }
        </style>

        <div class="az-content az-content-dashboard">
            <div class="container">
                <div class="az-content-body">
                    <h5 class="m-0 ms-2">Detail Kamar Saya</h5>
                    <p class="az-dashboard-text mb-3">
                        Ini adalah detail kamar yang anda pesan.
                    </p>
                    @if ($residentDetails['address'] == '-' || $residentDetails['emergency_info']['contact_name'] == '')
                        <div class="alert alert-danger {{ $residentProfileComplete ? 'd-none' : '' }}">Mohon lengkapi
                            data diri terlebih
                            dahulu, supaya mendapat
                            terverifikasi saat melakukan pelunasan. Abaikan bila sudah terlengkapi
                        </div>
                    @endif
                </div>
                <!-- az-content-body -->
            </div>
            <div class="container">
                <div class="d-flex flex-column w-100">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a wire:click="tab_active_change('payment')""
                                class="nav-item nav-link {{ $tab_active == 'payment' ? 'active' : '' }}"
                                id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                                aria-controls="nav-home" aria-selected="true">Pembayaran</a>
                            <a wire:click="tab_active_change('room')"
                                class="nav-item nav-link {{ $tab_active == 'room' ? 'active' : '' }}" id="nav-room-tab"
                                data-toggle="tab" href="#nav-room" role="tab" aria-controls="nav-room"
                                aria-selected="false">Infomasi Kamar</a>
                            <a wire:click="tab_active_change('profile')""
                                class="nav-item nav-link {{ $tab_active == 'profile' ? 'active' : '' }}"
                                id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                                aria-controls="nav-room" aria-selected="false">Informasi Data Diri</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade {{ $tab_active == 'payment' ? 'show active' : '' }}" id="nav-home"
                            role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="d-flex mt-3 justify-content-end">

                            </div>
                            <div class="card text-start mt-3">
                                <div class="card-body">
                                    <h4 class="card-title">Unggah File Bukti</h4>
                                    <div>
                                        @if (session('success'))
                                            <div class="alert alert-success">Bukti Pembayaran Berhasil Diunggah</div>
                                        @endif
                                        <div class="alert alert-warning">
                                            Pembayaran uang sewa kost dilakukan melalui transfer ke rekening pemilik
                                            rumah Kost di <b>Bank Mandiri (1780002818074)</b> atau di <b>Bank BSI
                                                (4297640280) an. Mia Fathia</b>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" wire:model='file' class="form-control">
                                        </div>
                                        @error('file')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <button type="button" wire:loading.attr='disabled' wire:click='uploadFile'
                                            class="btn btn-success">Unggah Sekarang <span wire:loading
                                                class="spinner-border spinner-border-sm " role="status"
                                                aria-hidden="true"
                                                style="width: 1rem; height: 1rem; margin-left: 5px"></span></button>
                                    </div>

                                </div>
                            </div>
                            <div class="card mt-3 text-start">
                                <div class="card-body">
                                    <h4 class="card-title">Riwayat Pembayaran</h4>

                                    @livewire('resident-payment-histories-table', ['resident_id' => $resident_id])

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $tab_active == 'room' ? 'show active' : '' }}" id="nav-room"
                            role="tabpanel" aria-labelledby="nav-room-tab">
                            <div class="row mt-3">
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group mb-3">
                                                <label for="room_name" class="form-label">Nama Kamar</label>
                                                <input disabled type="text" class="form-control" name="room_name"
                                                    value="{{ $roomDetails['room_name'] }}" />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label id="room_type" class="form-label">Tipe Kamar</label>
                                                <input disabled type="text" class="form-control" name="room_type"
                                                    value="{{ $roomDetails['room_type'] }}" />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="capacity" class="form-label">Kapasitas Kamar</label>
                                                <input disabled type="number" class="form-control" name="capacity"
                                                    value="{{ $roomDetails['capacity'] }}" />
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="price" class="form-label">Harga per-bulan</label>
                                                <input disabled type="text" class="form-control" name="price"
                                                    value="Rp. {{ number_format($roomDetails['price'], '2') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="form-group mb-3">
                                                <label id="facilities" class="form-label">Fasilitas</label>
                                                @foreach ($roomDetails['room_facilities'] as $room_facility)
                                                    <li class="select-item pe-3"
                                                        data-val="{{ $room_facility['facility']['facility_name'] }}"
                                                        title="{{ $room_facility['facility']['facility_name'] }}">
                                                        {{ $room_facility['facility']['facility_name'] }}
                                                    </li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="form-group mb-3">
                                                <label id="description" class="form-label">Deskripsi Kamar</label>
                                                <textarea disabled class="form-control" id="" cols="30" rows="3"
                                                    value='{{ $roomDetails['description'] }}'>{{ $roomDetails['description'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $tab_active == 'profile' ? 'show active' : '' }}"
                            id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row mt-3">
                                <div class="col">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @elseif(session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                    <div class="card">
                                        <div class="card-body">
                                            <form wire:submit.prevent="save" enctype="multipart/form-data">
                                                <div class="form-group mb-3">
                                                    <label for="name" class="form-label">Nama Penghuni</label>
                                                    <input wire:model="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" value="{{ $name }}" />
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="address" class="form-label">Alamat</label>
                                                    <textarea wire:model="address" class="form-control @error('address') is-invalid @enderror" name="address">{{ $address }}</textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="contact" class="form-label">Kontak Penghuni</label>
                                                    <input wire:model="contact" type="text"
                                                        class="form-control @error('contact') is-invalid @enderror"
                                                        name="contact" value="{{ $contact }}" />
                                                    @error('contact')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="contact_name" class="form-label">Nomor Darurat</label>
                                                    <div class="d-flex gap-2">
                                                        <div style='width: 50%'>
                                                            <input wire:model="contact_name" type="text"
                                                                class="form-control @error('contact_name') is-invalid @enderror"
                                                                name="contact_name" value="{{ $contact_name }}"
                                                                placeholder="Nama Nomor Darurat. Contoh: Ibu, Ayah" />
                                                            @error('contact_name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div style='width: 50%'>
                                                            <input wire:model="contact_number" type="text"
                                                                class="form-control @error('contact_number') is-invalid @enderror"
                                                                name="contact_number" value="{{ $contact_number }}"
                                                                placeholder="Nomor Darurat" />
                                                            @error('contact_number')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Kolom-kolom baru -->

                                                <div class="form-group mb-3">
                                                    <label for="ktp_number" class="form-label">Nomor KTP</label>
                                                    <input wire:model="ktp_number" type="text"
                                                        class="form-control @error('ktp_number') is-invalid @enderror"
                                                        name="ktp_number" value="{{ $ktp_number }}" />
                                                    @error('ktp_number')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="ktp_image" class="form-label">Foto KTP</label>
                                                    <input wire:model="ktp_image" type="file"
                                                        class="form-control-file @error('ktp_image') is-invalid @enderror"
                                                        name="ktp_image" />
                                                    @error('ktp_image')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="job" class="form-label">Pekerjaan</label>
                                                    <select wire:model="job"
                                                        class="form-control @error('job') is-invalid @enderror"
                                                        name="job">
                                                        <option value="">Pilih Pekerjaan</option>
                                                        <option value="karyawan">Karyawan</option>
                                                        <option value="pelajar">Pelajar</option>
                                                    </select>
                                                    @error('job')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="institute" class="form-label">Institusi</label>
                                                    <input wire:model="institute" type="text"
                                                        class="form-control @error('institute') is-invalid @enderror"
                                                        name="institute" value="{{ $institute }}" />
                                                    @error('institute')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="institute" class="form-label">Alamat Institusi</label>
                                                    <textarea wire:model="institute_address" type="text"
                                                        class="form-control @error('institute_address') is-invalid @enderror" name="institute_address"
                                                        value="{{ $institute_address }}">{{ $institute_address }}</textarea>
                                                    @error('institute')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="vehicle" class="form-label">Kendaraan</label>
                                                    <select wire:model="vehicle"
                                                        class="form-control @error('vehicle') is-invalid @enderror"
                                                        name="vehicle">
                                                        <option value="">Pilih Kendaraan</option>
                                                        <option value="tidak_ada">Tidak ada kendaraan</option>
                                                        <option value="mobil">Mobil</option>
                                                        <option value="motor">Motor</option>
                                                    </select>
                                                    @error('vehicle')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="vehicle_number" class="form-label">Nomor
                                                        Kendaraan</label>
                                                    <input wire:model="vehicle_number" type="text"
                                                        class="form-control @error('vehicle_number') is-invalid @enderror"
                                                        name="vehicle_number" value="{{ $vehicle_number }}" />
                                                    @error('vehicle_number')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <button class="btn btn-success">Simpan</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @push('script')
            <script>
                let datatable_init = new DataTable('#tableId');
            </script>
        @endpush
    </div>
</div>
