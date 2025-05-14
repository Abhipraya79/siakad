<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
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
        $dosenWalis = Dosen::where('is_dosen_wali', true)->get();
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
        $dosenWalis = Dosen::where('is_dosen_wali', true)->get();
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

    $frs = $mahasiswa->frs()->with('jadwalKuliah.mataKuliah')->get();

    $totalSks = $frs->sum(fn($frs) => $frs->jadwalKuliah->mataKuliah->sks ?? 0);

    $ipk = $mahasiswa->ipk ?? 0;

    $semesterAktif = $mahasiswa->semester_aktif ?? '-';

    $hariIni = Carbon::now()->translatedFormat('l');

    $jadwalHariIni = $frs
        ->filter(fn($frs) => optional($frs->jadwalKuliah)->hari === $hariIni)
        ->map(fn($frs) => $frs->jadwalKuliah)
        ->filter()
        ->unique('id_jadwal_kuliah'); 

    return view('mahasiswa.dashboard', compact(
        'mahasiswa',
        'totalSks',
        'ipk',
        'semesterAktif',
        'jadwalHariIni'
    ));
}
}