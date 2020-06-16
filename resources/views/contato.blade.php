<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
@include('partials.head')
    <body>
    @include('partials.menuprincipal')
    @include('partials.header-contato')
    @include('partials.conteudo-contato')
    @include('partials.footer')
       <!-- Contact Form JavaScript -->
       <script src="{{ asset('frontend/js/jqBootstrapValidation.js') }}"></script>
       <script src="{{ asset('frontend/js/contact_me.js') }}"></script>
    </body>
</html>
