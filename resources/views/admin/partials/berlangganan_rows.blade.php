@if ($berlangganan->count())
    @foreach ($berlangganan as $i => $b)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $b->nama_umkm }}</td>
            <td>{{ $b->tanggal_bayar }}</td>
            <td>@currency($b->total)</td>
            <td>{{ $b->jenis_pembayaran }}</td>
            <td>{{ $b->paket }}</td>
            <td>
                <div class="action-buttons">
                    <a class="btn-action" href="{{ route('admin.berlanganan.show', $b->id) }}"><i
                            class="bi bi-pencil-square"></i></a>

                    <form action="{{ route('admin.berlanganan.destroy', $b->id) }}" method="POST" class="form-hapus">
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
        <td colspan="7" class="py-10">
            <div class=" text-center">Data Berlangganan Tidak Ada</div>
        </td>
    </tr>
@endif
