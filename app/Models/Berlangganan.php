<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berlangganan extends Model
{
    use HasFactory;

    protected $table = 'berlangganan';

    protected $fillable = [
        'user_id',
        'nama_umkm',
        'tanggal_bayar',
        'total',
        'jenis_pembayaran',
        'paket',
        'expired_at',
    ];
}
