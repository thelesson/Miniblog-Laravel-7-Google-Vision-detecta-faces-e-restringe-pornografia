
<header class="masthead" style="<?php if(!empty($pagina->image) && $pagina->on_off_background ===1): ?> background-image: url('<?php echo e(Voyager::image( $pagina->image)); ?>') <?php elseif(!empty($pagina->background_cor) && $pagina->on_off_background ===0): ?> background-color:<?php echo e($pagina->background_cor); ?> <?php elseif($pagina->on_off_background ===2 ): ?> background-image: url('<?php echo e(asset('frontend/img/home-bg.jpg')); ?>') <?php else: ?> background-image: url('<?php echo e(asset('frontend/img/home-bg.jpg')); ?>')  <?php endif; ?>">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1><?php echo e($pagina->title); ?></h1>
            <span class="subheading"><?php echo e($pagina->excerpt); ?></span>
          </div>
        </div>
      </div>
    </div>
  </header><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/header-generico.blade.php ENDPATH**/ ?>