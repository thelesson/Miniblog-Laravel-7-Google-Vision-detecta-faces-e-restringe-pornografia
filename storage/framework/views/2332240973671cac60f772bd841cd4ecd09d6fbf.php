<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">

      <a class="navbar-brand" href="/"><?php echo e($tituloSite->value); ?></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          
          <?php if(Route::has('login')): ?>
               
                    <?php if(auth()->guard()->check()): ?>
                    <?= menu('website', 'partials.menuhook'); ?>
                 
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/home')); ?>">Área do Assinante</a>
                   </li>
                    <?php else: ?>
                    <?= menu('website', 'partials.menuhook'); ?>
                    <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a>
                   </li>
                        <?php if(Route::has('register')): ?>
                        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/register')); ?>">Registrar</a>
                   </li>
                         
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/menuprincipal.blade.php ENDPATH**/ ?>