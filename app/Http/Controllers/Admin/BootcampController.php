<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BootcampController extends Controller
{
    // Halaman utama (full HTML)
    public function index(Request $request)
    {
        $query = Bootcamp::with('user');

        if ($search = $request->get('q')) {
            $query->where('nama_bootcamp', 'like', '%' . $search . '%');
        }

        $perPage   = $request->integer('per_page', 10);
        $bootcamps = $query->orderBy('pelaksanaan', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.bootcamp', compact('bootcamps'));
    }

    // Endpoint AJAX untuk reload tabel + pagination tanpa reload halaman
    public function list(Request $request)
    {
        $query = Bootcamp::with('user');

        if ($search = $request->get('q')) {
            $query->where('nama_bootcamp', 'like', '%' . $search . '%');
        }

        $perPage   = $request->integer('per_page', 10);
        $bootcamps = $query->orderBy('pelaksanaan', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        // Render partials jadi HTML string
        $rows       = view('admin.partials.bootcamp_rows', compact('bootcamps'))->render();
        $pagination = view('admin.partials.bootcamp_pagination', compact('bootcamps'))->render();
        $info       = view('admin.partials.bootcamp_pagination_info', compact('bootcamps'))->render();

        return response()->json([
            'rows'       => $rows,
            'pagination' => $pagination,
            'info'       => $info,
        ]);
    }

    // Halaman Edit
    public function show(string $id)
    {
        $bootcamps = Bootcamp::findOrFail($id);
        return view('admin.editBootcamp', compact('bootcamps'));
    }

    // Halaman Tambah
    public function tambah()
    {
        return view('admin.tambahBootcamp');
    }

    // Logic untuk simpan data bootcamp
    public function simpan(Request $request)
    {
        $request->validate([
            'nama_bootcamp'   => 'required|string|max:255',
            'jenis_bootcamp'  => 'required|string|max:255',
            'pelaksanaan'     => 'required|date',
            'link'            => 'nullable|url|max:255',
            'deskripsi'       => 'nullable|string',
            'preview'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_bootcamp.required' => 'Nama bootcamp wajib diisi.',
            'nama_bootcamp.string'   => 'Nama bootcamp harus berupa teks.',
            'nama_bootcamp.max'      => 'Nama bootcamp tidak boleh lebih dari 255 karakter.',

            'jenis_bootcamp.required' => 'Jenis bootcamp wajib diisi.',
            'jenis_bootcamp.string'   => 'Jenis bootcamp harus berupa teks.',
            'jenis_bootcamp.max'      => 'Jenis bootcamp tidak boleh lebih dari 255 karakter.',

            'pelaksanaan.required' => 'Tanggal pelaksanaan wajib diisi.',
            'pelaksanaan.date'     => 'Tanggal pelaksanaan harus berupa format tanggal yang valid.',

            'link.url'  => 'Link harus berupa URL yang valid (contoh: https://example.com).',
            'link.max'  => 'Link tidak boleh lebih dari 255 karakter.',

            'deskripsi.string' => 'Deskripsi harus berupa teks.',

            'preview.image' => 'File preview harus berupa gambar.',
            'preview.mimes' => 'Preview hanya boleh berformat jpeg, png, atau jpg.',
            'preview.max'   => 'Ukuran file preview maksimal 2 MB.',
        ]);


        $bootcamp = new Bootcamp($request->except('preview'));
        $bootcamp->user_id = Auth::id(); // simpan user yang login

        if ($request->hasFile('preview')) {
            $file = $request->file('preview');
            $bootcamp->preview = $file->store('bootcamp-previews', 'public');
        }

        $bootcamp->save();

        return redirect()->route('bootcamp.php')->with('success', 'Bootcamp berhasil ditambahkan.');
    }

    // Untuk Edit Bootcamp
    public function update(Request $request, string $id)
    {
        $bootcamp = Bootcamp::findOrFail($id);

        $request->validate([
            'nama_bootcamp'   => 'string|max:255',
            'jenis_bootcamp'  => 'string|max:255',
            'pelaksanaan'     => 'date',
            'link'            => 'nullable|url|max:255',
            'deskripsi'       => 'nullable|string',
            'preview'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_bootcamp.string'   => 'Nama bootcamp harus berupa teks.',
            'nama_bootcamp.max'      => 'Nama bootcamp tidak boleh lebih dari 255 karakter.',

            'jenis_bootcamp.string'   => 'Jenis bootcamp harus berupa teks.',
            'jenis_bootcamp.max'      => 'Jenis bootcamp tidak boleh lebih dari 255 karakter.',

            'pelaksanaan.date'     => 'Tanggal pelaksanaan harus berupa format tanggal yang valid.',

            'link.url'  => 'Link harus berupa URL yang valid (contoh: https://example.com).',
            'link.max'  => 'Link tidak boleh lebih dari 255 karakter.',

            'deskripsi.string' => 'Deskripsi harus berupa teks.',

            'preview.image' => 'File preview harus berupa gambar.',
            'preview.mimes' => 'Preview hanya boleh berformat jpeg, png, atau jpg.',
            'preview.max'   => 'Ukuran file preview maksimal 2 MB.',
        ]);

        if ($request->hasFile('preview')) {
            // simpan path lama
            $oldPreview = $bootcamp->preview;

            // upload file baru
            $path = $request->file('preview')->store('bootcamp-previews', 'public');

            // update ke model
            $bootcamp->preview = $path;

            // hapus gambar lama kalau ada
            if ($oldPreview && Storage::disk('public')->exists($oldPreview)) {
                Storage::disk('public')->delete($oldPreview);
            }
        }

        $bootcamp->update([
            'nama_bootcamp'   => $request->nama_bootcamp,
            'jenis_bootcamp'  => $request->jenis_bootcamp,
            'pelaksanaan'     => $request->pelaksanaan,
            'link'            => $request->link,
            'deskripsi'       => $request->deskripsi,
            'preview'         => $bootcamp->preview,
        ]);

        return redirect()->route('admin.bootcamp.show', $bootcamp->id)->with('success', 'Bootcamp berhasil diperbarui.');
    }

    // Hapus Bootcamp
    public function destroy(string $id)
    {
        $bootcamp = Bootcamp::findOrFail($id);

        // Hapus gambar preview dari storage jika ada
        if ($bootcamp->preview && Storage::disk('public')->exists($bootcamp->preview)) {
            Storage::disk('public')->delete($bootcamp->preview);
        }

        $bootcamp->delete();

        return redirect()->route('admin.bootcamp.index')->with('success', 'Bootcamp berhasil dihapus.');
    }
}
