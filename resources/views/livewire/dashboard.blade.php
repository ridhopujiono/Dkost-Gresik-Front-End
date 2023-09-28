<div>
    <style>
        .fc-direction-ltr .fc-daygrid-event.fc-event-end,
        .fc-direction-rtl .fc-daygrid-event.fc-event-start {
            text-wrap: balance;
        }

        .fc-daygrid-event-dot {
            border: calc(var(--fc-daygrid-event-dot-width)/2) solid #ff0000;
        }

        .fc-event-time {
            display: none
        }
    </style>
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <div class="az-dashboard-one-title">
                    <div>
                        <h2 class="az-dashboard-title">Selamat datang, {{ auth()->user()->name }}</h2>
                        <p class="az-dashboard-text">
                            Dashboard utama kamu.
                        </p>
                    </div>
                    <div class="az-content-header-right">
                        <div class="media">
                            <div class="media-body">
                                <label>Tanggal Mulai</label>
                                <h6 id="eventStartText">-</h6>
                            </div>
                            <!-- media-body -->
                        </div>
                        <!-- media -->
                        <div class="media">
                            <div class="media-body">
                                <label>Tanggal Berakhir</label>
                                <h6 id="eventEndText">-</h6>
                            </div>
                            <!-- media-body -->
                        </div>
                        <!-- media -->
                        <div class="media">
                            <div class="media-body">
                                <div class="form-group mb-0">
                                    <label>Kamar</label>
                                    <select name="room" id="roomSelect" class="form-control">
                                        @forelse ($processedContracts as $pc)
                                            <option value="{{ $pc['id'] }}">{{ $pc['event_name'] }}</option>
                                        @empty
                                            <option value="" disabled>-</option>
                                        @endforelse
                                    </select>

                                </div>
                            </div>
                            <!-- media-body -->
                        </div>
                        <!-- media -->
                    </div>
                </div>
                <!-- az-dashboard-one-title -->
                <hr>

                <h5 class="m-0 ms-2">Informasi Tenggat</h5>
                <p class="az-dashboard-text mb-2">
                    Ini adalah informasi tanggal kapan tenggat kamar tiba.
                </p>
                <div class="row">
                    <div class="col-md mb-2">
                        <div class="card text-start">
                            <div class="card-body">
                                <h4 class="card-title">Informasi</h4>
                                <hr>
                                @forelse ($processedContracts as $pc)
                                    <ul style="padding-left: 1.5rem;">
                                        <li>
                                            <b class=""> {{ $pc['event_name'] }}</b>
                                            <br>
                                            @php
                                                $dueDate = \Carbon\Carbon::parse($pc['event_end']);
                                                $today = \Carbon\Carbon::now();
                                            @endphp

                                            <span
                                                class="badge py-1 px-2 @if ($dueDate->isPast()) bg-danger @else bg-info @endif text-white"
                                                style="font-size: 12px">
                                                Jatuh tempo: {{ $dueDate->format('d - m - Y') }}
                                            </span>
                                        </li>
                                    </ul>
                                @empty
                                    <div class="alert alert-secondary">tidak ada</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card text-start">
                            <div class="card-body">
                                <p class="card-text">
                                <div wire:ignore id="calendar"></div>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- az-content-body -->
        </div>
    </div>
    <script>
        let result = []
    </script>
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
        <script>
            var calendarEl = document.getElementById("calendar");
            var resourceData = <?php echo json_encode($processedContracts); ?>; // Convert PHP array to JavaScript array
            result = resourceData.map(function(item) {
                return {
                    id: item.event_name, // You can use a unique identifier as the ID
                    title: "Tenggat " + item.event_name,
                    start: item.event_end,
                    end: item.event_end,

                };
            });
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "dayGridMonth",
                locale: "id",
                themeSystem: 'bootstrap5',
                events: result
            });
            calendar.render();
        </script>
        <script>
            let data = resourceData;

            // Fungsi untuk memformat tanggal ke dalam format yang lebih mudah dibaca
            function formatTanggal(tanggal) {
                var date = new Date(tanggal);
                var tahun = date.getFullYear();
                var bulan = (date.getMonth() + 1).toString().padStart(2, "0");
                var hari = date.getDate().toString().padStart(2, "0");
                return tahun + "-" + bulan + "-" + hari;
            }

            function tampilkanEvent() {
                var select = document.getElementById("roomSelect");
                var selectedId = select.value;

                // Cari data berdasarkan ID yang dipilih
                var selectedData = data.find(function(item) {
                    return item.id == selectedId;
                });

                if (selectedData) {
                    var eventStart = formatTanggal(selectedData.event_start);
                    var eventEnd = formatTanggal(selectedData.event_end);
                    document.getElementById("eventStartText").textContent = eventStart;
                    document.getElementById("eventEndText").textContent = eventEnd;
                } else {
                    document.getElementById("eventStartText").textContent = "-";
                    document.getElementById("eventEndText").textContent = "-";
                }
            }

            // Panggil fungsi tampilkanEvent saat dropdown berubah
            var roomSelect = document.getElementById("roomSelect");
            roomSelect.addEventListener("change", tampilkanEvent);

            // Tampilkan event_start dan event_end awal
            tampilkanEvent();
        </script>
    @endpush
</div>
