<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
      <?php if($errors->any()): ?>
      <div class="alert alert-danger">
      <?php echo e(implode('', $errors->all('Não conseguimos enviar sua mensagem. Por favor verifique os campos e tente novamente'))); ?></div>
<?php endif; ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-info">
        <?php echo e(Session::get('message')); ?>

    </div>
<?php endif; ?>

<?php if(!empty($intro->value)): ?>
<?php echo e($intro->value); ?>

<?php else: ?>
        <p>Quer entrar em contato? Preencha o formulário abaixo para me enviar uma mensagem e retornaremos o mais breve possível!</p>
     <?php endif; ?>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form name="sentMessage" id="contactForm" action="<?php echo e(route('enviaContato')); ?>" method = "post" validate>
          <div class="control-group">
          
            <div class="form-group floating-label-form-group controls">
              <label>Nome *</label>
              <input type="text" class="form-control" placeholder="Nome" id="name" name="nome" required data-validation-required-message="Por favor, insira seu nome." <?php if($errors->has('nome')): ?> autofocus <?php endif; ?>>
              <?php if($errors->has('nome')): ?>
    <div class="error" style="color:red"><?php echo e($errors->first('nome')); ?></div>
<?php endif; ?>
              <p class="help-block text-danger"></p>
              <?php echo e(csrf_field()); ?>

            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Endereço de Email *</label>
              <input type="email" class="form-control" placeholder="Endereço de email" id="email" name="email" required data-validation-required-message="Por favor, insira seu email." <?php if($errors->has('email')): ?> autofocus <?php endif; ?>>
              <?php if($errors->has('email')): ?>
    <div class="error" style="color:red"><?php echo e($errors->first('email')); ?></div>
<?php endif; ?>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Número de Telefone</label>
              <input type="tel" class="form-control" placeholder="Número de Telefone" id="phone" name="telefone"  data-validation-required-message="Por favor, insira seu telefone." <?php if($errors->has('telefone')): ?> autofocus <?php endif; ?>>
              <?php if($errors->has('telefone')): ?>
    <div class="error" style="color:red"><?php echo e($errors->first('telefone')); ?></div>
<?php endif; ?>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Mensagem *</label>
              <textarea rows="5" class="form-control" placeholder="Mensagem" id="message" name="mensagem" required data-validation-required-message="Por favor, escreva sua mensagem." <?php if($errors->has('mensagem')): ?> autofocus <?php endif; ?>></textarea>
              <?php if($errors->has('mensagem')): ?>
    <div class="error" style="color:red"><?php echo e($errors->first('mensagem')); ?></div>
<?php endif; ?>
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
  <?php echo $__env->make('notify::messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <hr>
<?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/conteudo-contato.blade.php ENDPATH**/ ?>