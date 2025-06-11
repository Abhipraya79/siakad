<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Mematikan pengecekan foreign key sementara untuk memastikan proses seeding lancar
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Panggil semua seeder dengan urutan yang benar
        $this->call([
            DosenSeeder::class,
            DosenWaliSeeder::class,
            MataKuliahSeeder::class,
            RuanganSeeder::class,
            MahasiswaSeeder::class,
            JadwalKuliahSeeder::class,
            FrsSeeder::class,
            NilaiSeeder::class,
            PembayaranSeeder::class,
            UserSeeder::class,
        ]);

        // Menyalakan kembali pengecekan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}