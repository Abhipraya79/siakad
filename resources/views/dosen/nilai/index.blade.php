@extends('layouts.dosen')

@section('title', 'Daftar Nilai')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Nilai</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($nilaiList->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded mb-4">
            Belum ada mahasiswa yang mengambil mata kuliah Anda atau FRS belum disetujui.
        </div>
    @else
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-yellow-400 text-white uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3">NRP</th>
                    <th class="px-6 py-3">Nama Mahasiswa</th>
                    <th class="px-6 py-3">Mata Kuliah</th>
                    <th class="px-6 py-3">SKS</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($nilaiList as $nilai)
                <tr class="hover:bg-yellow-50 transition duration-150 ease-in-out">
                    <td class="px-6 py-4">{{ $nilai->mahasiswa->nrp ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $nilai->mahasiswa->nama ?? 'Data Tidak Lengkap' }}</td>
                    <td class="px-6 py-4">
                        {{ $nilai->jadwalKuliah->mataKuliah->nama_mata_kuliah ?? 'Data Tidak Lengkap' }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $nilai->jadwalKuliah->mataKuliah->sks ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($nilai->nilai && $nilai->nilai->nilai_angka !== null)
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Sudah Dinilai</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Belum Dinilai</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($nilai->nilai && $nilai->nilai->nilai_angka !== null)
                            <a href="{{ route('dosen.nilai.edit', ['id_nilai' => $nilai->nilai->id_nilai]) }}" class="text-blue-600 hover:text-blue-800">
                                Edit Nilai
                            </a>
                        @else
                            @if($nilai->jadwalKuliah)
                                <a href="{{ route('dosen.nilai.create', ['id_jadwal_kuliah' => $nilai->jadwalKuliah->id_jadwal_kuliah]) }}" class="text-green-600 hover:text-green-800">
                                    Input Nilai
                                </a>
                            @else
                                <span class="text-red-500">Data jadwal tidak tersedia</span>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('dosen.dashboard') }}" class="bg-gray-600 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded">
            Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
