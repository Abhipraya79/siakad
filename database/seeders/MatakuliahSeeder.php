<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mata_kuliah')->insert([
            ['id_mata_kuliah' => 1, 'kode_mata_kuliah' => 'IF101', 'nama_mata_kuliah' => 'Administrasi Basis Data', 'sks' => 3, 'created_at' => '2025-05-18 12:13:19', 'updated_at' => '2025-05-18 12:13:19'],
            ['id_mata_kuliah' => 2, 'kode_mata_kuliah' => 'IF102', 'nama_mata_kuliah' => 'Struktur Data', 'sks' => 3, 'created_at' => '2025-05-22 08:14:23', 'updated_at' => '2025-05-22 08:14:23'],
            ['id_mata_kuliah' => 3, 'kode_mata_kuliah' => 'IF103', 'nama_mata_kuliah' => 'Algoritma Pemrograman', 'sks' => 3, 'created_at' => '2025-05-22 08:14:23', 'updated_at' => '2025-05-22 08:14:23'],
            ['id_mata_kuliah' => 4, 'kode_mata_kuliah' => 'IF104', 'nama_mata_kuliah' => 'Matematika Diskrit', 'sks' => 3, 'created_at' => '2025-05-22 08:14:23', 'updated_at' => '2025-05-22 08:14:23'],
            ['id_mata_kuliah' => 5, 'kode_mata_kuliah' => 'IF105', 'nama_mata_kuliah' => 'Jaringan Komputer', 'sks' => 3, 'created_at' => '2025-05-22 08:14:23', 'updated_at' => '2025-05-22 08:14:23'],
            ['id_mata_kuliah' => 6, 'kode_mata_kuliah' => 'IF106', 'nama_mata_kuliah' => 'Sistem Operasi', 'sks' => 3, 'created_at' => '2025-05-22 08:14:23', 'updated_at' => '2025-05-22 08:14:23'],
            ['id_mata_kuliah' => 7, 'kode_mata_kuliah' => 'IF107', 'nama_mata_kuliah' => 'Pemrograman Lanjut', 'sks' => 3, 'created_at' => '2025-05-22 08:14:23', 'updated_at' => '2025-05-22 08:14:23'],
            ['id_mata_kuliah' => 8, 'kode_mata_kuliah' => 'IF108', 'nama_mata_kuliah' => 'Basis Data', 'sks' => 3, 'created_at' => '2025-05-22 08:14:23', 'updated_at' => '2025-05-22 08:14:23'],
            ['id_mata_kuliah' => 9, 'kode_mata_kuliah' => 'IF109', 'nama_mata_kuliah' => 'Etika Profesi', 'sks' => 2, 'created_at' => '2025-05-22 08:14:23', 'updated_at' => '2025-05-22 08:14:23'],
            ['id_mata_kuliah' => 10, 'kode_mata_kuliah' => 'IF110', 'nama_mata_kuliah' => 'Sistem Informasi', 'sks' => 3, 'created_at' => '2025-05-22 08:14:23', 'updated_at' => '2025-05-22 08:14:23'],
        ]);
    }
}