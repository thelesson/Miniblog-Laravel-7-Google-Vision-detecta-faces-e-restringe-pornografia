<div class="main-navbar sticky-top bg-white">
            <!-- Main Navbar -->
            <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
              <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                <div class="input-group input-group-seamless ml-3">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                  <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
              </form>
              <ul class="navbar-nav border-left flex-row ">
                <li class="nav-item border-right dropdown notifications">
                  <a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="nav-link-icon__wrapper">
                      <i class="material-icons">&#xE7F4;</i>
                      @php $tem = auth()->user()->unreadNotifications->count()  @endphp
                      @if($tem > 0)
                      <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications->count() }} 
            </span>
                      @endif
            
                     
                    </div>
                  </a>
                

                  <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
                  @if($tem > 0)
                  @php $index = 0; @endphp
                  @foreach(auth()->user()->unreadNotifications  as $key => $notification )

                  @php
                 
                   $id = auth()->user()->unreadNotifications[$index]->id; @endphp
                    <a class="dropdown-item" href="/seguro/marcaComoLido/{{$id}}">
                      <div class="notification__icon-wrapper">
                        <div class="notification__icon">
                          <i class="material-icons">new_releases</i>
                        </div>
                      </div>
                      <div class="notification__content">
                        <span class="notification__category"> {{ $notification->data['greeting'] }}</span>
                        <p>{{ $notification->data['body'] }}</p>
                      </div>
                    </a>
                    @if($index == 3) @break @endif
                    @php $index++; @endphp
                   @endforeach
                   @else
                   <a class="dropdown-item" href="#">
                      <div class="notification__icon-wrapper">
                        <div class="notification__icon">
                          <i class="material-icons">&#xE6E1;</i>
                        </div>
                      </div>
                      <div class="notification__content">
                        <span class="notification__category">Nenhuma Notificação</span>
                        <p>Sem notificações para exibir</p>
                      </div>
                    </a>
                    @endif
                    <a class="dropdown-item notification__all text-center" href="/seguro/lista-notificacoes">Ver todas as notificações </a>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img width="40" height="40" class="user-avatar rounded-circle mr-2" src="@if(!empty(Auth()->user()->avatar)){{ Voyager::image(Auth()->user()->avatar) }} @else{{ asset('autenticado/frontend/images/avatars/0.jpg') }} @endif" alt="User Avatar">
                    <span class="d-none d-md-inline-block">{{Auth()->user()->name}}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item" href="{{route('perfil')}}">
                      <i class="material-icons">&#xE7FD;</i> Perfil</a>
                    <a class="dropdown-item" href="/listagem">
                      <i class="material-icons">vertical_split</i>Postagens do Blog</a>
                    <a class="dropdown-item" href="/add-post">
                      <i class="material-icons">note_add</i> Nova Postagem</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                      <i class="material-icons text-danger">&#xE879;</i> Sair </a>
                  </div>
                </li>
              </ul>
              <nav class="nav">
                <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                  <i class="material-icons">&#xE5D2;</i>
                </a>
              </nav>
            </nav>
          </div>
          <!-- / .main-navbar -->