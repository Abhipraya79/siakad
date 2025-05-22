@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa')

@section('content')

<!-- Ini section dashboard mahasiswa -->
<div class="mb-6">
    <h2 class="text-xl font-semibold">Dashboard Mahasiswa</h2>
     <p class="text-black-600" > {{ $mahasiswa->nama }}</p>
</div>

<!-- Ini Widgets Card -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-4 py-3">
    <!-- Widget Jumlah SKS -->
    <div class="bg-mustard shadow-md rounded-lg p-4 flex items-center">
        <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-6">
            <svg class="widget-card w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 3a1 1 0 011-1h10a1 1 0 011 1v2H4V3zM3 6h14v10a1 1 0 01-1 1H4a1 1 0 01-1-1V6zm6 2v2H6V8h3zm0 3v2H6v-2h3zm5-3v2h-3V8h3zm0 3v2h-3v-2h3z" />
                </svg>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Jumlah SKS Diambil</p>
            <h3 class="text-xl font-semibold">{{ $totalSks ?? 0 }}</h3>
        </div>
    </div>

    <!-- Widget Jumlah Mata Kuliah -->
    <div class="bg-mustard shadow-md rounded-lg p-4 flex items-center">
        <div class="p-3 rounded-full bg-green-100 text-green-500 mr-6">
            <svg class="widget-card" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zm0 7.3L5 7l7 3.3 7-3.3-7 2.3zM4 10v2c0 2.8 4 5 8 5s8-2.2 8-5v-2l-8 4-8-4z" />
            </svg>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Jumlah Mata Kuliah</p>
            <h3 class="text-xl font-semibold">{{ $jumlahMatkul ?? 0 }}</h3>
        </div>
    </div>

    <!-- Widget Jumlah User Aktif -->
    <div class="bg-mustard shadow-md rounded-lg p-4 flex items-justify-between">
        <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-6">
            <svg class="widget-card" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2a4 4 0 00-4 4v2a4 4 0 108 0V6a4 4 0 00-4-4zm-6 14a6 6 0 0112 0v1H4v-1z" />
            </svg>
        </div>
        <div>
            <p class="text-gray-600 text-sm">User Aktif</p>
            <h3 class="text-xl font-semibold">{{ $jumlahUserAktif ?? 0 }}</h3>
        </div>
    </div>
</div>
<!-- Section 2 -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4 py-6">
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="font-medium text-gray-500">IPK</h3>
        <p class="text-2xl font-semibold">{{ number_format($ipk, 2) }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="font-medium text-gray-500">Semester</h3>
        <p class="text-2xl font-semibold">{{ $semesterAktif }}</p>
    </div>
</div>

<!-- Descriptive Text Section -->
<div class="grid grid-cols-1 bg-white p-5 rounded-lg shadow mb-6">
    <p class="text-gray-600">
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
    </p>
</div>

<!-- Bottom Section -->

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
