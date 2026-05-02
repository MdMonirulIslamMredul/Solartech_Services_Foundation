<form method="post" <?php echo e($attributes->merge(['action' => '#', 'class' => 'form-horizontal'])); ?>>
    <?php echo csrf_field(); ?>
    <?php echo method_field('patch'); ?>

    <?php echo e($slot); ?>

</form>
<?php /**PATH C:\laragon\www\Solartech_Services_Foundation\resources\views/components/forms/patch.blade.php ENDPATH**/ ?>