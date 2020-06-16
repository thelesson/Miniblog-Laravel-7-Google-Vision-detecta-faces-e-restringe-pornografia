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
                  @if(isset($erros))
                   
                    <table class="table table-responsive mb-0">
                      <thead class="bg-light">
              
                        <tr>
                       
                        <th scope="col" class="border-0">Id</th>
                        <th scope="col" class="border-0">Código</th>
                        <th scope="col" class="border-0">Mensagem</th>
                        <th scope="col" class="border-0">Criado em </th>
                        <th scope="col" class="border-0">Atualizado em</th>
                       
                    
                          
                        </tr>
                      </thead>
                      <tbody>
                     @php dd($erros);@endphp
                     @foreach ($erros as $erro)
                     <tr>
                     <td>{{$erro->id}}</td>
                     <td>{{$erro->code}}</td>
                     <td>{{$erro->message}}</td>
                     <td>{{$erro->created_at}}</td>
                     <td>{{$erro->update_at}}</td>
                  
                     
                     @endforeach
                      </tbody>
                  
                    </table>
                   
                    @else
                      <h5>Sem posts favoritados para exibir</h5>
                      @endif
                  </div>

                  {{$erro->links()}}
                </div>
              </div>
              
            </div>
            
              </div>
