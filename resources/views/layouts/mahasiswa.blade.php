<!DOCTYPE html>
<html lang="en">
<head>
<body class="min-h-screen bg-white text-gray-800">

    <!-- ... meta tags ... -->
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-...your-integrity..."
      crossorigin="anonymous"
    >
    <!-- Bootstrap Icons -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
      rel="stylesheet"
    >
    <title>@yield('title', 'SIAKAD Mahasiswa')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header')
    @include('partials.sidebar-mahasiswa')
    <main class="p-4 md:ml-64">
        @yield('content')
    </main>
    @include('partials.footer')

    <!-- Bootstrap JS Bundle -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-...your-integrity..."
      crossorigin="anonymous"
    ></script>
    @stack('scripts')
</body>
</html>
