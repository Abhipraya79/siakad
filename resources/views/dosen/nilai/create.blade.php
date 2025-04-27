@extends('layouts.app')

@section('title', 'Input Nilai')

@section('content')
<div>
    <h1 class="text-2xl mb-4">Input Nilai</h1>
    
    <form method="POST" action="{{ route('dosen.nilai.store', $frs->id_frs) }}">
        @csrf
        <div class="mb-4">
            <label>Nilai Angka</label>
            <input type="number" name="nilai_angka" class="border p-2 w-full" required>
        </div>
        
        <div class="mb-4">
            <label>Nilai Huruf</label>
            <input type="text" name="nilai_huruf" class="border p-2 w-full" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>
@endsection