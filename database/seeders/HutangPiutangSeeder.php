<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\HutangPiutang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HutangPiutangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 10; $i++) {
                $qty = rand(1, 5);
                $harga = rand(10000, 50000);
                $total = $qty * $harga;

                HutangPiutang::create([
                    'user_id'           => $user->id,
                    'nama_pihak'        => 'Pihak ' . Str::random(5),
                    'qty'               => $qty,
                    'harga_satuan'      => $harga,
                    'total'             => $total,
                    'catatan'           => 'Catatan transaksi ' . Str::random(10),
                    'jatuh_tempo'       => now()->addDays(rand(3, 30)),
                    'tanggal_pelunasan' => rand(0, 1) ? now()->addDays(rand(1, 30)) : null,
                    'status'            => collect(['belum lunas', 'lunas', 'sebagian'])->random(),
                    'jenis_transaksi'   => collect(['hutang', 'piutang'])->random(),
                    'pembayaran'        => collect(['cash', 'transfer', 'qris'])->random(),
                ]);
            }
        }
    }
}
