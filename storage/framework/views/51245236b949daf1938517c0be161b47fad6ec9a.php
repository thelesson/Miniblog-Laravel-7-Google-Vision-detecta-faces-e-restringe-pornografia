<div class="row">
<?php $a = count($posts); ?>
<?php if($a>0): ?>
<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card card-small card-post card-post--1 h-100">
                  <div class="card-post__image" style="<?php if(!empty($p->image)): ?>background-image: url('<?php echo e(Voyager::image( $p->image)); ?>'); <?php else: ?> background-color:blue; <?php endif; ?>">
                   <?php if($p->featured ===1): ?> <a href="#" class="card-post__category badge badge-pill badge-dark">Exclusivo para membros</a>
                   <?php endif; ?>
                   <?php if($p->status ==="PENDING"): ?> <a href="#" style="<?php if($p->featured ===1): ?> margin-top:10%; <?php endif; ?>" class="card-post__category badge badge-pill badge-warning">Aguardando Aprovação</a>
                   <?php endif; ?>
                   <?php if($p->status ==="DRAFT"): ?> <a href="#" style="<?php if($p->featured ===1): ?> margin-top:10%; <?php endif; ?>" class="card-post__category badge badge-pill badge-danger">Postagem Rejeitada</a>
                   <?php endif; ?> 
                   <?php if(isset($cambio)): ?>
                   <?php if($p->status ==="PUBLISHED"): ?> <a href="#" style="<?php if($p->featured ===1): ?> margin-top:10%; <?php endif; ?>" class="card-post__category badge badge-pill badge-success">Postagem aprovada</a>
                   <?php endif; ?>
                   <?php endif; ?>
                   <?php if(isset($p->autor->avatar)): ?>
                    <div class="card-post__author d-flex">
                      <a href="#" class="card-post__author-avatar card-post__author-avatar--small" style="background-image: url('<?php echo e(Voyager::image( $p->autor->avatar)); ?>');"></a>
                    </div>
                    <?php else: ?>
                    <?php $deletado  = \App\User::onlyTrashed()->find($p->author_id);?>
                    <?php if(!empty($deletado)): ?>
                   
                    <div class="card-post__author d-flex">
                      <a href="#" class="card-post__author-avatar card-post__author-avatar--small" style="background-image: url('<?php echo e(Voyager::image( $deletado->avatar)); ?>');"></a>
                    </div>

                    <?php else: ?>
                    <div class="card-post__author d-flex">
                      <a href="#" class="card-post__author-avatar card-post__author-avatar--small" style="background-image: url('<?php echo e(asset('autenticado/frontend/images/avatars/2.jpg')); ?>');"></a>
                    </div>
                    <?php endif; ?>
                     
                    
                    <?php endif; ?>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">
                      <a class="text-fiord-blue" target="_blank" href="post/<?php echo e($p->slug); ?>"><?php echo e(\Illuminate\Support\Str::limit($p->title, 15, $end='...')); ?></a>
                    </h5>
                    <p class="card-text d-inline-block mb-3"><?php echo e(\Illuminate\Support\Str::limit($p->excerpt, 80, $end='...')); ?></p>
                   
                    <span class="text-muted">Postado por
                    <?php if(isset($p->autor->name)): ?>
            <a href="#"><?php echo e($p->autor->name); ?></a>
            <?php else: ?>
            <?php $deletado  = \App\User::onlyTrashed()->find($p->author_id);?>
                    <?php if(!empty($deletado)): ?>
                    <a href="#"><?php echo e($deletado->name); ?></a>
                    <?php else: ?>
                    <a href="#">Admin</a>
                    <?php endif; ?>
            <?php endif; ?>
             <?php echo e($p->created_at->diffForHumans()); ?></span>
             <?php if(auth()->check()): ?>
                <?php $regra = \App\Role::where('id',auth()->user()->role_id)->first(); ?>
                       
                        <?php if(!empty($regra)): ?>
   <?php if($regra->name !=="user"): ?>
             <div>
             <a href="/post/edita/<?php echo e($p->id); ?>" style="float:left;" class="btn btn-sm btn-accent ml-auto" id="acoes" type="submit">
                          <i class="material-icons">edit</i>Editar</a>
                          <form class="add-new-post" id="delete-maroto" action="<?php echo e(route('postDeletar',$p->id)); ?>" method = "post">
                          <?php echo csrf_field(); ?>
                  <?php echo method_field('DELETE'); ?>
                    <button type="submit" style="float:right;" class="btn btn-sm btn-danger ml-auto" id="acoes">
                          <i class="material-icons">delete_forever</i> Deletar</button>
                      </form>   
                          </div>
                          <?php else: ?>
                          <?php if($p->status==="PENDING"): ?>
                          <div>
             <a href="/post/edita/<?php echo e($p->id); ?>" style="float:left;" class="btn btn-sm btn-accent ml-auto" id="acoes" type="submit">
                          <i class="material-icons">edit</i>Editar</a>
                          </div>
                          <?php endif; ?>
                          <?php endif; ?>
                          <?php endif; ?>
                          <?php endif; ?>
                  </div>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php echo e($posts->links()); ?>

              <?php else: ?>
           <div style="width:100%"> <h6 style="text-align:100%;">Você ainda não criou nenhuma postagem</h6></div>
            <?php endif; ?>
            </div>
            <?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/lista-blogs.blade.php ENDPATH**/ ?>