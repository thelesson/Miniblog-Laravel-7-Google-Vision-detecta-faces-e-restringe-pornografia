<div class="col-lg-12 col-md-12 col-sm-12 mb-4">

            <!-- End Page Header -->
            <!-- Default Light Table -->
            <div class="row">
              <div class="col">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Relatório</h6>
                  </div>
                  <div class="card-body p-0 pb-3 text-center">
                  @if(isset($favoritos))
                   
                    <table class="table table-responsive mb-0">
                      <thead class="bg-light">
              
                        <tr>
                       
                        <th scope="col" class="border-0">#</th>
                        <th scope="col" class="border-0">Titulo</th>
                        <th scope="col" class="border-0">Descrição</th>
                        <th scope="col" class="border-0">Autor</th>
                        <th scope="col" class="border-0">Ler postagem</th>
                       
                    
                          
                        </tr>
                      </thead>
                      <tbody>
                     
                     
                     @foreach ($favoritos as $fav)
                     <tr>
                     <td>##</td>
                     <td>{{$fav->title}}</td>
                     <td>{{$fav->excerpt}}</td>
                     @php $autor = \App\User::where('id',$fav->author_id)->first(); @endphp
                     <td>{{$autor->name}}</td>
                     <td><a href="{{route('postagem',$fav->slug)}}" target="_blank">Visitar</a></td>
                  
                     
                     @endforeach
                      </tbody>
                   
                    </table>
                   
                    @else
                      <h5>Sem posts favoritados para exibir</h5>
                      @endif
                  </div>

                  {{$favoritos->links()}}
                </div>
              </div>
              
            </div>
            
              </div>
