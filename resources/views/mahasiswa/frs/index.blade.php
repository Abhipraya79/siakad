@extends('layouts.mahasiswa')

@section('title', 'Daftar FRS')

@section('content')

@if(session('success_create'))
    <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
        {{ session('success_create') }}
    </div>
@endif

@if(session('success_destroy'))
    <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
        {{ session('success_destroy') }}
    </div>
@endif
<a href="{{ route('mahasiswa.frs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
    Tambah FRS
</a>

@if($frsList->isEmpty())
    <p class="text-gray-600">Belum ada FRS yang diajukan.</p>
@else
    <h1 class="text-2xl mb-4">Daftar FRS Anda</h1>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 p-2">ID FRS</th>
                <th class="border border-gray-300 p-2">Mata Kuliah</th>
                <th class="border border-gray-300 p-2">SKS</th>
                <th class="border border-gray-300 p-2">Semester</th>
                <th class="border border-gray-300 p-2">Status</th>
                <th class="border border-gray-300 p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($frsList as $frs)
            <tr>
                <td class="border border-gray-300 p-2">{{ $frs->id_frs }}</td>
                <td class="border border-gray-300 p-2">{{ $frs->jadwalKuliah->mataKuliah->nama_mata_kuliah ?? '-' }}</td>
                <td class="border border-gray-300 p-2">{{ $frs->jadwalKuliah->mataKuliah->sks ?? '-' }}</td>
                <td class="border border-gray-300 p-2">{{ $frs->semester }}</td>
                <td class="border border-gray-300 p-2 capitalize">{{ $frs->status_acc }}</td>
                <td class="border border-gray-300 p-2 text-center">
                    <form action="{{ route('mahasiswa.frs.destroy', $frs->id_frs) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus FRS ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection
