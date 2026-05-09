<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\HutangPiutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HutangPiutangController extends Controller
{
    // Untuk Halaman Index Hutang Piutang
    public function index(Request $request)
    {
        // Query hanya hutang Piutang milik user yg login
        $query = HutangPiutang::where('user_id', $request->user()->id);

        // Search
        if ($q = $request->get('q')) {
            $query->where(function ($qr) use ($q) {
                $qr->where('nama_pihak', 'like', "%{$q}%")
                    ->orWhere('jenis_transaksi', 'like', "%{$q}%")
                    ->orWhere('pembayaran', 'like', "%{$q}%")->orWhere('status', 'like', "%{$q}%");
            });
        }

        // Filter waktu (tanggal_pelunasan)
        if ($filter = $request->get('filter')) {
            if ($filter === 'today') {
                $query->whereDate('tanggal_pelunasan', today());
            } elseif ($filter === 'month') {
                $query->whereMonth('tanggal_pelunasan', now()->month)
                    ->whereYear('tanggal_pelunasan', now()->year);
            } elseif ($filter === 'year') {
                $query->whereYear('tanggal_pelunasan', now()->year);
            }
        }

        $hutangPiutang = $query->orderBy('tanggal_pelunasan', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('member.hutangPiutang', compact('hutangPiutang'));
    }

    // Untuk Pegination
    public function list(Request $request)
    {
        $query = HutangPiutang::where('user_id', $request->user()->id);

        if ($q = $request->get('q')) {
            $query->where(function ($qr) use ($q) {
                $qr->where('nama_pihak', 'like', "%{$q}%")
                    ->orWhere('jenis_transaksi', 'like', "%{$q}%")
                    ->orWhere('pembayaran', 'like', "%{$q}%")->orWhere('status', 'like', "%{$q}%");
            });
        }

        if ($filter = $request->get('filter')) {
            if ($filter === 'today') {
                $query->whereDate('tanggal_pelunasan', today());
            } elseif ($filter === 'month') {
                $query->whereMonth('tanggal_pelunasan', now()->month)
                    ->whereYear('tanggal_pelunasan', now()->year);
            } elseif ($filter === 'year') {
                $query->whereYear('tanggal_pelunasan', now()->year);
            }
        }

        $hutangPiutang = $query->orderBy('tanggal_pelunasan', 'desc')
            ->paginate(10)
            ->withQueryString();

        return response()->json([
            'rows'       => view('member.partials.hutangPiutang_rows', compact('hutangPiutang'))->render(),
            'pagination' => view('member.partials.hutangPiutang_pagination', compact('hutangPiutang'))->render(),
            'info'       => view('member.partials.hutangPiutang_info', compact('hutangPiutang'))->render(),
        ]);
    }

    // Untuk Halaman Tambah
    public function tambah()
    {
        return view('member.hutangPiutangTambah');
    }

    // Sistem Tambah Hutang Piutang
    public function simpan(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pihak'       => 'required|string|max:255',
            'qty'               => 'required|numeric|min:1',
            'harga_satuan'      => 'required|numeric|min:0',
            'total'             => 'required|numeric|min:0',
            'catatan'           => 'required|string',
            'jatuh_tempo'       => 'nullable|date',
            'tanggal_pelunasan' => 'nullable|date',
            'status'            => 'required|string|max:255',
            'jenis_transaksi'   => 'required|string|max:255',
            'pembayaran'        => 'required|string|max:255',
        ], [
            'nama_pihak.required'       => 'Nama pihak wajib diisi.',
            'nama_pihak.max'            => 'Nama pihak maksimal 255 karakter.',
            'qty.required'               => 'Jumlah produk wajib diisi.',
            'qty.numeric'                => 'Jumlah harus berupa angka.',
            'qty.min'                    => 'Jumlah minimal 1.',
            'harga_satuan.required'      => 'Harga satuan wajib diisi.',
            'harga_satuan.numeric'       => 'Harga satuan harus berupa angka.',
            'harga_satuan.min'           => 'Harga satuan tidak boleh negatif.',
            'total.required'             => 'Total wajib diisi.',
            'total.numeric'              => 'Total harus berupa angka.',
            'total.min'                  => 'Total tidak boleh negatif.',
            'catatan.required'           => 'Catatan wajib diisi.',
            'jatuh_tempo.date'           => 'Format tanggal jatuh tempo tidak valid.',
            'tanggal_pelunasan.date'     => 'Format tanggal pelunasan tidak valid.',
            'status.required'            => 'Status wajib diisi.',
            'jenis_transaksi.required'   => 'Jenis transaksi wajib diisi.',
            'pembayaran.required'        => 'Jenis pembayaran wajib diisi.',
        ]);

        // Simpan data
        HutangPiutang::create([
            'user_id'           => Auth::id(),
            'nama_pihak'       => $request->nama_pihak,
            'qty'               => $request->qty,
            'harga_satuan'      => $request->harga_satuan,
            'total'             => $request->total,
            'catatan'           => $request->catatan,
            'jatuh_tempo'       => $request->jatuh_tempo,
            'tanggal_pelunasan' => $request->tanggal_pelunasan,
            'status'            => $request->status,
            'jenis_transaksi'   => $request->jenis_transaksi,
            'pembayaran'        => $request->pembayaran,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data Hutnag Piutang berhasil disimpan.');
    }

    // Hapus Hutang Piutang
    public function destroy(string $id)
    {
        $hutangPiutang = HutangPiutang::findOrFail($id);

        $hutangPiutang->delete();

        return redirect()->back()->with('success', 'Hutang Piutang berhasil dihapus.');
    }

    // Untuk Halaman Edit
    public function show(string $id)
    {
        $hutangPiutang = HutangPiutang::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('member.editHutangPiutang', compact('hutangPiutang'));
    }

    // Sistem Update Hutang Piutanf
    public function update(Request $request, string $id)
    {
        // Ambil hutang piutang sesuai ID dan pastikan milik user login
        $hutangPiutang = HutangPiutang::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Validasi input
        $request->validate([
            'nama_pihak'        => 'string|max:255',
            'qty'               => 'numeric|min:1',
            'harga_satuan'      => 'numeric|min:0',
            'total'             => 'numeric|min:0',
            'catatan'           => 'string',
            'jatuh_tempo'       => 'nullable|date',
            'tanggal_pelunasan' => 'nullable|date',
            'status'            => 'in:lunas,belum lunas,sebagian',
            'jenis_transaksi'   => 'in:hutang,piutang',
            'pembayaran'        => 'string|max:255',
        ], [
            'qty.numeric'                => 'Jumlah harus berupa angka.',
            'qty.min'                    => 'Jumlah minimal 1.',
            'harga_satuan.numeric'       => 'Harga satuan harus berupa angka.',
            'harga_satuan.min'           => 'Harga satuan tidak boleh negatif.',
            'total.numeric'              => 'Total harus berupa angka.',
            'total.min'                  => 'Total tidak boleh negatif.',
            'jatuh_tempo.date'           => 'Format tanggal jatuh tempo tidak valid.',
            'tanggal_pelunasan.date'     => 'Format tanggal pelunasan tidak valid.',
        ]);

        // Update data
        $hutangPiutang->update([
            'nama_pihak'        => $request->nama_pihak,
            'qty'               => $request->qty,
            'harga_satuan'      => $request->harga_satuan,
            'total'             => $request->total,
            'catatan'           => $request->catatan,
            'jatuh_tempo'       => $request->jatuh_tempo,
            'tanggal_pelunasan' => $request->tanggal_pelunasan,
            'status'            => $request->status,
            'jenis_transaksi'   => $request->jenis_transaksi,
            'pembayaran'        => $request->pembayaran,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Data hutang/piutang berhasil diperbarui.');
    }
}
