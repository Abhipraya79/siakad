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
            <div>
                <p class="text-gray-600">Semester:</p>
                <p class="font-medium">{{ $jadwalKuliah->semester }}</p>
            </div>
        </div>
    </div>

    @if($frsList->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
            <p>Belum ada mahasiswa yang mengambil mata kuliah ini atau FRS belum disetujui.</p>
        </div>
    @else
        <form action="{{ route('dosen.nilai.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_jadwal_kuliah" value="{{ $jadwalKuliah->id_jadwal_kuliah }}">
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">NIM</th>
                            <th class="px-4 py-3 text-left">Nama Mahasiswa</th>
                            <th class="px-4 py-3 text-left">Nilai Angka</th>
                            <th class="px-4 py-3 text-left">Nilai Huruf</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($frsList as $index => $frs)
                            <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                                <td class="border px-4 py-3">{{ $index + 1 }}</td>
                                <td class="border px-4 py-3">{{ $frs->mahasiswa->nim }}</td>
                                <td class="border px-4 py-3">{{ $frs->mahasiswa->nama }}</td>
                                <td class="border px-4 py-3">
                                    <input 
                                        type="number" 
                                        name="nilai[{{ $frs->id_frs }}][angka]" 
                                        min="0" 
                                        max="100" 
                                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        value="{{ $frs->nilai->nilai_angka ?? '' }}"
                                        onchange="updateNilaiHuruf(this, {{ $frs->id_frs }})"
                                    >
                                </td>
                                <td class="border px-4 py-3">
                                    <select 
                                        name="nilai[{{ $frs->id_frs }}][huruf]" 
                                        id="nilai_huruf_{{ $frs->id_frs }}"
                                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    >
                                        <option value="A" {{ isset($frs->nilai) && $frs->nilai->nilai_huruf == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B" {{ isset($frs->nilai) && $frs->nilai->nilai_huruf == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="C" {{ isset($frs->nilai) && $frs->nilai->nilai_huruf == 'C' ? 'selected' : '' }}>C</option>
                                        <option value="D" {{ isset($frs->nilai) && $frs->nilai->nilai_huruf == 'D' ? 'selected' : '' }}>D</option>
                                        <option value="E" {{ isset($frs->nilai) && $frs->nilai->nilai_huruf == 'E' ? 'selected' : '' }}>E</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md">
                    Simpan Nilai
                </button>
                <a href="{{ route('dosen.nilai.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-md">
                    Kembali
                </a>
            </div>
        </form>
    @endif
</div>

<script>
    function updateNilaiHuruf(input, idFrs) {
        const angka = parseFloat(input.value);
        const hurufSelect = document.getElementById('nilai_huruf_' + idFrs);
        
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