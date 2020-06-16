<div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Postagens Publicadas</span>
                       <h6 class="stats-small__value count my-3">@if(!empty($postsPublicados)) {{$postsPublicados}} @else 0 @endif</h6>
                      </div>
                      <div class="stats-small__data">
                        <span class="stats-small__percentage stats-small__percentage">DE {{$postsTotais}} POSTS TOTAIS</span>
                      </div>
                    </div>
                   
                  </div>
                </div>
              </div>