<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FRS;
use App\Models\JadwalKuliah;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Pembayaran;

class FRSController extends Controller
{
    public function __construct()
    {
        // Semua route di file api.php sudah dilingkupi `auth:sanctum`,
        // tapi tetap aman kita pasang juga pada controller.
        $this->middleware('auth:sanctum');
    }

    /* =========================================================
     *  1.  LIST FRS MILIK MAHASISWA
     *  =======================================================*/
    public function index(Request $request)
    {
        $mahasiswa = $request->user();                // guard default = mahasiswa
        if (!$mahasiswa) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $frsList = $mahasiswa->frs()
            ->with([
                'jadwalKuliah.mataKuliah',
                'jadwalKuliah.dosen',                // ← relasi dosen agar UI bisa tampil nama dosen
            ])
            ->orderByDesc('created_at')
            ->get();

        return response()->json(['status' => 'success', 'data' => $frsList]);
    }

    /* =========================================================
     *  2.  JADWAL YANG MASIH BISA DIPILIH
     *  =======================================================*/
    public function availableJadwal(Request $request)
    {
        $mahasiswa = $request->user();
        if (!$mahasiswa) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        // ambil jadwal yang sudah di‐take oleh mahasiswa
        $taken = $mahasiswa->frs()->pluck('id_jadwal_kuliah');

        $jadwalKuliah = JadwalKuliah::with(['mataKuliah', 'dosen'])
            ->whereNotIn('id_jadwal_kuliah', $taken)
            ->get();

        return response()->json(['status' => 'success', 'data' => $jadwalKuliah]);
    }

