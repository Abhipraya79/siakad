@extends('layouts.mahasiswa')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Jadwal Kuliah</h1>

    @php
        $grouped = $frsList->groupBy(function($frs) {
            return $frs->jadwalKuliah->hari ?? 'Tidak Diketahui';
        });
    @endphp

    @foreach ($grouped as $hari => $frsGroup)
        <div class="mb-10">
            <h2 class="text-xl font-semibold mb-4 text-blue-700">{{ $hari }}</h2>
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden mb-4">
                <thead class="bg-[#14487a] text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Mata Kuliah</th>
                        <th class="py-3 px-4 text-left">Kelas</th>
                        <th class="py-3 px-4 text-left">Jam Mulai</th>
                        <th class="py-3 px-4 text-left">Jam Selesai</th>
                        <th class="py-3 px-4 text-left">Dosen</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($frsGroup as $frs)
                        @php
                            $jadwal = $frs->jadwalKuliah;
                            $mataKuliah = $jadwal->mataKuliah ?? null;
                            $ruangan = $jadwal->ruangan ?? null;
                            $dosen = $jadwal->dosen ?? null;
                        @endphp
                        <tr class="border-b hover:bg-blue-50">
                            <td class="py-3 px-4">{{ $mataKuliah->nama_mata_kuliah ?? '-' }}</td>
                            <td class="py-3 px-4">{{ $jadwal->kelas ?? '-' }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                            <td class="py-3 px-4">{{ $dosen->nama ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>
@endsection
