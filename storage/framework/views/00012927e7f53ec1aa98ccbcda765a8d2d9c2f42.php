<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    
<?php echo $__env->make('partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <body>
    <?php echo $__env->make('partials.menuprincipal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partials.header-contato', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partials.conteudo-contato', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       <!-- Contact Form JavaScript -->
       <script src="<?php echo e(asset('frontend/js/jqBootstrapValidation.js')); ?>"></script>
       <script src="<?php echo e(asset('frontend/js/contact_me.js')); ?>"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\miniblog\resources\views/contato.blade.php ENDPATH**/ ?>