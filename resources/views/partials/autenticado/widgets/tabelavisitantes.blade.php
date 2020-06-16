<div class="col-lg-12 col-md-12 col-sm-12 mb-4">
<div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Log de Atividade</span>
                <h3 class="page-title">@if(isset($visitantesTracker)) Registro de Visitantes ultimos 30 dias  @else Erro @endif</h3>
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
                  @if(isset($sessions))
                    <table class="table table-responsive mb-0">
                      <thead class="bg-light">
                      
                        <tr>
                       
                        <th scope="col" class="border-0">#</th>
                        <th scope="col" class="border-0">Email</th>
                          <th scope="col" class="border-0">Ip</th>
                          <th scope="col" class="border-0">País/Cidade</th>
                          <th scope="col" class="border-0">Dispositivo</th>
                          <th scope="col" class="border-0">Navegador</th>
                          <th scope="col" class="border-0">Origem</th>
                          <th scope="col" class="border-0">Ultima Atividade</th>
                       
                    
                          
                        </tr>
                      </thead>
                      <tbody>
                     
                     
                     @foreach ($sessions as $session)
                     <tr>
                     <td  style="@if($session->is_robot) @if($session->is_robot === 1 ) background-color:red;color:white; @endif @endif" >@if($session->is_robot) @if($session->is_robot === 1 ) Robô @else ## @endif @else ## @endif</td>
                     <td> @if(isset($session->user->email)) {{$session->user->email}} @endif</td>
                     <td> @if(isset($session->client_ip)){{$session->client_ip}} @endif</td>
                     <td>@if(isset($session->user->geo_ip)){{$session->user->geo_ip}} @else Não Detectado @endif</td>
                     
                     <td>@if(isset($session->user->device))[{{$session->user->device}}][{{$session->user->device->model}}][{{$session->user->device->plataform}}] - [{{$session->user->device->plataform_version}}] @else Não Detectado @endif</td>
                        <td>@if(isset($session->agent)){{$session->agent->name}} [{{$session->agent->browser}}][{{$session->agent->browser_version}}] @else Não Detectado @endif</td>
                        <td>@if(isset($session->referer->url)){{$session->referer->url}} @endif</td>
                        <td>@if(isset($session->referer->updated_at)){{$session->referer->updated_at}} @endif</td>
                      </tr>
                     @endforeach
                      </tbody>
                   
                    </table>
                    @else
                      <h5>Tracker Desativado. habilite-o para acessar este recurso</h5>
                      @endif
                  </div>
                
                </div>
              </div>
              
            </div>
            
              </div>
