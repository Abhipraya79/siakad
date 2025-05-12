<?php $__env->startSection('title', 'Login ' . ucfirst($role)); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden mx-auto mt-10">
  <div class="p-8">
    
    <h2 class="text-2xl font-bold text-center mb-2">Login <?php echo e(ucfirst($role)); ?></h2>
    <p class="text-center text-gray-500 mb-6">Sign in to your account</p>

    
    <?php if($errors->any()): ?>
      <div class="mb-4 text-sm text-red-600">
        <ul class="list-disc list-inside">
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($e); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>

    <form action="<?php echo e(route('login.perform')); ?>" method="POST" class="space-y-4">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="role" value="<?php echo e(old('role', $role)); ?>">

      
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
        <input
          id="username"
          name="username"
          type="text"
          required
          autofocus
          placeholder="Enter your username"
          value="<?php echo e(old('username')); ?>"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                 focus:ring-indigo-500 focus:border-indigo-500 <?php echo e($errors->has('username') ? 'border-red-500' : ''); ?>"
        />
        <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <p class="text-sm text-red-500 mt-1"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input
          id="password"
          name="password"
          type="password"
          required
          placeholder="Enter your password"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 <?php echo e($errors->has('password') ? 'border-red-500' : ''); ?>"
        />
        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <p class="text-sm text-red-500 mt-1"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
      <a href="<?php echo e(url('forgot-password')); ?>" class="text-indigo-600 hover:underline">
        Reset Password
      </a>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\siakad\resources\views/auth/login.blade.php ENDPATH**/ ?>