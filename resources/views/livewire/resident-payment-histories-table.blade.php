<div class="table-responsive">
    <table class="table mg-b-0" id='tableId'>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pembayaran</th>
                <th>Status</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paymentHistories as $index => $paymentHistory)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ \Carbon\Carbon::parse($paymentHistory['payment_date'])->format('d M Y') }}</td>
                    <td>
                        @if ($paymentHistory['verification_status'] == 'terverifikasi')
                            <span class="badge bg-success text-white">terverifikasi</span>
                        @else
                            <span class="badge bg-warning text-dark">menunggu</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ $paymentHistory['payment_proof'] }}" target="_blank">
                            {{ \Str::limit($paymentHistory['payment_proof'], 20, '...') }}
                            <span class="typcn typcn-image-outline" style="font-size: 20px"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
