@extends('layouts.app')

@section('title', 'Buat FRS')

@section('content')
<div>
    <h1 class="text-2xl mb-4">Buat FRS Baru</h1>
    
    <form method="POST" action="{{ route('mahasiswa.frs.store') }}">
        @csrf
        <div class="mb-4">
            <label>Jadwal Kuliah</label>
            <select name="id_jadwal_kuliah" class="border p-2 w-full">
                @foreach($jadwal as $j)
                <option value="{{ $j->id_jadwal_kuliah }}">
                    {{ $j->mataKuliah->nama_mata_kuliah }}
                </option>
                @endforeach
            </select>
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
@endsection