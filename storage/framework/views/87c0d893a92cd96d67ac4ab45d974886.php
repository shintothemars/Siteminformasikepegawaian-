<nav class="navbar navbar-expand-lg bg-body-secondary">
    <div class="container g-5">
        <a class="navbar-brand" href="/">WorkSync</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-offcanvas">
            <?php if(auth()->guard()->check()): ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if(Auth::user()->role === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('admin/karyawan*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.karyawan.view')); ?>">Data Karyawan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('admin/presensi*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.presensi.view')); ?>">Data Presensi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('admin/cuti*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.cuti.view')); ?>">Data Cuti</a>
                        </li>
                    <?php elseif(Auth::user()->role === 'user'): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('user/profile*') ? 'active' : ''); ?>" href="<?php echo e(route('user.profile.view')); ?>">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('user/presensi*') ? 'active' : ''); ?>" href="<?php echo e(route('user.presensi.view')); ?>">Presensi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('user/cuti*') ? 'active' : ''); ?>" href="<?php echo e(route('user.cuti.view')); ?>">Pengajuan Cuti</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav hstack justify-content-between gap-3 ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text">
                            <?php echo e(Auth::user()->name); ?>

                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="<?php echo e(route('logout.handle')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                        </form>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav><?php /**PATH C:\xampp\htdocs\worksync\resources\views/_components/header.blade.php ENDPATH**/ ?>