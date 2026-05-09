<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bootcamp extends Model
{
    use HasFactory;

    protected $table = "bootcamp";
    protected $fillable = [
        'user_id',
        'nama_bootcamp',
        'jenis_bootcamp',
        'pelaksanaan',
        'link',
        'deskripsi',
        'preview'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
