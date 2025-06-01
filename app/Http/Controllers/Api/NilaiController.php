<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\FRS;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function __construct()
    {
        // butuh token Sanctum – guard mahasiswa | dosen
        $this->middleware('auth:sanctum');
    }

    /* =========================================================
       1.  LIST NILAI (index) – auto-filter berdasar role
    ========================================================= */
    public function index()
    {
        /* ----------- DOSEN ----------- */
        if (Auth::guard('dosen')->check()) {
            $dosen = Auth::guard('dosen')->user();

            $nilaiList = FRS::whereHas('jadwalKuliah', function ($q) use ($dosen) {
                    $q->where('id_dosen', $dosen->id_dosen);
                })
                ->where('status_acc', 'approved')
                ->with(['mahasiswa', 'jadwalKuliah.mataKuliah', 'nilai'])
                ->get();

            return response()->json([
                'status' => 'success',
                'role'   => 'dosen',
                'data'   => $nilaiList,
            ]);
        }

        /* ----------- MAHASISWA ----------- */
        if (Auth::guard('mahasiswa')->check()) {
            $mhs = Auth::guard('mahasiswa')->user();

            $nilaiList = Nilai::whereHas('frs', fn ($q) => $q->where('id_mahasiswa', $mhs->id_mahasiswa))
                ->with(['frs.jadwalKuliah.mataKuliah'])
                ->get();

            return response()->json([
                'status' => 'success',
                'role'   => 'mahasiswa',
                'data'   => $nilaiList,
            ]);
        }

        /* ----------- UNAUTHORIZED ----------- */
        return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
    }

    /* =========================================================
       2.  STORE – (dosen) input / update nilai mahasiswa
           - hanya diizinkan untuk kelas yang diampunya
    ========================================================= */
    public function store(Request $request)
    {
        $request->validate([
            'id_frs'      => 'required|exists:frs,id_frs',
            'nilai_angka' => 'required|numeric|min:0|max:100',
            'nilai_huruf' => 'required|string|max:2',
        ]);

        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return response()->json(['status' => 'error', 'message' => 'Forbidden'], 403);
        }

        $frs = FRS::with('jadwalKuliah')->findOrFail($request->id_frs);
        if ($frs->jadwalKuliah->id_dosen != $dosen->id_dosen) {
            return response()->json(['status' => 'error', 'message' => 'Tidak berhak menilai FRS ini'], 403);
        }

        $nilai = Nilai::updateOrCreate(
            ['id_frs' => $frs->id_frs],
            [
                'nilai_angka' => $request->nilai_angka,
                'nilai_huruf' => strtoupper($request->nilai_huruf),
            ]
        )->load(['frs.mahasiswa', 'frs.jadwalKuliah.mataKuliah']);

        return response()->json([
            'status'  => 'success',
            'message' => 'Nilai tersimpan',
            'data'    => $nilai,
        ], 201);
    }

    /* =========================================================
       3.  SHOW detail nilai (dosen atau mahasiswa)
    ========================================================= */
    public function show($id)
    {
        $nilai = Nilai::with(['frs.mahasiswa', 'frs.jadwalKuliah.mataKuliah'])->find($id);
        if (!$nilai) {
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        }

        // hak akses: dosen pemilik kelas ATAU mahasiswa pemilik FRS
        if ($this->forbidden($nilai)) {
            return response()->json(['status' => 'error', 'message' => 'Forbidden'], 403);
        }

        return response()->json(['status' => 'success', 'data' => $nilai]);
    }

    /* =========================================================
       4.  UPDATE nilai
    ========================================================= */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai_angka' => 'required|numeric|min:0|max:100',
        ]);

        $nilai = Nilai::with('frs.jadwalKuliah')->find($id);
        if (!$nilai) {
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        }
        if ($this->forbidden($nilai)) {
            return response()->json(['status' => 'error', 'message' => 'Forbidden'], 403);
        }

        $nilai_huruf = $this->konversiNilai($request->nilai_angka);
        $nilai->update([
            'nilai_angka' => $request->nilai_angka,
            'nilai_huruf' => $nilai_huruf,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Nilai diupdate', 'data' => $nilai]);
    }

    /* =========================================================
       5.  DESTROY nilai
    ========================================================= */
    public function destroy($id)
    {
        $nilai = Nilai::with('frs.jadwalKuliah')->find($id);
        if (!$nilai) {
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        }
        if ($this->forbidden($nilai)) {
            return response()->json(['status' => 'error', 'message' => 'Forbidden'], 403);
        }

        $nilai->delete();
        return response()->json(['status' => 'success', 'message' => 'Nilai dihapus']);
    }

    /* =========================================================
       6.  Helper ACL & konversi nilai
    ========================================================= */
    private function forbidden(Nilai $nilai): bool
    {
        // dosen hanya boleh akses nilai kelasnya
        if (Auth::guard('dosen')->check()) {
            return $nilai->frs->jadwalKuliah->id_dosen != Auth::guard('dosen')->id();
        }
        // mahasiswa hanya boleh akses nilai dirinya
        if (Auth::guard('mahasiswa')->check()) {
            return $nilai->frs->id_mahasiswa != Auth::guard('mahasiswa')->user()->id_mahasiswa;
        }
        return true;
    }

    private function konversiNilai($angka): string
    {
        return match (true) {
            $angka >= 90 => 'A',
            $angka >= 80 => 'B',
            $angka >= 70 => 'C',
            $angka >= 60 => 'D',
            default      => 'E',
        };
    }
}
