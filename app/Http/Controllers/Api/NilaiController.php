<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $user = Auth::user();

        // ---------- MAHASISWA ----------
        if ($user instanceof Mahasiswa || $user->role === 'mahasiswa') {
            $nilai = $this->queryMahasiswa($user->id_mahasiswa)->get();
        }
        // ---------- DOSEN ----------
        elseif ($user instanceof Dosen || $user->role === 'dosen') {
            $nilai = $this->queryDosen($user->id_dosen)->get();
        }
        // ---------- ADMIN / LAINNYA ----------
        else {
            $nilai = $this->baseQuery()->get();
        }
    
        return response()->json([
            'status' => 'success',
            'data'   => $nilai
        ]);
    }

    /* =========================================================
       2.  TAMBAH NILAI  (biasanya dipakai dosen)
    ========================================================= */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_frs'      => 'required|exists:frs,id_frs',
            'nilai_angka' => 'nullable|integer|min:0|max:100',
            'nilai_huruf' => 'nullable|string|max:2',
        ]);

        $nilai = Nilai::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Nilai berhasil ditambahkan',
            'data'    => $nilai->load(['frs.mahasiswa','frs.jadwalKuliah.mataKuliah'])
        ], 201);
    }

    /* =========================================================
       3.  DETAIL NILAI
    ========================================================= */
    public function show($id)
    {
        $user  = Auth::user();
        $nilai = $this->baseQuery()->find($id);

        if (!$nilai) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Nilai tidak ditemukan'
            ], 404);
        }

        // --- Authorization ---
        if ($user instanceof Mahasiswa &&
            $nilai->frs->id_mahasiswa !== $user->id_mahasiswa) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        if ($user instanceof Dosen &&
            $nilai->frs->jadwalKuliah->id_dosen !== $user->id_dosen) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $nilai
        ]);
    }

    /* =========================================================
       4.  UPDATE NILAI
    ========================================================= */
    public function update(Request $request, $id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Nilai tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nilai_angka' => 'sometimes|integer|min:0|max:100',
            'nilai_huruf' => 'sometimes|string|max:2',
        ]);

        $nilai->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Nilai berhasil di-update',
            'data'    => $nilai->load(['frs.mahasiswa','frs.jadwalKuliah.mataKuliah'])
        ]);
    }

    /* =========================================================
       5.  HAPUS NILAI
    ========================================================= */
    public function destroy($id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Nilai tidak ditemukan'
            ], 404);
        }

        $nilai->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Nilai berhasil dihapus'
        ]);
    }

    /* =========================================================
       Helper query scopes
    ========================================================= */
    private function baseQuery()
    {
        return Nilai::with([
            'frs.mahasiswa',
            'frs.jadwalKuliah.mataKuliah'
        ]);
    }

    private function queryMahasiswa($idMahasiswa)
    {
        return $this->baseQuery()
            ->whereHas('frs', function ($q) use ($idMahasiswa) {
                $q->where('id_mahasiswa', $idMahasiswa);
            });
    }

    private function queryDosen($idDosen)
    {
        return $this->baseQuery()
            ->whereHas('frs.jadwalKuliah', function ($q) use ($idDosen) {
                $q->where('id_dosen', $idDosen);
            });
    }
}
