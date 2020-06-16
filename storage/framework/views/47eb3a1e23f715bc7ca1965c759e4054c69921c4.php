<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
      <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="post-preview">
        <?php if($p->featured ===0): ?>
          <a href="post/<?php echo e($p->slug); ?>">
          <?php else: ?>
           <?php if(Auth::check()): ?>
           <a href="post/<?php echo e($p->slug); ?>">
           <?php else: ?>
           <a href="/login">
           <?php endif; ?>
       
          <?php endif; ?>
            <h2 class="post-title">
              <?php echo e($p->title); ?>

            </h2>
            <?php if($p->featured ===1): ?>
            <span  style="color:white!important;" class="card-post__category badge badge-pill badge-dark">Exclusivo para membros</span>
           <?php endif; ?>
            <h3 class="post-subtitle">
            <?php echo e($p->excerpt); ?>

            </h3>
          </a>
          <?php if(isset($p->autor->avatar)): ?>
          <p class="post-meta">Postado por
            <a href="#"><?php echo e($p->autor->name); ?></a>
             <?php echo e($p->created_at->diffForHumans()); ?></p>    
                    <?php else: ?>
                    <?php $deletado  = \App\User::onlyTrashed()->find($p->author_id);?>
                    <?php if(!empty($deletado)): ?>
                    <p class="post-meta">Postado por
            <a href="#"><?php echo e($deletado->name); ?></a>
             <?php echo e($p->created_at->diffForHumans()); ?></p>    
                    <?php else: ?>
                    <p class="post-meta">Postado por
            <a href="#">Admin</a>
             <?php echo e($p->created_at->diffForHumans()); ?></p>
                    <?php endif; ?>
                  <?php endif; ?>
          
        </div>
        <hr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!-- Pager -->
        <div class="clearfix">
         <?php echo e($posts->links()); ?>

        </div>
      </div>
    </div>
  </div>

  <hr><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/conteudo.blade.php ENDPATH**/ ?>