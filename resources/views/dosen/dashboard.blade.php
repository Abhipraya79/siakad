@extends('layouts.dosen')

@section('title', 'Dashboard Dosen')

@section('content')
<div class="p-6">
    
   
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Dashboard Dosen</h2>
        <p class="text-gray-600">Selamat Datang {{ $dosen->nama }}</p>
    </div>

   
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Mahasiswa Wali</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalMahasiswa ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-orange-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-100 text-orange-600 mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">FRS Perlu Approval</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalFrsPending ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Total Mata Kuliah</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalMataKuliah ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 mb-8">
        <div class="flex items-start">
            <div class="bg-blue-100 rounded-full p-2 mr-3">
                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
            <p class="text-blue-800 italic">
                "Selamat datang di Dashboard SIAKAD Dosen. Tetap semangat membimbing dan memberikan yang terbaik untuk mahasiswa!"
            </p>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                Jadwal Mengajar per Hari
            </h3>
            
            @if($dosen->jadwalMataKuliah->groupBy('hari')->count() > 0)
                <div class="space-y-2">
                    @foreach ($dosen->jadwalMataKuliah->groupBy('hari') as $hari => $list)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="font-medium text-gray-700 capitalize">{{ $hari }}</span>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                {{ $list->count() }} kelas
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <p>Belum ada jadwal mengajar</p>
                </div>
            @endif
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                Jadwal Hari Ini ({{ ucfirst(\Carbon\Carbon::now()->translatedFormat('l')) }})
            </h3>
            
            @php
                $today = \Carbon\Carbon::now()->isoFormat('dddd');
                $jadwalHariIni = $dosen->jadwalMataKuliah->filter(fn($jadwal) => strtolower($jadwal->hari) === strtolower($today));
            @endphp
            
            @if ($jadwalHariIni->isEmpty())
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2L3 7v11c0 1.1.9 2 2 2h4v-6h2v6h4c1.1 0 2-.9 2-2V7l-7-5z"/>
                    </svg>
                    <p>Tidak ada jadwal hari ini</p>
                    <p class="text-sm mt-1">Selamat beristirahat!</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($jadwalHariIni as $jadwal)
                        <div class="border-l-4 border-green-400 bg-green-50 p-4 rounded-r-lg">
                            <h4 class="font-semibold text-gray-800 mb-1">
                                {{ $jadwal->mataKuliah->nama_mata_kuliah ?? 'Mata Kuliah' }}
                            </h4>
                            <p class="text-gray-600 text-sm mb-1">
                                📚 Kelas: {{ $jadwal->kelas->nama_kelas ?? '-' }}
                            </p>
                            <p class="text-gray-600 text-sm">
                                🕒 {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    
</div>
@endsection