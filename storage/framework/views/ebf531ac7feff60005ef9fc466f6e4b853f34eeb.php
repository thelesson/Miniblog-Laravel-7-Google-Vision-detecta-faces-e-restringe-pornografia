<?php $__env->startSection('page_header'); ?>
    <h1 class="page-title">
        <i class="voyager-hook"></i> Hooks
        <div class="btn btn-success install">
            <i class="voyager-plus"></i> Add hook
        </div>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header_actions'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-content container-fluid">
        <?php if(request()->has('message')): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-<?php echo e(request('message_type', 'info')); ?>">
                        <p><?php echo e(request('message')); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if($daysSinceLastCheck >= 10): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <p>You have not checked for any updates for the last <?php echo e($daysSinceLastCheck); ?> days.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Enabled</th>
                                <th class="actions">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $hooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <i class="voyager-<?php echo e($hook->type); ?>"></i> <?php echo e($hook->name); ?>

                                    </td>
                                    <td>
                                        <?= ($hook->enabled ? '<i class="voyager-check"></i> ENABLED' : '<i class="voyager-x"></i> DISABLED') ?>
                                    </td>
                                    <td class="no-sort no-click">
                                        <div class="btn-sm btn-danger pull-right delete" data-id="<?php echo e($hook->name); ?>" id="delete-<?php echo e($hook->name); ?>">
                                            <i class="voyager-trash"></i> Uninstall
                                        </div>
                                        <a href="<?php echo e(route('voyager.hooks.'.($hook->enabled ? 'disable' : 'enable'), $hook->name)); ?>" class="btn-sm btn-primary pull-right edit">
                                            <i class="voyager-edit"></i> <?php echo e($hook->enabled ? 'Disable' : 'Enable'); ?>

                                        </a>
                                        <?php /*
                                        @if ($hook->hasUpdateAvailable())
                                            <a href="{{ route('voyager.hooks.update', $hook->name) }}" class="btn-sm btn-warning pull-right update">
                                                <i class="voyager-edit"></i> Update
                                            </a>
                                        @endif
                                        */ ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to uninstall
                        this hook?</h4>
                </div>
                <div class="modal-footer">
                    <form action="<?php echo e(route('voyager.hooks')); ?>" id="delete_form" method="POST">
                        <?php echo e(method_field("DELETE")); ?>

                        <?php echo e(csrf_field()); ?>

                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="Yes, Delete This Hook">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal modal-success fade" tabindex="-1" id="install_modal" role="dialog">
        <div class="modal-dialog">
            <form class="modal-content" action="<?php echo e(route('voyager.hooks')); ?>" id="install_form" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-plus"></i>Install new hook.</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name of hook">
                    </div>
                </div>
                <div class="modal-footer">
                        <?php echo e(csrf_field()); ?>

                        <input type="submit" class="btn btn-success pull-right install-confirm"
                               value="Install">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <!-- DataTables -->
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({ "order": [] });
        });

        $('.page-title').on('click', '.install', function (e) {
            var form = $('#install_form')[0];

            $('#install_modal').modal('show');
        });

        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];

            form.action = parseActionUrl(form.action, $(this).data('id'));

            $('#delete_modal').modal('show');
        });

        function parseActionUrl(action, id) {
            return action.match(/\/[0-9]+$/)
                    ? action.replace(/([0-9]+$)/, id)
                    : action + '/' + id;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('voyager::master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\miniblog\vendor\larapack\voyager-hooks\src/../resources/views/browse.blade.php ENDPATH**/ ?>