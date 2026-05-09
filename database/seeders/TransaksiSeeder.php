<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            DB::table('transaksi')->insert([
                'user_id' => $faker->numberBetween(1, 10),
                'nama_produk' => $faker->randomElement([
                    'Americano',
                    'Cappuccino',
                    'Cinnamon Roll',
                    'Croissant',
                    'Latte',
                    'Espresso',
                    'Matcha',
                    'Red Velvet Cake'
                ]),
                'tanggal_transaksi' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
                'total' => $faker->numberBetween(10000, 75000),
                'qty' => $faker->numberBetween(1, 5),
                'pembayaran' => $faker->randomElement(['Cash', 'QRIS', 'Transfer', 'Debit']),
                'jenis_transaksi' => $faker->randomElement(['Penjualan', 'Pembelian', 'Refund']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
