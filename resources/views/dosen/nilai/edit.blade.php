@extends('layouts.dosen')

@section('title', 'Edit Nilai Mahasiswa')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-6">Edit Nilai Mahasiswa</h1>
    
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Detail Mahasiswa dan Mata Kuliah</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-gray-600">NIM:</p>
                <p class="font-medium">{{ $nilai->frs->mahasiswa->nim }}</p>
            </div>
            <div>
                <p class="text-gray-600">Nama Mahasiswa:</p>
                <p class="font-medium">{{ $nilai->frs->mahasiswa->nama }}</p>
            </div>
            <div>
                <p class="text-gray-600">Mata Kuliah:</p>
                <p class="font-medium">{{ $nilai->frs->jadwalKuliah->mataKuliah->nama_mata_kuliah }}</p>
            </div>
            <div>
                <p class="text-gray-600">Kode Mata Kuliah:</p>
                <p class="font-medium">{{ $nilai->frs->jadwalKuliah->mataKuliah->kode_mata_kuliah }}</p>
            </div>
            <div>
                <p class="text-gray-600">SKS:</p>
                <p class="font-medium">{{ $nilai->frs->jadwalKuliah->mataKuliah->sks }}</p>
            </div>
            <div>
                <p class="text-gray-600">Semester:</p>
                <p class="font-medium">{{ $nilai->frs->jadwalKuliah->semester }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Edit Nilai</h2>
        
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif
        
        <form action="{{ route('dosen.nilai.update', $nilai->id_nilai) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="nilai_angka" class="block text-gray-700 font-medium mb-2">Nilai Angka</label>
                <input 
                    type="number" 
                    id="nilai_angka" 
                    name="nilai_angka" 
                    value="{{ old('nilai_angka', $nilai->nilai_angka) }}" 
                    min="0" 
                    max="100" 
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nilai_angka') border-red-500 @enderror"
                    onchange="editNilaiHuruf()"
                    required
                >
                @error('nilai_angka')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="nilai_huruf" class="block text-gray-700 font-medium mb-2">Nilai Huruf</label>
                <input 
                    type="text" 
                    id="nilai_huruf" 
                    value="{{ $nilai->nilai_huruf }}" 
                    class="w-full px-3 py-2 border rounded-md bg-gray-100 focus:outline-none"
                    readonly
                >
                <p class="text-sm text-gray-500 mt-1">Nilai huruf akan otomatis dikonversi berdasarkan nilai angka</p>
            </div>
            
            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md">
                    Simpan Perubahan
                </button>
                <a href="{{ route('dosen.nilai.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-md">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function editNilaiHuruf() {
        const angka = parseFloat(document.getElementById('nilai_angka').value);
        const hurufField = document.getElementById('nilai_huruf');
        
        if (!isNaN(angka)) {
            if (angka >= 90) {
                hurufField.value = 'A';
            } else if (angka >= 80) {
                hurufField.value = 'B';
            } else if (angka >= 70) {
                hurufField.value = 'C';
            } else if (angka >= 60) {
                hurufField.value = 'D';
            } else {
                hurufField.value = 'E';
            }
        }
    }
</script>
@endsection