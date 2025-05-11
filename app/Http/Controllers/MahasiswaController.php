<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::with('dosenWali')->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $dosenWalis = Dosen::where('is_dosen_wali', true)->get();
        return view('mahasiswa.create', compact('dosenWalis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_mahasiswa' => 'required|unique:mahasiswas',
            'nama' => 'required|string|max:100',
            'nfp' => 'required|unique:mahasiswas',
            'prodi' => 'required|string|max:50',
            'tahun_masuk' => 'required|digits:4',
            'username' => 'required|unique:mahasiswas',
            'password' => 'required|min:6',
            'id_dosen_wali' => 'required|exists:dosens,id_dosen'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        
        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $dosenWalis = Dosen::where('is_dosen_wali', true)->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'dosenWalis'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'prodi' => 'required|string|max:50',
            'tahun_masuk' => 'required|digits:4',
            'password' => 'nullable|min:6',
            'id_dosen_wali' => 'required|exists:dosens,id_dosen'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }

   public function dashboard()
    {
        // 1. Ambil objek Mahasiswa yang sedang login via guard 'mahasiswa'
        $mahasiswa = auth()->guard('mahasiswa')->user();

        // 2. Ambil daftar FRS beserta jadwalKuliah -> mataKuliah
        $frsList = $mahasiswa
            ->frs()
            ->with('jadwalKuliah.mataKuliah')
            ->get();

        // 3. Hitung total SKS dari relasi jadwalKuliah->mataKuliah->sks
        $totalSks = $frsList->sum(function ($frs) {
            return optional($frs->jadwalKuliah->mataKuliah)->sks ?? 0;
        });

        // 4. Contoh IPK (sementara hardcode, ganti sesuai logika kamu)
        $ipk = 3.50;

        // 5. Tentukan semester aktif dari data FRS
        $semesterAktif = $frsList
            ->pluck('semester')
            ->unique()
            ->sortDesc()
            ->first() 
            ?? 'Belum Ada';

        // 6. Ambil nama hari ini (sesuaikan locale jika perlu)
        $hariIni = Carbon::now()->translatedFormat('l'); // ex: 'Senin', 'Selasa', dll.

        // 7. Query jadwal hari ini:
        //    - Filter FRS yang jadwalKuliah.hari == $hariIni
        //    - Eager load mataKuliah & dosen (relasi jadwalKuliah)
        $jadwalHariIni = $mahasiswa
            ->frs()
            ->whereHas('jadwalKuliah', function ($q) use ($hariIni) {
                $q->where('hari', $hariIni);
            })
            ->with([
                'jadwalKuliah.mataKuliah',
                'jadwalKuliah.dosenWali as dosen', // pastikan relasi dosen di JadwalKuliah
            ])
            ->get()
            // Ambil objek JadwalKuliah-nya saja untuk ditampilkan
            ->pluck('jadwalKuliah')
            ->filter(); // singkirkan null jika ada

        // 8. Kirim data ke view
        return view('mahasiswa.dashboard', compact(
            'totalSks',
            'ipk',
            'semesterAktif',
            'jadwalHariIni'
        ));
    }




}