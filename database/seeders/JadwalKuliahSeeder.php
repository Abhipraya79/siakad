<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JadwalKuliahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jadwal_kuliah')->insert([
            ['id_jadwal_kuliah' => 1, 'id_mata_kuliah' => 1, 'id_dosen' => 1, 'id_ruang' => 1, 'kelas' => 'C-303', 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '09:40:00', 'created_at' => '2025-05-18 12:18:38', 'updated_at' => '2025-05-18 12:18:38'],
            ['id_jadwal_kuliah' => 2, 'id_mata_kuliah' => 2, 'id_dosen' => 2, 'id_ruang' => 1, 'kelas' => 'C-106', 'hari' => 'Senin', 'jam_mulai' => '07:30:00', 'jam_selesai' => '09:00:00', 'created_at' => null, 'updated_at' => null],
            ['id_jadwal_kuliah' => 3, 'id_mata_kuliah' => 3, 'id_dosen' => 3, 'id_ruang' => 1, 'kelas' => 'C-203', 'hari' => 'Selasa', 'jam_mulai' => '09:00:00', 'jam_selesai' => '10:30:00', 'created_at' => null, 'updated_at' => null],
            ['id_jadwal_kuliah' => 4, 'id_mata_kuliah' => 4, 'id_dosen' => 4, 'id_ruang' => 1, 'kelas' => 'B-203', 'hari' => 'Rabu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '09:30:00', 'created_at' => null, 'updated_at' => null],
            ['id_jadwal_kuliah' => 5, 'id_mata_kuliah' => 5, 'id_dosen' => 5, 'id_ruang' => 1, 'kelas' => 'C-307', 'hari' => 'Kamis', 'jam_mulai' => '10:00:00', 'jam_selesai' => '11:30:00', 'created_at' => null, 'updated_at' => null],
            ['id_jadwal_kuliah' => 6, 'id_mata_kuliah' => 6, 'id_dosen' => 6, 'id_ruang' => 1, 'kelas' => 'B-302', 'hari' => 'Jumat', 'jam_mulai' => '13:00:00', 'jam_selesai' => '14:30:00', 'created_at' => null, 'updated_at' => null],
            ['id_jadwal_kuliah' => 7, 'id_mata_kuliah' => 7, 'id_dosen' => 7, 'id_ruang' => 1, 'kelas' => 'C-203', 'hari' => 'Senin', 'jam_mulai' => '10:00:00', 'jam_selesai' => '11:30:00', 'created_at' => null, 'updated_at' => null],
            ['id_jadwal_kuliah' => 8, 'id_mata_kuliah' => 8, 'id_dosen' => 8, 'id_ruang' => 1, 'kelas' => 'C-106', 'hari' => 'Selasa', 'jam_mulai' => '13:00:00', 'jam_selesai' => '14:30:00', 'created_at' => null, 'updated_at' => null],
            ['id_jadwal_kuliah' => 9, 'id_mata_kuliah' => 9, 'id_dosen' => 9, 'id_ruang' => 1, 'kelas' => 'B-204', 'hari' => 'Rabu', 'jam_mulai' => '14:00:00', 'jam_selesai' => '15:30:00', 'created_at' => null, 'updated_at' => null],
            ['id_jadwal_kuliah' => 10, 'id_mata_kuliah' => 10, 'id_dosen' => 10, 'id_ruang' => 1, 'kelas' => 'C-206', 'hari' => 'Jumat', 'jam_mulai' => '07:30:00', 'jam_selesai' => '09:00:00', 'created_at' => null, 'updated_at' => null],
            ['id_jadwal_kuliah' => 11, 'id_mata_kuliah' => 10, 'id_dosen' => 2, 'id_ruang' => 1, 'kelas' => '', 'hari' => 'Selasa', 'jam_mulai' => '10:28:03', 'jam_selesai' => '11:28:03', 'created_at' => null, 'updated_at' => null],
        ]);
    }
}