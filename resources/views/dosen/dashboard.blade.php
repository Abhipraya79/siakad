@extends('layouts.dosen')

@section('title', 'Dashboard Dosen')

@section('content')
<div class="mb-6">
    <h2 class="text-xl font-semibold">Dashboard Dosen</h2>
    <p class="text-gray-600">Selamat datang, {{ auth()->user()->dosen->nama }}</p>
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

<div class="bg-white rounded-lg shadow overflow-hidden mb-6">
    <div class="p-4 border-b border-gray-200">
        <h3 class="font-semibold">FRS Perlu Persetujuan</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mahasiswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mata Kuliah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Semester</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($frsPending as $frs)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $frs->mahasiswa->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $frs->jadwalKuliah->mataKuliah->nama_mata_kuliah }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $frs->semester }}</td>
                        <td class="px-6 py-4 whitespace-nowrap space-x-2">
                            <form action="{{ route('dosen.frs.approve', $frs->id_frs) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-900">Setujui</button>
                            </form>
                            <form action="{{ route('dosen.frs.reject', $frs->id_frs) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-900">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada FRS yang perlu disetujui</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection