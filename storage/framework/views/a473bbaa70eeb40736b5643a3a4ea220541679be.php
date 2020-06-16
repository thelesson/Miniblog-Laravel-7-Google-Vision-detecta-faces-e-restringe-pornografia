<div class="col-lg-12 col-md-12 col-sm-12 mb-4">
<div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Segurança - Informações de Sessões</span>
                <h3 class="page-title">Locais onde estive conectado</h3>
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
                      <?php if(!empty($sessaoAtual)): ?>
                        <tr>
                          <th scope="col" class="border-0">#</th>
                          <th scope="col" class="border-0">Email</th>
                          <th scope="col" class="border-0">Ip</th>
                          <th scope="col" class="border-0">É Mobile</th>
                          <th scope="col" class="border-0">Tipo Dispositivo</th>
                          <th scope="col" class="border-0">Plataforma</th>
                          <th scope="col" class="border-0">Vesão da Plataforma</th>
                          <th scope="col" class="border-0">Browser</th>
                          <th scope="col" class="border-0">Linguagem</th>
                        </tr>
                      </thead>
                      <tbody>
              
                        <tr>
                          <td style="background-color:green;color:white;">ONLINE AGORA</td>
                          <td><?php echo e(Auth()->user()->email); ?></td>
                          <td><?php echo e($sessaoAtual->client_ip); ?></td>
                          <td><?php if($sessaoAtual->device->is_mobile ===0): ?> Não <?php else: ?> Sim <?php endif; ?></td>
                          <td><?php echo e($sessaoAtual->device->kind); ?></td>
                          <td><?php echo e($sessaoAtual->device->platform); ?></td>
                          <td><?php if(!empty($sessaoAtual->device->plataform_version)): ?>
                          <?php echo e($sessaoAtual->device->plataform_version); ?> <?php else: ?> Não detectado <?php endif; ?></td>
                          <td><?php echo e($sessaoAtual->agent->browser); ?></td>
                          <td><?php echo e($sessaoAtual->language->preference); ?></td>
                         
                        </tr>
                      
                        <?php if(!empty($sessaoTodasDoLogado)): ?>
                          <?php $__currentLoopData = $sessaoTodasDoLogado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($sessaoAtual->uuid === $ss->uuid): ?>
                          <?php else: ?>
                          <tr>
                          <td>##</td>
                          <td><?php echo e(Auth()->user()->email); ?></td>
                          <td><?php echo e($ss->client_ip); ?></td>
                          <td><?php if($ss->device->is_mobile ===0): ?> Não <?php else: ?> Sim <?php endif; ?></td>
                          <td><?php echo e($ss->device->kind); ?></td>
                          <td><?php echo e($ss->device->platform); ?></td>
                          <td><?php if(!empty($ss->device->plataform_version)): ?>
                          <?php echo e($ss->device->plataform_version); ?> <?php else: ?> Não detectado <?php endif; ?></td>
                          <td><?php echo e($ss->agent->browser); ?></td>
                          <td><?php echo e($ss->language->preference); ?></td>
                         
                         
                        </tr>
                        <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                       
                      
                        
                        
                      </tbody>
                      <?php else: ?>
                     <tr> <td>Rastreador do Sistema desabilitado - Habilite-o para utilizar esta função </td></tr>
                      <?php endif; ?>
                    </table>
                    
                  </div>
                  <?php echo e($sessaoTodasDoLogado->links()); ?>

                </div>
              </div>
              
            </div>
            
              </div><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/widgets/sessoesativas.blade.php ENDPATH**/ ?>