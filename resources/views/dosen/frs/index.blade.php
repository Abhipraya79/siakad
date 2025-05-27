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

    @if($frsList->count() > 0)
        @php
            $groupedFrs = $frsList->groupBy('mahasiswa.nrp');
        @endphp

        @foreach($groupedFrs as $nrp => $mahasiswaFrs)
            @php
                $mahasiswa = $mahasiswaFrs->first()->mahasiswa;
            @endphp
            
            <div class="mb-8 bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Header Mahasiswa -->
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">
                        {{ $mahasiswa->nama }} - {{ $mahasiswa->nrp }}
                    </h2>
                    <p class="text-sm text-gray-600">
                        Total Mata Kuliah: {{ $mahasiswaFrs->count() }}
                    </p>
                </div>
                
                <!-- Tabel FRS per Mahasiswa -->
                <table class="min-w-full">
                    <thead class="bg-[#14487a] text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">No</th>
                            <th class="py-3 px-4 text-left">Mata Kuliah</th>
                            <th class="py-3 px-4 text-left">Kode MK</th>
                            <th class="py-3 px-4 text-left">SKS</th>
                            <th class="py-3 px-4 text-left">Status</th>
                            <th class="py-3 px-4 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($mahasiswaFrs as $index => $item)
                            <tr class="border-b hover:bg-blue-50">
                                <td class="py-3 px-4">{{ $index + 1 }}</td>
                                <td class="py-3 px-4">{{ $item->jadwalKuliah->mataKuliah->nama_mata_kuliah }}</td>
                                <td class="py-3 px-4">{{ $item->jadwalKuliah->mataKuliah->kode_mata_kuliah ?? '-' }}</td>
                                <td class="py-3 px-4">{{ $item->jadwalKuliah->mataKuliah->sks ?? '-' }}</td>
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
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-medium">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('dosen.frs.reject', $item->id_frs) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-medium">
                                                Tolak
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500 text-sm">Sudah diproses</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- Summary per Mahasiswa -->
                <div class="bg-gray-50 px-6 py-3 border-t">
                    @php
                        $approved = $mahasiswaFrs->where('status_acc', 'approved')->count();
                        $rejected = $mahasiswaFrs->where('status_acc', 'rejected')->count();
                        $pending = $mahasiswaFrs->where('status_acc', 'pending')->count();
                    @endphp
                    <div class="flex space-x-6 text-sm">
                        <span class="text-green-600">✓ Disetujui: {{ $approved }}</span>
                        <span class="text-red-600">✗ Ditolak: {{ $rejected }}</span>
                        <span class="text-yellow-600">⏳ Pending: {{ $pending }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="bg-white shadow-md rounded-lg p-8 text-center">
            <p class="text-gray-500">Tidak ada data FRS.</p>
        </div>
    @endif
</div>
@endsection