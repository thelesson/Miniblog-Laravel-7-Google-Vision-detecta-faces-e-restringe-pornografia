<div class="col-lg-12 col-md-12 col-sm-12 mb-4">
<div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Log de Atividade</span>
                <h3 class="page-title"><?php if(isset($visitantesTracker)): ?> Registro de Visitantes ultimos 30 dias  <?php else: ?> Erro <?php endif; ?></h3>
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
                  <?php if(isset($sessions)): ?>
                    <table class="table table-responsive mb-0">
                      <thead class="bg-light">
                      
                        <tr>
                       
                        <th scope="col" class="border-0">#</th>
                        <th scope="col" class="border-0">Email</th>
                          <th scope="col" class="border-0">Ip</th>
                          <th scope="col" class="border-0">País/Cidade</th>
                          <th scope="col" class="border-0">Dispositivo</th>
                          <th scope="col" class="border-0">Navegador</th>
                          <th scope="col" class="border-0">Origem</th>
                          <th scope="col" class="border-0">Ultima Atividade</th>
                       
                    
                          
                        </tr>
                      </thead>
                      <tbody>
                     
                     
                     <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                     <td  style="<?php if($session->is_robot): ?> <?php if($session->is_robot === 1 ): ?> background-color:red;color:white; <?php endif; ?> <?php endif; ?>" ><?php if($session->is_robot): ?> <?php if($session->is_robot === 1 ): ?> Robô <?php else: ?> ## <?php endif; ?> <?php else: ?> ## <?php endif; ?></td>
                     <td> <?php if(isset($session->user->email)): ?> <?php echo e($session->user->email); ?> <?php endif; ?></td>
                     <td> <?php if(isset($session->client_ip)): ?><?php echo e($session->client_ip); ?> <?php endif; ?></td>
                     <td><?php if(isset($session->user->geo_ip)): ?><?php echo e($session->user->geo_ip); ?> <?php else: ?> Não Detectado <?php endif; ?></td>
                     
                     <td><?php if(isset($session->user->device)): ?>[<?php echo e($session->user->device); ?>][<?php echo e($session->user->device->model); ?>][<?php echo e($session->user->device->plataform); ?>] - [<?php echo e($session->user->device->plataform_version); ?>] <?php else: ?> Não Detectado <?php endif; ?></td>
                        <td><?php if(isset($session->agent)): ?><?php echo e($session->agent->name); ?> [<?php echo e($session->agent->browser); ?>][<?php echo e($session->agent->browser_version); ?>] <?php else: ?> Não Detectado <?php endif; ?></td>
                        <td><?php if(isset($session->referer->url)): ?><?php echo e($session->referer->url); ?> <?php endif; ?></td>
                        <td><?php if(isset($session->referer->updated_at)): ?><?php echo e($session->referer->updated_at); ?> <?php endif; ?></td>
                      </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                   
                    </table>
                    <?php else: ?>
                      <h5>Tracker Desativado. habilite-o para acessar este recurso</h5>
                      <?php endif; ?>
                  </div>
                
                </div>
              </div>
              
            </div>
            
              </div>
<?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/widgets/tabelavisitantes.blade.php ENDPATH**/ ?>