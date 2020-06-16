<div class='card card-small mb-3'>
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Ações</h6>
                  </div>
                  <div class='card-body p-0'>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item p-3">
                        <span class="d-flex mb-2">
                          <i class="material-icons mr-1">flag</i>

                          <strong class="mr-1">Status:</strong> <span id="status-publicacao"><?php if(isset($postEdit)): ?> <?php if($postEdit->status ==="PUBLISHED"): ?> Publicado <?php elseif($postEdit->status ==="PENDING"): ?> Pendente <?php elseif($postEdit->status ==="DRAFT"): ?> Rejeitado <?php else: ?> Publicado <?php endif; ?> <?php else: ?> Publicado <?php endif; ?></span>
                          <input class="form-control form-control-lg mb-3" id="hiddenStatus" name="status" type="hidden" value="<?php echo e(isset($postEdit) ? ($postEdit->status ? $postEdit->status : 'PUBLISHED') : 'PUBLISHED'); ?>">
                    
                          <a class="ml-auto" data-toggle="modal" data-target="#modalStatus" href="#">Alterar</a>
                        </span>
                        <span class="d-flex mb-2">
                          <i class="material-icons mr-1">visibility</i>
                          <input class="form-control form-control-lg mb-3" id="hiddenVisibilidade" name="visibilidade" type="hidden" value="<?php echo e(isset($postEdit) ? ($postEdit->featured ===1 ? 'logado' : 'public') : 'public'); ?>">
                          <strong class="mr-1">Visibilidade:</strong>
                          <strong id="txt-visibilidade" class="<?php echo e(isset($postEdit) ? ($postEdit->featured ===1 ? 'text-warning' : 'text-success') : 'text-success'); ?>"><?php echo e(isset($postEdit) ? ($postEdit->featured ===1 ? 'Membros' : 'Público') : 'Público'); ?></strong>
                          <a class="ml-auto" data-toggle="modal" data-target="#modalVisibilidade" href="#">Alterar</a>
                        </span>
                        <span class="d-flex mb-2">
                          <i class="material-icons mr-1">calendar_today</i>
                          <input class="form-control form-control-lg mb-3" id="hiddenRestrito" name="restrito" type="hidden" value="nao">
                          <strong class="mr-1">Cont. Restrito:</strong> <span id="txt-restrito">Não</span>
                          <a class="ml-auto" data-toggle="modal" data-target="#modalRestrito" href="#">Alterar</a>
                        </span>
                        <span class="d-flex">
                          <i class="material-icons mr-1">score</i>
                          <input class="form-control form-control-lg mb-3" id="hiddenSlug" name="slug" type="hidden" value="<?php echo e(isset($postEdit) ? ($postEdit->slug ? $postEdit->slug : 'text-text') : 'text-text'); ?>">
                    <strong class="mr-1">Slug:</strong><span id="textoSlug"><?php echo e(isset($postEdit) ? ($postEdit->slug ? $postEdit->slug : 'text-text') : 'text-text'); ?>

                         </span> <a class="ml-auto" data-toggle="modal" data-target="#modalSlug" href="#">Alterar</a>  
                        </span>
                      
                        
                      </li>
                      <li class="list-group-item d-flex px-3">
                   
                       <button class="btn btn-sm btn-accent ml-auto" id="acoes" type="submit">
                          <i class="material-icons">save</i><?php if(isset($postEdit)): ?>Atualizar  <?php else: ?> Criar Postagem <?php endif; ?></button>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- Button trigger modal -->


<!-- ModalStatus-->
<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Alterar Status da Postagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <select id ="select-status" name="select-status" class="form-control form-control-lg">
  <option  <?php if(isset($postEdit)): ?> <?php if($postEdit->status ==="PUBLISHED"): ?> selected="selected" <?php endif; ?> <?php endif; ?> value="PUBLISHED" >Publicado </option>
  <option  <?php if(isset($postEdit)): ?> <?php if($postEdit->status ==="DRAFT"): ?> selected="selected" <?php endif; ?> <?php endif; ?> value="DRAFT">Rejeitado </option>
  <option  <?php if(isset($postEdit)): ?> <?php if($postEdit->status ==="PENDING"): ?> selected="selected" <?php endif; ?> <?php endif; ?> value="PENDING">Pendente</option>
</select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="btn-status">Salvar Alteração</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Visibilidade-->
<div class="modal fade" id="modalVisibilidade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Visibilidade desta Publicação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <select id="select-visibilidade" name="select-visibilidade" class="form-control form-control-lg">
  <option <?php if(isset($postEdit)): ?> <?php if($postEdit->featured ===0): ?> selected="selected" <?php endif; ?> <?php endif; ?> value="public" >Público </option>
  <option <?php if(isset($postEdit)): ?> <?php if($postEdit->featured ===1): ?> selected="selected" <?php endif; ?> <?php endif; ?> value="logado">Apenas para usuários registrados</option>
</select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="btn-visibilidade">Salvar Alteração</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Restrito-->
<div class="modal fade" id="modalRestrito" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Aviso de Conteúdo restrito</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h5>Ao selecionar restrição de postagem, uma mensagem de advertência perguntará ao usuário se deseja prosseguir.</h5>
      <h5>O superAdministrador poderá ajustar, no dashboard do superusuário, a calibração  do nivel da restrição</h5>
      <select class="form-control form-control-lg" name="select-restrito" id="select-restrito">
  <option value="nao" >Não </option>
  <option value="nudez">Sim - Imagens com  Nudez(Nu frontal, sexo explicito, etc)</option>
  <option value="violencia">Sim - Imagens com Violência(assasinato, sangue, etc)</option>
  <option value="nudez-violencia">Sim - Imagens com Nudez ou com Violência</option>
</select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="btn-restritox">Salvar Alteração</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Slug-->
<div class="modal fade" id="modalSlug" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Slug da Postagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <input id="slugp" type="text" value="<?php echo e(isset($postEdit) ? ($postEdit->slug ? $postEdit->slug : 'text-text') : 'text-text'); ?>"></input><br/>
     <span class="text text-danger" id="span-erro" style="display:none;">O formulário não pode ser salvo sem um slug de url</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" id="salvaSlugp" class="btn btn-primary">Salvar Alteração</button>
      </div>
    </div>
  </div>
</div>


<!--Modal Conteudo Sensivel-->

<!-- Button trigger modal -->
<?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/add-post-partials/acoes.blade.php ENDPATH**/ ?>