<div class="col-lg-5 col-md-12 col-sm-12 mb-4">
<?php if(isset($contatos)): ?>

<div class="card card-small blog-comments">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Mensagens de Contato Recebidas</h6>
                  </div>
                  <div class="card-body p-0">
                  <?php $__currentLoopData = $contatos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 
                    <div class="blog-comments__item d-flex p-3">
                      <div class="blog-comments__avatar mr-3">
                     <?php $usuarioC = App\User::where('email',$c->email)->count(); ?>
                     <?php if(!empty($usuarioC)): ?>
                     <?php if($usuarioC > 0): ?>
                     <?php $usuar = App\User::where('email',$c->email)->first(); ?>
                     <img src="<?php echo e(Voyager::image( $usuar->avatar)); ?>" alt="User avatar" /> </div>
                     <?php else: ?>
                     <img src="<?php echo e(asset('autenticado/frontend/images/avatars/2.jpg')); ?>" alt="User avatar" /> </div>
                      <?php endif; ?>
                     <?php else: ?>
                     <img src="<?php echo e(asset('autenticado/frontend/images/avatars/2.jpg')); ?>" alt="User avatar" /> </div>
                      <?php endif; ?>
                       <div class="blog-comments__content">
                        <div class="blog-comments__meta text-muted">
                          <a class="text-secondary" href="#"><?php echo e($c->nome); ?></a> enviou uma
                          <a class="text-secondary" href="#">nova mensagem</a>
                          <span class="text-muted"><?php echo e($c->created_at->diffForHumans()); ?></span>
                        </div>
                        <p class="m-0 my-1 mb-2 text-muted"><?php if(isset($c->mensagem)): ?> <?php echo e(\Illuminate\Support\Str::limit($c->mensagem, 150, $end='...')); ?><?php endif; ?></p>
                        <div class="blog-comments__actions">
                          <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-white" data-toggle="modal" data-target="#modalgenerico<?php echo e($c->id); ?>">
                              <span class="text-success">
                                <i class="material-icons">visibility</i>
                              </span> Ler Mensagem </button>
                          
                             
                    <button style="width:100%;"  data-toggle="modal" data-target="#seguroDelete<?php echo e($c->id); ?>" style="float:right;" class="btn btn-white" id="axcoes">
                    <span class="text-danger">
                                <i class="material-icons">clear</i>
                              </span> Deletar </button>
                    
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<h3>Nenhuma mensagem de contato para exibir</h3>
<?php endif; ?>
                
                   
                  </div>
                  <div class="card-footer border-top">
                    <div class="row">
                      <div class="col text-center view-report">
                        <a href="/seguro/contatos" class="btn btn-white">Ver todas as mensagens de contato recebidas</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php $__currentLoopData = $contatos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <!-- ModalGenerico-->
<div class="modal fade" id="modalgenerico<?php echo e($cm->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mensagem Recebida</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <?php echo e($cm->mensagem); ?>

      </div>
      <div class="modal-footer">
         
          </div>
    </div>
  </div>
</div>
      <!-- SegurancaDelete-->
      <div class="modal fade" id="seguroDelete<?php echo e($cm->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Exclua este item com segurança</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <h4>Para sua segurança clique no botão abaixo para deletar</h4>
    <form action="<?php echo e(route('contatosDeletar',$cm->id)); ?>" method = "post">
                          <?php echo csrf_field(); ?>
                  <?php echo method_field('DELETE'); ?>
                    <button style="width:100%;" type="submit" style="float:right;" class="btn btn-danger" id="axcoes">
                    <span class="text-white">
                                <i class="material-icons">clear</i>
                              </span> Deletar </button>
                      </form> 
      </div>
      <div class="modal-footer">
         
          </div>
    </div>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/widgets/msgContatosRecebidos.blade.php ENDPATH**/ ?>