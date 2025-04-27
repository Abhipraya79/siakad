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
        $jadwalKuliahs = JadwalKuliah::with(['mataKuliah', 'dosen', 'ruangan'])->get();
        return view('jadwal-kuliah.index', compact('jadwalKuliahs'));
    }

    public function create()
    {
        $mataKuliahs = MataKuliah::all();
        $dosens = Dosen::all();
        $ruangans = Ruangan::all();
        
        return view('jadwal-kuliah.create', compact('mataKuliahs', 'dosens', 'ruangans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_mata_kuliah' => 'required|exists:mata_kuliahs,id_mata_kuliah',
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'id_ruang' => 'required|exists:ruangans,id_ruang',
            'kelas' => 'required|string|max:10',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai'
        ]);

        JadwalKuliah::create($validated);

        return redirect()->route('jadwal-kuliah.index')->with('success', 'Jadwal kuliah berhasil ditambahkan');
    }

    public function show(JadwalKuliah $jadwalKuliah)
    {
        return view('jadwal-kuliah.show', compact('jadwalKuliah'));
    }

    public function edit(JadwalKuliah $jadwalKuliah)
    {
        $mataKuliahs = MataKuliah::all();
        $dosens = Dosen::all();
        $ruangans = Ruangan::all();
        
        return view('jadwal-kuliah.edit', compact('jadwalKuliah', 'mataKuliahs', 'dosens', 'ruangans'));
    }

    public function update(Request $request, JadwalKuliah $jadwalKuliah)
    {
        $validated = $request->validate([
            'id_mata_kuliah' => 'required|exists:mata_kuliahs,id_mata_kuliah',
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'id_ruang' => 'required|exists:ruangans,id_ruang',
            'kelas' => 'required|string|max:10',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai'
        ]);

        $jadwalKuliah->update($validated);

        return redirect()->route('jadwal-kuliah.index')->with('success', 'Jadwal kuliah berhasil diperbarui');
    }

    public function destroy(JadwalKuliah $jadwalKuliah)
    {
        $jadwalKuliah->delete();
        return redirect()->route('jadwal-kuliah.index')->with('success', 'Jadwal kuliah berhasil dihapus');
    }
}