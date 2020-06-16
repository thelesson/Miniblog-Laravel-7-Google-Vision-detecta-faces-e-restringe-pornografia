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
                  <?php if(isset($erros)): ?>
                   
                    <table class="table table-responsive mb-0">
                      <thead class="bg-light">
              
                        <tr>
                       
                        <th scope="col" class="border-0">Id</th>
                        <th scope="col" class="border-0">Código</th>
                        <th scope="col" class="border-0">Mensagem</th>
                        <th scope="col" class="border-0">Criado em </th>
                        <th scope="col" class="border-0">Atualizado em</th>
                       
                    
                          
                        </tr>
                      </thead>
                      <tbody>
                     <?php dd($erros);?>
                     <?php $__currentLoopData = $erros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                     <td><?php echo e($erro->id); ?></td>
                     <td><?php echo e($erro->code); ?></td>
                     <td><?php echo e($erro->message); ?></td>
                     <td><?php echo e($erro->created_at); ?></td>
                     <td><?php echo e($erro->update_at); ?></td>
                  
                     
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                  
                    </table>
                   
                    <?php else: ?>
                      <h5>Sem posts favoritados para exibir</h5>
                      <?php endif; ?>
                  </div>

                  <?php echo e($erro->links()); ?>

                </div>
              </div>
              
            </div>
            
              </div>
<?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/widgets/tabelaErros.blade.php ENDPATH**/ ?>