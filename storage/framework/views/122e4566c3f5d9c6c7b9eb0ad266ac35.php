<?php
    $navOpen = fn (...$patterns) => collect($patterns)->contains(fn ($p) => request()->is($p));

    $orderKeuanganPaths = ['admin/order/belumLunas*'];
    $orderOmzetPaths = ['admin/order/omzet*'];
    $orderProduksiExcluded = ['admin/order/dashboard*', 'admin/order/marketplace*', 'admin/order/belumLunas*', 'admin/order/omzet*', 'admin/order/arsip*'];

    $activeOrderProses = request()->is('admin/order/dashboard*');
    $activeOrderArsip = request()->is('admin/order') || (request()->is('admin/order/*') && !request()->is(...$orderProduksiExcluded));
    $activeOrderOnline = request()->is('admin/order/marketplace*');
    $activeBelumLunas = request()->is(...$orderKeuanganPaths);
    $activeOmzetTahunan = request()->is('admin/order/omzet') || request()->is('admin/order/omzet/*');
    $activeOmzetBulanan = request()->is('admin/order/omzetBulan*');
    $activeOmzetMarketplace = request()->is('admin/marketplace/omzetBulan*');

    $activeMarketplaceAnalisa = request()->is('admin/analisaMarketplace*');
    $activeAnalisaBeban = request()->is('admin/analisa/beban*');
    $activeAnalisaOperasional = request()->is('admin/analisa/operasional*');
    $activeAnalisaStok = request()->is('admin/analisa/stok*');

    $openProduksiOrder = $activeOrderProses || $activeOrderArsip || $activeOrderOnline;
    $openData = $navOpen('admin/kontaks*');
    $openKeuangan = $navOpen('admin/akunKategoris*', 'admin/akunDetails*', 'admin/belanja*', 'admin/hutang*', 'admin/kas') || $activeBelumLunas;
    $openMarketplace = $navOpen('admin/projectmp*', 'admin/marketplaceProduk*', 'admin/marketplaces*') || $activeMarketplaceAnalisa;
    $openInventory = $navOpen('admin/produk-kategori-utama*', 'admin/pemakaian*', 'admin/opnames*', 'admin/po*');
    $openProduksiFactory = $navOpen('admin/produksi*', 'admin/produkProduksi*') && !$navOpen('admin/produksis*');
    $openPegawai = $navOpen('admin/members*', 'admin/nonaktif', 'admin/freelance*', 'admin/absensi*', 'admin/ars*');
    $openAnalisa = $activeAnalisaBeban || $activeAnalisaOperasional || $activeAnalisaStok;
    $openLaporan = $navOpen('admin/neraca*', 'admin/labarugi*', 'admin/labakotor*', 'admin/tunjangan*', 'admin/penggajian*', 'admin/operasional*');
    $openOmzet = $activeOmzetTahunan || $activeOmzetBulanan || $activeOmzetMarketplace || $navOpen('admin/aset*', 'admin/produk/omzet*');
    $openUserMgmt = $navOpen('users*', 'admin/level*', 'admin/bagian*');
    $openConfig = $navOpen('roles*', 'permissions*', 'admin/produksis*', 'admin/speks*', 'admin/pemproses*', 'admin/sistem*', 'admin/linkPages*');
?>

