<?php

namespace App\Http\Controllers;

use App\Models\FRS;
use App\Models\JadwalKuliah;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FRSController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();

        $frsList = $mahasiswa->frs()
        ->with('jadwalKuliah.mataKuliah')
        ->orderBy('created_at', 'desc')
        ->get();
        
        return view('mahasiswa.frs.index', compact('frsList'));
    }

    public function create()
{
    $mahasiswa = Auth::guard('mahasiswa')->user();
    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai mahasiswa');
    }

    $jadwalKuliah = JadwalKuliah::with('mataKuliah')->get();
    return view('mahasiswa.frs.create', compact('jadwalKuliah'));
}


    public function store(Request $request)
{
    $request->validate([
        'id_jadwal_kuliah' => 'required|exists:jadwal_kuliah,id_jadwal_kuliah',
        'semester' => 'required|numeric|min:1|max:14'
    ]);

    $mahasiswa = Auth::guard('mahasiswa')->user();
    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai mahasiswa');
    }

    if (!$mahasiswa->dosenWali) {
        return redirect()->back()->with('error', 'Anda belum memiliki dosen wali');
    }

    FRS::create([
        'id_frs' => time(),
        'id_mahasiswa' => $mahasiswa->id_mahasiswa,
        'id_jadwal_kuliah' => $request->id_jadwal_kuliah,
        'id_dosen_wali' => $mahasiswa->dosenWali->id_dosen,
        'semester' => $request->semester,
        'status_acc' => 'pending'
    ]);

    return redirect()->route('mahasiswa.frs.index')->with('success_create', 'FRS berhasil diajukan');
}


// Duplicate destroy method removed to resolve duplicate symbol declaration error.




    public function approve($id)
    {
        $user = Auth::user();
        
        $frs = FRS::findOrFail($id);
        $frs->update(['status_acc' => 'approved']);
        return back()->with('success', 'FRS berhasil disetujui');
    }

    public function reject($id)
    {
        $user = Auth::user();
        
        if (!$user || !$user->dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen');
        }
        
        $frs = FRS::findOrFail($id);
        $frs->update(['status_acc' => 'rejected']);
        return back()->with('success', 'FRS berhasil ditolak');
    }

    public function destroy(FRS $id)
{
    $mahasiswa = Auth::guard('mahasiswa')->user();
    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai mahasiswa');
    }

    $id->delete();
    return redirect()->route('mahasiswa.frs.index')->with('success_destroy', 'FRS berhasil dibatalkan');
}
public function approvalIndex()
{
    $dosen = auth('dosen')->user(); // ini sudah dosen langsung

    $frsList = $dosen->frsApprovals()
        ->with(['mahasiswa', 'jadwalKuliah.mataKuliah'])
        ->get();

    return view('dosen.frs.index', compact('frsList'));
}


}