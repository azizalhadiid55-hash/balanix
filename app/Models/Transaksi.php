<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'user_id',
        'nama_produk',
        'tanggal_transaksi',
        'total',
        'qty',
        'pembayaran',
        'jenis_transaksi'
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
