<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenWaliSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('dosen_wali')->insert([
                'id_dosen_wali' => $i,
                'id_dosen' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
