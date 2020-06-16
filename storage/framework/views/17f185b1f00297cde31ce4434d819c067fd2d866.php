<div class="card card-small h-100">
<?php if($errors->any()): ?>
      <div class="alert alert-danger">
      <?php echo e(implode('', $errors->all(''))); ?></div>
<?php endif; ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info">
        <?php echo e(Session::get('message')); ?>

    </div>
<?php endif; ?>
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Enviar Nova Notificação</h6>
                  </div>
                  <div class="card-body d-flex flex-column">
                  <form name="enviaNoti" id="enviaNoti" action="<?php echo e(route('widgetNotificacao')); ?>" method = "post" validate>
        
                      <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail1" name="tituloNot" aria-describedby="emailHelp" placeholder="Titulo da Notificação"> </div>
                        <?php echo e(csrf_field()); ?>

                      <div class="form-group">
                        <textarea class="form-control" name="msgNot" placeholder="Texto da notificação"></textarea>
                      </div>
                      <div class="form-group">
                   
<div>
  <div class="form-group row">
    <label class="col-sm-12">
     Selecione Destinatários
    </label>

    <div class="col-sm-12">
      <select id="notSel" name="selNot" required>
        <option value="0">Enviar para todos </option>
        <option value="1" id="manual">Escolher manualmente por email</option>
        <option value="2" id="manualId">Escolher manualmente por id</option>
        </select>
    </div>
    <div id="g1" style="display:none;">
    <label class="col-sm-12">
     Insira um endereço de email
    </label>
    <div class="col-md-12">
    <input type="email" class="form-control" placeholder="Endereço de email" id="emailNot" name="emailNot"  data-validation-required-message="Por favor, insira seu email." value="email@exampppllle.com">
              
    </div>
    </div>
    <div id="g2" style="display:none;">
    <label class="col-sm-12">
     Insira o id do usuário
    </label>
    <div class="col-md-12">
    <input type="text" class="form-control" placeholder="Id do usuário" id="idNot" name="idNot"  value="x">
              
    </div>
    </div>
  </div>

  
</div>
                         </div>
                    
                      <div class="form-group mb-0">
                        <button type="submit" class="btn btn-accent">Enviar agora</button>
                      </div>
                    </form>
                  </div>
                </div><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/widgets/enviarNotificacoes.blade.php ENDPATH**/ ?>