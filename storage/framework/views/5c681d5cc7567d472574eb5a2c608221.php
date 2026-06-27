<?php if(Session::get('success', false)): ?>
    <?php $data = Session::get('success'); ?>
    <?php if(is_array($data)): ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-success" role="alert">
                <i class="fa fa-check"></i>
                <?php echo e($msg); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="alert alert-success" role="alert">
            <i class="fa fa-check"></i>
            <?php echo e($data); ?>

        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if(Session::get('danger', false) || Session::get('error', false)): ?>
    <?php $data = Session::get('danger', Session::get('error')); ?>
    <?php if(is_array($data)): ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-danger" role="alert">
                <i class="fa fa-exclamation-triangle"></i>
                <?php echo e($msg); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <i class="fa fa-exclamation-triangle"></i>
            <?php echo e($data); ?>

        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/html/souvenirbag/resources/views/layouts/includes/messages.blade.php ENDPATH**/ ?>