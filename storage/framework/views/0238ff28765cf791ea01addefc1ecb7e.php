<?php $__env->startSection('content'); ?>
    <div class="hstack justify-content-between gap-3 mb-4">
        <h4 class="mb-0">Data Karyawan</h4>
        <a href="<?php echo e(route('admin.karyawan.create.view')); ?>" class="btn btn-success">Tambah</a>
    </div>

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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $karyawans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $karyawan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($karyawan->user->name); ?></td>
                        <td><?php echo e($karyawan->user->email); ?></td>
                        <td><?php echo e($karyawan->jabatan); ?></td>
                        <td class="d-flex gap-1">
                            <a href="<?php echo e(route('admin.karyawan.detail.view', $karyawan->id)); ?>" class="btn btn-sm btn-primary">Detail</a>
                            <a href="<?php echo e(route('admin.karyawan.print', $karyawan->id)); ?>" class="btn btn-sm btn-info">Print</a>
                            <form action="<?php echo e(route('admin.karyawan.delete.handle', $karyawan->user->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if($karyawans->isEmpty()): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data karyawan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\worksync\resources\views/admin/karyawan/index.blade.php ENDPATH**/ ?>