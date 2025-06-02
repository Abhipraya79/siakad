<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrsSeeder extends Seeder
{
    public function run()
    {
        DB::table('frs')->insert([
            [
                'id_mahasiswa' => 1,
                'id_jadwal_kuliah' => 1,
                'id_dosen_wali' => 1,
                'status_acc' => 'pending',
                'semester' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
