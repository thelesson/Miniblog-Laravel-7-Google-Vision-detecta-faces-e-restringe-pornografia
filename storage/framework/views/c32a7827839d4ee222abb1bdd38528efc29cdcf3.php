<div class='card card-small mb-3'>
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Categorias * <span style="font-size:10px;"> não implementado</span></h6>
                  </div>
                  <?php $categorias= \App\Category::all();
                  $cC =  \App\Category::all()->count(); ?>
                  <div class='card-body p-0'>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item px-3 pb-2">
                      <?php if(!empty($categorias)): ?>
                      
                      <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                        <div <?php if($loop->iteration > 5): ?> class="ativado custom-control custom-checkbox mb-1" <?php else: ?> class="custom-control custom-checkbox mb-1" <?php endif; ?> >
                          <input type="checkbox" class="custom-control-input" id="category<?php echo e($cat->id); ?>" <?php if(isset($postEdit)): ?> <?php if($postEdit->category_id === $cat->id): ?> checked <?php endif; ?> <?php endif; ?>>
                          <label class="custom-control-label" for="category<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></label>
                        </div>
                        
                       
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($cC > 6): ?>
                        <h4  style="text-align:center;" class="btn btn-sm  ml-auto" id="btnVer">
                         --------- Ver  mais Categorias ----------  </h4><?php endif; ?>
                        <?php else: ?>
                        <h5>Não há categorias para exibir</h5>
                       <?php endif; ?>
                      </li>
                     
                    </ul>
                  </div>
                </div><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/add-post-partials/categorias.blade.php ENDPATH**/ ?>