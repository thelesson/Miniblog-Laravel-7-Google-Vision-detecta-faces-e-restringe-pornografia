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
                  @if(isset($contatos))
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
                     
                     
                     @foreach ($contatos as $c)
                     
                     <tr>
                    
                     <td> @if(isset($c->nome)) {{$c->nome}} @endif</td>
                     <td> @if(isset($c->email)) {{$c->email}} @endif</td>
                     <td>@if(isset($c->telefone)) {{$c->telefone}} @endif</td>
                     
                     <td style="width: 100%;">@if(isset($c->mensagem)) {{ \Illuminate\Support\Str::limit($c->mensagem, 150, $end='...') }}@endif</td>
                        <td>@if(isset($c->created_at)) {{$c->created_at->diffForHumans()}}({{$c->created_at->format('d/m/Y')}}) @endif</td>
                        <td>@if(isset($c->updated_at))  {{$c->updated_at->diffForHumans()}} ({{$c->updated_at->format('d/m/Y')}}) @endif</td>
                       
                         <td style=" width: 80%;"> <div><button style="width:100%;" class="btn btn-sm btn-accent ml-auto" data-toggle="modal" data-target="#modalgenerico{{$c->id}}" id="modalgeneriico{{$c->id}}">
                          <i class="material-icons">visibility</i></button>
                          
                         
                    <button style="width:100%;"  data-toggle="modal" data-target="#seguroDeletex{{$c->id}}" style="float:right;" class="btn btn-sm btn-danger ml-auto" id="acoes">
                          <i class="material-icons">delete_forever</i></button>
                     
                          </div>
                         
                      </td>
                    @endforeach
                      </tbody>
                   
                    </table>
                    @else
                      <h5>Tracker Desativado. habilite-o para acessar este recurso</h5>
                      @endif
                  </div>
                  {{ $contatos->links() }}
                </div>
              </div>
              
            </div>
            <div >
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
  <div class="modal fade" id="seguroDeletex{{$cm->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
<div id="divA"></div>

            </div>
              </div>
             
