<div class="col-lg-12 col-md-12 col-sm-12 mb-4">
<div class="page-header row no-gutters py-4">
             
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
                  <?php if(isset($contatos)): ?>
                    <table class="table table-responsive mb-0">
                      <thead class="bg-light">
                      
                        <tr>
                        <th scope="col" class="border-0">Nome</th>
                          <th scope="col" class="border-0">Email</th>
                          <th scope="col" class="border-0">Telefone</th>
                          <th scope="col" class="border-0">Mensagem</th>
                          <th scope="col" class="border-0">Criado em</th>
                          <th scope="col" class="border-0">Ultima Atualização</th>
                          <th scope="col" class="border-0">Ações</th>
                       
                    
                          
                        </tr>
                      </thead>
                      <tbody>
                     
                     
                     <?php $__currentLoopData = $contatos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     
                     <tr>
                    
                     <td> <?php if(isset($c->nome)): ?> <?php echo e($c->nome); ?> <?php endif; ?></td>
                     <td> <?php if(isset($c->email)): ?> <?php echo e($c->email); ?> <?php endif; ?></td>
                     <td><?php if(isset($c->telefone)): ?> <?php echo e($c->telefone); ?> <?php endif; ?></td>
                     
                     <td style="width: 100%;"><?php if(isset($c->mensagem)): ?> <?php echo e(\Illuminate\Support\Str::limit($c->mensagem, 150, $end='...')); ?><?php endif; ?></td>
                        <td><?php if(isset($c->created_at)): ?> <?php echo e($c->created_at->diffForHumans()); ?>(<?php echo e($c->created_at->format('d/m/Y')); ?>) <?php endif; ?></td>
                        <td><?php if(isset($c->updated_at)): ?>  <?php echo e($c->updated_at->diffForHumans()); ?> (<?php echo e($c->updated_at->format('d/m/Y')); ?>) <?php endif; ?></td>
                       
                         <td style=" width: 80%;"> <div><button style="width:100%;" class="btn btn-sm btn-accent ml-auto" data-toggle="modal" data-target="#modalgenerico<?php echo e($c->id); ?>" id="modalgeneriico<?php echo e($c->id); ?>">
                          <i class="material-icons">visibility</i></button>
                          
                         
                    <button style="width:100%;"  data-toggle="modal" data-target="#seguroDeletex<?php echo e($c->id); ?>" style="float:right;" class="btn btn-sm btn-danger ml-auto" id="acoes">
                          <i class="material-icons">delete_forever</i></button>
                     
                          </div>
                         
                      </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                   
                    </table>
                    <?php else: ?>
                      <h5>Tracker Desativado. habilite-o para acessar este recurso</h5>
                      <?php endif; ?>
                  </div>
                  <?php echo e($contatos->links()); ?>

                </div>
              </div>
              
            </div>
            <div >
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
  <div class="modal fade" id="seguroDeletex<?php echo e($cm->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div id="divA"></div>

            </div>
              </div>
             
<?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/widgets/tabelaContato.blade.php ENDPATH**/ ?>