 <!-- End Page Header -->
 <div class="row">
              <div class="col-lg-9 col-md-12">
                <!-- Add New Post Form -->
                <div class="card card-small mb-3">
                <div class="card-header">
    
  </div>
  
                  <div class="card-body">
                  @if($errors->any())
      <div class="alert alert-danger">
      {{ implode('', $errors->all('')) }}</div>
@endif
@if(Session::has('message'))
    <div class="alert alert-info">
        {{ Session::get('message') }}
    </div>
@endif
@if(isset($postEdit))
<form class="add-new-post" id="quill-form" method="post" action="{{ route('updatePost', $postEdit->id) }}">

        @method('PATCH')
@else
<form class="add-new-post" id="quill-form" action="{{route('salvaPost')}}" method = "post">
@endif                  

                    <label for="titulo">Titulo</label>
                    {{ csrf_field() }}
                    <input id="FileIDs" type="hidden" name="FileIDs" value="{{$usersImage}} -- <?php echo asset("storage/app/public/tempupload/ca.jpg")?>">
                   
                    @if($errors->has('title'))
    <div class="error" style="color:red;width:100%;height:10%;">{{ $errors->first('title') }}</div>
@endif
                      <input class="form-control form-control-lg mb-3" id="tituloui" name="title" type="text" placeholder="Seu titulo de Post" value="@if(isset($postEdit)){{$postEdit->title}}@endif" required>
                     <label for="subtitulo">Subtitulo</label> 
                     @if($errors->has('subtitle'))
    <div class="error" style="color:red;width:100%;height:10%;">{{ $errors->first('subtitle') }}</div>
@endif
                      <input class="form-control form-control-lg mb-3" id="subtitulo" name="subtitle" type="text" placeholder="Subtitulo do Post" value="@if(isset($postEdit)){{$postEdit->subtitle}}@endif" required>
                      <label for="excerpt">Pequena Descrição - * Aparecerá na lista de posts</label>
                      @if($errors->has('excerpt'))
    <div class="error" style="color:red;width:100%;height:10%;">{{ $errors->first('excerpt') }}</div>
@endif 
                      <input class="form-control form-control-lg mb-3" id="excerpt" name="excerpt" type="text" placeholder="Pequena descrição do Post" value="@if(isset($postEdit)){{$postEdit->excerpt}}@endif" required>
                      
                      <label for="editor-container">Corpo da Postagem</label>
                      @if($errors->has('body'))
    <div class="error" style="color:red;width:100%;height:10%;">{{ $errors->first('body') }}</div>
@endif 
                      <div id="editor-container" class="add-new-post__editor mb-1"></div>
                      <input type="hidden" name="body" id="body" value="@if(isset($postEdit)){{$postEdit->body}}@endif">
                      
               
                   
                  </div>
                </div>
                <!-- / Add New Post Form -->
                @if(isset($postEdit))
                @if($postEdit->image)
                <div class="card card-small mb-3" id="card-salvado-img">
                <div class="card">
  <div class="card-header">
    Imagem de Capa Salva
  </div>
  <div class="card-body">
   <!-- <h5 class="card-title">Special title treatment</h5>-->
    <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
    <div class="image-area">       
    <img src="{{ Voyager::image( $postEdit->image) }}" > 
            <button type="button" class="remove-image" id="btnDelimg" style="display: inline;">&#215;</button> 
                     
</div>
  </div>
</div>
 
                 
                  </div>
                  @endif
                  @endif
                <div class="card card-small mb-3" id="cardUpload" style="@if(isset($postEdit)) @if($postEdit->image != null) display:none!important; @endif @endif">
                <div class="card">
  <div class="card-header">
   @if(isset($postEdit)) Envie uma nova capa para o post @else  Capa do Post @endif
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
                @if (auth()->check())
                @php $regra = \App\Role::where('id',auth()->user()->role_id)->first(); @endphp
                       
                        @if(!empty($regra))
   @if ($regra->name !=="user")
                @include('partials.autenticado.add-post-partials.acoes')
                @else
                @include('partials.autenticado.add-post-partials.acoesUsuarios')
                @endif
                @else
                <span>Sem permissão para visualizar este módulo</span>
                @endif
                @else
                <span>O superadmin revogou o acesso a este módulo para usuários não autenticados!</span>
                @endif
                <!-- / Post Overview -->
                <!-- Post Overview -->
                @include('partials.autenticado.add-post-partials.categorias')
                @include('partials.autenticado.add-post-partials.seoCard')
                <!-- / Post Overview -->
                </form>
                @include('notify::messages')
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
              </div>