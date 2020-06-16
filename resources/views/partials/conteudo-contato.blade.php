<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
      @if($errors->any())
      <div class="alert alert-danger">
      {{ implode('', $errors->all('Não conseguimos enviar sua mensagem. Por favor verifique os campos e tente novamente')) }}</div>
@endif
@if(Session::has('message'))
    <div class="alert alert-info">
        {{ Session::get('message') }}
    </div>
@endif

@if(!empty($intro->value))
{{ $intro->value }}
@else
        <p>Quer entrar em contato? Preencha o formulário abaixo para me enviar uma mensagem e retornaremos o mais breve possível!</p>
     @endif
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form name="sentMessage" id="contactForm" action="{{route('enviaContato')}}" method = "post" validate>
          <div class="control-group">
          
            <div class="form-group floating-label-form-group controls">
              <label>Nome *</label>
              <input type="text" class="form-control" placeholder="Nome" id="name" name="nome" required data-validation-required-message="Por favor, insira seu nome." @if ($errors->has('nome')) autofocus @endif>
              @if($errors->has('nome'))
    <div class="error" style="color:red">{{ $errors->first('nome') }}</div>
@endif
              <p class="help-block text-danger"></p>
              {{ csrf_field() }}
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Endereço de Email *</label>
              <input type="email" class="form-control" placeholder="Endereço de email" id="email" name="email" required data-validation-required-message="Por favor, insira seu email." @if ($errors->has('email')) autofocus @endif>
              @if($errors->has('email'))
    <div class="error" style="color:red">{{ $errors->first('email') }}</div>
@endif
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Número de Telefone</label>
              <input type="tel" class="form-control" placeholder="Número de Telefone" id="phone" name="telefone"  data-validation-required-message="Por favor, insira seu telefone." @if ($errors->has('telefone')) autofocus @endif>
              @if($errors->has('telefone'))
    <div class="error" style="color:red">{{ $errors->first('telefone') }}</div>
@endif
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Mensagem *</label>
              <textarea rows="5" class="form-control" placeholder="Mensagem" id="message" name="mensagem" required data-validation-required-message="Por favor, escreva sua mensagem." @if ($errors->has('mensagem')) autofocus @endif></textarea>
              @if($errors->has('mensagem'))
    <div class="error" style="color:red">{{ $errors->first('mensagem') }}</div>
@endif
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @include('notify::messages')
  <hr>
