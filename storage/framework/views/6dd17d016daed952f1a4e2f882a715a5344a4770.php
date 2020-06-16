
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(modallog_asset('css/main.css')); ?> ">
    <link rel="stylesheet" href="<?php echo e(modallog_asset('css/font-awesome.css')); ?> ">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_title', __('modellog::modellog.model_logs')); ?>

<?php $__env->startSection('page_header'); ?>
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-logbook"></i> <?php echo e(__('modellog::modellog.model_logs')); ?>

        </h1>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clear', app('Jahondust\ModelLog\Models\ModelLog'))): ?>
            <?php echo $__env->make('modellog::partials.clear', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-content browse container-fluid">
        <?php echo $__env->make('voyager::alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form method="get" class="form-search">
                            <div id="search-input">
                                <div class="col-2">
                                    <select id="search_key" name="key">
                                        <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php if($search->key == $key): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e($name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select id="filter" name="filter">
                                        <option value="contains" <?php if($search->filter == "contains"): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e(__('modellog::modellog.contains')); ?></option>
                                        <option value="equals" <?php if($search->filter == "equals"): ?><?php echo e('selected'); ?><?php endif; ?>>=</option>
                                    </select>
                                </div>
                                <div class="input-group col-md-12">
                                    <input type="text" class="form-control" placeholder="<?php echo e(__('voyager::generic.search')); ?>" name="s" value="<?php echo e($search->value); ?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-info btn-lg" type="submit">
                                            <i class="voyager-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <?php if(request()->has('sort_order') && request()->has('order_by')): ?>
                                <input type="hidden" name="sort_order" value="<?php echo e(request()->get('sort_order')); ?>">
                                <input type="hidden" name="order_by" value="<?php echo e(request()->get('order_by')); ?>">
                            <?php endif; ?>
                        </form>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                <tr>
                                    <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $params['order_by'] = $field;
                                            $params['sort_order'] = ($orderBy == $field && $sortOrder == 'asc') ? 'desc' : 'asc';
                                        ?>
                                        <th>
                                            <a href="<?php echo e(url()->current().'?'.http_build_query(array_merge(request()->all(), $params))); ?>">

                                                <?php echo e($name); ?>

                                                    <?php if($orderBy == $field): ?>
                                                        <?php if($sortOrder == 'asc'): ?>
                                                            <i class="voyager-angle-up pull-right"></i>
                                                        <?php else: ?>
                                                            <i class="voyager-angle-down pull-right"></i>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                            </a>
                                        </th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td>
                                                <?php if($field == 'table_name'): ?>
                                                    <h5 align="center"><?php echo e($log->{$field}); ?></h5>
                                                <?php elseif($field == 'user_id'): ?>
                                                    <i><?php echo e(isset($log->user->log_name) ? $log->user->log_name : isset($log->user->name) ? $log->user->name : ''); ?></i>
                                                <?php elseif($field == 'event'): ?>
                                                    <div class="primary"><span class="label <?php echo e($log->getType()['class']); ?>"><?php echo e($log->getType()['title']); ?></span></div>
                                                <?php elseif($field == 'before' || $field == 'after'): ?>
                                                    <?php $__currentLoopData = (array) json_decode($log->$field); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="primary"><span class="label label-default"><?php echo e($key); ?>:</span> <?php echo e($value); ?></div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php elseif($field == 'user_agent'): ?>
                                                    <div class="col-lg-6 user_agent">
                                                        <?php if( !empty($log->user_agent) ): ?>
                                                            <i class="<?php echo e($log->getUserAgent()['device']['icon']); ?>"   style=" <?php echo e($log->getUserAgent()['device']['text'] == 'Mobile' ? 'font-size:25px': ""); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e($log->getUserAgent()['device']['text']); ?>"></i>
                                                            <i class="<?php echo e($log->getUserAgent()['platform']['icon']); ?>" style="color: #62a8ea;" data-toggle="tooltip" data-placement="top" title="<?php echo e($log->getUserAgent()['platform']['version']); ?>"></i>
                                                            <i class="<?php echo e($log->getUserAgent()['browser']['icon']); ?>" style="color: #0275d8;" data-toggle="tooltip" data-placement="top" title="<?php echo e($log->getUserAgent()['browser']['version']); ?>"></i>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <?php echo e($log->{$field}); ?>

                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pull-left">
                            <div role="status" class="show-res" aria-live="polite"><?php echo e(trans_choice(
                                'voyager::generic.showing_entries', $logs->total(), [
                                    'from' => $logs->firstItem(),
                                    'to' => $logs->lastItem(),
                                    'all' => $logs->total()
                                ])); ?></div>
                        </div>
                        <div class="pull-right">
                            <?php echo e($logs->appends([
                                's' => $search->value,
                                'filter' => $search->filter,
                                'key' => $search->key,
                                'order_by' => $orderBy,
                                'sort_order' => $sortOrder,
                            ])->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('#search-input select').select2({
                minimumResultsForSearch: Infinity
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('voyager::master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\miniblog\vendor\model-log\src/../resources/views/index.blade.php ENDPATH**/ ?>