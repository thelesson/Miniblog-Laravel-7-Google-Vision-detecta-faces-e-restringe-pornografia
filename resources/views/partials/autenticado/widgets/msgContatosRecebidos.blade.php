<div class="col-lg-5 col-md-12 col-sm-12 mb-4">
@if(isset($contatos))

<div class="card card-small blog-comments">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Mensagens de Contato Recebidas</h6>
                  </div>
                  <div class="card-body p-0">
                  @foreach($contatos as $c)
                 
                    <div class="blog-comments__item d-flex p-3">
                      <div class="blog-comments__avatar mr-3">
                     @php $usuarioC = App\User::where('email',$c->email)->count(); @endphp
                     @if(!empty($usuarioC))
                     @if($usuarioC > 0)
                     @php $usuar = App\User::where('email',$c->email)->first(); @endphp
                     <img src="{{ Voyager::image( $usuar->avatar) }}" alt="User avatar" /> </div>
                     @else
                     <img src="{{ asset('autenticado/frontend/images/avatars/2.jpg') }}" alt="User avatar" /> </div>
                      @endif
                     @else
                     <img src="{{ asset('autenticado/frontend/images/avatars/2.jpg') }}" alt="User avatar" /> </div>
                      @endif
                       <div class="blog-comments__content">
                        <div class="blog-comments__meta text-muted">
                          <a class="text-secondary" href="#">{{$c->nome}}</a> enviou uma
                          <a class="text-secondary" href="#">nova mensagem</a>
                          <span class="text-muted">{{$c->created_at->diffForHumans()}}</span>
                        </div>
                        <p class="m-0 my-1 mb-2 text-muted">@if(isset($c->mensagem)) {{ \Illuminate\Support\Str::limit($c->mensagem, 150, $end='...') }}@endif</p>
                        <div class="blog-comments__actions">
                          <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-white" data-toggle="modal" data-target="#modalgenerico{{$c->id}}">
                              <span class="text-success">
                                <i class="material-icons">visibility</i>
                              </span> Ler Mensagem </button>
                          
                             
                    <button style="width:100%;"  data-toggle="modal" data-target="#seguroDelete{{$c->id}}" style="float:right;" class="btn btn-white" id="axcoes">
                    <span class="text-danger">
                                <i class="material-icons">clear</i>
                              </span> Deletar </button>
                    
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
@else
<h3>Nenhuma mensagem de contato para exibir</h3>
@endif
                
                   
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
              @foreach($contatos as $cm)
             <!-- ModalGenerico-->
<div class="modal fade" id="modalgenerico{{$cm->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mensagem Recebida</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     {{$cm->mensagem}}
      </div>
      <div class="modal-footer">
         
          </div>
    </div>
  </div>
</div>
      <!-- SegurancaDelete-->
      <div class="modal fade" id="seguroDelete{{$cm->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
    <form action="{{route('contatosDeletar',$cm->id)}}" method = "post">
                          @csrf
                  @method('DELETE')
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
@endforeach