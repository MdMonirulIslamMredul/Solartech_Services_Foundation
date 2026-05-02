<?php $__env->startSection('title', 'Manage Service Areas'); ?>

<?php
    $required = html()
        ->span('*')
        ->class('text-danger');
    $demoImg = 'img/backend/front-logo.png';
?>

<?php $__env->startSection('content'); ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        .modal-confirm {
            color: #636363;
            width: 400px;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }

        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }

        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }

        .modal-confirm .modal-body {
            color: #999;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
        }

        .modal-confirm .modal-footer a {
            color: #999;
        }

        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }

        .modal-confirm .icon-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }

        .modal-confirm .btn,
        .modal-confirm .btn:active {
            color: #fff;
            border-radius: 4px;
            background: #60c7c1;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            border-radius: 3px;
            margin: 0 5px;
        }

        .modal-confirm .btn-secondary {
            background: #c1c1c1;
        }

        .modal-confirm .btn-secondary:hover,
        .modal-confirm .btn-secondary:focus {
            background: #a8a8a8;
        }

        .modal-confirm .btn-danger {
            background: #f15e5e;
        }

        .modal-confirm .btn-danger:hover,
        .modal-confirm .btn-danger:focus {
            background: #ee3535;
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
    </style>
     <?php
        $multis = DB::table('servic_areas')
            ->where('is_active', 1)
            ->orwhere('is_active', 0)
            ->get();
    ?>
<div class="card">
    <div class="card-header with-border">
        <h3 class="card-title">Add New Service Area</h3>
    </div>
    <div class="card-body">
        <?php echo e(html()->form('POST', route('admin.area.store'))->attribute('enctype', 'multipart/form-data')->open()); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(html()->label('Area Name')->for('areaname')); ?>

                    <?php echo e(html()->text('areaname')->class('form-control')->placeholder('Enter Area Name')->required()); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(html()->label('Description')->for('description')); ?>

                    <?php echo e(html()->text('description')->class('form-control')->placeholder('Details about this area')); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <?php echo e(html()->label('Image')->for('image')); ?>

                            <?php echo e(html()->file('image')->class('form-control-file image d-none')->id('image')->acceptImage()); ?>

                            <div class="d-block">
                                <label for="image">
                                    <img src="<?php echo e(asset($demoImg)); ?>" class="border img-fluid rounded holder" alt="Upload">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo e(html()->button('Save')->class('btn btn-block btn-primary')); ?>

        <?php echo e(html()->form()->close()); ?>

    </div>
</div>


<div class="col-lg-12 mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Service Areas</h3>
        </div>
        <div class="card-body">
            <table id="serviceAreaTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Area Name</th>
                        <th>Description</th>
                        <th>Active/Deactive</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $multis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $multi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td>
            <img src="<?php echo e(asset($multi->image)); ?>" style="height: 100px">
        </td>
        <td><?php echo e($multi->areaname); ?></td>
        <td><?php echo e(Str::limit($multi->description, 20)); ?></td>

        <td>
            <?php if($multi->is_active == 1): ?>
                <button class="btn btn-sm btn-primary">Active</button>
            <?php elseif($multi->is_active == 0): ?>
                <button class="btn btn-sm btn-danger">Deactive</button>
            <?php endif; ?>
        </td>


        <td>


            <a href="<?php echo e(route('admin.area.edit', $multi->id)); ?>" class="btn btn-primary btn-sm editProduct">
                Edit
            </a>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Solartech_Services_Foundation\resources\views/backend/content/settings/servicearea/index.blade.php ENDPATH**/ ?>