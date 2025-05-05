<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'Login') – SIAKAD</title>

  <!-- Bootstrap 5 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-…"
    crossorigin="anonymous"
  >
</head>
<body class="bg-light d-flex align-items-center vh-100">
  <div class="container">
    @yield('content')
  </div>

  <!-- Bootstrap 5 JS Bundle -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-…"
    crossorigin="anonymous"
  ></script>
</body>
</html>
