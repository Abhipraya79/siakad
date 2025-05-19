@extends('layouts.dosen')

@section('title', 'Daftar Nilai')

@section('content')
<div>
    <h1 class="text-2xl mb-4">Daftar Nilai</h1>
    
    <table class="w-full">
        <thead>
            <tr>
                <th class="border p-2">Mahasiswa</th>
                <th class="border p-2">Mata Kuliah</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($frsList as $item)
            <tr>
                <td class="border p-2">{{ $item->mahasiswa->nama }}</td>
                <td class="border p-2">{{ $item->jadwalKuliah->mataKuliah->nama_mata_kuliah }}</td>
                <td class="border p-2">
                    <a href="{{ route('dosen.nilai.create', $item->id_frs) }}" class="text-blue-600">
                        Input Nilai
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection