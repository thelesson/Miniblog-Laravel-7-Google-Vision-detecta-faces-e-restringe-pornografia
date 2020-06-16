<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">

      <a class="navbar-brand" href="/">{{$tituloSite->value}}</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          
          @if (Route::has('login'))
               
                    @auth
                    <?= menu('website', 'partials.menuhook'); ?>
                 
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/home') }}">Área do Assinante</a>
                   </li>
                    @else
                    <?= menu('website', 'partials.menuhook'); ?>
                    <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
                   </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
            <a class="nav-link" href="{{ url('/register') }}">Registrar</a>
                   </li>
                         
                        @endif
                    @endauth
                </div>
            @endif
        </ul>
      </div>
    </div>
  </nav>