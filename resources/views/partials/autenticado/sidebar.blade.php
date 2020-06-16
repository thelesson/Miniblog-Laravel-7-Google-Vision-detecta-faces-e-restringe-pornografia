 <!-- Main Sidebar -->
 <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
          <div class="main-navbar">
            <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
              <a class="navbar-brand w-100 mr-0" href="/home" style="line-height: 25px;">
                <div class="d-table m-auto">
                  <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{ asset('autenticado/frontend/images/shards-dashboards-logo.svg') }}" alt="Shards Dashboard">
                  @php
              $v = App\Role::where('id',auth()->user()->role_id)->first();
              @endphp
        @if(!empty($v))
            @if($v->name !=="user")
            <span class="d-none d-md-inline ml-1">@if(!empty($tituloDashboard->value)) {{$tituloDashboard->value}} @else Admin Dashboard @endif</span>
            @else
            <span class="d-none d-md-inline ml-1"> Dashboard </span>
               
            @endif

        @endif
                 </div>
              </a>
              <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
              </a>
            </nav>
          </div>
          <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
            <div class="input-group input-group-seamless ml-3">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-search"></i>
                </div>
              </div>
              <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
          </form>
          <div class="nav-wrapper">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="/home">
                  <i class="material-icons">edit</i>
                  <span>Blog Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="/listagem">
                  <i class="material-icons">vertical_split</i>
                  <span>Lista de Postagens</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="/add-post">
                  <i class="material-icons">note_add</i>
                  <span>Adicionar Novo Post</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="/minhas-postagens">
                  <i class="material-icons">vertical_split</i>
                  <span>Minhas Postagens</span>
                </a>
              </li>
              @php
              $verificaUsuarioLog = App\Role::where('id',auth()->user()->role_id)->first();
              @endphp
        @if(!empty($verificaUsuarioLog))
            @if($verificaUsuarioLog->name !=="user")
            <li class="nav-item">
                <a class="nav-link " href="/seguro/visitantes">
                  <i class="material-icons">view_module</i>
                  <span>Visitantes do Site</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="/logs">
                  <i class="material-icons">table_chart</i>
                  <span>Ativ. dos Usuários</span>
                </a>
              </li>
            @endif
            @endif

            
              <li class="nav-item">
                <a class="nav-link " href="/minhas-atividades">
                  <i class="material-icons">table_chart</i>
                  <span>Minhas Atividades</span>
                </a>
              </li>
             <li class="nav-item">
                <a class="nav-link " href="/seguro/lista-notificacoes">
                  <i class="material-icons">error</i>
                  <span>Notificações</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="{{route('listaFavoritos')}}">
                  <i class="material-icons">error</i>
                  <span>Favoritos</span>
                </a>
              </li>
              @if(!empty($verificaUsuarioLog))
              @php $pode = \App\Settings::where('key','site.moderadores-contatos')->first();@endphp
              @if($pode)
               @if($pode->value==="SIM")
              
               @if($verificaUsuarioLog->name !=="user")
               @if($verificaUsuarioLog->name ==="admin")
              <li class="nav-item">
                <a class="nav-link " href="/seguro/contatos">
                  <i class="material-icons">error</i>
                  <span>Contatos</span>
                </a>
              </li>
           <!--    <li class="nav-item">
                <a class="nav-link " href="{{route('errosSistema')}}">
                  <i class="material-icons">error</i>
                  <span>Erros do Sistema</span>
                </a>
              </li>  -->
              @else
              <li class="nav-item">
                <a class="nav-link " href="/seguro/contatos">
                  <i class="material-icons">error</i>
                  <span>Contatos</span>
                </a>
              </li>
              @endif
              @endif
              
              @else
              @if($verificaUsuarioLog->name ==="admin")
              <li class="nav-item">
                <a class="nav-link " href="/seguro/contatos">
                  <i class="material-icons">error</i>
                  <span>Contatos</span>
                </a>
              </li>
              
           <!--    <li class="nav-item">
                <a class="nav-link " href="{{route('errosSistema')}}">
                  <i class="material-icons">error</i>
                  <span>Erros do Sistema</span>
                </a>
              </li> -->
              @endif
               @endif
               @else
               @if($verificaUsuarioLog->name ==="admin")
              <li class="nav-item">
                <a class="nav-link " href="/seguro/contatos">
                  <i class="material-icons">error</i>
                  <span>Contatos</span>
                </a>
              </li>
              
            <!--   <li class="nav-item">
                <a class="nav-link " href="{{route('errosSistema')}}">
                  <i class="material-icons">error</i>
                  <span>Erros do Sistema</span>
                </a>
              </li>  -->
              @endif
               @endif
           
              @endif
            </ul>
          </div>
        </aside>
        <!-- End Main Sidebar -->
