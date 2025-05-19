<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\FRS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NilaiController extends Controller
{
    public function index()
    {
        // Jika yang login adalah mahasiswa, hanya lihat nilai sendiri
        if (auth()->user()->role === 'mahasiswa') {
            $nilaiList = auth()->user()->mahasiswa
                ->nilai()
                ->with('frs.jadwalKuliah.mataKuliah')
                ->get();

            return view('mahasiswa.nilai.index', compact('nilaiList'));
        }

        
        $dosen = auth('dosen')->user();
        // Jika dosen, tampilkan data FRS bimbingan
        $frsList = $dosen->frsApprovals()->with(['mahasiswa', 'jadwalKuliah.mataKuliah'])->get();

        return view('dosen.nilai.index', compact('frsList'));
    }

    public function create($frs_id)
    {
        $frs = FRS::with(['mahasiswa', 'jadwalKuliah.mataKuliah'])->findOrFail($frs_id);
        return view('dosen.nilai.create', compact('frs'));
    }

    public function store(Request $request, $frs_id)
    {
        $request->validate([
            'nilai_angka' => 'required|numeric|min:0|max:100',
            'nilai_huruf' => 'required|string|max:2'
        ]);

        Nilai::updateOrCreate(
            ['id_frs' => $frs_id],
            [
                'nilai_angka' => $request->nilai_angka,
                'nilai_huruf' => $request->nilai_huruf
            ]
        );

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil disimpan');
    }
    public function nilaiMahasiswa()
{
    $mahasiswa = Auth::guard('mahasiswa')->user();

    // Ambil data nilai yang sudah dimiliki mahasiswa (dari relasi FRS dan jadwal kuliah)
    $nilaiList = Nilai::whereHas('frs', function ($query) use ($mahasiswa) {
        $query->where('id_mahasiswa', $mahasiswa->id_mahasiswa);
    })->with(['frs.jadwalKuliah.mataKuliah'])->get();

    return view('mahasiswa.nilai.index', compact('nilaiList'));
}
    public function edit($id)
    {
        $nilai = Nilai::with('frs.jadwalKuliah.mataKuliah')->findOrFail($id);
        return view('dosen.nilai.edit', compact('nilai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai_angka' => 'required|numeric|min:0|max:100',
            'nilai_huruf' => 'required|string|max:2'
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update([
            'nilai_angka' => $request->nilai_angka,
            'nilai_huruf' => $request->nilai_huruf
        ]);

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diperbarui');
    }
}
