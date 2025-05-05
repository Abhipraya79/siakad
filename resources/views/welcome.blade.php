@extends('layouts.mahasiswa') {{-- atau layout umum Anda --}}

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center">

      <h1 class="display-4 mb-3">Sistem Akademik</h1>
      <p class="lead mb-4">Pilih login sesuai peran Anda untuk melanjutkan.</p>

      @auth
        <div class="alert alert-info">
          Anda sudah login sebagai <strong>{{ auth()->user()->role }}</strong>.
        </div>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
          </button>
        </form>
      @else
        <div class="d-flex justify-content-center gap-3">
          <a href="{{ route('login.role',['role'=>'mahasiswa']) }}"
             class="btn btn-primary btn-lg">
            <i class="bi bi-person-fill"></i> Login Mahasiswa
          </a>
          <a href="{{ route('login.role',['role'=>'dosen']) }}"
             class="btn btn-success btn-lg">
            <i class="bi bi-person-badge-fill"></i> Login Dosen
          </a>
        </div>
      @endauth

    </div>
  </div>
</div>
@endsection
