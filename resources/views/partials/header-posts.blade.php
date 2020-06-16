
<header class="masthead" style="background-image: url('{{ Voyager::image( $post->image) }}')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>{{$post->title}}</h1>
            @if(!empty($post->subtitle))
            <h2 class="subheading">{{$post->subtitle}}</h2>
            @elseif(!empty($post->excerpt))
            <h2 class="subheading">{{$post->excerpt}}</h2>
            @else
            @endif
            @if(isset($post->autor->avatar))
            <span class="meta">Postado por
              <a href="#">{{$post->autor->name}}</a>
              {{$post->created_at->diffForHumans()}}</span>
               @else
                    @php $deletado  = \App\User::onlyTrashed()->find($post->author_id);@endphp
                    @if(!empty($deletado))
                    <span class="meta">Postado por
              <a href="#">{{$deletado->name}}</a>
              {{$post->created_at->diffForHumans()}}</span>  
                    @else
                    <span class="meta">Postado por
              <a href="#">Admin</a>
              {{$post->created_at->diffForHumans()}}</span>
                    @endif
                  @endif
          
          </div>
        </div>
      </div>
    </div>
  </header>