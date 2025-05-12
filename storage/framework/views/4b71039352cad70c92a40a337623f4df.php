<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_','-',app()->getLocale())); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo $__env->yieldContent('title', 'Login'); ?> – SIAKAD</title>
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="relative min-h-screen bg-cover bg-center"  
      style="background-image: url('<?php echo e(asset('images/your-campus.jpg')); ?>')">
  
  <div class="absolute inset-0 bg-black opacity-50"></div>

  
  <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
    <?php echo $__env->yieldContent('content'); ?>
  </div>
</body>
</html>
<?php /**PATH C:\laragon\www\siakad\resources\views/layouts/auth.blade.php ENDPATH**/ ?>