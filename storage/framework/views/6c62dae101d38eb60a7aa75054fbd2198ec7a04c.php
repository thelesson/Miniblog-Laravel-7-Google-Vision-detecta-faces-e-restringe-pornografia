

           <?php if(auth()->check()): ?>
           <?php $regra = \App\Role::where('id',auth()->user()->role_id)->first(); ?>
                       
                        <?php if(!empty($regra)): ?>
   <?php if($regra->name ==="admin2"): ?>
   <div class="error">
            <div class="error__content">
              <h2>Implementação Futura</h2>
              <h3>Em breve está página estará disponivel</h3>
              <p>Na próxima atualização adicionaremos recursos para usuários logados.</p>
              <button type="button" class="btn btn-accent btn-pill">&larr; Voltar</button>
            </div>
            <!-- / .error_content -->
          </div>
   <?php else: ?>
   <div class="error">
            <div class="error__content">
              <h2>Acesso Negado</h2>
              <h3>Algo inesperado ocorreu!</h3>
              <p>Você não possui privilégios necessários para acessar esta página.</p>
              <button type="button" class="btn btn-accent btn-pill">&larr; Voltar</button>
            </div>
            <!-- / .error_content -->
          </div>
   <?php endif; ?>
  
   <?php endif; ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/errors/erropermissao.blade.php ENDPATH**/ ?>