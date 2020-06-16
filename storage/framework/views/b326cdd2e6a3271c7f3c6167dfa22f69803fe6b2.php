<?php $pode = \App\Settings::where('key','site.moderadores-notificacoes')->first();?>
              <?php $pode2 = \App\Settings::where('key','site.moderadores-contatos')->first();?>
<?php if($pode): ?>

                <?php if($pode->value==="NAO"): ?>
                  <?php if($regra->name ==="admin"): ?>
                    <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
                  <?php else: ?>
                     <?php if($pode2->value==="SIM"): ?>
                      <div class="col-lg-7 col-md-12 col-sm-12 mb-4">
                     <?php else: ?>
                      <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                     <?php endif; ?>
                  <?php endif; ?>
                <?php else: ?>
                 <?php if($pode2->value==="SIM"): ?>
                    <?php if($regra->name ==="admin"): ?>
                      <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
                     
                    <?php else: ?>
                      <?php if($pode->value==="SIM"): ?>
                       <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
                      <?php else: ?>
                      <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
                      <?php endif; ?>
                    <?php endif; ?>
                  <?php else: ?>
                  <?php if($regra->name ==="admin"): ?>
                      <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
                     
                    <?php else: ?>
                    <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
                  <?php endif; ?>
                     
                 <?php endif; ?>
                <?php endif; ?>
<?php else: ?>
<div class="col-lg-3 col-md-12 col-sm-12 mb-4">
<?php endif; ?>
                <div class="card card-small">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Minha Lista de Favoritos</h6>
                  </div>
                  <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                    <?php if(!empty($favoritos)): ?>
                    <?php $__currentLoopData = $favoritos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li class="list-group-item d-flex px-3">
                       <a href="<?php echo e(route('postagem',$f->slug)); ?>"> <span class="text-semibold text-fiord-blue"><?php echo e($f->title); ?></span></a>
                      
                      </li>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endif; ?>
                    </ul>
                  </div>
                  <div class="card-footer border-top">
                    
                      <div class="col text-right view-report">
                        <a href="<?php echo e(route('listaFavoritos')); ?>">Ver todos &rarr;</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/widgets/postsMaisAcessados.blade.php ENDPATH**/ ?>