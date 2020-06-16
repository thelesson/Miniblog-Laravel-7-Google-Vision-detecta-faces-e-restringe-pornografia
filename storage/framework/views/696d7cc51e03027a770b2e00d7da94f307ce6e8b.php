<!-- Small Stats Blocks -->

<div class="row">
<?php if(auth()->check()): ?>
                        <?php $regra = \App\Role::where('id',auth()->user()->role_id)->first(); ?>
                        <?php if(!empty($regra)): ?>
   <?php if($regra->name !=="user"): ?>
<?php echo $__env->make('partials.autenticado.widgets.cards.postagensPublicadas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
<?php echo $__env->make('partials.autenticado.widgets.cards.paginasPublicadas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php echo $__env->make('partials.autenticado.widgets.cards.usuariosTotais', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php echo $__env->make('partials.autenticado.widgets.cards.novosUsers30dias', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php echo $__env->make('partials.autenticado.widgets.cards.usuariosOnline', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
<?php else: ?>
      
<?php echo $__env->make('partials.autenticado.widgets.cards.usuarios.postagensEnviadas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
<?php echo $__env->make('partials.autenticado.widgets.cards.usuarios.postagensAprovadas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
<?php echo $__env->make('partials.autenticado.widgets.cards.usuarios.postagensRejeitadas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php echo $__env->make('partials.autenticado.widgets.cards.usuarios.postagensPendentes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php echo $__env->make('partials.autenticado.widgets.cards.usuarios.favoritos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
      <?php endif; ?>

   <?php else: ?>

<span>A permissão para acessar este conteúdo foi revogada. Por favor, entre em contato com o Administrador do sistema! </span>
  
    <?php endif; ?>
   <?php else: ?>
   <span>A permissão para acessar este conteúdo foi revogada. Por favor, entre em contato com o Administrador do sistema! </span>
  
<?php endif; ?>

  <!-- End Small Stats Blocks -->
  
  </div><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/cards.blade.php ENDPATH**/ ?>