<?php

namespace App\Http\Controllers;
use App\Models\Pembayaran;
use App\Models\FRS;
use App\Models\JadwalKuliah;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Nilai;
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

    /**
     * Menampilkan form untuk membuat FRS baru
     */
public function create()
{
    $mahasiswa = Auth::guard('mahasiswa')->user();
    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai mahasiswa');
    }

    // Cek pembayaran terakhir
    $statusBayar = Pembayaran::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
        ->latest('tanggal_bayar')
        ->first();

    if (!$statusBayar || $statusBayar->status_pembayaran != 'Lunas') {
        return redirect()->back()->with('error', 'Anda belum melakukan pembayaran UKT semester ini.');
    }

    $frsTaken = $mahasiswa->frs()->pluck('id_jadwal_kuliah')->toArray();
    $jadwalKuliah = JadwalKuliah::with('mataKuliah')
        ->whereNotIn('id_jadwal_kuliah', $frsTaken)
        ->get();

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
 $statusBayar = Pembayaran::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
        ->latest('tanggal_bayar')
        ->first();

    if (!$statusBayar || $statusBayar->status_pembayaran != 'Lunas') {
        return redirect()->back()->with('error', 'FRS tidak bisa diajukan. Anda belum membayar UKT semester ini.');
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

    /**
     * Menghapus FRS
     */
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
        $dosen = Auth::guard('dosen')->user();
        
        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen');
        }

        $frsList = FRS::where('id_dosen_wali', $dosen->id_dosen)
            ->with(['mahasiswa', 'jadwalKuliah.mataKuliah'])
            ->get();

        return view('dosen.frs.index', compact('frsList'));
    }
    public function approve($id)
    {
        $dosen = Auth::guard('dosen')->user();
        
        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen');
        }
        
        $frs = FRS::findOrFail($id);
        
        if ($frs->id_dosen_wali != $dosen->id_dosen) {
            return redirect()->back()->with('error', 'Anda tidak berhak menyetujui FRS ini');
        }
        
        $frs->update(['status_acc' => 'approved']);
        
        $nilaiExists = Nilai::where('id_frs', $frs->id_frs)->exists();
        if (!$nilaiExists) {
                    Nilai::create([
            'id_frs' => $frs->id_frs,
            'nilai_angka' => null,
            'nilai_huruf' => null
        ]);
        }
        
        return back()->with('success');
    }
    public function reject($id)
    {
        $dosen = Auth::guard('dosen')->user();
        
        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen');
        }
        
        $frs = FRS::findOrFail($id);
        if ($frs->id_dosen_wali != $dosen->id_dosen) {
            return redirect()->back()->with('error', 'Anda tidak berhak menolak FRS ini');
        }
        
        $frs->update(['status_acc' => 'rejected']);
        return back()->with('success', 'FRS berhasil ditolak');
    }
}