@extends('layouts.app')

@section('title', 'Persetujuan FRS')

@section('content')
<div>
    <h1 class="text-2xl mb-4">Daftar FRS</h1>
    
    <table class="w-full">
        <thead>
            <tr>
                <th class="border p-2">Mahasiswa</th>
                <th class="border p-2">Mata Kuliah</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($frs as $item)
            <tr>
                <td class="border p-2">{{ $item->mahasiswa->nama }}</td>
                <td class="border p-2">{{ $item->jadwalKuliah->mataKuliah->nama_mata_kuliah }}</td>
                <td class="border p-2">
                    <form class="inline-block" action="{{ route('dosen.frs.approve', $item->id_frs) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-green-600">Setujui</button>
                    </form>
                    <form class="inline-block" action="{{ route('dosen.frs.reject', $item->id_frs) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-600">Tolak</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection