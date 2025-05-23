@extends('layouts.dosen')

@section('title', 'Jadwal Mengajar')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Jadwal Mengajar Saya</h1>

    @if($jadwalKuliah->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
            <p>Belum ada jadwal mengajar yang terdaftar untuk Anda.</p>
        </div>
    @else
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-[#14487a] text-white">
                <tr>
                    <th class="py-3 px-4 text-left">No</th>
                    <th class="py-3 px-4 text-left">Mata Kuliah</th>
                    <th class="py-3 px-4 text-left">Hari</th>
                    <th class="py-3 px-4 text-left">Jam</th>
                    <th class="py-3 px-4 text-left">Kelas</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($jadwalKuliah as $index => $jadwal)
                    <tr class="border-b hover:bg-blue-50">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4">{{ $jadwal->mataKuliah->nama_mata_kuliah ?? '-' }}</td>
                        <td class="py-3 px-4">{{ $jadwal->hari }}</td>
                        <td class="py-3 px-4">
                            {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - 
                            {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                        </td>
                        <td class="py-3 px-4">{{ $jadwal->kelas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
