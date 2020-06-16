<?php if(isset($dataTypeContent->{$row->field})): ?>
    <div data-field-name="<?php echo e($row->field); ?>">
        <a href="#" class="voyager-x remove-single-image" style="position:absolute;"></a>
        <img src="<?php if( !filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL)): ?><?php echo e(Voyager::image( $dataTypeContent->{$row->field} )); ?><?php else: ?><?php echo e($dataTypeContent->{$row->field}); ?><?php endif; ?>"
          data-file-name="<?php echo e($dataTypeContent->{$row->field}); ?>" data-id="<?php echo e($dataTypeContent->getKey()); ?>"
          style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
    </div>
<?php endif; ?>
<input <?php if($row->required == 1 && !isset($dataTypeContent->{$row->field})): ?> required <?php endif; ?> type="file" name="<?php echo e($row->field); ?>" accept="image/*">
<?php /**PATH C:\xampp\htdocs\miniblog\vendor\tcg\voyager\src/../resources/views/formfields/image.blade.php ENDPATH**/ ?>