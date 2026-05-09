<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi & Hutang Piutang</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi & Hutang Piutang</h2>

    <h3>Data Transaksi</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Pembayaran</th>
                <th>Jenis Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($transaksi->count())
                @foreach($transaksi as $i => $t)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $t->nama_produk }}</td>
                    <td>{{ $t->qty }}</td>
                    <td>@currency($t->total)</td>
                    <td>{{ $t->tanggal_transaksi->format('Y-m-d') }}</td>
                    <td>{{ $t->pembayaran }}</td>
                    <td>{{ $t->jenis_transaksi }}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada transaksi</td>
                </tr>
            @endif
        </tbody>
    </table>

    <h3>Data Hutang Piutang</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pihak</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
                <th>Catatan</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Pelunasan</th>
                <th>Status</th>
                <th>Jenis Transaksi</th>
                <th>Metode Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @if ($hutangPiutang->count())
                @foreach($hutangPiutang as $i => $h)
                    <tr>
                        <td>{{ $i + 1}}</td>
                        <td>{{ $h->nama_pihak }}</td>
                        <td>{{ $h->qty }}</td>
                        <td>@currency($h->harga_satuan)</td>
                        <td>@currency($h->total)</td>
                        <td>{{ \Illuminate\Support\Str::limit($h->catatan, 50, '...') }}</td>
                        <td>{{ $h->jatuh_tempo }}</td>
                        <td>{{ $h->tanggal_pelunasan }}</td>
                        <td>
                            @if ($h->status === 'lunas')
                            <span class="badge bg-success">Lunas</span>
                            @elseif ($h->status === 'belum lunas')
                            <span class="badge bg-danger">Belum Lunas</span>
                            @else
                            <span class="badge bg-warning text-dark">Sebagian</span>
                            @endif
                        </td>
                        <td>{{ ucfirst($h->jenis_transaksi) }}</td>
                        <td>{{ ucfirst($h->pembayaran) }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="11" style="text-align: center;">Tidak ada hutang piutang</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>
