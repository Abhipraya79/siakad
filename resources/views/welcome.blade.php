{{-- resources/views/welcome.blade.php --}}
@extends('layouts.auth')

@section('title', 'Welcome')

@section('content')
<div class="max-w-lg w-full bg-white rounded-2xl shadow-xl overflow-hidden">
  <div class="p-6 text-center">
    
    {{-- Judul --}}
    <h2 class="text-2xl font-bold mb-1">Sistem Akademik</h2>
    <p class="text-gray-500 mb-6">Pilih login sesuai peran Anda</p>

    {{-- Tombol Role --}}
    <div class="space-y-4">
      <a href="{{ route('login.role',['role'=>'dosen']) }}"
         class="flex items-center justify-center gap-2 w-full py-3 rounded-lg border-2 border-indigo-600 text-indigo-600 font-medium hover:bg-indigo-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 12c2.485 0 4.5-2.015 4.5-4.5S14.485 3 12 3 7.5 5.015 7.5 7.5 9.515 12 12 12zm0 1.5c-3.033 0-9 1.517-9 4.5V21h18v-3c0-2.983-5.967-4.5-9-4.5z"/>
        </svg>
        Login Dosen
      </a>

      <a href="{{ route('login.role',['role'=>'mahasiswa']) }}"
        class="flex items-center justify-center gap-2 w-full py-3 rounded-lg border-2 border-yellow-600 text-yellow-600 font-medium hover:bg-yellow-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 12c2.485 0 4.5-2.015 4.5-4.5S14.485 3 12 3 7.5 5.015 7.5 7.5 9.515 12 12 12zm0 1.5c-3.033 0-9 1.517-9 4.5V21h18v-3c0-2.983-5.967-4.5-9-4.5z"/>
        </svg>
        Login Mahasiswa
     </a>
     
    </div>
  </div>
</div>
@endsection
