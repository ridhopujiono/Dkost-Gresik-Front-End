<div>
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <h5 class="m-0 ms-2">Notifikasi</h5>
                <p class="az-dashboard-text mb-3">
                    Ini adalah daftar notifikasi telat pembayaran anda
                </p>
            </div>
            <!-- az-content-body -->
        </div>
        <div class="container">
            <div class="row mt-3 w-100">
                @forelse ($notifs as $notif)
                    <div class="col">
                        <div class="card text-start">
                            <div class="card-body">
                                <div class="d-flex justify-content-between gap-1 align-items-center flex-wrap">
                                    <div>
                                        {!! $notif['notification_content'] !!}
                                    </div>
                                    <div style="font-size: 11px">
                                        {{ \Carbon\Carbon::parse($notif['notification_date'])->setTimezone('Asia/Jakarta')->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <div class="alert alert-secondary">belum ada notifikasi</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
