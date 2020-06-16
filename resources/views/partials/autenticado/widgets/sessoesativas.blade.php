<div class="col-lg-12 col-md-12 col-sm-12 mb-4">
<div class="page-header row no-gutters py-4">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Segurança - Informações de Sessões</span>
                <h3 class="page-title">Locais onde estive conectado</h3>
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
                      @if(!empty($sessaoAtual))
                        <tr>
                          <th scope="col" class="border-0">#</th>
                          <th scope="col" class="border-0">Email</th>
                          <th scope="col" class="border-0">Ip</th>
                          <th scope="col" class="border-0">É Mobile</th>
                          <th scope="col" class="border-0">Tipo Dispositivo</th>
                          <th scope="col" class="border-0">Plataforma</th>
                          <th scope="col" class="border-0">Vesão da Plataforma</th>
                          <th scope="col" class="border-0">Browser</th>
                          <th scope="col" class="border-0">Linguagem</th>
                        </tr>
                      </thead>
                      <tbody>
              
                        <tr>
                          <td style="background-color:green;color:white;">ONLINE AGORA</td>
                          <td>{{ Auth()->user()->email }}</td>
                          <td>{{ $sessaoAtual->client_ip}}</td>
                          <td>@if($sessaoAtual->device->is_mobile ===0) Não @else Sim @endif</td>
                          <td>{{ $sessaoAtual->device->kind}}</td>
                          <td>{{ $sessaoAtual->device->platform}}</td>
                          <td>@if(!empty($sessaoAtual->device->plataform_version))
                          {{ $sessaoAtual->device->plataform_version}} @else Não detectado @endif</td>
                          <td>{{$sessaoAtual->agent->browser}}</td>
                          <td>{{$sessaoAtual->language->preference}}</td>
                         
                        </tr>
                      
                        @if(!empty($sessaoTodasDoLogado))
                          @foreach($sessaoTodasDoLogado as $ss)
                          @if($sessaoAtual->uuid === $ss->uuid)
                          @else
                          <tr>
                          <td>##</td>
                          <td>{{ Auth()->user()->email }}</td>
                          <td>{{ $ss->client_ip}}</td>
                          <td>@if($ss->device->is_mobile ===0) Não @else Sim @endif</td>
                          <td>{{ $ss->device->kind}}</td>
                          <td>{{ $ss->device->platform}}</td>
                          <td>@if(!empty($ss->device->plataform_version))
                          {{ $ss->device->plataform_version}} @else Não detectado @endif</td>
                          <td>{{$ss->agent->browser}}</td>
                          <td>{{$ss->language->preference}}</td>
                         
                         
                        </tr>
                        @endif
                          @endforeach
                        @endif
                       
                      
                        
                        
                      </tbody>
                      @else
                     <tr> <td>Rastreador do Sistema desabilitado - Habilite-o para utilizar esta função </td></tr>
                      @endif
                    </table>
                    
                  </div>
                  {{ $sessaoTodasDoLogado->links() }}
                </div>
              </div>
              
            </div>
            
              </div>