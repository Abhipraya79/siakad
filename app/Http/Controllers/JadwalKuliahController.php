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
    $mahasiswa = auth('mahasiswa')->user();

    if (!$mahasiswa) {
        abort(403, 'Mahasiswa tidak ditemukan.');
    }

    $frsList = $mahasiswa->frs()
        ->where('status_acc', 'approved')
        ->with('jadwalKuliah.mataKuliah', 'jadwalKuliah.ruangan', 'jadwalKuliah.dosen')
        ->get();

    return view('mahasiswa.jadwal.index', compact('frsList'));
}

    public function jadwalDosen()
{
    $dosen = auth('dosen')->user();

    if (!$dosen) {
        abort(403, 'Dosen tidak ditemukan.');
    }

    $jadwalKuliah = JadwalKuliah::with(['mataKuliah', 'ruangan'])
        ->where('id_dosen', $dosen->id_dosen)
        ->get();

    return view('dosen.jadwal.index', compact('jadwalKuliah'));
}

    }
