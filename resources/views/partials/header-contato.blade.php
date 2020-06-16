
<header class="masthead" style="@if(!empty($capaInicial->value) && $on_offx->value ==='1') background-image: url('{{ Voyager::image( $capaInicial->value) }}') @elseif(!empty($capaInicialCor->value) && $on_offx->value ==='0') background-color:{{$capaInicialCor->value}} @elseif ($on_offx->value ==='2' ) background-image: url('{{ asset('frontend/img/home-bg.jpg') }}') @else background-image: url('{{ asset('frontend/img/home-bg.jpg') }}')  @endif">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
          @if(!empty($tituloPagina->value))
            <h1>{{$tituloPagina->value}}</h1>
            @else
            <h1>Contatos</h1>
            @endif
            @if(!empty($subtituloSite->value))
            <span class="subheading">{{$subtituloSite->value}}</span>
            @else
            <span class="subheading">Página de Contatos</span>
            @endif
          </div>
        </div>
      </div>
    </div>
  </header>