<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dosen::create([
            'id_dosen' => 'DSN001',
            'nama' => 'Dr. John Doe',
            'nip' => '1234567890',
            'prodi' => 'Teknik Informatika',
            'username' => 'johndoe@gmail.com',
            'password' => bcrypt('admin123'),  // Hash password
        ]);
    }
}
