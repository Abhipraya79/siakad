<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalKuliahSeeder extends Seeder
{
    public function run()
    {
        DB::table('jadwal_kuliah')->insert([
            [
                'id_jadwal_kuliah' => 1,
                'hari' => 'Senin',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '09:40:00',
                'ruangan' => 'D401',
                'mata_kuliah' => 'Pemrograman Dasar',
                'kode_matkul' => 'TI101',
                'sks' => 3,
                'dosen' => 'Dosen Satu',
                'kelas' => 'TI-1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
