@extends('layouts.mahasiswa')

@section('title', 'Buat FRS')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow-lg rounded-lg animate-fade-in">
    <h1 class="text-3xl font-bold text-blue-600 mb-6 text-center">Buat FRS Baru</h1>
    
    <form method="POST" action="{{ route('mahasiswa.frs.store') }}">
        @csrf

        <!-- Pilih Jadwal -->
        <div class="mb-4">
            <label for="jadwalSelect" class="block text-gray-700 font-medium mb-2">Jadwal Kuliah</label>
            <select name="id_jadwal_kuliah" id="jadwalSelect" class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">-- Pilih Jadwal --</option>
                @foreach($jadwalKuliah as $j)
                <option 
                    value="{{ $j->id_jadwal_kuliah }}"
                    data-matkul="{{ $j->mataKuliah->nama_mata_kuliah }}"
                    data-sks="{{ $j->mataKuliah->sks }}">
                    {{ $j->mataKuliah->nama_mata_kuliah }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Nama Mata Kuliah -->
        <div class="mb-4">
            <label for="matkulInput" class="block text-gray-700 font-medium mb-2">Nama Mata Kuliah</label>
            <input type="text" id="matkulInput" class="border border-gray-300 rounded px-4 py-2 w-full bg-gray-100 cursor-not-allowed" readonly>
        </div>

        <!-- SKS -->
        <div class="mb-4">
            <label for="sksInput" class="block text-gray-700 font-medium mb-2">SKS</label>
            <input type="text" id="sksInput" class="border border-gray-300 rounded px-4 py-2 w-full bg-gray-100 cursor-not-allowed" readonly>
        </div>

        <!-- Semester -->
        <div class="mb-6">
            <label for="semester" class="block text-gray-700 font-medium mb-2">Semester</label>
            <input type="number" name="semester" id="semester" class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold px-6 py-2 rounded w-full">
            Submit
        </button>
    </form>
</div>

<script>
    document.getElementById('jadwalSelect').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        document.getElementById('matkulInput').value = selected.getAttribute('data-matkul');
        document.getElementById('sksInput').value = selected.getAttribute('data-sks');
    });
</script>
@endsection
