@if ($transaksi->count())
@foreach ($transaksi as $i => $t)
<tr>
    <td>{{ $transaksi->firstItem() + $i }}</td>
    <td>{{ $t->nama_produk }}</td>
    <td>{{ $t->qty }}</td>
    <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
    <td>{{ $t->pembayaran }}</td>
    <td>{{ $t->tanggal_transaksi->format('d M Y') }}</td>
    <td>{{ $t->jenis_transaksi }}</td>
    <td>
        <div class="action-buttons">
            <a class="btn-action" href="{{ route('transaksi.edit', $t->id) }}"><i class="bi bi-pencil-square"></i></a>

            <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" class="form-hapus">
                @csrf
                @method('DELETE')
                <button class="btn-action delete" type="submit"><i class="bi bi-trash"></i></button>
            </form>
        </div>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="7" class="text-center">Tidak ada transaksi</td>
</tr>
@endif
