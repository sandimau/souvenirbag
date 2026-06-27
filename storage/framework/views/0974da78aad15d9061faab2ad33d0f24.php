

<?php $__env->startSection('content'); ?>
    <div class="col-lg-6">
        <div class="card-group d-block d-md-flex row">
            <div class="card col-md-7 p-4 mb-0">
                <div class="card-body">
                    <h1 class="pb-3"><?php echo e(__('Login')); ?></h1>
                    <!-- Errors block -->
                    <?php echo $__env->make('layouts.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- / Errors block -->
                    <form action="<?php echo e(route('login')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="input-group mb-3"><span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-envelope-open')); ?>"></use>
                                </svg></span>
                            <input class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text"
                                name="email" placeholder="<?php echo e(__('Username')); ?>" required autofocus>
                            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="input-group mb-4"><span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-lock-locked')); ?>"></use>
                                </svg></span>
                            <input class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="password"
                                name="password" placeholder="<?php echo e(__('Password')); ?>" required>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="row">
                            
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit"><?php echo e(__('Login')); ?></button>
                            </div>
                            

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/souvenirbag/resources/views/auth/login.blade.php ENDPATH**/ ?>