@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="mb-6">
    <h2 class="text-xl font-semibold">Dashboard Mahasiswa</h2>
    <p class="text-gray-600">Selamat datang, {{ $mahasiswa->nama }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="font-medium text-gray-500">Total SKS Semester Ini</h3>
        <p class="text-2xl font-bold">{{ $totalSks }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="font-medium text-gray-500">IPK</h3>
        <p class="text-2xl font-bold">{{ number_format($ipk, 2) }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="font-medium text-gray-500">Semester</h3>
        <p class="text-2xl font-bold">{{ $semesterAktif }}</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden mb-6">
    <div class="p-4 border-b border-gray-200">
        <h3 class="font-semibold">Jadwal Kuliah Hari Ini</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mata Kuliah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dosen</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ruang</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($jadwalHariIni as $jadwal)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->mataKuliah->nama_mata_kuliah }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->dosen->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->ruangan->nama_ruang }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada jadwal hari ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
