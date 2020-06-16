@php $pode = \App\Settings::where('key','site.moderadores-notificacoes')->first();@endphp
              @php $pode2 = \App\Settings::where('key','site.moderadores-contatos')->first();@endphp
@if($pode)

                @if($pode->value==="NAO")
                  @if($regra->name ==="admin")
                    <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
                  @else
                     @if($pode2->value==="SIM")
                      <div class="col-lg-7 col-md-12 col-sm-12 mb-4">
                     @else
                      <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                     @endif
                  @endif
                @else
                 @if($pode2->value==="SIM")
                    @if($regra->name ==="admin")
                      <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
                     
                    @else
                      @if($pode->value==="SIM")
                       <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
                      @else
                      <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
                      @endif
                    @endif
                  @else
                  @if($regra->name ==="admin")
                      <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
                     
                    @else
                    <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
                  @endif
                     
                 @endif
                @endif
@else
<div class="col-lg-3 col-md-12 col-sm-12 mb-4">
@endif
                <div class="card card-small">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Minha Lista de Favoritos</h6>
                  </div>
                  <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                    @if(!empty($favoritos))
                    @foreach($favoritos as $f)
                      <li class="list-group-item d-flex px-3">
                       <a href="{{route('postagem',$f->slug)}}"> <span class="text-semibold text-fiord-blue">{{$f->title}}</span></a>
                      
                      </li>
                     @endforeach
                     @endif
                    </ul>
                  </div>
                  <div class="card-footer border-top">
                    
                      <div class="col text-right view-report">
                        <a href="{{route('listaFavoritos')}}">Ver todos &rarr;</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>