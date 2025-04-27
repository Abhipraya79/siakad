@extends('layouts.app')

@section('title', 'Daftar FRS')

@section('content')
<div>
    <h1 class="text-2xl mb-4">Daftar FRS</h1>
    <a href="{{ route('mahasiswa.frs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
        Buat FRS Baru
    </a>

    <table class="w-full">
        <thead>
            <tr>
                <th class="border p-2">Mata Kuliah</th>
                <th class="border p-2">SKS</th>
                <th class="border p-2">Semester</th>
                <th class="border p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($frs as $item)
            <tr>
                <td class="border p-2">{{ $item->jadwalKuliah->mataKuliah->nama_mata_kuliah }}</td>
                <td class="border p-2">{{ $item->jadwalKuliah->mataKuliah->sks }}</td>
                <td class="border p-2">{{ $item->semester }}</td>
                <td class="border p-2">{{ $item->status_acc }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection