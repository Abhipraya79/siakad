@extends('layouts.app')

@section('content')
    <h2>Jadwal Mengajar Saya</h2>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Kuliah</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Ruangan</th>
            </tr>
        </thead>
        <tbody>
            {{-- Contoh data statis, nanti bisa diganti dengan @foreach --}}
            <tr>
                <td>1</td>
                <td>Pemrograman Web</td>
                <td>Senin</td>
                <td>08:00 - 10:00</td>
                <td>Ruang 101</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Basis Data</td>
                <td>Rabu</td>
                <td>10:00 - 12:00</td>
                <td>Ruang 102</td>
            </tr>
        </tbody>
    </table>
@endsection
