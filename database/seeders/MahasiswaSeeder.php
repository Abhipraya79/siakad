<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mahasiswa::create([
            'id_mahasiswa' => 'MHS007',
            'nama' => 'Abhipraya12345',
            'nrp' => '3123500051',
            'prodi' => 'Teknik Informatika',
            'tahun_masuk' => '2023',
            'username' => 'abhiz79@gmail.com',
            'password' => bcrypt('admin123'),  // Hash password
        ]);
    }
}
