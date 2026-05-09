<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BootcampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'user_id' => 1, // sesuaikan dengan id user yang sudah ada di tabel users
                'nama_bootcamp' => 'Bootcamp Laravel ' . $i,
                'jenis_bootcamp' => $i % 2 == 0 ? 'Online' : 'Offline',
                'pelaksanaan' => Carbon::now()->addDays($i),
                'link' => $i % 2 == 0 ? 'https://example.com/bootcamp-' . $i : null,
                'deskripsi' => 'Ini adalah deskripsi untuk bootcamp Laravel ke-' . $i,
                'preview' => 'https://picsum.photos/seed/' . Str::random(5) . '/600/400',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('bootcamp')->insert($data);
    }
}
