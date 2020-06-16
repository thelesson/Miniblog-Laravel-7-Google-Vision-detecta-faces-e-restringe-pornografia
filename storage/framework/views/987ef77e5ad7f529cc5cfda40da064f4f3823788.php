<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo e(route('voyager.dashboard')); ?>">
                    <div class="logo-icon-container">
                        <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
                        <?php if($admin_logo_img == ''): ?>
                            <img src="<?php echo e(voyager_asset('images/logo-icon-light.png')); ?>" alt="Logo Icon">
                        <?php else: ?>
                            <img src="<?php echo e(Voyager::image($admin_logo_img)); ?>" alt="Logo Icon">
                        <?php endif; ?>
                    </div>
                    <div class="title"><?php echo e(Voyager::setting('admin.title', 'VOYAGER')); ?></div>
                </a>
            </div><!-- .navbar-header -->

            <div class="panel widget center bgimage"
                 style="background-image:url(<?php echo e(Voyager::image( Voyager::setting('admin.bg_image'), voyager_asset('images/bg.jpg') )); ?>); background-size: cover; background-position: 0px;">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <img src="<?php echo e($user_avatar); ?>" class="avatar" alt="<?php echo e(Auth::user()->name); ?> avatar">
                    <h4><?php echo e(ucwords(Auth::user()->name)); ?></h4>
                    <p><?php echo e(Auth::user()->email); ?></p>

                    <a href="<?php echo e(route('voyager.profile')); ?>" class="btn btn-primary"><?php echo e(__('voyager::generic.profile')); ?></a>
                    <div style="clear:both"></div>
                </div>
            </div>

        </div>
        <div id="adminmenu">
            <admin-menu :items="<?php echo e(menu('admin', '_json')); ?>"></admin-menu>
        </div>
    </nav>
</div>
<?php /**PATH C:\xampp\htdocs\miniblog\vendor\tcg\voyager\src/../resources/views/dashboard/sidebar.blade.php ENDPATH**/ ?>