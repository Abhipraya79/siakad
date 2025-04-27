<?php

namespace App\Http\Controllers;

use App\Models\FRS;
use App\Models\JadwalKuliah;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class FRSController extends Controller
{
    public function index()
    {
        $frsList = auth()->user()->mahasiswa->frs()->with('jadwalKuliah.mataKuliah')->get();
        return view('frs.index', compact('frsList'));
    }

    public function create()
    {
        $jadwalKuliah = JadwalKuliah::with('mataKuliah')->get();
        return view('frs.create', compact('jadwalKuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal_kuliah' => 'required|exists:jadwal_kuliahs,id_jadwal_kuliah',
            'semester' => 'required|numeric|min:1|max:14'
        ]);

        $mahasiswa = auth()->user()->mahasiswa;
        
        FRS::create([
            'id_frs' => 'FRS'.time(),
            'id_mahasiswa' => $mahasiswa->id_mahasiswa,
            'id_jadwal_kuliah' => $request->id_jadwal_kuliah,
            'id_dosen_wali' => $mahasiswa->dosenWali->id_dosen,
            'semester' => $request->semester,
            'status_acc' => 'pending'
        ]);

        return redirect()->route('frs.index')->with('success', 'FRS berhasil diajukan');
    }

    public function show(FRS $frs)
    {
        return view('frs.show', compact('frs'));
    }

    public function approvalIndex()
    {
        $frsList = auth()->user()->dosen->frsWali()->with(['mahasiswa', 'jadwalKuliah.mataKuliah'])->get();
        return view('dosen.frs.index', compact('frsList'));
    }

    public function approve($id)
    {
        $frs = FRS::findOrFail($id);
        $frs->update(['status_acc' => 'approved']);
        return back()->with('success', 'FRS berhasil disetujui');
    }

    public function reject($id)
    {
        $frs = FRS::findOrFail($id);
        $frs->update(['status_acc' => 'rejected']);
        return back()->with('success', 'FRS berhasil ditolak');
    }

    public function destroy(FRS $frs)
    {
        $frs->delete();
        return redirect()->route('frs.index')->with('success', 'FRS berhasil dibatalkan');
    }
}