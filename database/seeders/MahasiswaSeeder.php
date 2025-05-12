<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        DB::table('mahasiswa')->delete(); // Solusi untuk hapus semua data sebelum seed
    
        DB::table('mahasiswa')->insert([
            [
                'id_mahasiswa' => 'MHS001',
                'nama' => 'Andi Saputra',
                'nrp' => '1234567890',
                'prodi' => 'Teknik Informatika',
                'tahun_masuk' => 2022,
                'username' => 'andi123',
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mahasiswa' => 'MHS002',
                'nama' => 'Budi Santoso',
                'nrp' => '1234567891',
                'prodi' => 'Sistem Informasi',
                'tahun_masuk' => 2023,
                'username' => 'budi123',
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    
    }

