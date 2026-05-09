@if ($hutangPiutang->count())
@foreach ($hutangPiutang as $i => $h)
<tr>
    <td>{{ $hutangPiutang->firstItem() + $i }}</td>
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
    <td>
        <div class="action-buttons">
            <a class="btn-action" href="{{ route('hutangPiutang.edit', $h->id) }}"><i class="bi bi-pencil-square"></i></a>

            <form action="{{ route('hutangPiutang.destroy', $h->id) }}" method="POST" class="form-hapus">
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
    <td colspan="12" class="text-center">Tidak ada Hutang Piutang</td>
</tr>
@endif
