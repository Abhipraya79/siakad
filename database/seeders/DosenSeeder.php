<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan beberapa data dosen
        DB::table('dosen')->insert([
            [
                'id_dosen' => 'D001',
                'nama' => 'Dr. Ahmad Fikri',
                'nidn' => '1234567890',
                'bidang_studi' => 'Informatika',
                'prodi' => 'S1 Teknik Informatika',
                'is_dosen_wali' => true,
                'username' => 'ahmadfikri',
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 'D002',
                'nama' => 'Prof. Siti Rahmawati',
                'nidn' => '9876543210',
                'bidang_studi' => 'Matematika',
                'prodi' => 'S1 Matematika',
                'is_dosen_wali' => false,
                'username' => 'siti_rahmawati',
                'password' => Hash::make('password456'),
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 'D003',
                'nama' => 'Dr. Budi Santoso',
                'nidn' => '1122334455',
                'bidang_studi' => 'Fisika',
                'prodi' => 'S1 Fisika',
                'is_dosen_wali' => false,
                'username' => 'budi_santoso',
                'password' => Hash::make('password789'),
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
