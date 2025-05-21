<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\FRS;
use App\Models\JadwalKuliah;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    /**
     * Menampilkan daftar nilai berdasarkan role user
     */
    public function index()
    {
        // Untuk dosen - menampilkan nilai mahasiswa yang menjadi dosen pengampu mata kuliah
        if (Auth::guard('dosen')->check()) {
            $dosen = Auth::guard('dosen')->user();

            $nilaiList = FRS::with(['mahasiswa', 'jadwalKuliah.mataKuliah', 'nilai'])
                ->whereHas('jadwalKuliah', function ($query) use ($dosen) {
                    $query->where('id_dosen', $dosen->id_dosen);
                })
                ->where('status_acc', 'approved')
                ->get();

            if ($nilaiList->isEmpty()) {
                \Log::info('Tidak ada data nilai untuk dosen ID: ' . $dosen->id_dosen);
                $jumlahJadwal = JadwalKuliah::where('id_dosen', $dosen->id_dosen)->count();
                \Log::info('Jumlah jadwal kuliah dosen ini: ' . $jumlahJadwal);

                $jumlahFrs = FRS::whereHas('jadwalKuliah', function ($q) use ($dosen) {
                    $q->where('id_dosen', $dosen->id_dosen);
                })->count();
                \Log::info('Total FRS terkait dosen (semua status): ' . $jumlahFrs);
            }

            return view('dosen.nilai.index', compact('nilaiList'));
        }

        // Untuk mahasiswa - hanya lihat nilai sendiri
        elseif (Auth::guard('mahasiswa')->check()) {
            $mahasiswa = Auth::guard('mahasiswa')->user();

            $nilaiList = Nilai::whereHas('frs', function ($query) use ($mahasiswa) {
                $query->where('id_mahasiswa', $mahasiswa->id_mahasiswa);
            })
                ->with(['frs.jadwalKuliah.mataKuliah'])
                ->get();

            return view('mahasiswa.nilai.index', compact('nilaiList'));
        }

        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
    }

    public function listJadwal()
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen');
        }

        $jadwalList = JadwalKuliah::where('id_dosen', $dosen->id_dosen)
            ->with('mataKuliah')
            ->get();

        foreach ($jadwalList as $jadwal) {
            $jadwal->total_mahasiswa = FRS::where('id_jadwal_kuliah', $jadwal->id_jadwal_kuliah)
                ->where('status_acc', 'approved')
                ->count();
        }

        return view('dosen.nilai.list_jadwal', compact('jadwalList'));
    }

    public function create($id_jadwal_kuliah)
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen');
        }

        $jadwalKuliah = JadwalKuliah::with('mataKuliah')
            ->where('id_jadwal_kuliah', $id_jadwal_kuliah)
            ->where('id_dosen', $dosen->id_dosen)
            ->firstOrFail();

        $frsList = FRS::where('id_jadwal_kuliah', $id_jadwal_kuliah)
            ->where('status_acc', 'approved')
            ->with(['mahasiswa', 'nilai'])
            ->get();

        return view('dosen.nilai.create', compact('jadwalKuliah', 'frsList'));
    }

    public function getMahasiswaList($id_jadwal_kuliah)
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $jadwalExists = JadwalKuliah::where('id_jadwal_kuliah', $id_jadwal_kuliah)
            ->where('id_dosen', $dosen->id_dosen)
            ->exists();

        if (!$jadwalExists) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $mahasiswaList = FRS::where('id_jadwal_kuliah', $id_jadwal_kuliah)
            ->where('status_acc', 'approved')
            ->with(['mahasiswa', 'nilai'])
            ->get()
            ->map(function ($frs) {
                return [
                    'id_frs' => $frs->id_frs,
                    'NRP' => $frs->mahasiswa->id_mahasiswa,
                    'nama' => $frs->mahasiswa->nama,
                    'nilai_angka' => $frs->nilai ? $frs->nilai->nilai_angka : null,
                    'nilai_huruf' => $frs->nilai ? $frs->nilai->nilai_huruf : null
                ];
            });

        return response()->json(['data' => $mahasiswaList]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal_kuliah' => 'required|exists:jadwal_kuliah,id_jadwal_kuliah',
            'nilai' => 'required|array',
            'nilai.*.angka' => 'nullable|numeric|min:0|max:100',
            'nilai.*.huruf' => 'nullable|string|max:2'
        ]);

        $dosen = Auth::guard('dosen')->user();
        $jadwalKuliah = JadwalKuliah::where('id_jadwal_kuliah', $request->id_jadwal_kuliah)
            ->where('id_dosen', $dosen->id_dosen)
            ->firstOrFail();

        DB::beginTransaction();

        try {
            foreach ($request->nilai as $id_frs => $nilaiData) {
                $angka = $nilaiData['angka'];
                $huruf = $nilaiData['huruf'] ?? $this->konversiNilai($angka);

                if ($angka !== null) {
                    Nilai::updateOrCreate(
                        ['id_frs' => $id_frs],
                        [
                            'nilai_angka' => $angka,
                            'nilai_huruf' => strtoupper($huruf)
                        ]
                    );
                }
            }

            DB::commit();
            return redirect()->route('dosen.nilai.index')->with('success', 'Nilai berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
{
    $dosen = Auth::guard('dosen')->user();
    if (!$dosen) {
        return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen');
    }

    $nilai = Nilai::with(['frs.mahasiswa', 'frs.jadwalKuliah.mataKuliah'])->findOrFail($id);

    if ($nilai->frs->jadwalKuliah->id_dosen != $dosen->id_dosen) {
        return redirect()->back()->with('error', 'Anda tidak berhak mengedit nilai ini');
    }

    return view('dosen.nilai.edit', compact('nilai'));
}


    public function update(Request $request, $id)
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen');
        }

        $request->validate([
            'nilai_angka' => 'required|numeric|min:0|max:100',
        ]);

        $nilai = Nilai::with('frs.jadwalKuliah')->findOrFail($id);

        if ($nilai->frs->jadwalKuliah->id_dosen != $dosen->id_dosen) {
            return redirect()->back()->with('error', 'Anda tidak berhak mengedit nilai ini');
        }

        $nilai_huruf = $this->konversiNilai($request->nilai_angka);

        $nilai->update([
            'nilai_angka' => $request->nilai_angka,
            'nilai_huruf' => $nilai_huruf
        ]);

        return redirect()->route('dosen.nilai.index');
    }

    public function nilaiMahasiswa()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai mahasiswa');
        }

        $nilaiList = Nilai::whereHas('frs', function ($query) use ($mahasiswa) {
            $query->where('id_mahasiswa', $mahasiswa->id_mahasiswa);
        })
            ->with(['frs.jadwalKuliah.mataKuliah'])
            ->get();

        return view('mahasiswa.nilai.index', compact('nilaiList'));
    }

    private function konversiNilai($nilai_angka)
    {
        if ($nilai_angka >= 90) return 'A';
        if ($nilai_angka >= 80) return 'B';
        if ($nilai_angka >= 70) return 'C';
        if ($nilai_angka >= 60) return 'D';
        return 'E';
    }
}
