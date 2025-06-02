<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    public function run()
    {
        $mataKuliah = [
            ['IF101', 'Pemrograman Dasar', 3],
            ['MK001', 'Administrasi Basis Data', 3],
            ['MK002', 'Kecerdasan Buatan', 3],
            ['MK003', 'Algoritma Pemrograman', 3],
            ['MK004', 'Jaringan Komputer', 2],
        ];

        foreach ($mataKuliah as $i => $mk) {
            DB::table('mata_kuliah')->insert([
                'id_mata_kuliah' => $i + 1,
                'kode_mata_kuliah' => $mk[0],
                'nama_mata_kuliah' => $mk[1],
                'sks' => $mk[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
