@extends('layouts.dosen') 
 
@section('title', 'Daftar Nilai') 
 
@section('content') 
<div> 
    <h1 class="text-2xl mb-4">Daftar Nilai</h1>
    
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif
    
    @if($nilaiList->isEmpty())
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
        <p>Belum ada mahasiswa yang mengambil mata kuliah Anda atau FRS belum disetujui.</p>
    </div>
    @endif
     
    <table class="w-full"> 
        <thead> 
            <tr> 
                <th class="border p-2">NIM</th>
                <th class="border p-2">Nama Mahasiswa</th> 
                <th class="border p-2">Mata Kuliah</th>
                <th class="border p-2">SKS</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th> 
            </tr> 
        </thead> 
        <tbody> 
            @foreach($nilaiList as $nilai) 
            <tr> 
                <td class="border p-2">{{ $nilai->mahasiswa->nim ?? 'N/A' }}</td>
                <td class="border p-2">{{ $nilai->mahasiswa->nama ?? 'Data Tidak Lengkap' }}</td> 
                <td class="border p-2"> 
                    @if($nilai->jadwalKuliah && $nilai->jadwalKuliah->mataKuliah) 
                        {{ $nilai->jadwalKuliah->mataKuliah->nama_mata_kuliah }} 
                    @else 
                        <span class="text-red-500">Data Tidak Lengkap</span> 
                    @endif 
                </td>
                <td class="border p-2 text-center">
                    @if($nilai->jadwalKuliah && $nilai->jadwalKuliah->mataKuliah)
                        {{ $nilai->jadwalKuliah->mataKuliah->sks }}
                    @else
                        -
                    @endif
                </td>
                <td class="border p-2 text-center">
                    @if($nilai->nilai && $nilai->nilai->nilai_angka !== null)
    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Sudah Dinilai</span>
@else
    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Belum Dinilai</span>
@endif

                </td>
                <td class="border p-2 text-center">
    @if($nilai->nilai && $nilai->nilai->nilai_angka !== null)
        {{-- Jika nilai sudah diisi, tampilkan Edit --}}
        <a href="{{ route('dosen.nilai.edit', ['id_nilai' => $nilai->nilai->id_nilai]) }}" class="text-blue-600 hover:text-blue-800">
            Edit Nilai
        </a>
    @else
        {{-- Jika belum dinilai, arahkan ke form input berdasarkan jadwal --}}
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
    
    <div class="mt-4">
        <a href="{{ route('dosen.dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>
</div> 
@endsection