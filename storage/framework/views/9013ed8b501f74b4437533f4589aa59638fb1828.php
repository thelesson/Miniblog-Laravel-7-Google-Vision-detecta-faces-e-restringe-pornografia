
<header class="masthead" style="<?php if(!empty($capaInicial->value) && $on_offx->value ==='1'): ?> background-image: url('<?php echo e(Voyager::image( $capaInicial->value)); ?>') <?php elseif(!empty($capaInicialCor->value) && $on_offx->value ==='0'): ?> background-color:<?php echo e($capaInicialCor->value); ?> <?php elseif($on_offx->value ==='2' ): ?> background-image: url('<?php echo e(asset('frontend/img/home-bg.jpg')); ?>') <?php else: ?> background-image: url('<?php echo e(asset('frontend/img/home-bg.jpg')); ?>')  <?php endif; ?>">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
          <?php if(!empty($tituloPagina->value)): ?>
            <h1><?php echo e($tituloPagina->value); ?></h1>
            <?php else: ?>
            <h1>Contatos</h1>
            <?php endif; ?>
            <?php if(!empty($subtituloSite->value)): ?>
            <span class="subheading"><?php echo e($subtituloSite->value); ?></span>
            <?php else: ?>
            <span class="subheading">Página de Contatos</span>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </header><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/header-contato.blade.php ENDPATH**/ ?>