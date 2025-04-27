@extends('layouts.app')

@section('title', 'Nilai Mahasiswa')

@section('content')
<div>
    <h1 class="text-2xl mb-4">Daftar Nilai</h1>
    
    <table class="w-full">
        <thead>
            <tr>
                <th class="border p-2">Mata Kuliah</th>
                <th class="border p-2">Nilai Angka</th>
                <th class="border p-2">Nilai Huruf</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilai as $n)
            <tr>
                <td class="border p-2">{{ $n->frs->jadwalKuliah->mataKuliah->nama_mata_kuliah }}</td>
                <td class="border p-2">{{ $n->nilai_angka }}</td>
                <td class="border p-2">{{ $n->nilai_huruf }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection