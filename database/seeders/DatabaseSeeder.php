<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('dosen')->insert([
            ['id_dosen' => 1, 'nama' => 'Dr. Ahmad Yusuf', 'nidn' => '5570909090', 'bidang_studi' => 'Informatika', 'prodi' => 'Teknik Informatika', 'username' => 'ahmad@it.lecturer', 'password' => '$2y$12$ysRBSRd5cxE0r0smZ0VzDeifUm2alkhXHLbwq0UAwHw1nOC2SAeQK', 'remember_token' => null, 'created_at' => '2025-05-18 11:43:42', 'updated_at' => '2025-05-18 11:43:42'],
            ['id_dosen' => 2, 'nama' => 'Guntur Ali S.T M.T', 'nidn' => '5560908010', 'bidang_studi' => 'Ilmu Komputer', 'prodi' => 'Teknik Komputer', 'username' => 'budi@tk.lecturer', 'password' => '$2y$12$cZakPQ5J6dUcsh.eqIX2BudBBO/e5p52JnC5Fm/7u..jfYb13LWHm', 'remember_token' => null, 'created_at' => '2025-05-19 14:57:15', 'updated_at' => '2025-05-19 14:57:15'],
            ['id_dosen' => 3, 'nama' => 'Dr. Budi Hartono', 'nidn' => '1987654321', 'bidang_studi' => 'Rekayasa Perangkat Lunak', 'prodi' => 'Teknik Informatika', 'username' => 'budi123@it.lecturer', 'password' => '$2y$12$fCKSTvaqhUH/hmV4dnRwKeryVKvLAkwdstaQf0cE8BeObeSFCAO4y', 'remember_token' => null, 'created_at' => '2025-05-22 09:09:27', 'updated_at' => '2025-05-22 09:09:27'],
            ['id_dosen' => 4, 'nama' => 'Prof. Siti Aminah', 'nidn' => '1876543210', 'bidang_studi' => 'Sistem Cerdas', 'prodi' => 'Teknik Informatika', 'username' => 'siti@it.lecturer', 'password' => '$2y$12$KxvVUgfJfnakOWMCNCCIEeJI9/Bc1yYZS.3j22KQ73PT2D1UZf9ku', 'remember_token' => null, 'created_at' => '2025-05-22 09:09:27', 'updated_at' => '2025-05-22 09:09:27'],
            ['id_dosen' => 5, 'nama' => 'Dr. Rina Kurniawati', 'nidn' => '1765432109', 'bidang_studi' => 'Jaringan Komputer', 'prodi' => 'Teknik Komputer', 'username' => 'rina@it.lecturer', 'password' => '$2y$12$qRvvN.60Aq8uwj5BGWo5Pupn4sxD/w4m2QjoFfCNNJg.GnDdLh8GO', 'remember_token' => null, 'created_at' => '2025-05-22 09:09:27', 'updated_at' => '2025-05-22 09:09:27'],
        ]);

        DB::table('dosen_wali')->insert([
            ['id_dosen_wali' => 1, 'id_dosen' => 1, 'created_at' => '2025-05-18 11:44:40', 'updated_at' => '2025-05-18 11:44:40'],
            ['id_dosen_wali' => 2, 'id_dosen' => 2, 'created_at' => '2025-05-19 14:58:19', 'updated_at' => '2025-05-19 14:58:19'],
            ['id_dosen_wali' => 3, 'id_dosen' => 3, 'created_at' => '2025-05-22 13:37:05', 'updated_at' => '2025-05-22 13:37:05'],
            ['id_dosen_wali' => 4, 'id_dosen' => 4, 'created_at' => '2025-05-22 13:37:05', 'updated_at' => '2025-05-22 13:37:05'],
            ['id_dosen_wali' => 5, 'id_dosen' => 5, 'created_at' => '2025-05-22 13:37:05', 'updated_at' => '2025-05-22 13:37:05'],
        ]);

         DB::table('mahasiswa')->insert([
            ['id_mahasiswa' => 1, 'id_dosen_wali' => 1, 'nama' => 'Zhulva Priya Abhipraya', 'nrp' => '3123500047', 'prodi' => 'Teknik Informatika', 'tahun_masuk' => '2023', 'username' => 'abhi@it.student', 'password' => '$2y$12$5TF90CLE9ohiRE/e/BraJOP0JHqHBvQ/nakv.fdLc5pAJhGMG8ZMq', 'remember_token' => null, 'created_at' => '2025-05-18 12:05:01', 'updated_at' => '2025-05-18 12:05:01'],
            ['id_mahasiswa' => 2, 'id_dosen_wali' => 2, 'nama' => 'Reva Fidela Pantjoro', 'nrp' => '3123500055', 'prodi' => 'Teknik Informatika', 'tahun_masuk' => '2023', 'username' => 'reva@it.student', 'password' => '$2y$12$FW0w44B2rzAcqkBRUbMw5u1QNJngO5.UlcVeYbIqQccG44zmgSZVO', 'remember_token' => null, 'created_at' => '2025-05-22 13:46:24', 'updated_at' => '2025-05-22 13:46:24'],
            ['id_mahasiswa' => 3, 'id_dosen_wali' => 3, 'nama' => 'Muhammad Rahadian', 'nrp' => '3123500054', 'prodi' => 'Teknik Informatika', 'tahun_masuk' => '2023', 'username' => 'rahadian@it.student', 'password' => '$2y$12$P9MC6w0zx3MvMl7DB3rzYuq/g4L92Ogh3dmKabcGXWlx.w2cRnxge', 'remember_token' => null, 'created_at' => '2025-05-22 13:46:24', 'updated_at' => '2025-05-22 13:46:24'],
            ['id_mahasiswa' => 4, 'id_dosen_wali' => 4, 'nama' => 'Kanseva Putra', 'nrp' => '3123500056', 'prodi' => 'Teknik Informatika', 'tahun_masuk' => '2023', 'username' => 'seva@it.student', 'password' => '$2y$12$zB0vdj5rrn1RCHbCP5FoyuR3xUjM9H3uYzdZq2ZdYF519yk5CjMBq', 'remember_token' => null, 'created_at' => '2025-05-22 13:46:24', 'updated_at' => '2025-05-22 13:46:24'],
            ['id_mahasiswa' => 5, 'id_dosen_wali' => 5, 'nama' => 'Rahmat Sungging', 'nrp' => '3123500057', 'prodi' => 'Teknik Informatika', 'tahun_masuk' => '2023', 'username' => 'nggeng@it.student', 'password' => '$2y$12$3.z2x7NpkT8muYGlR.kdYuq2ktSHm29hAKpfFWMh8mUsRf/Xx8cn.', 'remember_token' => null, 'created_at' => '2025-05-22 13:46:24', 'updated_at' => '2025-05-22 13:46:24'],
        ]);

        DB::table('frs')->insert([
            ['id_frs' => 1747920436, 'id_mahasiswa' => 1, 'id_jadwal_kuliah' => 1, 'id_dosen_wali' => 1, 'status_acc' => 'approved', 'semester' => 4, 'created_at' => '2025-05-22 06:27:16', 'updated_at' => '2025-05-22 06:30:32'],
            ['id_frs' => 1747920447, 'id_mahasiswa' => 2, 'id_jadwal_kuliah' => 2, 'id_dosen_wali' => 1, 'status_acc' => 'approved', 'semester' => 4, 'created_at' => '2025-05-22 06:27:27', 'updated_at' => '2025-05-22 06:31:17'],
            ['id_frs' => 1747920455, 'id_mahasiswa' => 3, 'id_jadwal_kuliah' => 3, 'id_dosen_wali' => 1, 'status_acc' => 'approved', 'semester' => 4, 'created_at' => '2025-05-22 06:27:35', 'updated_at' => '2025-05-22 06:31:25'],
            ['id_frs' => 1747920475, 'id_mahasiswa' => 4, 'id_jadwal_kuliah' => 5, 'id_dosen_wali' => 1, 'status_acc' => 'approved', 'semester' => 4, 'created_at' => '2025-05-22 06:27:55', 'updated_at' => '2025-05-23 08:31:28'],
            ['id_frs' => 1747920487, 'id_mahasiswa' => 5, 'id_jadwal_kuliah' => 6, 'id_dosen_wali' => 1, 'status_acc' => 'approved', 'semester' => 4, 'created_at' => '2025-05-22 06:28:07', 'updated_at' => '2025-05-23 08:31:32'],
        ]);

        DB::table('jadwal_kuliah')->insert([
            ['id_jadwal_kuliah' => 1, 'id_mata_kuliah' => 1, 'id_dosen' => 1, 'id_ruang' => 1, 'kelas' => 'C-303', 'hari' => 'Senin', 'jam_mulai' => '08:00:00', 'jam_selesai' => '09:40:00', 'created_at' => '2025-05-18 12:18:38', 'updated_at' => '2025-05-18 12:18:38'],
            ['id_jadwal_kuliah' => 2, 'id_mata_kuliah' => 2, 'id_dosen' => 2, 'id_ruang' => 1, 'kelas' => 'C-106', 'hari' => 'Senin', 'jam_mulai' => '07:30:00', 'jam_selesai' => '09:00:00', 'created_at' => null, 'updated_at' => null],
            ['id_jadwal_kuliah' => 3, 'id_mata_kuliah' => 3, 'id_dosen' => 3, 'id_ruang' => 1, 'kelas' => 'C-203', 'hari' => 'Selasa', 'jam_mulai' => '09:00:00', 'jam_selesai' => '10:30:00', 'created_at' => null, 'updated_at' => null],
            ['id_jadwal_kuliah' => 4, 'id_mata_kuliah' => 4, 'id_dosen' => 4, 'id_ruang' => 1, 'kelas' => 'B-203', 'hari' => 'Rabu', 'jam_mulai' => '08:00:00', 'jam_selesai' => '09:30:00', 'created_at' => null, 'updated_at' => null],
            ['id_jadwal_kuliah' => 5, 'id_mata_kuliah' => 5, 'id_dosen' => 5, 'id_ruang' => 1, 'kelas' => 'C-307', 'hari' => 'Kamis', 'jam_mulai' => '10:00:00', 'jam_selesai' => '11:30:00', 'created_at' => null, 'updated_at' => null],
        ]);

        DB::table('mata_kuliah')->insert([
            ['id_mata_kuliah' => 1, 'kode_mata_kuliah' => 'IF101', 'nama_mata_kuliah' => 'Administrasi Basis Data', 'sks' => 3, 'created_at' => '2025-05-18 12:13:19', 'updated_at' => '2025-05-18 12:13:19'],
            ['id_mata_kuliah' => 2, 'kode_mata_kuliah' => 'IF102', 'nama_mata_kuliah' => 'Struktur Data', 'sks' => 3, 'created_at' => '2025-05-22 08:14:23', 'updated_at' => '2025-05-22 08:14:23'],
            ['id_mata_kuliah' => 3, 'kode_mata_kuliah' => 'IF103', 'nama_mata_kuliah' => 'Algoritma Pemrograman', 'sks' => 3, 'created_at' => '2025-05-22 08:14:23', 'updated_at' => '2025-05-22 08:14:23'],
            ['id_mata_kuliah' => 4, 'kode_mata_kuliah' => 'IF104', 'nama_mata_kuliah' => 'Matematika Diskrit', 'sks' => 3, 'created_at' => '2025-05-22 08:14:23', 'updated_at' => '2025-05-22 08:14:23'],
            ['id_mata_kuliah' => 5, 'kode_mata_kuliah' => 'IF105', 'nama_mata_kuliah' => 'Jaringan Komputer', 'sks' => 3, 'created_at' => '2025-05-22 08:14:23', 'updated_at' => '2025-05-22 08:14:23'],
        ]);

        DB::table('migrations')->insert([
            ['id' => 1, 'migration' => '2014_10_12_100000_create_password_reset_tokens_table', 'batch' => 1],
            ['id' => 2, 'migration' => '2019_08_19_000000_create_failed_jobs_table', 'batch' => 1],
            ['id' => 3, 'migration' => '2019_12_14_000001_create_personal_access_tokens_table', 'batch' => 1],
            ['id' => 4, 'migration' => '2024_04_26_103503_create_dosen_table', 'batch' => 1],
            ['id' => 5, 'migration' => '2024_04_26_103509_create_mata_kuliah_table', 'batch' => 1],
        ]);

        DB::table('nilai')->insert([
            ['id_nilai' => 22, 'id_frs' => 1747920436, 'nilai_angka' => 90, 'nilai_huruf' => 'A', 'created_at' => '2025-05-22 06:30:32', 'updated_at' => '2025-05-23 06:40:47'],
            ['id_nilai' => 23, 'id_frs' => 1747920447, 'nilai_angka' => 87, 'nilai_huruf' => 'B', 'created_at' => '2025-05-22 06:31:18', 'updated_at' => '2025-05-23 07:02:44'],
            ['id_nilai' => 24, 'id_frs' => 1747920455, 'nilai_angka' => 60, 'nilai_huruf' => 'D', 'created_at' => '2025-05-22 06:31:25', 'updated_at' => '2025-05-23 07:05:34'],
            ['id_nilai' => 25, 'id_frs' => 1747923239, 'nilai_angka' => null, 'nilai_huruf' => null, 'created_at' => '2025-05-22 07:15:51', 'updated_at' => '2025-05-22 07:15:51'],
            ['id_nilai' => 26, 'id_frs' => 1747922116, 'nilai_angka' => null, 'nilai_huruf' => null, 'created_at' => '2025-05-22 07:15:53', 'updated_at' => '2025-05-22 07:15:53'],
        ]);

        DB::table('personal_access_tokens')->insert([
            ['id' => 7, 'tokenable_type' => 'App\\\\Models\\\\Mahasiswa', 'tokenable_id' => 1, 'name' => 'mahasiswa-token', 'token' => '7926c3f80680d442dcbf2a100512253745703bd2161b2beb44f9ab72c7de7eed', 'abilities' => '[\\"*\\"]', 'last_used_at' => '2025-05-25 06:49:43', 'expires_at' => null, 'created_at' => '2025-05-25 06:49:41', 'updated_at' => '2025-05-25 06:49:43'],
        ]);

        DB::table('ruangan')->insert([
            ['id_ruang' => 1, 'kode_ruang' => 'C-303', 'nama_ruang' => 'Lab Jaringan', 'kapasitas_ruang' => 30, 'created_at' => '2025-05-18 12:17:30', 'updated_at' => '2025-05-18 12:17:30'],
        ]);

        DB::table('user')->insert([
            ['id' => 1, 'id_reference' => 1, 'remember_token' => null, 'name' => 'Zhulva Priya Abhipraya', 'email' => 'abhi@it.student', 'email_verified_at' => '2025-05-18 12:30:43', 'password' => '$2y$12$5TF90CLE9ohiRE/e/BraJOP0JHqHBvQ/nakv.fdLc5pAJhGMG8ZMq', 'role' => 'mahasiswa', 'created_at' => '2025-05-18 12:30:43', 'updated_at' => '2025-05-18 12:30:43'],
            ['id' => 3, 'id_reference' => 2, 'remember_token' => null, 'name' => 'Guntur Ali S.T M.T', 'email' => 'budi@tk.lecturer', 'email_verified_at' => null, 'password' => '$2y$12$xGX9lI0iOyBp9elZTIyd/uuCWAa7jvF9O/QRNdOkLG2IQouBd3Qjq', 'role' => 'dosen', 'created_at' => '2025-05-19 14:43:33', 'updated_at' => '2025-05-19 14:43:33'],
        ]);

    }
}