<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'Login') – SIAKAD</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative min-h-screen bg-cover bg-center"  
      style="background-image: url('{{ asset('images/your-campus.jpg') }}')">
  {{-- Overlay gelap --}}
  <div class="absolute inset-0 bg-black opacity-50"></div>

  {{-- Konten --}}
  <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
    @yield('content')
  </div>
</body>
</html>
