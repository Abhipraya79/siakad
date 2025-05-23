@extends('layouts.mahasiswa')

@section('title', 'Daftar FRS')

@section('content')

@if(session('success_create'))
    <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
        {{ session('success_create') }}
    </div>
@endif

@if(session('success_destroy'))
    <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
        {{ session('success_destroy') }}
    </div>
@endif

<a href="{{ route('mahasiswa.frs.create') }}" class="bg-[#14487a] text-white px-4 py-2 rounded mb-4 inline-block">
    Tambah FRS
</a>

@if($frsList->isEmpty())
    <p class="text-gray-600">Belum ada FRS yang diajukan.</p>
@else
    <h1 class="text-2xl font-bold mb-6 text-blue-700">Daftar FRS Anda</h1>

    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-[#14487a] text-white">
            <tr>
                <th class="py-3 px-4 text-left">ID FRS</th>
                <th class="py-3 px-4 text-left">Kode Mata Kuliah</th>
                <th class="py-3 px-4 text-left">Mata Kuliah</th>
                <th class="py-3 px-4 text-left">SKS</th>
                <th class="py-3 px-4 text-left">Hari</th>
                <th class="py-3 px-4 text-left">Jam</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-left">Keterangan</th>
                <th class="py-3 px-4 text-left">Batalkan Pengajuan</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($frsList as $frs)
                <tr class="border-b hover:bg-blue-50">
                    <td class="py-3 px-4">{{ $frs->id_frs }}</td>
                    <td class="py-3 px-4">{{ $frs->jadwalKuliah->mataKuliah->kode_mata_kuliah ?? '-' }}</td>
                    <td class="py-3 px-4">{{ $frs->jadwalKuliah->mataKuliah->nama_mata_kuliah ?? '-' }}</td>
                    <td class="py-3 px-4">{{ $frs->jadwalKuliah->mataKuliah->sks ?? '-' }}</td>
                    <td class="py-3 px-4">{{ $frs->jadwalKuliah->hari ?? '-' }}</td>
                    <td class="py-3 px-4">
                        {{ $frs->jadwalKuliah->jam_mulai ? \Carbon\Carbon::parse($frs->jadwalKuliah->jam_mulai)->format('H:i') : '-' }} -
                        {{ $frs->jadwalKuliah->jam_selesai ? \Carbon\Carbon::parse($frs->jadwalKuliah->jam_selesai)->format('H:i') : '-' }}
                    </td>
                    <td class="py-3 px-4">
                        @if($frs->status_acc === 'approved')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Approved</span>
                        @elseif($frs->status_acc === 'rejected')
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Rejected</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Pending</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-sm">
                        @if($frs->status_acc == 'pending')
                            Menunggu persetujuan dosen wali
                        @elseif($frs->status_acc == 'approved')
                            Telah disetujui
                        @elseif($frs->status_acc == 'rejected')
                            Ditolak oleh dosen wali
                        @endif
                    </td>
                    <td class="py-3 px-4 text-center">
                        @if($frs->status_acc == 'pending')
                        <form action="{{ route('mahasiswa.frs.destroy', $frs->id_frs) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus FRS ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                        </form>
                        @else
                        <span class="text-gray-500 text-sm">Anda telah mengambil frs</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection
