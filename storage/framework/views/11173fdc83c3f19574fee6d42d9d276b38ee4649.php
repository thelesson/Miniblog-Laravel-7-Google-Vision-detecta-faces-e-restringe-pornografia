<div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body  p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Postagens Enviadas</span>
                        <?php $postuser = \App\Post::where('author_id',Auth()->user()->id)->count(); ?>
                        <h6 class="stats-small__value count my-3"><?php if(!empty($postuser)): ?> <?php echo e($postuser); ?> <?php else: ?> 0 <?php endif; ?></h6>
                      </div>
           
                    </div>
                   
                  </div>
                </div>
              </div><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/widgets/cards/usuarios/postagensEnviadas.blade.php ENDPATH**/ ?>