<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dosen')->insert([
            ['id_dosen' => 1, 'nama' => 'Dr. Ahmad Yusuf', 'nidn' => '5570909090', 'bidang_studi' => 'Informatika', 'prodi' => 'Teknik Informatika', 'username' => 'ahmad@it.lecturer', 'password' => '$2y$12$ysRBSRd5cxE0r0smZ0VzDeifUm2alkhXHLbwq0UAwHw1nOC2SAeQK', 'created_at' => '2025-05-18 11:43:42', 'updated_at' => '2025-05-18 11:43:42'],
            ['id_dosen' => 2, 'nama' => 'Guntur Ali S.T M.T', 'nidn' => '5560908010', 'bidang_studi' => 'Ilmu Komputer', 'prodi' => 'Teknik Komputer', 'username' => 'budi@tk.lecturer', 'password' => '$2y$12$cZakPQ5J6dUcsh.eqIX2BudBBO/e5p52JnC5Fm/7u..jfYb13LWHm', 'created_at' => '2025-05-19 14:57:15', 'updated_at' => '2025-05-19 14:57:15'],
            ['id_dosen' => 3, 'nama' => 'Dr. Budi Hartono', 'nidn' => '1987654321', 'bidang_studi' => 'Rekayasa Perangkat Lunak', 'prodi' => 'Teknik Informatika', 'username' => 'budi123@it.lecturer', 'password' => '$2y$12$fCKSTvaqhUH/hmV4dnRwKeryVKvLAkwdstaQf0cE8BeObeSFCAO4y', 'created_at' => '2025-05-22 09:09:27', 'updated_at' => '2025-05-22 09:09:27'],
            ['id_dosen' => 4, 'nama' => 'Prof. Siti Aminah', 'nidn' => '1876543210', 'bidang_studi' => 'Sistem Cerdas', 'prodi' => 'Teknik Informatika', 'username' => 'siti@it.lecturer', 'password' => '$2y$12$KxvVUgfJfnakOWMCNCCIEeJI9/Bc1yYZS.3j22KQ73PT2D1UZf9ku', 'created_at' => '2025-05-22 09:09:27', 'updated_at' => '2025-05-22 09:09:27'],
            ['id_dosen' => 5, 'nama' => 'Dr. Rina Kurniawati', 'nidn' => '1765432109', 'bidang_studi' => 'Jaringan Komputer', 'prodi' => 'Teknik Komputer', 'username' => 'rina@it.lecturer', 'password' => '$2y$12$qRvvN.60Aq8uwj5BGWo5Pupn4sxD/w4m2QjoFfCNNJg.GnDdLh8GO', 'created_at' => '2025-05-22 09:09:27', 'updated_at' => '2025-05-22 09:09:27'],
            ['id_dosen' => 6, 'nama' => 'Ir. Teguh Saputra, M.T.', 'nidn' => '1654321098', 'bidang_studi' => 'Sistem Tertanam', 'prodi' => 'Teknik Elektro', 'username' => 'teguh@it.lecturer', 'password' => '$2y$12$1tfZFb0OV3N/9KKuCyq7LOa6yDgrs1XWh4MzzO1xAz4qxg7gXkCG.', 'created_at' => '2025-05-22 09:09:27', 'updated_at' => '2025-05-22 09:09:27'],
            ['id_dosen' => 7, 'nama' => 'Dr. Lilis Suryani', 'nidn' => '1543210987', 'bidang_studi' => 'Multimedia', 'prodi' => 'Teknik Multimedia', 'username' => 'lilis@it.lecturer', 'password' => '$2y$12$V2vH6v27dHoPtRKaUYMKOe3QTXs84Dd6IKVT6dSW5.UhkGlWqd1G6', 'created_at' => '2025-05-22 09:09:27', 'updated_at' => '2025-05-22 09:09:27'],
            ['id_dosen' => 8, 'nama' => 'Drs. Anton Wijaya', 'nidn' => '1432109876', 'bidang_studi' => 'Etika Profesi', 'prodi' => 'Teknologi Informasi', 'username' => 'anton@it.lecturer', 'password' => '$2y$12$PkscWbJJxbE01j4CZNSu.OjzgqzUTqcagyL6lS6.7hr/E7TCZlN0C', 'created_at' => '2025-05-22 09:09:27', 'updated_at' => '2025-05-22 09:09:27'],
            ['id_dosen' => 9, 'nama' => 'Dr. Farah Nuraini', 'nidn' => '1321098765', 'bidang_studi' => 'Data Science', 'prodi' => 'Statistika', 'username' => 'farah@it.lecturer', 'password' => '$2y$12$b.8dHWQCYzinO.PXlkK2ueGKum8jbStbQB2gP38DXtnIf5Y38RPxy', 'created_at' => '2025-05-22 09:09:27', 'updated_at' => '2025-05-22 09:09:27'],
            ['id_dosen' => 10, 'nama' => 'Dr. Yusuf Hidayat', 'nidn' => '1210987654', 'bidang_studi' => 'Pemrograman Mobile', 'prodi' => 'Teknik Informatika', 'username' => 'yusuf@it.lecturer', 'password' => '$2y$12$FA7FTdRIwiA.wcsbIir7TOe5dmIx7wzi0e1WcWTE0HcL5sbWgPTZu', 'created_at' => '2025-05-22 09:09:27', 'updated_at' => '2025-05-22 09:09:27'],
        ]);
    }
}