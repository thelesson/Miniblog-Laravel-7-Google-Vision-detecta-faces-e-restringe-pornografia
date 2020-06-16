
<header class="masthead" style="@if(!empty($pagina->image) && $pagina->on_off_background ===1) background-image: url('{{ Voyager::image( $pagina->image) }}') @elseif(!empty($pagina->background_cor) && $pagina->on_off_background ===0) background-color:{{$pagina->background_cor}} @elseif ($pagina->on_off_background ===2 ) background-image: url('{{ asset('frontend/img/home-bg.jpg') }}') @else background-image: url('{{ asset('frontend/img/home-bg.jpg') }}')  @endif">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>{{$pagina->title}}</h1>
            <span class="subheading">{{$pagina->excerpt}}</span>
          </div>
        </div>
      </div>
    </div>
  </header>