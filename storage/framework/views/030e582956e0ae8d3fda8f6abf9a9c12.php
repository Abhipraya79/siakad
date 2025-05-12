<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'SIAKAD Mahasiswa'); ?></title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-whatever"
        crossorigin="anonymous"
    >
    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        .sidebar {
            width: 16rem;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 40;
            background: #fff;
            border-right: 1px solid #dee2e6;
            padding-top: 4rem;
            overflow-y: auto;
        }

        .topbar {
            margin-left: 16rem;
            padding: 1rem;
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            position: fixed;
            width: calc(100% - 16rem);
            top: 0;
            z-index: 30;
        }

        .content-body {
            margin-left: 16rem;
            padding-top: 5rem;
        }
    </style>
</head>
<body class="bg-light">

    <?php echo $__env->make('partials.sidebar-mahasiswa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="topbar d-flex justify-content-end align-items-center">
        <div class="input-group" style="max-width: 300px;">
            <input type="text" class="form-control" placeholder="Search...">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
        <button class="btn btn-link ms-3 text-muted"><i class="bi bi-bell fs-4"></i></button>
    </div>

    <main class="content-body">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-whatever"
        crossorigin="anonymous"
    ></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\siakad\resources\views/partials/sidebar-mahasiswa.blade.php ENDPATH**/ ?>