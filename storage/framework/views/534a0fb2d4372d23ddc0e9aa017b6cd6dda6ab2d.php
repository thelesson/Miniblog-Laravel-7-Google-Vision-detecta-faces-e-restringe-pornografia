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
                  <?php if(isset($notificacoes)): ?>
                  <?php ?>
                    <table class="table table-responsive mb-0">
                      <thead class="bg-light">
                      
                        <tr>
                       
                        <th scope="col" class="border-0">#</th>
                        <th scope="col" class="border-0">Titulo</th>
                          <th scope="col" class="border-0">Mensagem</th>
                       
                    
                          
                        </tr>
                      </thead>
                      <tbody>
                     
                     
                     <?php $__currentLoopData = $notificacoes->paginate(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $not): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                     <td>##</td>
                     <td> <?php if(isset($not->data)): ?>  <?php echo e($not->data['greeting']); ?> <?php endif; ?></td>
                  
                     <td> <?php if(isset($not->data)): ?>  <?php echo e($not->data['body']); ?> <?php endif; ?></td>
                     
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                   
                    </table>
                   
                    <?php else: ?>
                      <h5>Sem notificações no momento!</h5>
                      <?php endif; ?>
                  </div>

                  <?php echo e($notificacoes->paginate(10)->links()); ?>

                </div>
              </div>
              
            </div>
            
              </div>
<?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/widgets/tabelaNotificacoes.blade.php ENDPATH**/ ?>