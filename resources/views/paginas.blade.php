<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
@include('partials.head')
    <body>
    @include('partials.menuprincipal')
    @include('partials.header-generico')
    @include('partials.conteudo-generico')
    @include('partials.footer')
       
    </body>
</html>
