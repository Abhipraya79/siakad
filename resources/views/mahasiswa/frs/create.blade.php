@extends('layouts.mahasiswa')

@section('title', 'Buat FRS')

@section('content')
<div>
    <h1 class="text-2xl mb-4">Buat FRS Baru</h1>
    
    <form method="POST" action="{{ route('mahasiswa.frs.store') }}">
        @csrf
        <div class="mb-4">
            <label>Jadwal Kuliah</label>
            <select name="id_jadwal_kuliah" class="border p-2 w-full" id="jadwalSelect">
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

        <div class="mb-4">
            <label>Nama Mata Kuliah</label>
            <input type="text" id="matkulInput" class="border p-2 w-full" readonly>
        </div>

        <div class="mb-4">
            <label>SKS</label>
            <input type="text" id="sksInput" class="border p-2 w-full" readonly>
        </div>

        <div class="mb-4">
            <label>Semester</label>
            <input type="number" name="semester" class="border p-2 w-full" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
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
