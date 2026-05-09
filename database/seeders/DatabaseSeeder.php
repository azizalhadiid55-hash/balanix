<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan seeder Bootcamp
        $this->call([
            // BootcampSeeder::class,
            // UserSeeder::class,
            // BerlanggananSeeder::class,
            // TransaksiSeeder::class,
            HutangPiutangSeeder::class,
        ]);
    }
}
