<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
      @foreach($posts as $p)
        <div class="post-preview">
        @if($p->featured ===0)
          <a href="post/{{$p->slug}}">
          @else
           @if(Auth::check())
           <a href="post/{{$p->slug}}">
           @else
           <a href="/login">
           @endif
       
          @endif
            <h2 class="post-title">
              {{$p->title}}
            </h2>
            @if($p->featured ===1)
            <span  style="color:white!important;" class="card-post__category badge badge-pill badge-dark">Exclusivo para membros</span>
           @endif
            <h3 class="post-subtitle">
            {{$p->excerpt}}
            </h3>
          </a>
          @if(isset($p->autor->avatar))
          <p class="post-meta">Postado por
            <a href="#">{{$p->autor->name}}</a>
             {{$p->created_at->diffForHumans()}}</p>    
                    @else
                    @php $deletado  = \App\User::onlyTrashed()->find($p->author_id);@endphp
                    @if(!empty($deletado))
                    <p class="post-meta">Postado por
            <a href="#">{{$deletado->name}}</a>
             {{$p->created_at->diffForHumans()}}</p>    
                    @else
                    <p class="post-meta">Postado por
            <a href="#">Admin</a>
             {{$p->created_at->diffForHumans()}}</p>
                    @endif
                  @endif
          
        </div>
        <hr>
        @endforeach
        <!-- Pager -->
        <div class="clearfix">
         {{$posts->links()}}
        </div>
      </div>
    </div>
  </div>

  <hr>