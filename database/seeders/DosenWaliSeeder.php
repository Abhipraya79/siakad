<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DosenWaliSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dosen_wali')->insert([
            ['id_dosen_wali' => 1, 'id_dosen' => 1, 'created_at' => '2025-05-18 11:44:40', 'updated_at' => '2025-05-18 11:44:40'],
            ['id_dosen_wali' => 2, 'id_dosen' => 2, 'created_at' => '2025-05-19 14:58:19', 'updated_at' => '2025-05-19 14:58:19'],
            ['id_dosen_wali' => 3, 'id_dosen' => 3, 'created_at' => '2025-05-22 13:37:05', 'updated_at' => '2025-05-22 13:37:05'],
            ['id_dosen_wali' => 4, 'id_dosen' => 4, 'created_at' => '2025-05-22 13:37:05', 'updated_at' => '2025-05-22 13:37:05'],
            ['id_dosen_wali' => 5, 'id_dosen' => 5, 'created_at' => '2025-05-22 13:37:05', 'updated_at' => '2025-05-22 13:37:05'],
            ['id_dosen_wali' => 6, 'id_dosen' => 6, 'created_at' => '2025-05-22 13:37:05', 'updated_at' => '2025-05-22 13:37:05'],
            ['id_dosen_wali' => 7, 'id_dosen' => 7, 'created_at' => '2025-05-22 13:37:05', 'updated_at' => '2025-05-22 13:37:05'],
            ['id_dosen_wali' => 8, 'id_dosen' => 8, 'created_at' => '2025-05-22 13:37:05', 'updated_at' => '2025-05-22 13:37:05'],
            ['id_dosen_wali' => 9, 'id_dosen' => 9, 'created_at' => '2025-05-22 13:37:05', 'updated_at' => '2025-05-22 13:37:05'],
            ['id_dosen_wali' => 10, 'id_dosen' => 10, 'created_at' => '2025-05-22 13:37:05', 'updated_at' => '2025-05-22 13:37:05'],
        ]);
    }
}