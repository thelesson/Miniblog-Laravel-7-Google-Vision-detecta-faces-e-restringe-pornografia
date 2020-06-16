<?php if(isset($visitantesTracker)): ?>
<!--tabela visitantes do site-->
<?php echo $__env->make('partials.autenticado.widgets.tabelavisitantes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--end-->
<?php elseif(isset($contatosTracker)): ?>
<?php echo $__env->make('partials.autenticado.widgets.tabelaContato', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(isset($notificacoesTracker)): ?>
<?php echo $__env->make('partials.autenticado.widgets.tabelaNotificacoes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(isset($favoritosTracker)): ?>
<?php echo $__env->make('partials.autenticado.widgets.tabelaFavoritos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(isset($errosTracker)): ?>
<?php echo $__env->make('partials.autenticado.widgets.tabelaErros', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php else: ?>

<div class="col-lg-12 col-md-12 col-sm-12 mb-4">
<div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Log de Atividade</span>
                <h3 class="page-title"><?php if(isset($cambio)): ?> Minhas Ações <?php else: ?> Ações dos Usuários <?php endif; ?></h3>
              </div>
            </div>
            <!-- End Page Header -->
            <!-- Default Light Table -->
            <div class="row">
              <div class="col">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Relatório</h6>
                  </div>
                  <div class="card-body p-0 pb-3 text-center">
                    <table class="table table-responsive mb-0">
                      <thead class="bg-light">
                      <?php if(!empty($logs)): ?>
                        <tr>
                        <?php if(isset($cambio)): ?>
                        <th scope="col" class="border-0">#</th>
                          <th scope="col" class="border-0">Ip</th>
                          <?php $verificaUsuarioLog = App\Role::where('id',auth()->user()->role_id)->first(); ?>
          
          <?php if(!empty($verificaUsuarioLog)): ?>
            <?php if($verificaUsuarioLog->name ==="admin"): ?>
            
            <th scope="col" class="border-0">Linha</th>
            <th scope="col" class="border-0">Tabela</th>
            <?php endif; ?>
                <?php endif; ?>
                         <th scope="col" class="border-0">Evento</th>
                          <th scope="col" class="border-0">Antes</th>
                          <th scope="col" class="border-0">Depois</th>
                          <th scope="col" class="border-0">Browser</th>
                       
                        <?php else: ?>
                        <th scope="col" class="border-0">#</th>
                          <th scope="col" class="border-0">Email</th>
                          <th scope="col" class="border-0">Ip</th>
                          <th scope="col" class="border-0">Linha</th>
                          <th scope="col" class="border-0">Tabela</th>
                          <th scope="col" class="border-0">Evento</th>
                          <th scope="col" class="border-0">Id do Usuário</th>
                          <th scope="col" class="border-0">Antes</th>
                          <th scope="col" class="border-0">Depois</th>
                          <th scope="col" class="border-0">Browser</th>
                        <?php endif; ?>
                          
                        </tr>
                      </thead>
                      <tbody>
                     
               
                          <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         
                          <tr>
                          <?php if(isset($cambio)): ?>
                          <td>##</td>
                         <td><?php echo e($ss->ip_address); ?></td>
                         <?php $verificaUsuarioLog = App\Role::where('id',auth()->user()->role_id)->first(); ?>
          
          <?php if(!empty($verificaUsuarioLog)): ?>
            <?php if($verificaUsuarioLog->name ==="admin"): ?>
            
                        <td><?php echo e($ss->row_id); ?></td>
                          <td><?php echo e($ss->table_name); ?></td>
            <?php endif; ?>
                <?php endif; ?>
                          
                          <td><?php echo e($ss->event); ?></td>
                          <td>
                          <?php echo e($ss->before); ?></td>
                          <td><?php echo e($ss->after); ?></td>
                          <td><?php echo e($ss->user_agent); ?></td>
                          <?php else: ?>
                          <td>##</td>
                          <td><?php $e= App\User::where('id',$ss->user_id)->first(); ?>
                          <?php if($e): ?>
                            <?php echo e($e->email); ?>

                          <?php else: ?> Nao detectado <?php endif; ?>
                         </td>
                          <td><?php echo e($ss->ip_address); ?></td>
                          <td><?php echo e($ss->row_id); ?></td>
                          <td><?php echo e($ss->table_name); ?></td>
                          <td><?php echo e($ss->event); ?></td>
                          <td><?php echo e($ss->user_id); ?></td>
                          <td>
                          <?php echo e($ss->before); ?></td>
                          <td><?php echo e($ss->after); ?></td>
                          <td><?php echo e($ss->user_agent); ?></td>
                          <?php endif; ?>
                         
                          
                         
                         
                        </tr>
                       
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                       
                      
                        
                        
                      </tbody>
                      <?php else: ?>
                     <tr> <td>Rastreador do Sistema desabilitado - Habilite-o para utilizar esta função </td></tr>
                      <?php endif; ?>
                    </table>
                    
                  </div>
                  <?php echo e($logs->links()); ?>

                </div>
              </div>
              
            </div>
            
              </div>

<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/logs.blade.php ENDPATH**/ ?>