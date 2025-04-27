@extends('layouts.mahasiswa')


@section('content')
<div class="text-center">
    <h1 class="text-4xl mb-4">Sistem Akademik</h1>
    @auth
        <p>Anda sudah login sebagai {{ auth()->user()->role }}</p>
    @else
        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            Login
        </a>
    @endauth
</div>
@endsection