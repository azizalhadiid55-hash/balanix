<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HutangPiutang extends Model
{
    use HasFactory;

    protected $table = 'hutang_piutang';

    protected $fillable = [
        'user_id',
        'nama_pihak',
        'qty',
        'harga_satuan',
        'total',
        'catatan',
        'jatuh_tempo',
        'tanggal_pelunasan',
        'status',
        'jenis_transaksi',
        'pembayaran'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
