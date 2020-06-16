<!-- Small Stats Blocks -->

<div class="row">
@if (auth()->check())
                        @php $regra = \App\Role::where('id',auth()->user()->role_id)->first(); @endphp
                        @if(!empty($regra))
   @if ($regra->name !=="user")
@include('partials.autenticado.widgets.cards.postagensPublicadas')  
@include('partials.autenticado.widgets.cards.paginasPublicadas') 
@include('partials.autenticado.widgets.cards.usuariosTotais') 
@include('partials.autenticado.widgets.cards.novosUsers30dias') 
@include('partials.autenticado.widgets.cards.usuariosOnline')  
@else
      
@include('partials.autenticado.widgets.cards.usuarios.postagensEnviadas')  
@include('partials.autenticado.widgets.cards.usuarios.postagensAprovadas')  
@include('partials.autenticado.widgets.cards.usuarios.postagensRejeitadas') 
@include('partials.autenticado.widgets.cards.usuarios.postagensPendentes') 
@include('partials.autenticado.widgets.cards.usuarios.favoritos')    
      @endif

   @else

<span>A permissão para acessar este conteúdo foi revogada. Por favor, entre em contato com o Administrador do sistema! </span>
  
    @endif
   @else
   <span>A permissão para acessar este conteúdo foi revogada. Por favor, entre em contato com o Administrador do sistema! </span>
  
@endif

  <!-- End Small Stats Blocks -->
  
  </div>