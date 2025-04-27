@extends('layouts.app')

@section('content')
    <h2>Edit Nilai Mahasiswa</h2>

    <form method="POST" action="#">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Mata Kuliah:</label><br>
            <input type="text" name="nama_mk" value="Contoh Mata Kuliah">
        </div>

        <div>
            <label>Nilai:</label><br>
            <input type="number" name="nilai" value="80">
        </div>

        <button type="submit">Update Nilai</button>
    </form>
@endsection
