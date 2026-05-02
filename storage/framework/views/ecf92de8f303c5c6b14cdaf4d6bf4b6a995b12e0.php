<?php $__env->startSection('title', 'Edit Service Area'); ?>

<?php
    $demoImg = 'img/backend/no-image.png';
?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Service Area</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.area.update')); ?>" enctype="multipart/form-data" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($area->id); ?>">

                    <div class="row">
                        <!-- Area Name -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Area Name</label>
                                <input type="text" name="areaname" value="<?php echo e(old('areaname', $area->areaname)); ?>" class="form-control" required>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" value="<?php echo e(old('description', $area->description)); ?>" class="form-control">
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                                <input type="hidden" name="oldimage" value="<?php echo e($area->image); ?>">
                            </div>
                            <div class="mt-2">
                                <img src="<?php echo e($area->image ? asset($area->image) : asset($demoImg)); ?>" alt="Current Image" style="height: 100px;">
                            </div>
                        </div>

                        <!-- is_active -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="is_active" class="form-control">
                                    <option value="1" <?php echo e($area->is_active == 1 ? 'selected' : ''); ?>>Active</option>
                                    <option value="0" <?php echo e($area->is_active == 0 ? 'selected' : ''); ?>>Deactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Solartech_Services_Foundation\resources\views/backend/content/settings/servicearea/edite.blade.php ENDPATH**/ ?>