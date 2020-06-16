<div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="card card-small">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Minha lista de Favoritos</h6>
                  </div>
                  <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                    @if(!empty($favoritos))
                   
                     @foreach($favoritos as $f)
                 
                      <li class="list-group-item d-flex px-3">
                       <a href="{{route('postagem',$f->slug)}}"> <span class="text-semibold text-fiord-blue">{{$f->title}}</span></a>
                      
                      </li>
                    
                     @endforeach
                     @else
                      <li class="list-group-item d-flex px-3">
                      <h1>Nada para exibir</h1>
                      </li>
                      @endif
                    </ul>
                  </div>
                  <div class="card-footer border-top">
                    <div class="row">
                    
                      <div class="col text-right view-report">
                        <a href="{{route('listaFavoritos')}}">Ver todos &rarr;</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>