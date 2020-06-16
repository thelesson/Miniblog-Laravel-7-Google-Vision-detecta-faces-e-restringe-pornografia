<div class="row">
<?php if(auth()->check()): ?>
<?php $regra = \App\Role::where('id',auth()->user()->role_id)->first(); ?>
                       
                       <?php if(!empty($regra)): ?>
   <?php if($regra->name !=="user"): ?>
              <?php echo $__env->make('partials.autenticado.widgets.sessoesativas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <!-- Users Stats -->
              <?php echo $__env->make('partials.autenticado.widgets.estatisticas30diasusers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>          
              <!-- End Users Stats -->
              <!-- Users By Device Stats -->
              <?php echo $__env->make('partials.autenticado.widgets.dispositivosPorUser', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>          
             
              <!-- End Users By Device Stats -->
              <!-- New Draft Component -->
            
              <?php $pode = \App\Settings::where('key','site.moderadores-notificacoes')->first();?>
              <?php $pode2 = \App\Settings::where('key','site.moderadores-contatos')->first();?>
              <?php if($pode): ?>
                <?php if($pode->value==="SIM"): ?>
                      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <!-- Quick Post -->
                        <?php echo $__env->make('partials.autenticado.widgets.enviarNotificacoes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>          
                        <!-- End Quick Post -->
                      </div>
                <?php else: ?>
                   <?php if($regra->name ==="admin"): ?>
                       <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                          <!-- Quick Post -->
                        <?php echo $__env->make('partials.autenticado.widgets.enviarNotificacoes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>          
                          <!-- End Quick Post -->
                        </div>
                   <?php endif; ?>
                <?php endif; ?>
              <?php else: ?>
                   <?php if($regra->name ==="admin"): ?>
                       <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                          <!-- Quick Post -->
                        <?php echo $__env->make('partials.autenticado.widgets.enviarNotificacoes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>          
                          <!-- End Quick Post -->
                        </div>
                   <?php endif; ?>
              <?php endif; ?>
              
              <?php if($pode2): ?>
              <?php if($pode2->value==="SIM"): ?>
                   <?php echo $__env->make('partials.autenticado.widgets.msgContatosRecebidos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
                <?php else: ?>
                   <?php if($regra->name ==="admin"): ?>
                       <?php echo $__env->make('partials.autenticado.widgets.msgContatosRecebidos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
                   <?php endif; ?>
                <?php endif; ?>
              <?php else: ?>
                   <?php if($regra->name ==="admin"): ?>
                       <?php echo $__env->make('partials.autenticado.widgets.msgContatosRecebidos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
                   <?php endif; ?>
              <?php endif; ?>
              
              
              <!-- End Discussions Component -->
              <!-- Top Referrals Component -->
              <?php echo $__env->make('partials.autenticado.widgets.postsMaisAcessados', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
              <!-- End Top Referrals Component -->
            
   <?php else: ?>
             <?php echo $__env->make('partials.autenticado.widgets.sessoesativas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <!-- Users Stats -->
             <!-- End Users By Device Stats -->
              <!-- New Draft Component -->
              <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <!-- Quick Post -->
                <?php echo $__env->make('partials.autenticado.widgets.postsMaisAcessadosUsuario', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            
                <!-- End Quick Post -->
              </div>
              <!-- End New Draft Component -->
              <!-- Discussions Component -->
            <!-- End Discussions Component -->
              <!-- Top Referrals Component -->
              <!-- End Top Referrals Component -->
            
   
   <?php endif; ?>
   <?php else: ?>
   <span>Você não possui privilégios necessários para acessar este módulo</span>
  <?php endif; ?>
   <?php else: ?>
   <span>Você não possui privilégios necessários para acessar este módulo</span>
   <?php endif; ?>
             </div><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/cardscomplementaresEgraphs.blade.php ENDPATH**/ ?>