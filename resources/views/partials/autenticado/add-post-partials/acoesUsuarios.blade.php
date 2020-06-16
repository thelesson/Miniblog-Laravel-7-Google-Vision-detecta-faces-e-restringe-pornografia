<div class='card card-small mb-3'>
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Ações</h6>
                  </div>
                  <div class='card-body p-0'>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                        <span class="d-flex mb-2">
                          <i class="material-icons mr-1">flag</i>

                          <strong class="mr-1">Status:</strong> <span id="status-publicacao">@if(isset($postEdit)) @if($postEdit->status ==="PUBLISHED") Publicado @elseif($postEdit->status ==="PENDING") Pendente @elseif($postEdit->status ==="DRAFT") Rejeitado @else Publicado @endif @else Pendente @endif</span>
                          <input class="form-control form-control-lg mb-3" id="hiddenStatus" name="status" type="hidden" value="PUBLISH">
                      </span>
                        <span class="d-flex mb-2">
                          <i class="material-icons mr-1">visibility</i>
                          <input class="form-control form-control-lg mb-3" id="hiddenVisibilidade" name="visibilidade" type="hidden" value="public">
                          <strong class="mr-1">Visibilidade:</strong>
                          <strong id="txt-visibilidade" class="text-success">Público</strong>
                         </span>
                        <span class="d-flex mb-2">
                          <i class="material-icons mr-1">calendar_today</i>
                          <input class="form-control form-control-lg mb-3" id="hiddenRestrito" name="restrito" type="hidden" value="nao">
                          <strong class="mr-1">Cont. Restrito:</strong> <span id="txt-restrito">Não</span>
                              </span>
                        <span class="d-flex">
                          <i class="material-icons mr-1">score</i>
                          <input class="form-control form-control-lg mb-3" id="hiddenSlug" name="slug" type="hidden" value="{{ isset($postEdit) ? ($postEdit->slug ? $postEdit->slug : 'text-text') : 'text-text'}}">
                    <strong class="mr-1">Slug:</strong><span id="textoSlug">{{ isset($postEdit) ? ($postEdit->slug ? $postEdit->slug : 'text-text') : 'text-text'}}
                    <a class="ml-auto" data-toggle="modal" data-target="#modalSlug" href="#">Alterar</a>  
                     </span>
                        
                        
                      </li>
                      <li class="list-group-item d-flex px-3">
                     
                        <button class="btn btn-sm btn-accent ml-auto" id="acoes">
                          <i class="material-icons">save</i> Criar Postagem</button>
                      </li>
                    </ul>
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
     <input id="slugp" type="text" value="{{ isset($postEdit) ? ($postEdit->slug ? $postEdit->slug : 'text-text') : 'text-text'}}"></input><br/>
     <span class="text text-danger" id="span-erro" style="display:none;">O formulário não pode ser salvo sem um slug de url</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" id="salvaSlugp" class="btn btn-primary">Salvar Alteração</button>
      </div>
    </div>
  </div>
</div>