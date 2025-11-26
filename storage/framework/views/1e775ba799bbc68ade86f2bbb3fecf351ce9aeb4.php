<?php $__env->startSection('title', ' About Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('admin.about.committee.store')); ?>"
                        enctype="multipart/form-data" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Position</label>
                            <input type="text" name="position" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Details</label>
                            <input type="text" name="details" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        
                        
                        
                        <div class="form-group">
                            <label>Has Description ?</label>
                            <select name="has_description" id="" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="" class="editor form-control" col="10" row="3" name="description"></textarea>
                        </div>
                        <div class="table-responsive">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>





    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Position</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $committees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($committee->type_id == $t->id): ?>
                                    <?php
                                        $t_name = $t->type;
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><img src="<?php echo e(asset('/setting/committee/' . $committee->photo) ?? 'N/A'); ?>"
                                        style="height: 100px">
                                </td>
                                <td><?php echo e($committee->name ?? 'N/A'); ?></td>
                                <td><?php echo e($t_name ?? 'N/A'); ?></td>
                                <td><?php echo e($committee->position ?? 'N/A'); ?></td>
                                <td><?php echo e($committee->details ?? 'N/A'); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.about.committee.edit', ['id' => $committee->id])); ?>"
                                        class="btn btn-success">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <?php $__env->startPush('after-styles'); ?>
        <?php echo e(style(asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css'))); ?>

    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('after-scripts'); ?>
        <?php echo script(asset('assets/plugins/tinymce/jquery.tinymce.min.js')); ?>

        <?php echo script(asset('assets/plugins/tinymce/tinymce.min.js')); ?>

        <?php echo script(asset('assets/plugins/tinymce/editor-helper.js')); ?>

        <?php echo script(asset('assets/plugins/moment/moment.js')); ?>

        <?php echo script(asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>


        <script>
            $(document).ready(function() {
                simple_editor('.editor', 450);
                $('#datepicker-autoclose').datepicker({
                    format: "dd/mm/yyyy",
                    clearBtn: true,
                    autoclose: true,
                    todayHighlight: true,
                });

                $("#image").change(function() {
                    readImageURL(this, $('#holder'));
                });
            });


            $(document).on('blur', "#post_title", function() {
                let postField = $(this);
                let post_title = postField.val();
                if (post_title) {
                    ajax_slug_url(post_title);
                    setTimeout(update, 1000); // 30 seconds
                    $("#post_error").empty();
                    postField.removeClass('is-invalid');
                } else {
                    $("#post_error").text('Title must not empty');
                    postField.addClass('is-invalid');
                }
            });

            $(function() {
                $(".form-check-input").click(function() {
                    const status = $(this).val();
                    if (status === "schedule") {
                        $("#scheduleDate").removeClass("d-none");
                    } else if (status === "1") {
                        $("#for_New_upload").removeClass("d-none");
                    } else if (status === "0") {
                        $("#for_New_upload").addClass("d-none");
                    } else {
                        $("#scheduleDate").addClass("d-none");
                    }
                });

            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Solartech_Services_Foundation\resources\views/backend/content/about/committee/index.blade.php ENDPATH**/ ?>