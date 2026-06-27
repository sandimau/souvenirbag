<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-menu')); ?>"></use>
            </svg>
        </button>
        <a class="header-brand d-md-none" href="#">
            <?php if(session()->has('logo')): ?>
                <img style="height:35px"
                    src="<?php echo e(url('storage/logo/' . session('logo')[0] . session('logo')[1] . '/' . session('logo')[2] . session('logo')[3] . '/' . session('logo'))); ?>"
                    alt="" srcset="">
            <?php endif; ?>
        </a>
        <?php if(auth()->guard()->check()): ?>
            <ul class="header-nav ms-auto">
                <li class="nav-item">
                    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'super|Manager')): ?>
                        <a class="nav-link py-0" href="<?php echo e(route('dashboard')); ?>">
                            <svg class="icon me-2">
                                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-refresh')); ?>"></use>
                            </svg>
                            <button class="btn btn-primary">
                                Dashboard <span class="badge badge-primary"></span>
                            </button>
                        </a>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <div class="nav-link py-0">
                        <?php echo e(date('d-m-Y')); ?>

                    </div>
                </li>
                <li class="nav-item dropdown ms-auto">
                    <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <div class="avatar">
                            <img class="avatar-img" src="<?php echo e(asset('img/default-avatar.jpg')); ?>">
                        </div>
                        <?php echo e(Auth::user()->name); ?>

                    </a>
                    <div style="z-index: 5" class="dropdown-menu dropdown-menu-end pt-0">
                        <a class="dropdown-item" href="<?php echo e(route('whattodo')); ?>">
                            <svg class="icon me-2">
                                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-airplay')); ?>"></use>
                            </svg> What To Do
                        </a>

                        <a class="dropdown-item" href="<?php echo e(route('profile.cuti', Auth::user()->id)); ?>">
                            <svg class="icon me-2">
                                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-user')); ?>"></use>
                            </svg>
                            <?php echo e(__('Cuti')); ?>

                        </a>

                        <a class="dropdown-item" href="<?php echo e(route('profile.gaji', Auth::user()->id)); ?>">
                            <svg class="icon me-2">
                                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-user')); ?>"></use>
                            </svg>
                            <?php echo e(__('Gaji')); ?>

                        </a>

                        <a class="dropdown-item" href="<?php echo e(route('profile.lembur', Auth::user()->id)); ?>">
                            <svg class="icon me-2">
                                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-user')); ?>"></use>
                            </svg>
                            <?php echo e(__('Lembur')); ?>

                        </a>

                        <a class="dropdown-item" href="<?php echo e(route('profile.show', Auth::user()->id)); ?>">
                            <svg class="icon me-2">
                                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-user')); ?>"></use>
                            </svg>
                            <?php echo e(__('Ganti Password')); ?>

                        </a>

                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="icon me-2">
                                    <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-account-logout')); ?>"></use>
                                </svg>
                                <?php echo e(__('Logout')); ?>

                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</header>
<?php /**PATH /var/www/html/souvenirbag/resources/views/layouts/includes/header.blade.php ENDPATH**/ ?>