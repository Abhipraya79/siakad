@extends('layouts.dosen')

@section('title', 'Dashboard Dosen')

@section('content')

<!-- Section Header -->
<div class="mb-6">
    <h2 class="text-xl font-semibold">Dashboard Dosen</h2>
    <p class="text-black-600">Selamat datang</p>
</div>

<!-- Widgets Card -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-4 py-3">
    <!-- Widget Mahasiswa Bimbingan -->
    <div class="bg-mustard shadow-md rounded-lg p-4 flex items-center">
        <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-6">
            <svg class="widget-card w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
            </svg>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Mahasiswa Bimbingan</p>
            <h3 class="text-xl font-semibold">{{ $totalMahasiswa ?? 0 }}</h3>
        </div>
    </div>

    <!-- Widget FRS Perlu Approval -->
    <div class="bg-mustard shadow-md rounded-lg p-4 flex items-center">
        <div class="p-3 rounded-full bg-green-100 text-green-500 mr-6">
            <svg class="widget-card w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path d="M6 2a1 1 0 00-1 1v14l7-7-7-7z" />
            </svg>
        </div>
        <div>
            <p class="text-gray-600 text-sm">FRS Perlu Approval</p>
            <h3 class="text-xl font-semibold">{{ $totalFrsPending ?? 0 }}</h3>
        </div>
    </div>

    <!-- Widget Total Mata Kuliah -->
    <div class="bg-mustard shadow-md rounded-lg p-4 flex items-center">
        <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-6">
            <svg class="widget-card w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 4h16v2H4zm0 4h16v2H4zm0 4h16v2H4zm0 4h10v2H4z" />
            </svg>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Total Mata Kuliah</p>
            <h3 class="text-xl font-semibold">{{ $totalMataKuliah ?? 0 }}</h3>
        </div>
    </div>
</div>

<!-- Motivational Message -->
<div class="grid grid-cols-1 bg-white p-5 rounded-lg shadow mb-6">
    <p class="text-gray-600">
        "Selamat datang di Dashboard SIAKAD Dosen. Tetap semangat membimbing dan memberikan yang terbaik untuk mahasiswa!"
    </p>
</div>

    {{-- Jadwal Per Hari --}}
    <div class="mb-6">
        <h3 class="text-xl font-semibold mb-2">Jadwal Mengajar per Hari</h3>
        <ul class="list-disc ml-6">
            @foreach ($dosen->jadwalMataKuliah->groupBy('hari') as $hari => $list)
                <li>{{ ucfirst($hari) }}: {{ $list->count() }} kelas</li>
            @endforeach
        </ul>
    </div>

    {{-- Jadwal Hari Ini --}}
    <div class="mb-6">
        <h3 class="text-xl font-semibold mb-2">Jadwal Hari Ini ({{ ucfirst(\Carbon\Carbon::now()->translatedFormat('l')) }})</h3>
        @php
            $today = \Carbon\Carbon::now()->isoFormat('dddd');
            $jadwalHariIni = $dosen->jadwalMataKuliah->filter(fn($jadwal) => strtolower($jadwal->hari) === strtolower($today));
        @endphp
        @if ($jadwalHariIni->isEmpty())
            <p class="text-gray-600">Tidak ada jadwal hari ini.</p>
        @else
            <ul class="list-disc ml-6">
                @foreach ($jadwalHariIni as $jadwal)
                    <li>
                        {{ $jadwal->mataKuliah->nama_mata_kuliah ?? '-' }} -
                        {{ $jadwal->kelas->nama_kelas ?? '-' }},
                        {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
