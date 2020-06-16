<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
@include('partials.head')
    <body>
    @include('notify::messages')
    @include('partials.menuprincipal')
    @include('partials.header')
    @include('partials.conteudo')
    @include('partials.footer')
  
    @notifyJs
    </body>
</html>
