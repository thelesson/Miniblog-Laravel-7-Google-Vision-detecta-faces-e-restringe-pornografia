<footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
          <?php if(!empty($footer)): ?>
          <?php $__currentLoopData = $footer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-inline-item">
              <a href="<?php echo e($f->url); ?>" <?php if(!empty($f->target)): ?> target="_blank" <?php endif; ?>>
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="<?php echo e($f->icone); ?> fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </ul>
          <p class="copyright text-muted">Copyright &copy; 2020 - Frontend by Start Bootstrap and Backend by Thélesson de Souza</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo e(asset('frontend/vendor/jquery/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

  <!-- Custom scripts for this template -->
  <script src="<?php echo e(asset('frontend/js/clean-blog.min.js')); ?>"></script>
  <?php echo notifyJs(); ?>

<?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/footer.blade.php ENDPATH**/ ?>