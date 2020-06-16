<div class="col-lg col-md-4 col-sm-12 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Usuários Online  </span>
                        
                        <?php if(!empty($usersOnline)): ?>
                        <?php if($usersOnline !=false): ?>
                        <h6 class="stats-small__value count my-3" style="color:green;">
                        <?php echo e($usersOnline); ?></h6>
                        <?php else: ?>
                        <p>O rastreador de site nao está ativo</p>
                        <p>Ative em Config/tracker</p>
                        <?php endif; ?>
                        <?php else: ?>
                        <p>O rastreador de site nao está ativo</p>
                        <span>:(</span>
                        <?php endif; ?>
                      </div>
                    
                    </div>
                  </div>
                </div>
              </div>
            <?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/widgets/cards/usuariosOnline.blade.php ENDPATH**/ ?>