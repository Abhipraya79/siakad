<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\FRS;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        // Untuk mahasiswa
        if (auth()->user()->role === 'mahasiswa') {
            $nilaiList = auth()->user()->mahasiswa->nilai()->with('frs.jadwalKuliah.mataKuliah')->get();
            return view('mahasiswa.nilai', compact('nilaiList'));
        }
        
        // Untuk dosen
        $frsList = auth()->user()->dosen->frsWali()->with(['mahasiswa', 'jadwalKuliah.mataKuliah'])->get();
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