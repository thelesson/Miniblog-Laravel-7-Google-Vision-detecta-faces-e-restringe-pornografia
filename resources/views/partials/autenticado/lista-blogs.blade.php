<div class="row">
@php $a = count($posts); @endphp
@if($a>0)
@foreach($posts as $p)
              <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card card-small card-post card-post--1 h-100">
                  <div class="card-post__image" style="@if(!empty($p->image))background-image: url('{{ Voyager::image( $p->image) }}'); @else background-color:blue; @endif">
                   @if($p->featured ===1) <a href="#" class="card-post__category badge badge-pill badge-dark">Exclusivo para membros</a>
                   @endif
                   @if($p->status ==="PENDING") <a href="#" style="@if($p->featured ===1) margin-top:10%; @endif" class="card-post__category badge badge-pill badge-warning">Aguardando Aprovação</a>
                   @endif
                   @if($p->status ==="DRAFT") <a href="#" style="@if($p->featured ===1) margin-top:10%; @endif" class="card-post__category badge badge-pill badge-danger">Postagem Rejeitada</a>
                   @endif 
                   @if(isset($cambio))
                   @if($p->status ==="PUBLISHED") <a href="#" style="@if($p->featured ===1) margin-top:10%; @endif" class="card-post__category badge badge-pill badge-success">Postagem aprovada</a>
                   @endif
                   @endif
                   @if(isset($p->autor->avatar))
                    <div class="card-post__author d-flex">
                      <a href="#" class="card-post__author-avatar card-post__author-avatar--small" style="background-image: url('{{ Voyager::image( $p->autor->avatar) }}');"></a>
                    </div>
                    @else
                    @php $deletado  = \App\User::onlyTrashed()->find($p->author_id);@endphp
                    @if(!empty($deletado))
                   
                    <div class="card-post__author d-flex">
                      <a href="#" class="card-post__author-avatar card-post__author-avatar--small" style="background-image: url('{{ Voyager::image( $deletado->avatar) }}');"></a>
                    </div>

                    @else
                    <div class="card-post__author d-flex">
                      <a href="#" class="card-post__author-avatar card-post__author-avatar--small" style="background-image: url('{{ asset('autenticado/frontend/images/avatars/2.jpg') }}');"></a>
                    </div>
                    @endif
                     
                    
                    @endif
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">
                      <a class="text-fiord-blue" target="_blank" href="post/{{$p->slug}}">{{ \Illuminate\Support\Str::limit($p->title, 15, $end='...') }}</a>
                    </h5>
                    <p class="card-text d-inline-block mb-3">{{ \Illuminate\Support\Str::limit($p->excerpt, 80, $end='...') }}</p>
                   
                    <span class="text-muted">Postado por
                    @if(isset($p->autor->name))
            <a href="#">{{$p->autor->name}}</a>
            @else
            @php $deletado  = \App\User::onlyTrashed()->find($p->author_id);@endphp
                    @if(!empty($deletado))
                    <a href="#">{{$deletado->name}}</a>
                    @else
                    <a href="#">Admin</a>
                    @endif
            @endif
             {{$p->created_at->diffForHumans()}}</span>
             @if (auth()->check())
                @php $regra = \App\Role::where('id',auth()->user()->role_id)->first(); @endphp
                       
                        @if(!empty($regra))
   @if ($regra->name !=="user")
             <div>
             <a href="/post/edita/{{$p->id}}" style="float:left;" class="btn btn-sm btn-accent ml-auto" id="acoes" type="submit">
                          <i class="material-icons">edit</i>Editar</a>
                          <form class="add-new-post" id="delete-maroto" action="{{route('postDeletar',$p->id)}}" method = "post">
                          @csrf
                  @method('DELETE')
                    <button type="submit" style="float:right;" class="btn btn-sm btn-danger ml-auto" id="acoes">
                          <i class="material-icons">delete_forever</i> Deletar</button>
                      </form>   
                          </div>
                          @else
                          @if($p->status==="PENDING")
                          <div>
             <a href="/post/edita/{{$p->id}}" style="float:left;" class="btn btn-sm btn-accent ml-auto" id="acoes" type="submit">
                          <i class="material-icons">edit</i>Editar</a>
                          </div>
                          @endif
                          @endif
                          @endif
                          @endif
                  </div>
                </div>
              </div>
              @endforeach
              {{$posts->links()}}
              @else
           <div style="width:100%"> <h6 style="text-align:100%;">Você ainda não criou nenhuma postagem</h6></div>
            @endif
            </div>
            