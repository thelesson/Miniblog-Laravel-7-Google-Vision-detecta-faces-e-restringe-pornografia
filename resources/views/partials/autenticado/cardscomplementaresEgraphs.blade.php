<div class="row">
@if (auth()->check())
@php $regra = \App\Role::where('id',auth()->user()->role_id)->first(); @endphp
                       
                       @if(!empty($regra))
   @if ($regra->name !=="user")
              @include('partials.autenticado.widgets.sessoesativas')
              <!-- Users Stats -->
              @include('partials.autenticado.widgets.estatisticas30diasusers')          
              <!-- End Users Stats -->
              <!-- Users By Device Stats -->
              @include('partials.autenticado.widgets.dispositivosPorUser')          
             
              <!-- End Users By Device Stats -->
              <!-- New Draft Component -->
            
              @php $pode = \App\Settings::where('key','site.moderadores-notificacoes')->first();@endphp
              @php $pode2 = \App\Settings::where('key','site.moderadores-contatos')->first();@endphp
              @if($pode)
                @if($pode->value==="SIM")
                      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <!-- Quick Post -->
                        @include('partials.autenticado.widgets.enviarNotificacoes')          
                        <!-- End Quick Post -->
                      </div>
                @else
                   @if($regra->name ==="admin")
                       <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                          <!-- Quick Post -->
                        @include('partials.autenticado.widgets.enviarNotificacoes')          
                          <!-- End Quick Post -->
                        </div>
                   @endif
                @endif
              @else
                   @if($regra->name ==="admin")
                       <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                          <!-- Quick Post -->
                        @include('partials.autenticado.widgets.enviarNotificacoes')          
                          <!-- End Quick Post -->
                        </div>
                   @endif
              @endif
              
              @if($pode2)
              @if($pode2->value==="SIM")
                   @include('partials.autenticado.widgets.msgContatosRecebidos')  
                @else
                   @if($regra->name ==="admin")
                       @include('partials.autenticado.widgets.msgContatosRecebidos')  
                   @endif
                @endif
              @else
                   @if($regra->name ==="admin")
                       @include('partials.autenticado.widgets.msgContatosRecebidos')  
                   @endif
              @endif
              
              
              <!-- End Discussions Component -->
              <!-- Top Referrals Component -->
              @include('partials.autenticado.widgets.postsMaisAcessados')  
              <!-- End Top Referrals Component -->
            
   @else
             @include('partials.autenticado.widgets.sessoesativas')
              <!-- Users Stats -->
             <!-- End Users By Device Stats -->
              <!-- New Draft Component -->
              <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <!-- Quick Post -->
                @include('partials.autenticado.widgets.postsMaisAcessadosUsuario')  
            
                <!-- End Quick Post -->
              </div>
              <!-- End New Draft Component -->
              <!-- Discussions Component -->
            <!-- End Discussions Component -->
              <!-- Top Referrals Component -->
              <!-- End Top Referrals Component -->
            
   
   @endif
   @else
   <span>Você não possui privilégios necessários para acessar este módulo</span>
  @endif
   @else
   <span>Você não possui privilégios necessários para acessar este módulo</span>
   @endif
             </div>