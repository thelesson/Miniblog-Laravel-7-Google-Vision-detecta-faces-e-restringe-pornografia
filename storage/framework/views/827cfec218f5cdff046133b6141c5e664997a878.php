<div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body bg-warning p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span style="color:white;" class="stats-small__label text-uppercase">Postagens Pendentes</span>
                        <?php $postuserPP = \App\Post::where('author_id',Auth()->user()->id)->where('status','PENDING')->count(); ?>
                       <h6 style="color:white;" class="stats-small__value count my-3"><?php if(!empty($postuserPP)): ?> <?php echo e($postuserPP); ?> <?php else: ?> 0 <?php endif; ?></h6>
                      </div>
                     
                    </div>
                   
                  </div>
                </div>
              </div><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/autenticado/widgets/cards/usuarios/postagensPendentes.blade.php ENDPATH**/ ?>