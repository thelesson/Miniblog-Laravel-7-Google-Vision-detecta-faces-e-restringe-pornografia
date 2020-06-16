 <!-- End Page Header -->
 <div class="row">
              <div class="col-lg-9 col-md-12">
                <!-- Add New Post Form -->
                <div class="card card-small mb-3">
                <div class="card-header">
    
  </div>
  
                  <div class="card-body">
                  <?php if($errors->any()): ?>
      <div class="alert alert-danger">
      <?php echo e(implode('', $errors->all(''))); ?></div>
<?php endif; ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info">
        <?php echo e(Session::get('message')); ?>

    </div>
<?php endif; ?>
<?php if(isset($postEdit)): ?>
<form class="add-new-post" id="quill-form" method="post" action="<?php echo e(route('updatePost', $postEdit->id)); ?>">

        <?php echo method_field('PATCH'); ?>
<?php else: ?>
<form class="add-new-post" id="quill-form" action="<?php echo e(route('salvaPost')); ?>" method = "post">
<?php endif; ?>                  

                    <label for="titulo">Titulo</label>
                    <?php echo e(csrf_field()); ?>

                    <input id="FileIDs" type="hidden" name="FileIDs" value="<?php echo e($usersImage); ?> -- <?php echo asset("storage/app/public/tempupload/ca.jpg")?>">
                   
                    <?php if($errors->has('title')): ?>
    <div class="error" style="color:red;width:100%;height:10%;"><?php echo e($errors->first('title')); ?></div>
<?php endif; ?>
                      <input class="form-control form-control-lg mb-3" id="tituloui" name="title" type="text" placeholder="Seu titulo de Post" value="<?php if(isset($postEdit)): ?><?php echo e($postEdit->title); ?><?php endif; ?>" required>
                     <label for="subtitulo">Subtitulo</label> 
                     <?php if($errors->has('subtitle')): ?>
    <div class="error" style="color:red;width:100%;height:10%;"><?php echo e($errors->first('subtitle')); ?></div>
<?php endif; ?>
                      <input class="form-control form-control-lg mb-3" id="subtitulo" name="subtitle" type="text" placeholder="Subtitulo do Post" value="<?php if(isset($postEdit)): ?><?php echo e($postEdit->subtitle); ?><?php endif; ?>" required>
                      <label for="excerpt">Pequena Descrição - * Aparecerá na lista de posts</label>
                      <?php if($errors->has('excerpt')): ?>
    <div class="error" style="color:red;width:100%;height:10%;"><?php echo e($errors->first('excerpt')); ?></div>
<?php endif; ?> 
                      <input class="form-control form-control-lg mb-3" id="excerpt" name="excerpt" type="text" placeholder="Pequena descrição do Post" value="<?php if(isset($postEdit)): ?><?php echo e($postEdit->excerpt); ?><?php endif; ?>" required>
                      
                      <label for="editor-container">Corpo da Postagem</label>
                      <?php if($errors->has('body')): ?>
    <div class="error" style="color:red;width:100%;height:10%;"><?php echo e($errors->first('body')); ?></div>
<?php endif; ?> 
                      <div id="editor-container" class="add-new-post__editor mb-1"></div>
                      <input type="hidden" name="body" id="body" value="<?php if(isset($postEdit)): ?><?php echo e($postEdit->body); ?><?php endif; ?>">
                      
               
                   
                  </div>
                </div>
                <!-- / Add New Post Form -->
                <?php if(isset($postEdit)): ?>
                <?php if($postEdit->image): ?>
                <div class="card card-small mb-3" id="card-salvado-img">
                <div class="card">
  <div class="card-header">
    Imagem de Capa Salva
  </div>
  <div class="card-body">
   <!-- <h5 class="card-title">Special title treatment</h5>-->
    <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
    <div class="image-area">       
    <img src="<?php echo e(Voyager::image( $postEdit->image)); ?>" > 
            <button type="button" class="remove-image" id="btnDelimg" style="display: inline;">&#215;</button> 
                     
</div>
  </div>
</div>
 
                 
                  </div>
                  <?php endif; ?>
                  <?php endif; ?>
                <div class="card card-small mb-3" id="cardUpload" style="<?php if(isset($postEdit)): ?> <?php if($postEdit->image != null): ?> display:none!important; <?php endif; ?> <?php endif; ?>">
                <div class="card">
  <div class="card-header">
   <?php if(isset($postEdit)): ?> Envie uma nova capa para o post <?php else: ?>  Capa do Post <?php endif; ?>
  </div>
  <div class="card-body">
   <!-- <h5 class="card-title">Special title treatment</h5>-->
    <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
    <input type="file" id="image" name="image" class="filepond">
    <input class="form-control form-control-lg mb-3" id="removidoOunao" name="removidoOunao" type="hidden" value="0">
             

  </div>
</div>
 
                 
                  </div>
              
              </div>
              <div class="col-lg-3 col-md-12">
                <!-- Post Overview -->
                <?php if(auth()->check()): ?>
                <?php $regra = \App\Role::where('id',auth()->user()->role_id)->first(); ?>
                       
                        <?php if(!empty($regra)): ?>
   <?php if($regra->name !=="user"): ?>
                <?php echo $__env->make('partials.autenticado.add-post-partials.acoes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php else: ?>
                <?php echo $__env->make('partials.autenticado.add-post-partials.acoesUsuarios', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                <?php else: ?>
                <span>Sem permissão para visualizar este módulo</span>
                <?php endif; ?>
                <?php else: ?>
                <span>O superadmin revogou o acesso a este módulo para usuários não autenticados!</span>
                <?php endif; ?>
                <!-- / Post Overview -->
                <!-- Post Overview -->
                <?php echo $__env->make('partials.autenticado.add-post-partials.categorias', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('partials.autenticado.add-post-partials.seoCard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- / Post Overview -->
                </form>
                <?php echo $__env->make('notify::messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <button type="button" style="display:none!important;" id="sensivel" class="btn btn-primary" data-toggle="modal" data-target="#modalSensivel">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="modalSensivel" tabindex="-1" role="dialog" aria-labelledby="modalSensivel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Aviso de Conteúdo impróprio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p>Você tentou realizar o upload de uma imagem que não está de acordo com os nossos termos de uso</p>
      <p><b>Status:</b> <span style="color:red;">Upload negado por conter nudez ou sexo explicito </span></p>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
              </div><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/add-post.blade.php ENDPATH**/ ?>