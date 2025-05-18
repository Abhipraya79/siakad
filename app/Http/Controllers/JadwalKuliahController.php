<?php

namespace App\Http\Controllers;

use App\Models\JadwalKuliah;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class JadwalKuliahController extends Controller
{
    public function index()
    {
        $jadwalKuliah = JadwalKuliah::with(['mataKuliah', 'dosen', 'ruangan'])->get();
        return view('mahasiswa.jadwal.index', compact('jadwalKuliah'));
    }
    /**
     * Tambahan untuk kebutuhan mahasiswa: Fetch jadwal kuliah dengan relasi mata kuliah
     */
    public function jadwalMahasiswa()
{
    $jadwalKuliah = JadwalKuliah::with('mataKuliah')->get();

    return view('mahasiswa.jadwal.index', compact('jadwalKuliah'));
}
}
