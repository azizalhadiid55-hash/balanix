<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use Illuminate\Http\Request;

class BootcampController extends Controller
{
    public function index(Request $request)
    {
        $bootcamps = Bootcamp::latest()->get(); // Ambil semua data bootcamp, diurutkan dari yang terbaru
        $jenisBootcamp = Bootcamp::select('jenis_bootcamp')->distinct()->pluck('jenis_bootcamp'); // Ambil semua jenis bootcamp unik

        return view('member.bootcamp', compact('bootcamps', 'jenisBootcamp'));
    }

    public function searchAndFilter(Request $request)
    {
        $query = Bootcamp::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama_bootcamp', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        if ($request->filled('jenis')) {
            $jenis = $request->input('jenis');
            if ($jenis !== 'Semua') {
                $query->where('jenis_bootcamp', $jenis);
            }
        }

        $bootcamps = $query->latest()->get();
        $jenisBootcamp = Bootcamp::select('jenis_bootcamp')->distinct()->pluck('jenis_bootcamp');

        return view('member.bootcamp', compact('bootcamps', 'jenisBootcamp'));
    }
}
