<?php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
?>



<?php $__env->startSection('css'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular')); ?>

<?php $__env->startSection('page_header'); ?>
    <h1 class="page-title">
        <i class="<?php echo e($dataType->icon); ?>"></i>
        <?php echo e(__('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular')); ?>

    </h1>
    <?php echo $__env->make('voyager::multilingual.language-selector', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form" action="<?php if($edit): ?><?php echo e(route('voyager.posts.update', $dataTypeContent->id)); ?><?php else: ?><?php echo e(route('voyager.posts.store')); ?><?php endif; ?>" method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            <?php if($edit): ?>
                <?php echo e(method_field("PUT")); ?>

            <?php endif; ?>
            <?php echo e(csrf_field()); ?>


            <div class="row">
                <div class="col-md-8">
                    <!-- ### TITLE ### -->
                    <div class="panel">
                        <?php if(count($errors) > 0): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="voyager-character"></i> <?php echo e(__('voyager::post.title')); ?>

                                <span class="panel-desc"> <?php echo e(__('voyager::post.title_sub')); ?></span>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?php echo $__env->make('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'title',
                                '_field_trans' => get_field_translations($dataTypeContent, 'title')
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="text" class="form-control" id="title" name="title" placeholder="<?php echo e(__('voyager::generic.title')); ?>" value="<?php echo e($dataTypeContent->title ?? ''); ?>">
                        </div>
                        <!--SUTITULO HACK-->
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="voyager-character"></i> <?php echo e(__('voyager::post.subtitle')); ?>

                                <span class="panel-desc"> <?php echo e(__('voyager::post.subtitle_sub')); ?></span>
                            </h3>
                           
                        </div>
                        <div class="panel-body">
                            <?php echo $__env->make('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'subtitle',
                                '_field_trans' => get_field_translations($dataTypeContent, 'subtitle')
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="<?php echo e(__('voyager::generic.subtitle')); ?>" value="<?php echo e($dataTypeContent->subtitle ?? ''); ?>">
                        </div>
                        <!--END HACK-->
                    </div>

                    <!-- ### CONTENT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo e(__('voyager::post.content')); ?></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <?php echo $__env->make('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'body',
                                '_field_trans' => get_field_translations($dataTypeContent, 'body')
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                                $row = $dataTypeRows->where('field', 'body')->first();
                            ?>
                            <?php echo app('voyager')->formField($row, $dataType, $dataTypeContent); ?>

                        </div>
                    </div><!-- .panel -->

                    <!-- ### EXCERPT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo __('voyager::post.excerpt'); ?></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?php echo $__env->make('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'excerpt',
                                '_field_trans' => get_field_translations($dataTypeContent, 'excerpt')
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <textarea class="form-control" name="excerpt"><?php echo e($dataTypeContent->excerpt ?? ''); ?></textarea>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo e(__('voyager::post.additional_fields')); ?></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                                $exclude = ['title', 'subtitle','body', 'excerpt', 'slug', 'status', 'category_id', 'author_id', 'featured', 'image', 'meta_description', 'meta_keywords', 'seo_title'];
                            ?>

                            <?php $__currentLoopData = $dataTypeRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!in_array($row->field, $exclude)): ?>
                                    <?php
                                        $display_options = $row->details->display ?? NULL;
                                    ?>
                                    <?php if(isset($row->details->formfields_custom)): ?>
                                        <?php echo $__env->make('voyager::formfields.custom.' . $row->details->formfields_custom, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php else: ?>
                                        <div class="form-group <?php if($row->type == 'hidden'): ?> hidden <?php endif; ?> <?php if(isset($display_options->width)): ?><?php echo e('col-md-' . $display_options->width); ?><?php endif; ?>" <?php if(isset($display_options->id)): ?><?php echo e("id=$display_options->id"); ?><?php endif; ?>>
                                            <?php echo e($row->slugify); ?>

                                            <label for="name"><?php echo e($row->getTranslatedAttribute('display_name')); ?></label>
                                            <?php echo $__env->make('voyager::multilingual.input-hidden-bread-edit-add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php if($row->type == 'relationship'): ?>
                                                <?php echo $__env->make('voyager::formfields.relationship', ['options' => $row->details], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php else: ?>
                                                <?php echo app('voyager')->formField($row, $dataType, $dataTypeContent); ?>

                                            <?php endif; ?>

                                            <?php $__currentLoopData = app('voyager')->afterFormFields($row, $dataType, $dataTypeContent); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $after): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo $after->handle($row, $dataType, $dataTypeContent); ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <!-- ### DETAILS ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-clipboard"></i> <?php echo e(__('voyager::post.details')); ?></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="slug"><?php echo e(__('voyager::post.slug')); ?></label>
                                <?php echo $__env->make('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'slug',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'slug')
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <input type="text" class="form-control" id="slug" name="slug"
                                    placeholder="slug"
                                    <?php echo isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug"); ?>

                                    value="<?php echo e($dataTypeContent->slug ?? ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="status"><?php echo e(__('voyager::post.status')); ?></label>
                                <select class="form-control" name="status">
                                    <option value="PUBLISHED"<?php if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PUBLISHED'): ?> selected="selected"<?php endif; ?>><?php echo e(__('voyager::post.status_published')); ?></option>
                                    <option value="DRAFT"<?php if(isset($dataTypeContent->status) && $dataTypeContent->status == 'DRAFT'): ?> selected="selected"<?php endif; ?>><?php echo e(__('voyager::post.status_draft')); ?></option>
                                    <option value="PENDING"<?php if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PENDING'): ?> selected="selected"<?php endif; ?>><?php echo e(__('voyager::post.status_pending')); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category_id"><?php echo e(__('voyager::post.category')); ?></label>
                                <select class="form-control" name="category_id">
                                    <?php $__currentLoopData = Voyager::model('Category')::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"<?php if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id): ?> selected="selected"<?php endif; ?>><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="featured"><?php echo e(__('voyager::generic.featured')); ?></label>
                                <input type="checkbox" name="featured"<?php if(isset($dataTypeContent->featured) && $dataTypeContent->featured): ?> checked="checked"<?php endif; ?>>
                            </div>
                        </div>
                    </div>

                    <!-- ### IMAGE ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-image"></i> <?php echo e(__('voyager::post.image')); ?></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?php if(isset($dataTypeContent->image)): ?>
                                <img src="<?php echo e(filter_var($dataTypeContent->image, FILTER_VALIDATE_URL) ? $dataTypeContent->image : Voyager::image( $dataTypeContent->image )); ?>" style="width:100%" />
                            <?php endif; ?>
                            <input type="file" name="image">
                        </div>
                    </div>

                    <!-- ### SEO CONTENT ### -->
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-search"></i> <?php echo e(__('voyager::post.seo_content')); ?></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="meta_description"><?php echo e(__('voyager::post.meta_description')); ?></label>
                                <?php echo $__env->make('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'meta_description',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'meta_description')
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <textarea class="form-control" name="meta_description"><?php echo e($dataTypeContent->meta_description ?? ''); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords"><?php echo e(__('voyager::post.meta_keywords')); ?></label>
                                <?php echo $__env->make('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'meta_keywords',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'meta_keywords')
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <textarea class="form-control" name="meta_keywords"><?php echo e($dataTypeContent->meta_keywords ?? ''); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="seo_title"><?php echo e(__('voyager::post.seo_title')); ?></label>
                                <?php echo $__env->make('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'seo_title',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'seo_title')
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <input type="text" class="form-control" name="seo_title" placeholder="SEO Title" value="<?php echo e($dataTypeContent->seo_title ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $__env->startSection('submit-buttons'); ?>
                <button type="submit" class="btn btn-primary pull-right">
                     <?php if($edit): ?><?php echo e(__('voyager::post.update')); ?><?php else: ?> <i class="icon wb-plus-circle"></i> <?php echo e(__('voyager::post.new')); ?> <?php endif; ?>
                </button>
            <?php $__env->stopSection(); ?>
            <?php echo $__env->yieldContent('submit-buttons'); ?>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="<?php echo e(route('voyager.upload')); ?>" target="form_target" method="post"
                enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
            <input name="image" id="upload_file" type="file"
                     onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="<?php echo e($dataType->slug); ?>">
            <?php echo e(csrf_field()); ?>

        </form>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> <?php echo e(__('voyager::generic.are_you_sure')); ?></h4>
                </div>

                <div class="modal-body">
                    <h4><?php echo e(__('voyager::generic.are_you_sure_delete')); ?> '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(__('voyager::generic.cancel')); ?></button>
                    <button type="button" class="btn btn-danger" id="confirm_delete"><?php echo e(__('voyager::generic.delete_confirm')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '<?php echo e($dataType->slug); ?>',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '<?php echo e(csrf_token()); ?>'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('#slug').slugify();

            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            <?php if($isModelTranslatable): ?>
                $('.side-body').multilingual({"editing": true});
            <?php endif; ?>

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('<?php echo e(route('voyager.'.$dataType->slug.'.media.remove')); ?>', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('voyager::master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\miniblog\resources\views/vendor/voyager/posts/edit-add.blade.php ENDPATH**/ ?>