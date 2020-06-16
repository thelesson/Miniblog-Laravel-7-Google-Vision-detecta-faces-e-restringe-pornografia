<?php if(session()->has('notify.message')): ?>

    <?php if(session()->get('notify.model') === 'toast'): ?>
        <div class="notify-alert notify-<?php echo e(session()->get('notify.type')); ?> <?php echo e(config('notify.theme')); ?> animated <?php echo e(config('notify.animate.in_class')); ?>" role="alert">
            <div class="notify-alert-icon"><i class="<?php echo e(session()->get('notify.icon')); ?>"></i></div>
            <div class="notify-alert-text">
                <h4><?php echo e(session()->get('notify.title') ?? session()->get('notify.type')); ?></h4>
                <p><?php echo e(session()->get('notify.message')); ?></p>
            </div>
            <div class="notify-alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="flaticon2-cross"></i></span>
                </button>
            </div>
        </div>
    <?php endif; ?>

    <?php if(session()->get('notify.model') === 'smiley'): ?>
        <div class="smiley-alert smiley-<?php echo e(session()->get('notify.type')); ?> <?php echo e(config('notify.theme')); ?> animated <?php echo e(config('notify.animate.in_class')); ?>" role="alert">
            <div class="smiley-icon"><span><?php echo e(session()->get('notify.icon')); ?></span></div>
            <div class="smiley-text">
                <p><span class="title"><?php echo e(session()->get('notify.type')); ?>!</span> <?php echo e(session()->get('notify.message')); ?></p>
            </div>
            <div class="smiley-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="flaticon2-cross"></i></span>
                </button>
            </div>
        </div>
    <?php endif; ?>

    <?php if(session()->get('notify.model') === 'drake'): ?>
        <div class="drake-alert drake-<?php echo e(session()->get('notify.type')); ?> animated <?php echo e(config('notify.animate.in_class')); ?>" role="alert">
            <div class="drake-icon">
                <span><i class="flaticon2-check-mark"></i></span>
                <h4><?php echo e(session()->get('notify.message')); ?></h4>
            </div>
        </div>
    <?php endif; ?>

    <?php if(session()->get('notify.model') === 'connect'): ?>
        <div class="connectify-alert connectify-<?php echo e(session()->get('notify.type')); ?> <?php echo e(config('notify.theme')); ?> animated <?php echo e(config('notify.animate.in_class')); ?>" role="alert">
            <div class="connectify-icon">
                <i class="flaticon-like"></i><span><?php echo e(session()->get('notify.type')); ?></span>
            </div>
            <div class="connectify-text">
                <h4><?php echo e(session()->get('notify.title')); ?></h4>
                <p><?php echo e(session()->get('notify.message')); ?></p>
            </div>
            <div class="connectify-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="flaticon2-cross"></i>
                    </span>
                </button>
            </div>
        </div>
    <?php endif; ?>

    <?php if(session()->get('notify.model') === 'emotify'): ?>
        <div class="emoticon-alert emoticon-<?php echo e(session()->get('notify.type')); ?> animated <?php echo e(config('notify.animate.in_class')); ?>" role="alert">
            <div class="emoticon-icon"><span></span></div>
            <div class="emoticon-text">
                <p><?php echo e(session()->get('notify.message')); ?></p>
            </div>
            <div class="emoticon-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="flaticon2-cross"></i></span>
                </button>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>

<?php echo e(session()->forget('notify.message')); ?>


<script>

    var notify = {
        timeout: "<?php echo e(config('notify.animate.timeout')); ?>",
        animatedIn: "<?php echo e(config('notify.animate.in_class')); ?>",
        animatedOut: "<?php echo e(config('notify.animate.out_class')); ?>",
        position: "<?php echo e(config('notify.position')); ?>"
    }

</script>
<?php /**PATH C:\xampp\htdocs\miniblog\vendor\mckenziearts\laravel-notify\src/../resources/views/messages.blade.php ENDPATH**/ ?>