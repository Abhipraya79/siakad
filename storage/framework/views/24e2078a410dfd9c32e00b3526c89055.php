<?php $__env->startSection('title', 'Dashboard Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1 class="mb-4">Dashboard Mahasiswa</h1>

    

<div class="d-flex justify-content-between align-items-stretch mb-5 flex-wrap">
  <!-- SKS -->
  <div class="info-card custom-card-sks flex-fill me-3">
    <div class="card-body d-flex justify-content-between align-items-center p-4">
      <i class="bi bi-journal-bookmark-fill fs-1"></i>
      <div class="text-end">
        <div class="info-label">SKS Diambil</div>
        <div class="info-value"><?php echo e($totalSks); ?></div>
      </div>
    </div>
  </div>

  <!-- Matakuliah -->
  <div class="info-card custom-card-mk flex-fill mx-3">
    <div class="card-body d-flex justify-content-between align-items-center p-4">
      <i class="bi bi-bookmark-fill fs-1"></i>
      <div class="text-end">
        <div class="info-label">IPK</div>
        <div class="info-value"><?php echo e($ipk); ?></div>
      </div>
    </div>
  </div>

  <!-- Users -->
  <div class="info-card custom-card-users flex-fill ms-3">
    <div class="card-body d-flex justify-content-between align-items-center p-4">
      <i class="bi bi-person-circle fs-1"></i>
      <div class="text-end">
        <div class="info-label">Semester</div>
        <div class="info-value"><?php echo e($semesterAktif); ?></div>
      </div>
    </div>
  </div>
</div>

    
    <div class="card mt-5">
        <div class="card-header">
            Jadwal Hari Ini —
            <?php echo e(\Carbon\Carbon::now()->translatedFormat('l, d F Y')); ?>

        </div>
        <div class="card-body p-0">
            <?php if($jadwalHariIni->isEmpty()): ?>
                <div class="p-4">Tidak ada jadwal kuliah hari ini.</div>
            <?php else: ?>
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode & Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Waktu</th>
                            <th>Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $jadwalHariIni; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <strong><?php echo e($jadwal->mataKuliah->kode_mata_kuliah ?? '-'); ?></strong><br>
                                <?php echo e($jadwal->mataKuliah->nama_mata_kuliah ?? '-'); ?>

                            </td>
                            <td><?php echo e($jadwal->dosen->nama ?? '-'); ?></td>
                            <td><?php echo e($jadwal->jam_mulai); ?> - <?php echo e($jadwal->jam_selesai); ?></td>
                            <td><?php echo e($jadwal->ruangan); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mahasiswa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\siakad\resources\views/mahasiswa/dashboard.blade.php ENDPATH**/ ?>