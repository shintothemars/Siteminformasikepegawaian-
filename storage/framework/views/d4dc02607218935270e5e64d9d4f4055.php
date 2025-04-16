<?php $__env->startSection('content'); ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>

    <form class="vstack gap-3" action="<?php echo e(route('login.handle')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div>
            <label class="form-label" id="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required autofocus>
        </div>
        <div>
            <label class="form-label" id="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\worksync\resources\views/auth/login.blade.php ENDPATH**/ ?>