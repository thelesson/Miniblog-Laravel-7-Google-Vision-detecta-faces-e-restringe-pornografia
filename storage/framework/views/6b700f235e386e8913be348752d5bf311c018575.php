<a class="btn btn-danger" id="clear_btn"><i class="voyager-trash"></i> <span><?php echo e(__('modellog::modellog.clear_log')); ?></span></a>


<div class="modal modal-danger fade" tabindex="-1" id="clear_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="voyager-trash"></i> <?php echo e(__('modellog::modellog.clear_title')); ?></span>
                </h4>
            </div>
            <form action="<?php echo e(route('voyager.model_log.clear')); ?>" id="clear_form" method="POST">
                <?php echo e(method_field("DELETE")); ?>

                <?php echo e(csrf_field()); ?>

                <div class="modal-body" id="clear_modal_body">
                    <input type="text" name="table_name" placeholder="<?php echo e(__('modellog::modellog.table_name')); ?>" class="form-control">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="start"><?php echo e(__('modellog::modellog.start_date')); ?></label>
                            <input type="date" name="start_date" class="form-control" id="start">
                        </div>
                        <div class="col-md-6">
                            <label for="end"><?php echo e(__('modellog::modellog.end_date')); ?></label>
                            <input type="date" name="end_date" class="form-control" id="end">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="<?php echo e(__('modellog::modellog.clear_log')); ?>">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                        <?php echo e(__('modellog::modellog.cancel')); ?>

                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    window.onload = function () {
        // Bulk delete selectors
        var $bulkDeleteBtn = $('#clear_btn');
        var $bulkDeleteModal = $('#clear_modal');
        // Reposition modal to prevent z-index issues
        $bulkDeleteModal.appendTo('body');
        // Bulk delete listener
        $bulkDeleteBtn.click(function () {
            $bulkDeleteModal.modal('show');
        });
    }
</script>
<?php /**PATH C:\xampp\htdocs\miniblog\vendor\model-log\src/../resources/views/partials/clear.blade.php ENDPATH**/ ?>