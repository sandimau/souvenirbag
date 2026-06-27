<?php if($errors->any()): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>
<?php /**PATH /var/www/html/souvenirbag/resources/views/layouts/includes/errors.blade.php ENDPATH**/ ?>