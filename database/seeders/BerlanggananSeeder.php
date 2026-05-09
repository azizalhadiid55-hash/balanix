<?php

namespace Database\Seeders;

use App\Models\Berlangganan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BerlanggananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create('id_ID');

        // Ambil semua user
        $users = User::all();

        foreach ($users as $user) {
            Berlangganan::create([
                'user_id' => $user->id,
                'nama_umkm' => $faker->company,
                'tanggal_bayar' => $faker->date(),
                'total' => $faker->randomFloat(2, 100000, 2000000), // Rp 100rb - 2jt
                'jenis_pembayaran' => $faker->randomElement(['Transfer Bank', 'E-Wallet', 'Kartu Kredit']),
                'paket' => $faker->randomElement(['Basic', 'Premium', 'Pro']),
            ]);
        }
    }
}
