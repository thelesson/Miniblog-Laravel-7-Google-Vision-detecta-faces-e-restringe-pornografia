
<header class="masthead" style="background-image: url('<?php echo e(Voyager::image( $post->image)); ?>')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1><?php echo e($post->title); ?></h1>
            <?php if(!empty($post->subtitle)): ?>
            <h2 class="subheading"><?php echo e($post->subtitle); ?></h2>
            <?php elseif(!empty($post->excerpt)): ?>
            <h2 class="subheading"><?php echo e($post->excerpt); ?></h2>
            <?php else: ?>
            <?php endif; ?>
            <?php if(isset($post->autor->avatar)): ?>
            <span class="meta">Postado por
              <a href="#"><?php echo e($post->autor->name); ?></a>
              <?php echo e($post->created_at->diffForHumans()); ?></span>
               <?php else: ?>
                    <?php $deletado  = \App\User::onlyTrashed()->find($post->author_id);?>
                    <?php if(!empty($deletado)): ?>
                    <span class="meta">Postado por
              <a href="#"><?php echo e($deletado->name); ?></a>
              <?php echo e($post->created_at->diffForHumans()); ?></span>  
                    <?php else: ?>
                    <span class="meta">Postado por
              <a href="#">Admin</a>
              <?php echo e($post->created_at->diffForHumans()); ?></span>
                    <?php endif; ?>
                  <?php endif; ?>
          
          </div>
        </div>
      </div>
    </div>
  </header><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/header-posts.blade.php ENDPATH**/ ?>