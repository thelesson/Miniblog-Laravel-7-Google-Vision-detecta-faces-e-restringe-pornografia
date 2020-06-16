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
                  @if(isset($notificacoes))
                  @php @endphp
                    <table class="table table-responsive mb-0">
                      <thead class="bg-light">
                      
                        <tr>
                       
                        <th scope="col" class="border-0">#</th>
                        <th scope="col" class="border-0">Titulo</th>
                          <th scope="col" class="border-0">Mensagem</th>
                       
                    
                          
                        </tr>
                      </thead>
                      <tbody>
                     
                     
                     @foreach ($notificacoes->paginate(10) as $not)
                     <tr>
                     <td>##</td>
                     <td> @if(isset($not->data))  {{ $not->data['greeting'] }} @endif</td>
                  
                     <td> @if(isset($not->data))  {{ $not->data['body'] }} @endif</td>
                     
                     @endforeach
                      </tbody>
                   
                    </table>
                   
                    @else
                      <h5>Sem notificações no momento!</h5>
                      @endif
                  </div>

                  {{$notificacoes->paginate(10)->links()}}
                </div>
              </div>
              
            </div>
            
              </div>