    /* =========================================================
     *  3.  AJUKAN / TAMBAH FRS
     *  =======================================================*/
    public function store(Request $request)
    {
        $mahasiswa = $request->user();
        if (!$mahasiswa) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'id_jadwal_kuliah' => 'required|exists:jadwal_kuliah,id_jadwal_kuliah',
            'semester'         => 'required|numeric|min:1|max:14',
        ]);

        // pastikan punya dosen wali
        if (!$mahasiswa->dosenWali) {
            return response()->json(['status' => 'error', 'message' => 'Anda belum memiliki dosen wali'], 403);
        }

        // 3.1 Cegah duplikat mata kuliah
        if ($mahasiswa->frs()->where('id_jadwal_kuliah', $request->id_jadwal_kuliah)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'Mata kuliah ini sudah diambil'], 409);
        }

        // 3.2 Cek batas SKS (contoh 24 SKS)
        $jadwal = JadwalKuliah::with('mataKuliah')->find($request->id_jadwal_kuliah);
        $mkSks  = $jadwal?->mataKuliah?->sks ?? 0;

        // total SKS yang sudah *approved* + mata kuliah ini
        $takenSks = $mahasiswa->frs()
            ->where('status_acc', 'approved')
            ->with('jadwalKuliah.mataKuliah')
            ->get()
            ->sum(fn ($f) => $f->jadwalKuliah->mataKuliah->sks);

        if ($takenSks + $mkSks > 24) {
            return response()->json(['status' => 'error', 'message' => 'Menambah mata kuliah ini melebihi batas 24 SKS'], 422);
        }

        // 3.3 Simpan
        $frs = FRS::create([
            // id_frs auto-increment / uuid – tidak perlu manual time()
            // 'id_frs'           => Str::uuid(),   // aktifkan kalau pakai UUID
            'id_mahasiswa'     => $mahasiswa->id_mahasiswa,
            'id_jadwal_kuliah' => $request->id_jadwal_kuliah,
            'id_dosen_wali'    => $mahasiswa->dosenWali->id_dosen,
            'semester'         => $request->semester,
            'status_acc'       => 'pending',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'FRS berhasil diajukan',
            'data'    => $frs,
        ], 201);
    }
    
    /* =========================================================
     *  4.  HAPUS / BATAL FRS  (hanya jika belum approved)
     *  =======================================================*/
    public function destroy(Request $request, $id)
    {
        $mahasiswa = $request->user();
        if (!$mahasiswa) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $frs = FRS::find($id);
        if (!$frs || $frs->id_mahasiswa != $mahasiswa->id_mahasiswa) {
            return response()->json(['status' => 'error', 'message' => 'Tidak dapat menghapus FRS ini'], 403);
        }

        if ($frs->status_acc === 'approved') {
            return response()->json(['status' => 'error', 'message' => 'FRS sudah disetujui dan tidak dapat dibatalkan'], 409);
        }

        $frs->delete();
        return response()->json(['status' => 'success', 'message' => 'FRS berhasil dibatalkan']);
    }

    /* =========================================================
     *  5.  LIST FRS YANG MENUNGGU APPROVAL DOSEN
     *  =======================================================*/
    public function approvalIndex(Request $request)
    {
        $dosen = $request->user();   // diasumsikan guard sama
        $frsList = FRS::where('id_dosen_wali', $dosen->id_dosen)
            ->with([
                'mahasiswa',
                'jadwalKuliah.mataKuliah',
                'jadwalKuliah.dosen',
            ])
            ->get();

        return response()->json(['status' => 'success', 'data' => $frsList]);
    }

    /* =========================================================
     *  6.  DOSEN MENYETUJUI FRS
     *  =======================================================*/
    public function approve(Request $request, $id)
    {
        $dosen = $request->user();
        $frs   = FRS::with('jadwalKuliah.mataKuliah')->findOrFail($id);

        if ($frs->id_dosen_wali != $dosen->id_dosen) {
            return response()->json(['status' => 'error', 'message' => 'Anda tidak berhak menyetujui FRS ini'], 403);
        }

        if ($frs->status_acc === 'approved') {
            return response()->json(['status' => 'error', 'message' => 'FRS sudah disetujui'], 409);
        }

        DB::transaction(function () use ($frs) {
            $frs->update(['status_acc' => 'approved']);
            // buat nilai jika belum ada
            Nilai::firstOrCreate(['id_frs' => $frs->id_frs]);
        });

        return response()->json(['status' => 'success', 'message' => 'FRS berhasil disetujui']);
    }


    public function reject(Request $request, $id)
    {
        $dosen = $request->user();
        $frs   = FRS::findOrFail($id);

        if ($frs->id_dosen_wali != $dosen->id_dosen) {
            return response()->json(['status' => 'error', 'message' => 'Anda tidak berhak menolak FRS ini'], 403);
        }

        if ($frs->status_acc === 'rejected') {
            return response()->json(['status' => 'error', 'message' => 'FRS sudah ditolak'], 409);
        }

        $frs->update(['status_acc' => 'rejected']);

        return response()->json(['status' => 'success', 'message' => 'FRS berhasil ditolak']);
    }
    // Mendapatkan semua jadwal FRS yang sudah di-approve untuk mahasiswa login
public function approvedFrs(Request $request)
{
    $mahasiswa = $request->user();
    if (!$mahasiswa) {
        return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
    }

    // Ambil semua FRS yang statusnya sudah approved
    $approvedFrs = $mahasiswa->frs()
        ->where('status_acc', 'approved')
        ->with([
            'jadwalKuliah.mataKuliah',
            'jadwalKuliah.dosen',
        ])
        ->get();

    // Kembalikan data jadwal kuliah saja
    $jadwalKuliah = $approvedFrs
        ->map(function ($frs) {
            // Ambil jadwal kuliah dan sertakan informasi kelas, dosen, mata kuliah
            $jadwal = $frs->jadwalKuliah;
            if ($jadwal) {
                $jadwal->status_acc = $frs->status_acc; // supaya model di Flutter bisa akses status_acc
                $jadwal->frs_id = $frs->id_frs;
            }
            return $jadwal;
        })
        ->filter()
        ->values();

    return response()->json(['status' => 'success', 'data' => $jadwalKuliah]);
}

}
