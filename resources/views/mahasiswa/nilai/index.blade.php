@extends('layouts.mahasiswa')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Nilai Saya</h1>

    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-green-600 text-white">
            <tr>
                <th class="py-3 px-4 text-left">Kode Mata Kuliah</th>
                <th class="py-3 px-4 text-left">Nama Mata Kuliah</th>
                <th class="py-3 px-4 text-left">Nilai Huruf</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @forelse ($nilaiList as $nilai)
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-3 px-4">{{ $nilai->frs->jadwalKuliah->mataKuliah->kode_mata_kuliah }}</td>
                    <td class="py-3 px-4">{{ $nilai->frs->jadwalKuliah->mataKuliah->nama_mata_kuliah }}</td>
                    <td class="py-3 px-4">{{ $nilai->nilai_huruf }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="py-3 px-4 text-center">Belum ada nilai.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
