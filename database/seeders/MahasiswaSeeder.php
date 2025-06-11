<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mahasiswa')->insert([
            ['id_mahasiswa' => 1, 'id_dosen_wali' => 1, 'nama' => 'Zhulva Priya Abhipraya', 'nrp' => '3123500047', 'prodi' => 'Teknik Informatika', 'tahun_masuk' => '2023', 'username' => 'abhi@it.student', 'password' => '$2y$12$5TF90CLE9ohiRE/e/BraJOP0JHqHBvQ/nakv.fdLc5pAJhGMG8ZMq', 'created_at' => '2025-05-18 12:05:01', 'updated_at' => '2025-05-18 12:05:01'],
            ['id_mahasiswa' => 2, 'id_dosen_wali' => 2, 'nama' => 'Reva Fidela Pantjoro', 'nrp' => '3123500055', 'prodi' => 'Teknik Informatika', 'tahun_masuk' => '2023', 'username' => 'reva@it.student', 'password' => '$2y$12$FW0w44B2rzAcqkBRUbMw5u1QNJngO5.UlcVeYbIqQccG44zmgSZVO', 'created_at' => '2025-05-22 13:46:24', 'updated_at' => '2025-05-22 13:46:24'],
            ['id_mahasiswa' => 3, 'id_dosen_wali' => 3, 'nama' => 'Muhammad Rahadian', 'nrp' => '3123500054', 'prodi' => 'Teknik Informatika', 'tahun_masuk' => '2023', 'username' => 'rahadian@it.student', 'password' => '$2y$12$P9MC6w0zx3MvMl7DB3rzYuq/g4L92Ogh3dmKabcGXWlx.w2cRnxge', 'created_at' => '2025-05-22 13:46:24', 'updated_at' => '2025-05-22 13:46:24'],
            ['id_mahasiswa' => 4, 'id_dosen_wali' => 4, 'nama' => 'Kanseva Putra', 'nrp' => '3123500056', 'prodi' => 'Teknik Informatika', 'tahun_masuk' => '2023', 'username' => 'seva@it.student', 'password' => '$2y$12$zB0vdj5rrn1RCHbCP5FoyuR3xUjM9H3uYzdZq2ZdYF519yk5CjMBq', 'created_at' => '2025-05-22 13:46:24', 'updated_at' => '2025-05-22 13:46:24'],
            ['id_mahasiswa' => 5, 'id_dosen_wali' => 5, 'nama' => 'Rahmat Sungging', 'nrp' => '3123500057', 'prodi' => 'Teknik Informatika', 'tahun_masuk' => '2023', 'username' => 'nggeng@it.student', 'password' => '$2y$12$3.z2x7NpkT8muYGlR.kdYuq2ktSHm29hAKpfFWMh8mUsRf/Xx8cn.', 'created_at' => '2025-05-22 13:46:24', 'updated_at' => '2025-05-22 13:46:24'],
            ['id_mahasiswa' => 6, 'id_dosen_wali' => 2, 'nama' => 'Eka Jatmiko', 'nrp' => '31235066', 'prodi' => 'Teknik Informatika', 'tahun_masuk' => '2023', 'username' => 'ekajatmiko@it.student', 'password' => '$2y$12$kK7YrdySnLkznxWIXUKdtuQ9FK2q/i83XZtCiAmwKI1R6b2lWFv4a', 'created_at' => null, 'updated_at' => null],
            ['id_mahasiswa' => 7, 'id_dosen_wali' => 2, 'nama' => 'Rina Utami', 'nrp' => '31235067', 'prodi' => 'Teknik Informatika', 'tahun_masuk' => '2023', 'username' => 'rinautami@it.student', 'password' => '$2y$12$kK7YrdySnLkznxWIXUKdtuQ9FK2q/i83XZtCiAmwKI1R6b2lWFv4a', 'created_at' => null, 'updated_at' => null],
        ]);
        // ... Lanjutkan data mahasiswa lainnya jika diperlukan
    }
}