@extends('layouts.dosen')

@section('title', 'Input Nilai Mahasiswa')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-6">Input Nilai Mahasiswa</h1>
    
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Detail Mata Kuliah</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-gray-600">Nama Mata Kuliah:</p>
                <p class="font-medium">{{ $jadwalKuliah->mataKuliah->nama_mata_kuliah }}</p>
            </div>
            <div>
                <p class="text-gray-600">Kode Mata Kuliah:</p>
                <p class="font-medium">{{ $jadwalKuliah->mataKuliah->kode_mata_kuliah }}</p>
            </div>
            <div>
                <p class="text-gray-600">SKS:</p>
                <p class="font-medium">{{ $jadwalKuliah->mataKuliah->sks }}</p>
            </div>
        </div>
    </div>

    <form action="{{ route('dosen.nilai.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_frs" value="{{ $frs->id_frs }}">
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">NRP</th>
                        <th class="px-4 py-3 text-left">Nama Mahasiswa</th>
                        <th class="px-4 py-3 text-left">Nilai Angka</th>
                        <th class="px-4 py-3 text-left">Nilai Huruf</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-3">{{ $frs->mahasiswa->nrp }}</td>
                        <td class="border px-4 py-3">{{ $frs->mahasiswa->nama }}</td>
                        <td class="border px-4 py-3">
                            <input 
                                type="number" 
                                name="nilai_angka" 
                                min="0" 
                                max="100" 
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $frs->nilai->nilai_angka ?? '' }}"
                                onchange="updateNilaiHuruf(this)"
                                required
                            >
                        </td>
                        <td class="border px-4 py-3">
                            <select 
                                name="nilai_huruf" 
                                id="nilai_huruf"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required
                            >
                                <option value="A" {{ isset($frs->nilai) && $frs->nilai->nilai_huruf == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ isset($frs->nilai) && $frs->nilai->nilai_huruf == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ isset($frs->nilai) && $frs->nilai->nilai_huruf == 'C' ? 'selected' : '' }}>C</option>
                                <option value="D" {{ isset($frs->nilai) && $frs->nilai->nilai_huruf == 'D' ? 'selected' : '' }}>D</option>
                                <option value="E" {{ isset($frs->nilai) && $frs->nilai->nilai_huruf == 'E' ? 'selected' : '' }}>E</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="flex gap-3">
            <button type="submit" class="bg-[#14487a] hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md">
                Simpan Nilai
            </button>
            <a href="{{ route('dosen.nilai.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-md">
                Kembali
            </a>
        </div>
    </form>
</div>

<script>
    function updateNilaiHuruf(input) {
        const angka = parseFloat(input.value);
        const hurufSelect = document.getElementById('nilai_huruf');
        
        if (!isNaN(angka)) {
            if (angka >= 90) {
                hurufSelect.value = 'A';
            } else if (angka >= 80) {
                hurufSelect.value = 'B';
            } else if (angka >= 70) {
                hurufSelect.value = 'C';
            } else if (angka >= 60) {
                hurufSelect.value = 'D';
            } else {
                hurufSelect.value = 'E';
            }
        }
    }
</script>
@endsection