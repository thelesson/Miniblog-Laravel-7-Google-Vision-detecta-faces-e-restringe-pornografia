<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <li class="nav-item">
         <?php $page =  \App\Page::where('slug',$menu_item->url)->first(); ?>
          <?php if(!empty($page)): ?>
          <?php if($page->status ==='ACTIVE'): ?>
            <a class="nav-link" href="/pagina/<?php echo e($menu_item->url); ?>"><?php echo e($menu_item->title); ?></a>
            <?php endif; ?>
            <?php endif; ?>
           
           
          </li>
          
        <?php $status = \App\Settings::where('key', 'pagina-contato.status')->first();
             $slugz   = \App\Settings::where('key', 'pagina-contato.slug')->first();
         ?>
          <?php if(!empty($status) && !empty($slugz)): ?>
          
            <?php if($status->value ==='ACTIVE' && $menu_item->url ===$slugz->value): ?>
            
            <li class="nav-item">
            <a class="nav-link" href="/paginas<?php echo e($menu_item->url); ?>"><?php echo e($menu_item->title); ?></a>

            </li>
            <?php endif; ?>
           <?php endif; ?>

           
           <?php if(empty($page) ): ?>
           <?php if($menu_item->url !==$slugz->value): ?>
           <li class="nav-item">
            <a class="nav-link" href="<?php echo e($menu_item->url); ?>"><?php echo e($menu_item->title); ?></a>

            </li>
            <?php endif; ?>
           <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/partials/menuhook.blade.php ENDPATH**/ ?>