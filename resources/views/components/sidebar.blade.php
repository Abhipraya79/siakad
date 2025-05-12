<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard Mahasiswa')</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    body { background-color: #f4f4f4; }
    .sidebar {
      width: 240px;
      background-color: #f1e7da;
      height: 100vh;
      position: fixed;
      padding: 2rem 1rem;
    }
    .sidebar .nav-link.active {
      background-color: #2e00ff;
      color: white !important;
      border-radius: 8px;
    }
    .sidebar .nav-link {
      color: #333;
      margin-bottom: 1rem;
    }
    .content {
      margin-left: 240px;
      padding: 2rem;
    }
    .card-stat {
      border-radius: 12px;
      padding: 1.5rem;
      color: #000;
    }
  </style>
</head>
<body>
  @include('components.sidebar')

  <div class="content">
    @yield('content')
  </div>

</body>
</html>