<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-group<?php echo e($openProduksiOrder ? ' show' : ''); ?>" aria-expanded="<?php echo e($openProduksiOrder ? 'true' : 'false'); ?>">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-industry')); ?>"></use>
            </svg>
            Produksi
        </a>
        <ul class="nav-group-items">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_access')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e($activeOrderProses ? 'active' : ''); ?>" href="<?php echo e(route('order.dashboard')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-task')); ?>"></use>
                        </svg>
                        Proses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e($activeOrderArsip ? 'active' : ''); ?>" href="<?php echo e(route('order.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-folder-open')); ?>"></use>
                        </svg>
                        Arsip Offline
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e($activeOrderOnline ? 'active' : ''); ?>"
                        href="<?php echo e(route('order.marketplace')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-cloud-download')); ?>"></use>
                        </svg>
                        Arsip Online
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>

    <li class="nav-group<?php echo e($openData ? ' show' : ''); ?>" aria-expanded="<?php echo e($openData ? 'true' : 'false'); ?>">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-storage')); ?>"></use>
            </svg>
            Data
        </a>
        <ul class="nav-group-items">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('kontak_access')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('kontaks*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('kontaks.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-user')); ?>"></use>
                        </svg>
                        <?php echo e(__('Kontak')); ?>

                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>

    <li class="nav-group<?php echo e($openKeuangan ? ' show' : ''); ?>" aria-expanded="<?php echo e($openKeuangan ? 'true' : 'false'); ?>">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-dollar')); ?>"></use>
            </svg>
            Keuangan
        </a>
        <ul class="nav-group-items">
            <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'super')): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('akun_access')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('akunKategoris*') ? 'active' : ''); ?>"
                            href="<?php echo e(route('akunDetails.index')); ?>">
                            <svg class="nav-icon">
                                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-calculator')); ?>"></use>
                            </svg>
                            <?php echo e(__('akuns')); ?>

                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('akun_detail_access')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('akunDetails*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('akunDetail.kas')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-wallet')); ?>"></use>
                        </svg>
                        <?php echo e(__('kas')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e($activeBelumLunas ? 'active' : ''); ?>"
                        href="<?php echo e(route('order.unpaid')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-credit-card')); ?>"></use>
                        </svg>
                        <?php echo e(__('belum lunas')); ?>

                    </a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('keuangan')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('belanjas*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('belanja.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-cart')); ?>"></use>
                        </svg>
                        Belanja
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('hutang*') ? 'active' : ''); ?>" href="<?php echo e(route('hutang.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-file')); ?>"></use>
                        </svg>
                        Hutang/Piutang
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>

    <li class="nav-group<?php echo e($openMarketplace ? ' show' : ''); ?>" aria-expanded="<?php echo e($openMarketplace ? 'true' : 'false'); ?>">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-basket')); ?>"></use>
            </svg>
            Marketplace
        </a>
        <ul class="nav-group-items">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('marketplace_access')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('admin/projectmp/dashboard*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('projectmp.dashboard')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-speedometer')); ?>"></use>
                        </svg>
                        <?php echo e(__('Proses Custom')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('admin/projectmp/packing*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('projectmp.packing')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-truck')); ?>"></use>
                        </svg>
                        <?php echo e(__('Proses Packing')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('admin/projectmp/index*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('projectmp.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-folder-open')); ?>"></use>
                        </svg>
                        <?php echo e(__('Arsip Order')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('admin/marketplaceProduk*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('marketplaces.produk')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-tags')); ?>"></use>
                        </svg>
                        <?php echo e(__('Produk')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('marketplaces*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('marketplaces.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-settings')); ?>"></use>
                        </svg>
                        <?php echo e(__('Config')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e($activeMarketplaceAnalisa ? 'active' : ''); ?>"
                        href="<?php echo e(route('marketplaces.analisa')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-chart-line')); ?>"></use>
                        </svg>
                        <?php echo e(__('Analisa')); ?>

                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>

    <li class="nav-group<?php echo e($openInventory ? ' show' : ''); ?>" aria-expanded="<?php echo e($openInventory ? 'true' : 'false'); ?>">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-inbox')); ?>"></use>
            </svg>
            Inventory
        </a>
        <ul class="nav-group-items">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('produk_access')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('produk-kategori-utama*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('produk-kategori-utama.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-basket')); ?>"></use>
                        </svg>
                        <?php echo e(__('Produk')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('pemakaian*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('pemakaian.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-basket')); ?>"></use>
                        </svg>
                        Pemakaian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('opnames*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('opnames.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-clipboard')); ?>"></use>
                        </svg>
                        <?php echo e(__('Opname')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('po*') ? 'active' : ''); ?>" href="<?php echo e(route('po.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-description')); ?>"></use>
                        </svg>
                        <?php echo e(__('PO')); ?>

                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>

    <li class="nav-group<?php echo e($openProduksiFactory ? ' show' : ''); ?>" aria-expanded="<?php echo e($openProduksiFactory ? 'true' : 'false'); ?>">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-inbox')); ?>"></use>
            </svg>
            Produksi
        </a>
        <ul class="nav-group-items">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('produk_access')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('produksi*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('produksi.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-factory')); ?>"></use>
                        </svg>
                        Proses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('produksi*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('produkProduksi.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-factory')); ?>"></use>
                        </svg>
                        Produk
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>

    <li class="nav-group<?php echo e($openPegawai ? ' show' : ''); ?>" aria-expanded="<?php echo e($openPegawai ? 'true' : 'false'); ?>">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-people')); ?>"></use>
            </svg>
            Pegawai
        </a>
        <ul class="nav-group-items">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('member_access')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('members*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('members.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-user')); ?>"></use>
                        </svg>
                        Karyawan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('members*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('members.freelance')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-user-follow')); ?>"></use>
                        </svg>
                        Freelance
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('absensi*') ? 'active' : ''); ?>" href="<?php echo e(route('absensi.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-calendar')); ?>"></use>
                        </svg>
                        Absensi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('member*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('members.nonaktif')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-user-unfollow')); ?>"></use>
                        </svg>
                        <?php echo e(__('non aktif')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('ars*') ? 'active' : ''); ?>" href="<?php echo e(route('ars.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-headphones')); ?>"></use>
                        </svg>
                        <?php echo e(__('cs')); ?>

                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>

    <li class="nav-group<?php echo e($openAnalisa ? ' show' : ''); ?>" aria-expanded="<?php echo e($openAnalisa ? 'true' : 'false'); ?>">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-chart')); ?>"></use>
            </svg>
            Analisa
        </a>
        <ul class="nav-group-items">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('laporan_access')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e($activeAnalisaBeban ? 'active' : ''); ?>"
                        href="<?php echo e(route('analisa.beban')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-chart-line')); ?>"></use>
                        </svg>
                        Analisa Beban
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e($activeAnalisaOperasional ? 'active' : ''); ?>"
                        href="<?php echo e(route('analisa.operasional')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-bar-chart')); ?>"></use>
                        </svg>
                        Analisa Operasional
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e($activeAnalisaStok ? 'active' : ''); ?>"
                        href="<?php echo e(route('analisa.stok')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-chart-pie')); ?>"></use>
                        </svg>
                        Analisa Stok
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>

    <li class="nav-group<?php echo e($openLaporan ? ' show' : ''); ?>" aria-expanded="<?php echo e($openLaporan ? 'true' : 'false'); ?>">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-description')); ?>"></use>
            </svg>
            Laporan
        </a>
        <ul class="nav-group-items">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('laporan_access')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('laporan*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('laporan.tunjangan')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-dollar')); ?>"></use>
                        </svg>
                        <?php echo e(__('Tunjangan')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('laporan*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('laporan.penggajian')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-wallet')); ?>"></use>
                        </svg>
                        <?php echo e(__('Penggajian')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('laporan*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('laporan.neraca')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-balance-scale')); ?>"></use>
                        </svg>
                        <?php echo e(__('Neraca')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('laporan*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('laporan.labarugi')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-chart-line')); ?>"></use>
                        </svg>
                        <?php echo e(__('Laba Rugi')); ?>

                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>

    <li class="nav-group<?php echo e($openOmzet ? ' show' : ''); ?>" aria-expanded="<?php echo e($openOmzet ? 'true' : 'false'); ?>">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-graph')); ?>"></use>
            </svg>
            Omzet
        </a>
        <ul class="nav-group-items">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('omzet_access')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e($activeOmzetTahunan ? 'active' : ''); ?>"
                        href="<?php echo e(route('order.omzet')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-calendar')); ?>"></use>
                        </svg>
                        <?php echo e(__('Tahunan')); ?>

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e($activeOmzetBulanan ? 'active' : ''); ?>"
                        href="<?php echo e(route('order.omzetBulan')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-calendar')); ?>"></use>
                        </svg>
                        <?php echo e(__('Bulanan')); ?>

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e($activeOmzetMarketplace ? 'active' : ''); ?>"
                        href="<?php echo e(route('marketplaces.omzetBulan')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-basket')); ?>"></use>
                        </svg>
                        <?php echo e(__('Marketplace')); ?>

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('produk*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('produk.aset')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-building')); ?>"></use>
                        </svg>
                        <?php echo e(__('Aset')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('produk*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('produk.omzet')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-chart-line')); ?>"></use>
                        </svg>
                        <?php echo e(__('Produk Omzet')); ?>

                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>

    <li class="nav-group<?php echo e($openUserMgmt ? ' show' : ''); ?>" aria-expanded="<?php echo e($openUserMgmt ? 'true' : 'false'); ?>">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-people')); ?>"></use>
            </svg>
            User Management
        </a>
        <ul class="nav-group-items">

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_access')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('users*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('users.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-user')); ?>"></use>
                        </svg>
                        <?php echo e(__('Users')); ?>

                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('level_access')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('levels*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('level.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-layers')); ?>"></use>
                        </svg>
                        <?php echo e(__('Levels')); ?>

                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bagian_access')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('bagians*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('bagian.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-sitemap')); ?>"></use>
                        </svg>
                        <?php echo e(__('Bagians')); ?>

                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
    <li class="nav-group<?php echo e($openConfig ? ' show' : ''); ?>" aria-expanded="<?php echo e($openConfig ? 'true' : 'false'); ?>">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-cog')); ?>"></use>
            </svg>
            Config
        </a>
        <ul class="nav-group-items">
            <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'super')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('roles*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('roles.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-group')); ?>"></use>
                        </svg>
                        <?php echo e(__('Roles')); ?>

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('permissions*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('permissions.index')); ?>">
                        <svg class="nav-icon">
                            <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-lock-locked')); ?>"></use>
                        </svg>
                        <?php echo e(__('Permissions')); ?>

                    </a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->is('produksis*') ? 'active' : ''); ?>"
                    href="<?php echo e(route('produksis.index')); ?>">
                    <svg class="nav-icon">
                        <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-wrench')); ?>"></use>
                    </svg>
                    <?php echo e(__('Setup Produksi')); ?>

                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->is('speks*') ? 'active' : ''); ?>"
                    href="<?php echo e(route('speks.index')); ?>">
                    <svg class="nav-icon">
                        <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-list')); ?>"></use>
                    </svg>
                    <?php echo e(__('Spek Produk')); ?>

                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->is('pemproses*') ? 'active' : ''); ?>"
                    href="<?php echo e(route('pemproses.index')); ?>">
                    <svg class="nav-icon">
                        <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-factory')); ?>"></use>
                    </svg>
                    <?php echo e(__('Pemproses')); ?>

                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->is('sistems*') ? 'active' : ''); ?>"
                    href="<?php echo e(route('sistem.index')); ?>">
                    <svg class="nav-icon">
                        <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-settings')); ?>"></use>
                    </svg>
                    <?php echo e(__('Sistem')); ?>

                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->is('admin/linkPages*') ? 'active' : ''); ?>"
                    href="<?php echo e(route('linkPages.index')); ?>">
                    <svg class="nav-icon">
                        <use xlink:href="<?php echo e(asset('icons/coreui.svg#cil-link')); ?>"></use>
                    </svg>
                    <?php echo e(__('Link Pages')); ?>

                </a>
            </li>
        </ul>
    </li>
</ul>

<?php $__env->startPush('after-scripts'); ?>
<script>
    window.addEventListener('load', function () {
        document.querySelectorAll('.sidebar-nav .nav-group').forEach(function (group) {
            if (!group.querySelector('.nav-group-items .nav-link.active')) {
                return;
            }

            group.classList.add('show');
            group.setAttribute('aria-expanded', 'true');

            var items = group.querySelector('.nav-group-items');
            if (items) {
                items.style.removeProperty('height');
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/souvenirbag/resources/views/layouts/navigation.blade.php ENDPATH**/ ?>