
<header class="masthead" style="@if(!empty($capaInicial->value) && $on_off->value ==='1') background-image: url('{{ Voyager::image( $capaInicial->value) }}') @elseif(!empty($capaInicialCor->value) && $on_off->value ==='0') background-color:{{$capaInicialCor->value}} @elseif ($on_off->value ==='2' ) background-image: url('{{ asset('frontend/img/home-bg.jpg') }}') @else background-image: url('{{ asset('frontend/img/home-bg.jpg') }}')  @endif">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
          @if(!empty($tituloSite->value))
            <h1>{{$tituloSite->value}}</h1>
            @else
            <h1>Miniblog</h1>
            @endif
            @if(!empty($subtituloSite->value))
            <span class="subheading">{{$subtituloSite->value}}</span>
            @else
            <span class="subheading">Um mini mini Blog desenvolvido por Thélesson de Souza</span>
           @endif
          </div>
        </div>
      </div>
    </div>
  </header>
  