<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berlangganan;
use App\Models\Bootcamp;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Halaman Index
    public function index()
    {
        $membersCount = \App\Models\User::where('role', 'member')->count();
        $bootcampCount = Bootcamp::count();
        $berlanggananCount = Berlangganan::count();

        $member = \App\Models\User::where('role', '=', 'member')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $berlangganan = Berlangganan::orderBy('created_at', 'desc')->paginate(5);

        return view('admin.dashboard', compact('membersCount', 'bootcampCount', 'berlanggananCount', 'berlangganan', 'member'));
    }

    // AJAX list untuk tabel Berlangganan
    public function listBerlangganan(Request $request)
    {
        $query = Berlangganan::query();

        if ($search = $request->get('q')) {
            $query->where('nama_umkm', 'like', "%{$search}%");
        }

        $berlangganan = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        return response()->json([
            'rows'       => view('admin.partials.berlangganan_rows', compact('berlangganan'))->render(),
            'pagination' => view('admin.partials.berlangganan_pagination', compact('berlangganan'))->render(),
            'info'       => view('admin.partials.berlangganan_info', compact('berlangganan'))->render(),
        ]);
    }

    // AJAX list untuk tabel Member
    public function listMember(Request $request)
    {
        $query = User::query();

        if ($search = $request->get('q')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $member = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        return response()->json([
            'rows'       => view('admin.partials.member_rows', compact('member'))->render(),
            'pagination' => view('admin.partials.member_pagination', compact('member'))->render(),
            'info'       => view('admin.partials.member_info', compact('member'))->render(),
        ]);
    }

    // Halaman Tambah Data Berlangganan
    public function tambah()
    {
        $members = \App\Models\User::where('role', 'member')->get(['id', 'name']);
        // Ambil hanya kolom id & name
        return view('admin.tambahBerlangganan', compact('members'));
    }

    // Simpan Data Berlangganan
    public function simpan(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id'          => 'required|exists:users,id|unique:berlangganan,user_id',
            'nama_umkm'        => 'required|string|max:255|unique:berlangganan,nama_umkm',
            'tanggal_bayar'    => 'required|date',
            'total'            => 'required|numeric|min:0',
            'jenis_pembayaran' => 'required|string|max:255',
            'paket'            => 'required|string|max:255',
        ], [
            'user_id.required' => 'Pilih UMKM terlebih dahulu.',
            'user_id.exists'   => 'UMKM tidak valid.',
            'user_id.unique'   => 'UMKM ini sudah berlangganan.',

            'nama_umkm.required' => 'Nama UMKM wajib diisi.',
            'nama_umkm.unique'   => 'Nama UMKM ini sudah terdaftar.',

            'tanggal_bayar.required' => 'Tanggal bayar wajib diisi.',
            'total.required'         => 'Total wajib diisi.',
            'total.numeric'          => 'Total harus berupa angka.',
            'jenis_pembayaran.required' => 'Jenis pembayaran wajib diisi.',
            'paket.required'            => 'Paket wajib diisi.',
        ]);

        // Simpan data
        Berlangganan::create([
            'user_id'          => $request->user_id,
            'nama_umkm'        => $request->nama_umkm,
            'tanggal_bayar'    => $request->tanggal_bayar,
            'total'            => $request->total,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'paket'            => $request->paket,
            'expired_at'      => now()->addMonth(1), // Set expired_at satu bulan dari sekarang
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berlangganan berhasil disimpan.');
    }

    // Halaman Edit Berlangganan
    public function show(string $id)
    {
        $berlangganan = Berlangganan::findOrFail($id);
        $members = \App\Models\User::where('role', 'member')->get(['id', 'name']);

        return view('admin.editBerlangganan', compact('berlangganan', 'members'));
    }

    // Sistem Edit Berlangganan
    public function update(Request $request, $id)
    {
        $berlangganan = \App\Models\Berlangganan::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'user_id'          => 'exists:users,id',
            'nama_umkm'        => 'string|max:255',
            'tanggal_bayar'    => 'date',
            'total'            => 'numeric|min:0',
            'jenis_pembayaran' => 'string|max:255',
            'paket'            => 'string|max:255',
        ], [
            'user_id.exists'   => 'ID UMKM tidak ditemukan.',
            'total.required' => 'Total pembayaran wajib diisi.',
            'total.numeric' => 'Total harus berupa angka.',
        ]);

        // Update data
        $berlangganan->update($validated);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.berlanganan.show', $berlangganan->id)->with('success', 'Data berlangganan berhasil diperbarui.');
    }


    // Hapus Data berlangganan
    public function destroy(string $id)
    {
        $berlangganan = Berlangganan::findOrFail($id);

        $berlangganan->delete();

        return redirect()->route('admin.dashbaord.index')->with('success', 'Berlangganan berhasil dihapus.');
    }
}
