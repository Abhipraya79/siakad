<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/InitialDataSeeder.php
public function run()
{
    // 1. Buat data dosen wali
    $dosen = \App\Models\Dosen::create([
        'id_dosen' => 'DSN001',
        'nama' => 'Prof. Ahmad',
        'ndin' => '123456',
        'bidang_studi' => 'Informatika',
        'prodi' => 'Teknik Informatika',
        'is_dosen_wali' => true,
        'username' => 'dosen1',
        'password' => bcrypt('dosen123')
    ]);

    // 2. Buat user untuk dosen
    \App\Models\User::create([
        'username' => 'dosen1',
        'password' => bcrypt('dosen123'),
        'role' => 'dosen',
        'id_reference' => 'DSN001'
    ]);

    // 3. Buat data mahasiswa
    $mhs = \App\Models\Mahasiswa::create([
        'id_mahasiswa' => 'MHS001',
        'nama' => 'Budi Santoso',
        'nfp' => '11223344',
        'prodi' => 'Teknik Informatika',
        'tahun_masuk' => '2023',
        'username' => 'mahasiswa1',
        'password' => bcrypt('mhs123')
    ]);

    // 4. Buat user untuk mahasiswa
    \App\Models\User::create([
        'username' => 'mahasiswa1',
        'password' => bcrypt('mhs123'),
        'role' => 'mahasiswa',
        'id_reference' => 'MHS001'
    ]);
}
}
