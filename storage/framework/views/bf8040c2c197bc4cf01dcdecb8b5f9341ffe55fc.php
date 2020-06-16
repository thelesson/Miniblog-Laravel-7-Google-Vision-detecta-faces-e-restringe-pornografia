<div class="col-lg-12 col-md-12 col-sm-12 mb-4">

            <!-- End Page Header -->
            <!-- Default Light Table -->
            <div class="row">
              <div class="col">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Relatório</h6>
                  </div>
                  <div class="card-body p-0 pb-3 text-center">
                  <?php if(isset($favoritos)): ?>
                   
                    <table class="table table-responsive mb-0">
                      <thead class="bg-light">
              
                        <tr>
                       
                        <th scope="col" class="border-0">#</th>
                        <th scope="col" class="border-0">Titulo</th>
                        <th scope="col" class="border-0">Descrição</th>
                        <th scope="col" class="border-0">Autor</th>
                        <th scope="col" class="border-0">Ler postagem</th>
                       
                    
                          
                        </tr>
                      </thead>
                      <tbody>
                     
                     
                     <?php $__currentLoopData = $favoritos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                     <td>##</td>
                     <td><?php echo e($fav->title); ?></td>
                     <td><?php echo e($fav->excerpt); ?></td>
                     <?php $autor = \App\User::where('id',$fav->author_id)->first(); ?>
                     <td><?php echo e($autor->name); ?></td>
                     <td><a href="<?php echo e(route('postagem',$fav->slug)); ?>" target="_blank">Visitar</a></td>
                  
                     
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                   
                    </table>
                   
                    <?php else: ?>
                      <h5>Sem posts favoritados para exibir</h5>
                      <?php endif; ?>
                  </div>

                  <?php echo e($favoritos->links()); ?>

                </div>
              </div>
              
            </div>
            
              </div>
<?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/widgets/tabelaFavoritos.blade.php ENDPATH**/ ?>