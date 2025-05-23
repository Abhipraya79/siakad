<?php

    namespace App\Http\Controllers;

    use App\Models\Dosen;
    use App\Models\Mahasiswa;
    use Illuminate\Http\Request;

    class DosenController extends Controller
    {
        public function index()
        {
            $dosen = Dosen::all();
            return view('dosen.index', compact('dosen'));
        }

        public function create()
        {
            return view('dosen.create');
        }

        public function store(Request $request)
        {
            $validated = $request->validate([
                'id_dosen' => 'required|unique:dosens',
                'nama' => 'required|string|max:100',
                'ndin' => 'required|unique:dosens',
                'bidang_studi' => 'required|string|max:50',
                'prodi' => 'required|string|max:50',
                'username' => 'required|unique:dosens',
                'password' => 'required|min:6'
            ]);

            $validated['password'] = bcrypt($validated['password']);
            $validated['is_dosen_wali'] = $request->has('is_dosen_wali');

            Dosen::create($validated);

            return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
        }

        public function show(Dosen $dosen)
        {
            return view('dosen.show', compact('dosen'));
        }

        public function edit(Dosen $dosen)
        {
            return view('dosen.edit', compact('dosen'));
        }

        public function update(Request $request, Dosen $dosen)
        {
            $validated = $request->validate([
                'nama' => 'required|string|max:100',
                'bidang_studi' => 'required|string|max:50',
                'prodi' => 'required|string|max:50',
                'password' => 'nullable|min:6'
            ]);

            if ($request->filled('password')) {
                $validated['password'] = bcrypt($request->password);
            }

            $validated['is_dosen_wali'] = $request->has('is_dosen_wali');

            $dosen->update($validated);

            return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui');
        }

        public function destroy(Dosen $dosen)
        {
            $dosen->delete();
            return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
        }

    public function dashboard()
{
    $dosen = auth('dosen')->user();
    
    if (!$dosen) {
        \Log::error('Dosen tidak ditemukan di dashboard');
        return redirect()->route('dosen.login')
            ->with('error', 'Anda harus login terlebih dahulu.');
    }
    
   
    \Log::info('Dashboard dosen diakses', [
        'id_dosen' => $dosen->id_dosen,
        'username' => $dosen->username ?? 'unknown'
    ]);
    
    $mahasiswa = Mahasiswa::where('id_dosen_wali', $dosen->id_dosen)->get();
    $totalMahasiswa = $mahasiswa->count();
    
    $frsPending = \App\Models\Frs::whereIn('id_mahasiswa', $mahasiswa->pluck('id_mahasiswa'))
        ->where('status_acc', 'pending')
        ->with(['mahasiswa', 'jadwalKuliah.mataKuliah']) 
        ->get();
    $totalFrsPending = $frsPending->count();

    $totalMataKuliah = $dosen->jadwalMataKuliah()->count();

    return view('dosen.dashboard', compact(
        'dosen',
        'totalMahasiswa',
        'totalFrsPending',
        'totalMataKuliah',
        'frsPending'
    ));
}
    }