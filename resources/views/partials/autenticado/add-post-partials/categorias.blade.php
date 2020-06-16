<div class='card card-small mb-3'>
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Categorias * <span style="font-size:10px;"> não implementado</span></h6>
                  </div>
                  @php $categorias= \App\Category::all();
                  $cC =  \App\Category::all()->count(); @endphp
                  <div class='card-body p-0'>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item px-3 pb-2">
                      @if(!empty($categorias))
                      
                      @foreach($categorias as $cat)
                    
                        <div @if($loop->iteration > 5) class="ativado custom-control custom-checkbox mb-1" @else class="custom-control custom-checkbox mb-1" @endif >
                          <input type="checkbox" class="custom-control-input" id="category{{$cat->id}}" @if(isset($postEdit)) @if($postEdit->category_id === $cat->id) checked @endif @endif>
                          <label class="custom-control-label" for="category{{$cat->id}}">{{$cat->name}}</label>
                        </div>
                        
                       
                        @endforeach
                        @if($cC > 6)
                        <h4  style="text-align:center;" class="btn btn-sm  ml-auto" id="btnVer">
                         --------- Ver  mais Categorias ----------  </h4>@endif
                        @else
                        <h5>Não há categorias para exibir</h5>
                       @endif
                      </li>
                     
                    </ul>
                  </div>
                </div>