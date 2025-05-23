@extends('layouts.dosen')

@section('title', 'Persetujuan FRS')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar FRS</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-[#14487a] text-white">
            <tr>
                <th class="py-3 px-4 text-left">Mahasiswa</th>
                <th class="py-3 px-4 text-left">Mata Kuliah</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @forelse($frsList as $item)
                <tr class="border-b hover:bg-blue-50">
                    <td class="py-3 px-4">{{ $item->mahasiswa->nama }}</td>
                    <td class="py-3 px-4">{{ $item->jadwalKuliah->mataKuliah->nama_mata_kuliah }}</td>
                    <td class="py-3 px-4">
                        @if($item->status_acc === 'approved')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Approved</span>
                        @elseif($item->status_acc === 'rejected')
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Rejected</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Pending</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        @if($item->status_acc === 'pending')
                            <form action="{{ route('dosen.frs.approve', $item->id_frs) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-800 font-medium">Setujui</button>
                            </form>
                            <form action="{{ route('dosen.frs.reject', $item->id_frs) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Tolak</button>
                            </form>
                        @else
                            <span class="text-gray-500 text-sm">Sudah diproses</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">Tidak ada data FRS.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
