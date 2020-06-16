@if(isset($visitantesTracker))
<!--tabela visitantes do site-->
@include('partials.autenticado.widgets.tabelavisitantes')
<!--end-->
@elseif(isset($contatosTracker))
@include('partials.autenticado.widgets.tabelaContato')
@elseif(isset($notificacoesTracker))
@include('partials.autenticado.widgets.tabelaNotificacoes')
@elseif(isset($favoritosTracker))
@include('partials.autenticado.widgets.tabelaFavoritos')
@elseif(isset($errosTracker))
@include('partials.autenticado.widgets.tabelaErros')

@else

<div class="col-lg-12 col-md-12 col-sm-12 mb-4">
<div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Log de Atividade</span>
                <h3 class="page-title">@if(isset($cambio)) Minhas Ações @else Ações dos Usuários @endif</h3>
              </div>
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
                    <table class="table table-responsive mb-0">
                      <thead class="bg-light">
                      @if(!empty($logs))
                        <tr>
                        @if(isset($cambio))
                        <th scope="col" class="border-0">#</th>
                          <th scope="col" class="border-0">Ip</th>
                          @php $verificaUsuarioLog = App\Role::where('id',auth()->user()->role_id)->first(); @endphp
          
          @if(!empty($verificaUsuarioLog))
            @if ($verificaUsuarioLog->name ==="admin")
            
            <th scope="col" class="border-0">Linha</th>
            <th scope="col" class="border-0">Tabela</th>
            @endif
                @endif
                         <th scope="col" class="border-0">Evento</th>
                          <th scope="col" class="border-0">Antes</th>
                          <th scope="col" class="border-0">Depois</th>
                          <th scope="col" class="border-0">Browser</th>
                       
                        @else
                        <th scope="col" class="border-0">#</th>
                          <th scope="col" class="border-0">Email</th>
                          <th scope="col" class="border-0">Ip</th>
                          <th scope="col" class="border-0">Linha</th>
                          <th scope="col" class="border-0">Tabela</th>
                          <th scope="col" class="border-0">Evento</th>
                          <th scope="col" class="border-0">Id do Usuário</th>
                          <th scope="col" class="border-0">Antes</th>
                          <th scope="col" class="border-0">Depois</th>
                          <th scope="col" class="border-0">Browser</th>
                        @endif
                          
                        </tr>
                      </thead>
                      <tbody>
                     
               
                          @foreach($logs as $ss)
                         
                          <tr>
                          @if(isset($cambio))
                          <td>##</td>
                         <td>{{ $ss->ip_address}}</td>
                         @php $verificaUsuarioLog = App\Role::where('id',auth()->user()->role_id)->first(); @endphp
          
          @if(!empty($verificaUsuarioLog))
            @if ($verificaUsuarioLog->name ==="admin")
            
                        <td>{{$ss->row_id}}</td>
                          <td>{{$ss->table_name}}</td>
            @endif
                @endif
                          
                          <td>{{ $ss->event}}</td>
                          <td>
                          {{ $ss->before}}</td>
                          <td>{{$ss->after}}</td>
                          <td>{{$ss->user_agent}}</td>
                          @else
                          <td>##</td>
                          <td>@php $e= App\User::where('id',$ss->user_id)->first(); @endphp
                          @if($e)
                            {{ $e->email }}
                          @else Nao detectado @endif
                         </td>
                          <td>{{ $ss->ip_address}}</td>
                          <td>{{$ss->row_id}}</td>
                          <td>{{$ss->table_name}}</td>
                          <td>{{ $ss->event}}</td>
                          <td>{{ $ss->user_id}}</td>
                          <td>
                          {{ $ss->before}}</td>
                          <td>{{$ss->after}}</td>
                          <td>{{$ss->user_agent}}</td>
                          @endif
                         
                          
                         
                         
                        </tr>
                       
                          @endforeach
                        
                       
                      
                        
                        
                      </tbody>
                      @else
                     <tr> <td>Rastreador do Sistema desabilitado - Habilite-o para utilizar esta função </td></tr>
                      @endif
                    </table>
                    
                  </div>
                  {{ $logs->links() }}
                </div>
              </div>
              
            </div>
            
              </div>

@endif
