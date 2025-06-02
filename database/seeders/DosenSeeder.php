<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    public function run()
    {
        DB::table('dosen')->insert([
            [
                'id_dosen' => 1,
                'nama' => 'Dr. Ahmad Yusuf',
                'nidn' => '5570909090',
                'bidang_studi' => 'Informatika',
                'prodi' => 'Teknik Informatika',
                'username' => 'yusuf@it.lecturer',
                'password' => Hash::make('password'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 2,
                'nama' => 'Guntur Ali S.T M.T',
                'nidn' => '5560908010',
                'bidang_studi' => 'Ilmu Komputer',
                'prodi' => 'Teknik Komputer',
                'username' => 'guntur@it.lecturer',
                'password' => Hash::make('password'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 3,
                'nama' => 'Budi Santoso',
                'nidn' => '5580908003',
                'bidang_studi' => 'Sistem Informasi',
                'prodi' => 'Teknik Informatika',
                'username' => 'budi@lecturer',
                'password' => Hash::make('password'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 4,
                'nama' => 'Nurhayati',
                'nidn' => '5590908004',
                'bidang_studi' => 'Data Science',
                'prodi' => 'Teknik Komputer',
                'username' => 'nur@lecturer',
                'password' => Hash::make('password'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 5,
                'nama' => 'Andi Saputra',
                'nidn' => '5600908005',
                'bidang_studi' => 'Cyber Security',
                'prodi' => 'Teknik Informatika',
                'username' => 'andi@lecturer',
                'password' => Hash::make('password'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
