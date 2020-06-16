 <!-- Default Light Table -->
 <div class="row">
              <div class="col-lg-4">
                <div class="card card-small mb-4 pt-3">
                  <div class="card-header border-bottom text-center">
                    <div class="mb-3 mx-auto">
                      <img class="rounded-circle" src="<?php echo e(Voyager::image( $usuario->avatar)); ?>" alt="User Avatar" width="110" height="110" style="   width: 150px;
    height: 150px;

    /* fill the container, preserving aspect ratio, and cropping to fit */
    background-size: cover;

    /* center the image vertically and horizontally */
    background-position: top center;

    /* round the edges to a circle with border radius 1/2 container size */
    border-radius: 50%;"> </div>
                    <h4 class="mb-0"><?php echo e($usuario->name); ?></h4>
                    <span class="text-muted d-block mb-2">Membro  <?php echo e($usuario->created_at->diffForHumans()); ?></span>
                  
                  </div>
                  <ul class="list-group list-group-flush">
                   
                  </ul>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Detalhes da Conta</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col">
                        <?php if($errors->any()): ?>
      <div class="alert alert-danger">
      <?php echo e(implode('', $errors->all(''))); ?></div>
<?php endif; ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info">
        <?php echo e(Session::get('message')); ?>

    </div>
<?php endif; ?>
                        <form class="add-new-post" id="quill-formX" method="post" action="<?php echo e(route('updatePerfil', $usuario->id)); ?>">

<?php echo method_field('PATCH'); ?>
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <label for="feFirstName">Nome</label>
                                <input type="text" class="form-control" id="feFirstName" name="nome" placeholder="First Name" value="<?php echo e($usuario->name); ?>"> </div>
                                <?php echo e(csrf_field()); ?>

                            </div>
                            <div class="form-row">
                         
                              <div class="form-group col-md-6">
                                <label for="feEmailAddress">Email</label>
                                <input type="email" class="form-control" id="feEmailAddress" name="email" placeholder="Email" value="<?php echo e($usuario->email); ?>"> </div>
                              <div class="form-group col-md-6">
                                <label for="fePassword">Password</label>
                                <input type="password" class="form-control" id="fePassword" name="senha" placeholder="deixe em branco para não alterar" > </div>
                              <input type="hidden" id="tk0" name="tk0" value="<?php echo e(\Crypt::encrypt('senha')); ?>">
                              <input type="hidden" id="tk" name="tk" value="0">
                             
                                <div class="form-group col-md-12" style="display:none;" id="bloco-old-p">
                                <div class="alert alert-primary" role="alert">
Para sua segurança, insira a senha antiga para prosseguir com a operação
</div>
                                <label for="oldPass">Senha Atual</label>
                                <input type="password" class="form-control" id="oldPass" name="senha-antiga" > </div>
                            </div>
                           
                            <div class="card card-small mb-3" id="cardUpload" style="<?php if(isset($postEdit)): ?> <?php if($postEdit->image != null): ?> display:none!important; <?php endif; ?> <?php endif; ?>">
                <div class="card">
  <div class="card-header">
    Envie sua foto
  </div>
  <div class="card-body">
   <!-- <h5 class="card-title">Special title treatment</h5>-->
    <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
    <input type="file" id="image" name="image" class="filepond">
    <input class="form-control form-control-lg mb-3" id="removidoOunao" name="removidoOunao" type="hidden" value="0">
             

  </div>
</div>
 
                 
                  </div>
                           
                            <button type="submit" class="btn btn-accent">Atualizar Conta</button>
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- End Default Light Table -->
            <?php echo $__env->make('notify::messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <button type="button" style="display:none!important;" id="sensivel" class="btn btn-primary" data-toggle="modal" data-target="#modalSensivel">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="modalSensivel" tabindex="-1" role="dialog" aria-labelledby="modalSensivel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload Negado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php 
        $googleVisionCheck = \App\Settings::where('key', 'site.google-vision-avatar2')->first();
        $googleVisionCheck2 = \App\Settings::where('key', 'site.google-vision-avatar')->first(); 
        ?>

        <?php if($googleVisionCheck->value ==="SIM" && $googleVisionCheck2->value ==="SIM"): ?>
        <p>Não é permitido realizar o upload de imagens que contenham nudez/sexo e que não possua face humana visivel</p>
      <p><b>Status:</b> <span style="color:red;">Upload negado por conter nudez/sexo explicito e/ou ausência de rosto humano </span></p>
      
        <?php endif; ?>
        <?php if($googleVisionCheck->value ==="SIM" && $googleVisionCheck2->value ==="NAO"): ?>
        <p>O sistema não conseguiu identificar face humana na imagem enviada. Somente imagens que contenha face humana visivel será aceita</p>
      <p><b>Status:</b> <span style="color:red;">Upload negado por ausência de rosto humano </span></p>
      
        <?php endif; ?>
        <?php if($googleVisionCheck->value ==="NAO" && $googleVisionCheck2->value ==="SIM"): ?>
        <p>Não é permitido o envio de imagens que contenham nudez/sexo explicito</p>
      <p><b>Status:</b> <span style="color:red;">Upload negado por conter nudez/sexo explicito </span></p>
      
        <?php endif; ?>
        <?php if($googleVisionCheck->value ==="NAO" && $googleVisionCheck2->value ==="NAO"): ?>
        <p>Por favor contate o administrador do sistema - Erro: S-23</p>
      <p><b>Status:</b> <span style="color:red;">O admin negou o upload desta imagem </span></p>
      
        <?php endif; ?>
        
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
              

<?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/perfil-update.blade.php ENDPATH**/ ?>