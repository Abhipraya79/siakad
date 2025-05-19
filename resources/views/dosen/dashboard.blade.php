@extends('layouts.dosen')

@section('title', 'Dashboard Dosen')

@section('content')
<div class="mb-6">
    <h2 class="text-xl font-semibold">Dashboard Dosen</h2>
    <p class="text-gray-600">
    Selamat datang
</p>

</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="font-medium text-gray-500">Mahasiswa Bimbingan</h3>
        <p class="text-2xl font-bold">{{ $totalMahasiswa }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="font-medium text-gray-500">FRS Perlu Approval</h3>
        <p class="text-2xl font-bold">{{ $totalFrsPending }}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="font-medium text-gray-500">Total Mata Kuliah</h3>
        <p class="text-2xl font-bold">{{ $totalMataKuliah }}</p>
    </div>
</div>


@endsection