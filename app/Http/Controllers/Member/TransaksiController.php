<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // Untuk Halaman Index Transaksi
    public function index(Request $request)
    {
        // Query hanya transaksi milik user yg login
        $query = Transaksi::where('user_id', $request->user()->id);

        // Search
        if ($q = $request->get('q')) {
            $query->where(function ($qr) use ($q) {
                $qr->where('nama_produk', 'like', "%{$q}%")
                    ->orWhere('jenis_transaksi', 'like', "%{$q}%")
                    ->orWhere('pembayaran', 'like', "%{$q}%");
            });
        }

        // Filter waktu (tanggal_transaksi)
        if ($filter = $request->get('filter')) {
            if ($filter === 'today') {
                $query->whereDate('tanggal_transaksi', today());
            } elseif ($filter === 'month') {
                $query->whereMonth('tanggal_transaksi', now()->month)
                    ->whereYear('tanggal_transaksi', now()->year);
            } elseif ($filter === 'year') {
                $query->whereYear('tanggal_transaksi', now()->year);
            }
        }

        $transaksi = $query->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('member.transaksi', compact('transaksi'));
    }

    public function list(Request $request)
    {
        $query = Transaksi::where('user_id', $request->user()->id);

        if ($q = $request->get('q')) {
            $query->where(function ($qr) use ($q) {
                $qr->where('nama_produk', 'like', "%{$q}%")
                    ->orWhere('jenis_transaksi', 'like', "%{$q}%")
                    ->orWhere('pembayaran', 'like', "%{$q}%");
            });
        }

        if ($filter = $request->get('filter')) {
            if ($filter === 'today') {
                $query->whereDate('tanggal_transaksi', today());
            } elseif ($filter === 'month') {
                $query->whereMonth('tanggal_transaksi', now()->month)
                    ->whereYear('tanggal_transaksi', now()->year);
            } elseif ($filter === 'year') {
                $query->whereYear('tanggal_transaksi', now()->year);
            }
        }

        $transaksi = $query->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10)
            ->withQueryString();

        return response()->json([
            'rows'       => view('member.partials.transaksi_rows', compact('transaksi'))->render(),
            'pagination' => view('member.partials.transaksi_pagination', compact('transaksi'))->render(),
            'info'       => view('member.partials.transaksi_info', compact('transaksi'))->render(),
        ]);
    }

    // Untuk halaman tambah index
    public function tambah()
    {
        return view('member.transaksiTambah');
    }

    // Sistem sistem transaksi
    public function simpan(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_produk'       => 'required|string|max:255',
            'tanggal_transaksi' => 'required|date|before_or_equal:today',
            'total'             => 'required|numeric|min:0',
            'qty'               => 'required|string|max: 255',
            'pembayaran'        => 'required|string|max:255',
            'jenis_transaksi'   => 'required|string|max:255',
        ], [
            'nama_produk.required'       => 'Nama produk wajib diisi.',
            'nama_produk.max'            => 'Nama produk maksimal 255 karakter.',

            'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
            'tanggal_transaksi.date'     => 'Format tanggal tidak valid.',
            'tanggal_transaksi.before_or_equal' => 'Tanggal tidak boleh di masa depan.',

            'qty.required'               => 'Jumlah produk wajib diisi.',
            'qty.max'                    => 'Jumlah harus  maksimal 255 karakter.',

            'total.required'             => 'Total wajib diisi.',
            'total.numeric'              => 'Total harus berupa angka.',
            'total.min'                  => 'Total tidak boleh negatif.',

            'pembayaran.required'        => 'Jenis pembayaran wajib diisi.',

            'jenis_transaksi.required'   => 'Jenis transaksi wajib diisi.',
        ]);


        // Simpan data
        Transaksi::create([
            'user_id'           => Auth::id(),
            'nama_produk'       => $request->nama_produk,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'qty'               => $request->qty,
            'total'             => $request->total,
            'pembayaran'        => $request->pembayaran,
            'jenis_transaksi'   => $request->jenis_transaksi,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data transaksi berhasil disimpan.');
    }

    // Hapus Transaksi
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }

    // Untuk Halaman Edit
    public function show(string $id)
    {
        $transaksi = Transaksi::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('member.editTransaksi', compact('transaksi'));
    }

    // Sistem Update Transaksi
    public function update(Request $request, string $id)
    {
        // Ambil transaksi sesuai ID dan pastikan milik user login
        $transaksi = Transaksi::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Validasi input
        $request->validate([
            'nama_produk'       => 'required|string|max:255',
            'tanggal_transaksi' => 'required|date|before_or_equal:today',
            'total'             => 'required|numeric|min:0',
            'qty'               => 'required|string|max:255',
            'pembayaran'        => 'required|string|max:255',
            'jenis_transaksi'   => 'required|string|max:255',
        ], [
            'nama_produk.required'       => 'Nama produk wajib diisi.',
            'nama_produk.max'            => 'Nama produk maksimal 255 karakter.',

            'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
            'tanggal_transaksi.date'     => 'Format tanggal tidak valid.',
            'tanggal_transaksi.before_or_equal' => 'Tanggal tidak boleh di masa depan.',

            'qty.required'               => 'Jumlah produk wajib diisi.',
            'qty.max'                    => 'Jumlah maksimal 255 karakter.',

            'total.required'             => 'Total wajib diisi.',
            'total.numeric'              => 'Total harus berupa angka.',
            'total.min'                  => 'Total tidak boleh negatif.',

            'pembayaran.required'        => 'Jenis pembayaran wajib diisi.',

            'jenis_transaksi.required'   => 'Jenis transaksi wajib diisi.',
        ]);

        // Update data
        $transaksi->update([
            'nama_produk'       => $request->nama_produk,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'qty'               => $request->qty,
            'total'             => $request->total,
            'pembayaran'        => $request->pembayaran,
            'jenis_transaksi'   => $request->jenis_transaksi,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Data transaksi berhasil diperbarui.');
    }
}
