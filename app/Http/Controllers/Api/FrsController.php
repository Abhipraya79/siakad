<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FRS;
use App\Models\JadwalKuliah;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use Illuminate\Http\Request;

class FRSController extends Controller
{
    // List FRS milik mahasiswa yang sedang login
    public function index(Request $request)
    {
        $mahasiswa = $request->user();

        if (!$mahasiswa) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $frsList = $mahasiswa->frs()
            ->with('jadwalKuliah.mataKuliah')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['status' => 'success', 'data' => $frsList]);
    }

    // Daftar jadwal kuliah yang bisa dipilih untuk FRS baru
    public function availableJadwal(Request $request)
    {
        $mahasiswa = $request->user();

        if (!$mahasiswa) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $frsTaken = $mahasiswa->frs()->pluck('id_jadwal_kuliah')->toArray();
        $jadwalKuliah = JadwalKuliah::with('mataKuliah')
            ->whereNotIn('id_jadwal_kuliah', $frsTaken)
            ->get();

        return response()->json(['status' => 'success', 'data' => $jadwalKuliah]);
    }

    // Ajukan FRS baru (mahasiswa)
    public function store(Request $request)
    {
        $mahasiswa = $request->user();
        if (!$mahasiswa) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'id_jadwal_kuliah' => 'required|exists:jadwal_kuliah,id_jadwal_kuliah',
            'semester' => 'required|numeric|min:1|max:14'
        ]);

        if (!$mahasiswa->dosenWali) {
            return response()->json(['status' => 'error', 'message' => 'Anda belum memiliki dosen wali'], 403);
        }

        $frs = FRS::create([
            'id_frs' => time(),
            'id_mahasiswa' => $mahasiswa->id_mahasiswa,
            'id_jadwal_kuliah' => $request->id_jadwal_kuliah,
            'id_dosen_wali' => $mahasiswa->dosenWali->id_dosen,
            'semester' => $request->semester,
            'status_acc' => 'pending'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'FRS berhasil diajukan',
            'data' => $frs
        ], 201);
    }

    // Hapus FRS (mahasiswa)
    public function destroy(Request $request, $id)
    {
        $mahasiswa = $request->user();

        $frs = FRS::find($id);

        if (!$frs || $frs->id_mahasiswa != $mahasiswa->id_mahasiswa) {
            return response()->json(['status' => 'error', 'message' => 'Tidak dapat menghapus FRS ini'], 403);
        }

        $frs->delete();

        return response()->json(['status' => 'success', 'message' => 'FRS berhasil dibatalkan']);
    }

    // List FRS untuk dosen yang butuh approval
    public function approvalIndex(Request $request)
    {
        $dosen = $request->user();

        $frsList = FRS::where('id_dosen_wali', $dosen->id_dosen)
            ->with(['mahasiswa', 'jadwalKuliah.mataKuliah'])
            ->get();

        return response()->json(['status' => 'success', 'data' => $frsList]);
    }

    // Dosen menyetujui FRS
    public function approve(Request $request, $id)
    {
        $dosen = $request->user();

        $frs = FRS::findOrFail($id);

        if ($frs->id_dosen_wali != $dosen->id_dosen) {
            return response()->json(['status' => 'error', 'message' => 'Anda tidak berhak menyetujui FRS ini'], 403);
        }

        $frs->update(['status_acc' => 'approved']);

        // Otomatis buat nilai jika belum ada
        $nilaiExists = Nilai::where('id_frs', $frs->id_frs)->exists();
        if (!$nilaiExists) {
            Nilai::create([
                'id_frs' => $frs->id_frs,
                'nilai_angka' => null,
                'nilai_huruf' => null
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'FRS berhasil disetujui']);
    }

    // Dosen menolak FRS
    public function reject(Request $request, $id)
    {
        $dosen = $request->user();

        $frs = FRS::findOrFail($id);

        if ($frs->id_dosen_wali != $dosen->id_dosen) {
            return response()->json(['status' => 'error', 'message' => 'Anda tidak berhak menolak FRS ini'], 403);
        }

        $frs->update(['status_acc' => 'rejected']);

        return response()->json(['status' => 'success', 'message' => 'FRS berhasil ditolak']);
    }
}
