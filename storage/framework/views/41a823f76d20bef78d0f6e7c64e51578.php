<?php $__env->startSection('content'); ?>
    <h4 class="text-center mb-4">Daftar Presensi</h4>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="vstack gap-3">
        <?php $__currentLoopData = ['absensi' => 'Absensi', 'terlambat' => 'Terlambat', 'keluar' => 'Keluar']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis => $judul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $data = $presensis->where('jenis', $jenis);
                $colspan = $jenis === 'absensi' ? 7 : 9;
            ?>
            <div class="hstack justify-content-between gap-3">
                <h4 class="mb-0">Data <?php echo e($jenis); ?></h4>
                <a href="<?php echo e(route('admin.presensi.print', $jenis)); ?>" class="btn btn-info btn-sm">Print</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="min-width: 15rem">Nama</th>
                            <?php if($jenis === 'absensi'): ?>
                                <th style="min-width: 10rem">Waktu</th>
                            <?php else: ?>
                                <th style="min-width: 10rem">Waktu Mulai</th>
                                <th style="min-width: 10rem">Waktu Selesai</th>
                                <th style="min-width: 7.5rem">Durasi</th>
                            <?php endif; ?>
                            <th style="min-width: 15rem">Alasan</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $presensi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($presensi->user->name ?? '-'); ?></td>
                                <?php if($jenis === 'absensi'): ?>
                                    <td class="text-center">
                                        <?php echo e(\Carbon\Carbon::parse($presensi->waktu)->format('d M Y H:i')); ?>

                                    </td>
                                <?php else: ?>
                                    <td class="text-center">
                                        <?php echo e($presensi->waktu_mulai ? \Carbon\Carbon::parse($presensi->waktu_mulai)->format('d M Y H:i') : '-'); ?>

                                    </td>
                                    <td class="text-center">
                                        <?php echo e($presensi->waktu_selesai ? \Carbon\Carbon::parse($presensi->waktu_selesai)->format('d M Y H:i') : '-'); ?>

                                    </td>
                                    <td class="text-center">
                                        <?php if($presensi->waktu_mulai && $presensi->waktu_selesai): ?>
                                            <?php echo e(number_format(\Carbon\Carbon::parse($presensi->waktu_mulai)->diffInMinutes($presensi->waktu_selesai), 2)); ?> menit
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                                <td><?php echo e($presensi->alasan ?? '-'); ?></td>
                                <td class="text-center">
                                    <?php if($presensi->bukti): ?>
                                        <a href="<?php echo e(asset('storage/' . $presensi->bukti)); ?>" target="_blank" class="btn btn-sm btn-outline-secondary">Lihat</a>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-<?php echo e(match($presensi->status) {
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        default => 'warning'
                                    }); ?>">
                                        <?php echo e(ucfirst($presensi->status)); ?>

                                    </span>
                                </td>
                                <td class="hstack gap-2 text-center">
                                    <?php if($presensi->status === 'pending'): ?>
                                        <form action="<?php echo e(route('admin.presensi.approval.handle', $presensi)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                        <form action="<?php echo e(route('admin.presensi.approval.handle', $presensi)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="<?php echo e($colspan); ?>" class="text-center">Belum ada data <?php echo e(strtolower($judul)); ?>.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\worksync\resources\views/admin/presensi/index.blade.php ENDPATH**/ ?>