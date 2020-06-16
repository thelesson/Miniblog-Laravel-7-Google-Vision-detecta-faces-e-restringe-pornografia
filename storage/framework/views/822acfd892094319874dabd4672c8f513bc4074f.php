<div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="card card-small">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Minha lista de Favoritos</h6>
                  </div>
                  <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                    <?php if(!empty($favoritos)): ?>
                   
                     <?php $__currentLoopData = $favoritos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 
                      <li class="list-group-item d-flex px-3">
                       <a href="<?php echo e(route('postagem',$f->slug)); ?>"> <span class="text-semibold text-fiord-blue"><?php echo e($f->title); ?></span></a>
                      
                      </li>
                    
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php else: ?>
                      <li class="list-group-item d-flex px-3">
                      <h1>Nada para exibir</h1>
                      </li>
                      <?php endif; ?>
                    </ul>
                  </div>
                  <div class="card-footer border-top">
                    <div class="row">
                    
                      <div class="col text-right view-report">
                        <a href="<?php echo e(route('listaFavoritos')); ?>">Ver todos &rarr;</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/widgets/postsMaisAcessadosUsuario.blade.php ENDPATH**/ ?>