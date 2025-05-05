@extends('layouts.auth')

@section('title', 'Login ' . ucfirst($role))

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="card-title text-center mb-4">Login {{ ucfirst($role) }}</h3>

        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
          @csrf
          <input type="hidden" name="role" value="{{ $role }}">

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input
              type="text"
              class="form-control"
              id="username"
              name="username"
              required
              autofocus
            >
          </div>
          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
              required
            >
          </div>

          <button type="submit" class="btn btn-primary w-100">
            Masuk sebagai {{ ucfirst($role) }}
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
