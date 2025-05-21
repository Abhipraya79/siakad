@extends('layouts.auth')

@section('title', 'Login ' . ucfirst($role))

@section('content')
<div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
  <div class="p-8">
    {{-- Judul Dinamis --}}
    <h2 class="text-2xl font-bold text-center mb-2">Login {{ ucfirst($role) }}</h2>
    <p class="text-center text-gray-500 mb-6">Sign in to your account</p>

    {{-- Errors --}}
    @if($errors->any())
      <div class="mb-4 text-sm text-red-600">
        <ul class="list-disc list-inside">
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('login.perform') }}" method="POST" class="space-y-4">
      @csrf 
      <input type="hidden" name="role" value="{{ $role }}">

      <div>
        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
        <input
          id="username"
          name="username"
          type="text"
          required
          autofocus
          placeholder="Enter your username"
          value="{{ old('username') }}"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                 focus:ring-indigo-500 focus:border-indigo-500"
        />
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input
          id="password"
          name="password"
          type="password"
          required
          placeholder="Enter your password"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                 focus:ring-indigo-500 focus:border-indigo-500"
        />
      </div>

      <button
        type="submit"
        class="w-full py-3 font-semibold rounded-md bg-indigo-600 text-white hover:bg-indigo-700"
      >
        Sign In
      </button>
    </form>

    <div class="mt-4 text-center text-sm text-gray-500">
      Forgot your password?
      <a href="{{ url('forgot-password') }}" class="text-indigo-600 hover:underline">
        Reset Password
      </a>
    </div>
  </div>
</div>
@endsection
