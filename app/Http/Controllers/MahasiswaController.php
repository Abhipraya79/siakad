<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\FRS;
use Illuminate\Http\Request;
use Carbon\Carbon;
class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::with('dosenWali')->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $dosenWalis = Dosen::where('id_dosen_wali', true)->get();
        return view('mahasiswa.create', compact('dosenWalis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_mahasiswa' => 'required|unique:mahasiswas',
            'nama' => 'required|string|max:100',
            'nfp' => 'required|unique:mahasiswas',
            'prodi' => 'required|string|max:50',
            'tahun_masuk' => 'required|digits:4',
            'username' => 'required|unique:mahasiswas',
            'password' => 'required|min:6',
            'id_dosen_wali' => 'required|exists:dosens,id_dosen'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        
        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $dosenWalis = Dosen::where('id_dosen_wali', true)->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'dosenWalis'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'prodi' => 'required|string|max:50',
            'tahun_masuk' => 'required|digits:4',
            'password' => 'nullable|min:6',
            'id_dosen_wali' => 'required|exists:dosens,id_dosen'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
    public function dashboard()
{
    $mahasiswa = auth('mahasiswa')->user();

    $hariIni = Carbon::now()->locale('id')->isoFormat('dddd'); 
    $jadwalHariIni = FRS::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
        ->where('status_acc', 'approved')
        ->whereHas('jadwalKuliah', function ($query) use ($hariIni) {
            $query->where('hari', $hariIni);
        })
        ->with(['jadwalKuliah.mataKuliah', 'jadwalKuliah.dosen', 'jadwalKuliah.ruangan'])
        ->get()
        ->map(function ($frs) {
            return $frs->jadwalKuliah;
        });

    $totalSks = $mahasiswa->frs()
        ->where('status_acc', 'approved')
        ->with('jadwalKuliah.mataKuliah')
        ->get()
        ->sum(function ($frs) {
            return $frs->jadwalKuliah->mataKuliah->sks ?? 0;
        });

    $jumlahMatkul = $mahasiswa->frs()->where('status_acc', 'approved')->count();
    $jumlahUserAktif = \App\Models\Mahasiswa::count(); 

   
    $nilai = \App\Models\Nilai::whereHas('frs', function ($query) use ($mahasiswa) {
        $query->where('id_mahasiswa', $mahasiswa->id_mahasiswa);
    })->get();

    $totalNilai = $nilai->sum('nilai_angka');
    $jumlahNilai = $nilai->whereNotNull('nilai_angka')->count();
    $ipk = $jumlahNilai > 0 ? $totalNilai / $jumlahNilai : 0;

    $semesterAktif = $mahasiswa->frs()->max('semester');

    return view('mahasiswa.dashboard', compact(
        'mahasiswa',
        'jadwalHariIni',
        'totalSks',
        'jumlahMatkul',
        'jumlahUserAktif',
        'ipk',
        'semesterAktif'
    ));
}
}