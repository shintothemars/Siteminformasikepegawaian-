<?php $__env->startSection('content'); ?>
    <h4 class="text-center mb-4">Pengajuan Cuti Karyawan</h4>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th style="min-width: 10rem">Nama</th>
                    <th style="min-width: 7.5rem">Dari</th>
                    <th style="min-width: 7.5rem">Hingga</th>
                    <th style="min-width: 15rem">Alasan</th>
                    <th>Saya</th>
                    <th>Umum</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $cutis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $myApproval = $cuti->approvals->firstWhere('user_id', auth()->id());
                        $total = $cuti->approvals->count();
                        $approved = $cuti->approvals->where('status', 'approved')->count();
                        $rejected = $cuti->approvals->where('status', 'rejected')->count();

                        if ($rejected > 0) {
                            $overallStatus = 'Ditolak';
                            $badge = 'danger';
                        } elseif ($approved === $total) {
                            $overallStatus = 'Disetujui';
                            $badge = 'success';
                        } else {
                            $overallStatus = 'Menunggu';
                            $badge = 'secondary';
                        }
                    ?>
                    <tr>
                        <td><?php echo e($cuti->user->name); ?></td>
                        <td class="text-center"><?php echo e(\Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M Y')); ?></td>
                        <td class="text-center"><?php echo e(\Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M Y')); ?></td>
                        <td><?php echo e($cuti->alasan); ?></td>
                        <td class="text-center">
                            <?php if($myApproval): ?>
                                <span class="badge bg-<?php echo e($myApproval->status === 'approved' ? 'success' : ($myApproval->status === 'rejected' ? 'danger' : 'secondary')); ?>">
                                    <?php echo e(ucfirst($myApproval->status)); ?>

                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning">Belum Ditugaskan</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-<?php echo e($badge); ?>"><?php echo e($overallStatus); ?></span>
                        </td>
                        <td class="text-center text-nowrap">
                            <?php if($myApproval && $myApproval->status === 'pending'): ?>
                                <form action="<?php echo e(route('admin.cuti.approval', $cuti->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-sm btn-success">Setuju</button>
                                </form>
                                <form action="<?php echo e(route('admin.cuti.approval', $cuti->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">Sudah Diproses</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada pengajuan cuti.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\worksync\resources\views/admin/cuti/index.blade.php ENDPATH**/ ?>