<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        <?php if(trim($__env->yieldContent('title'))): ?>
            <?php echo $__env->yieldContent('title'); ?> | <?php echo e(config('app.name', 'sablonku')); ?>

        <?php else: ?>
            <?php echo e(config('app.name', 'sablonku')); ?>

        <?php endif; ?>
    </title>
    <meta name="theme-color" content="#ffffff">
    <?php echo $__env->yieldPushContent('before-styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('build/assets/app-c3db2d24.css')); ?>">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <?php echo $__env->yieldPushContent('after-styles'); ?>
</head>

<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <?php if(session()->has('Logo')): ?>
                <img style="height:50px"
                    src="<?php echo e(url('uploads/Logo/' . session('Logo'))); ?>"
                    alt="" srcset="">
            <?php endif; ?>
        </div>
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <!-- Header block -->
        <?php echo $__env->make('layouts.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- / Header block -->

        <div class="body flex-grow-1 px-3">
            <div class="container-fluid">
                <!-- Errors block -->
                <?php echo $__env->make('layouts.includes.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- / Errors block -->
                <div class="mb-4"><?php echo $__env->yieldContent('content'); ?></div>
            </div>
        </div>

        <!-- Footer block -->
        <?php echo $__env->make('layouts.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- / Footer block -->
    </div>

    <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Yakin ingin menghapus data ini?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <h4>pilih "hapus" jika anda yakin</h4>
                </div>
                <div class="modal-footer">
                    <form action="" method="post">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('delete')); ?>

                        <p>
                            <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger waves-effect">Hapus</button>
                        </p>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Scripts -->
    <?php echo $__env->yieldPushContent('before-scripts'); ?>
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/coreui.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.PrintArea.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <?php echo $__env->yieldPushContent('after-scripts'); ?>
    <!-- / Scripts -->

</body>

</html>
<?php /**PATH /var/www/html/souvenirbag/resources/views/layouts/app.blade.php ENDPATH**/ ?>