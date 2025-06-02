<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PembayaranTableSeeder extends Seeder
{
    public function run()
    {
        // Ambil 1 data FRS yang ada
        $frs = DB::table('frs')->first();

        // Jika data FRS tersedia, insert pembayaran
        if ($frs) {
            DB::table('pembayaran')->insert([
                'id_bayar' => 1,
                'token' => strtoupper(Str::random(10)),
                'kode_bayar' => 'BYR1234567',
                'id_mahasiswa' => $frs->id_mahasiswa,
                'id_frs' => $frs->id_frs,
                'tanggal_bayar' => now()->toDateString(),
                'status_pembayaran' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
