<div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body  p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Postagens Enviadas</span>
                        @php $postuser = \App\Post::where('author_id',Auth()->user()->id)->count(); @endphp
                        <h6 class="stats-small__value count my-3">@if(!empty($postuser)) {{$postuser}} @else 0 @endif</h6>
                      </div>
           
                    </div>
                   
                  </div>
                </div>
              </div>