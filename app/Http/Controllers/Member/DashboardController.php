<?php

namespace App\Http\Controllers\Member;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\HutangPiutang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = Transaksi::where('user_id', $userId);

        // Search
        if ($q = $request->get('q')) {
            $query->where('nama_produk', 'like', "%{$q}%");
        }

        // Filter waktu
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
            ->paginate(5)
            ->withQueryString();

        // ====== Chart Kas & Bank ======
        $kasBank = Transaksi::select(
            DB::raw("MONTH(tanggal_transaksi) as bulan"),
            DB::raw("SUM(CASE WHEN jenis_transaksi='pemasukan' THEN total ELSE 0 END) as pemasukan"),
            DB::raw("SUM(CASE WHEN jenis_transaksi='pengeluaran' THEN total ELSE 0 END) as pengeluaran")
        )
            ->where('user_id', $userId)
            ->whereYear('tanggal_transaksi', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $pemasukanData = array_fill(1, 12, 0);
        $pengeluaranData = array_fill(1, 12, 0);

        foreach ($kasBank as $row) {
            $pemasukanData[$row->bulan] = $row->pemasukan;
            $pengeluaranData[$row->bulan] = $row->pengeluaran;
        }

        // ====== Chart Hutang Piutang ======
        $hutangPiutang = HutangPiutang::select(
            DB::raw("MONTH(created_at) as bulan"),
            DB::raw("SUM(CASE WHEN jenis_transaksi = 'hutang' THEN total ELSE 0 END) as hutang"),
            DB::raw("SUM(CASE WHEN jenis_transaksi = 'piutang' THEN total ELSE 0 END) as piutang")
        )
            ->where('user_id', $userId)
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $hutangData = array_fill(1, 12, 0);
        $piutangData = array_fill(1, 12, 0);

        foreach ($hutangPiutang as $row) {
            $hutangData[$row->bulan] = (float) $row->hutang;
            $piutangData[$row->bulan] = (float) $row->piutang;
        }

        return view('member.dashboard', [
            'transaksi'      => $transaksi,
            'bulanLabels'    => $bulanLabels,
            'pemasukanData'  => array_values($pemasukanData),
            'pengeluaranData' => array_values($pengeluaranData),
            'hutangData'     => array_values($hutangData),
            'piutangData'    => array_values($piutangData),
        ]);
    }

    public function list(Request $request)
    {
        $userId = Auth::id();
        $query = Transaksi::where('user_id', $userId);

        if ($q = $request->get('q')) {
            $query->where('nama_produk', 'like', "%{$q}%");
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
            ->paginate(5)
            ->withQueryString();

        return response()->json([
            'rows'       => view('member.partials.dashboard_rows', compact('transaksi'))->render(),
            'pagination' => view('member.partials.dashboard_pagination', compact('transaksi'))->render(),
            'info'       => view('member.partials.dashboard_info', compact('transaksi'))->render(),
        ]);
    }

    public function exportPdf()
    {
        // Ambil data dari 2 tabel
        $userId = Auth::id();
        $transaksi = Transaksi::where('user_id', $userId)->latest()->get();
        $hutangPiutang   = HutangPiutang::where('user_id', $userId)->latest()->get();

        // Kirim ke view
        $pdf = Pdf::loadView('laporan.pdf', [
            'transaksi' => $transaksi,
            'hutangPiutang'   => $hutangPiutang,
        ]);

        // Unduh file dengan nama dinamis
        return $pdf->download('Laporan-'.now()->format('Ymd').'.pdf');
    }
}
