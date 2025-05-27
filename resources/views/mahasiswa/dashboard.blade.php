@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="p-6">

    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Dashboard Mahasiswa</h2>
        <p class="text-gray-600 flex items-center">
            <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
            </svg>
            Selamat datang, <strong>{{ $mahasiswa->nama }}</strong>
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Widget Jumlah SKS -->
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a1 1 0 011-1h10a1 1 0 011 1v2H4V3zM3 6h14v10a1 1 0 01-1 1H4a1 1 0 01-1-1V6zm6 2v2H6V8h3zm0 3v2H6v-2h3zm5-3v2h-3V8h3zm0 3v2h-3v-2h3z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Jumlah SKS Diambil</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalSks ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Widget Jumlah Mata Kuliah -->
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zm0 7.3L5 7l7 3.3 7-3.3-7 2.3zM4 10v2c0 2.8 4 5 8 5s8-2.2 8-5v-2l-8 4-8-4z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Jumlah Mata Kuliah</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $jumlahMatkul ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Widget User Aktif -->
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-purple-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a4 4 0 00-4 4v2a4 4 0 108 0V6a4 4 0 00-4-4zm-6 14a6 6 0 0112 0v1H4v-1z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Mahasiswa Aktif</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $jumlahUserAktif ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-indigo-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Semester Aktif</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $semesterAktif }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                Jadwal Kuliah Hari Ini
            </h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Mata Kuliah
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                Dosen
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                Waktu
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($jadwalHariIni as $jadwal)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ $jadwal->mataKuliah->nama_mata_kuliah }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-gray-900">{{ $jadwal->dosen->nama }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2L3 7v11c0 1.1.9 2 2 2h4v-6h2v6h4c1.1 0 2-.9 2-2V7l-7-5z"/>
                                    </svg>
                                    <p class="text-sm font-medium text-gray-500">Tidak ada jadwal hari ini</p>
                                    <p class="text-sm text-gray-400 mt-1">Selamat beristirahat!</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection