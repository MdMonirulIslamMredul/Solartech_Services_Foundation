<?php $__env->startSection('title', __('Dashboard')); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.backend.card','data' => []]); ?>
<?php $component->withName('backend.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="d-flex justify-content-between align-items-center">
            <h1>Appointment Details</h1>
            <div class="appointment-stats">
                
            </div>
        </div>
     <?php $__env->endSlot(); ?>

     <?php $__env->slot('body', null, []); ?> 
        <!-- Filter Form -->
        <div class="mb-4">
            <form method="GET" action="<?php echo e(route('admin.appointment.search')); ?>" class="form-inline">
                <label class="mr-2" for="status-filter">Filter by Status:</label>
                <select name="status" id="status-filter" class="form-control mr-2" onchange="this.form.submit()">
                    <option value="all" <?php echo e(request('status') === 'all' || request('status') === null ? 'selected' : ''); ?>>All Statuses</option>
                    <option value="connected" <?php echo e(request('status') === 'connected' ? 'selected' : ''); ?>>Connected</option>
                    <option value="not connected" <?php echo e(request('status') === 'not connected' ? 'selected' : ''); ?>>Not Connected</option>
                </select>
                <?php if(request('status') && request('status') !== 'all'): ?>
                    <a href="<?php echo e(route('admin.appointment.search')); ?>" class="btn btn-secondary btn-sm">Clear Filter</a>
                <?php endif; ?>
            </form>
        </div>
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if($appointments->isEmpty()): ?>
            <p>No appointments found.</p>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        
                        <th>Note</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e(\Carbon\Carbon::parse($appointment->date)->format('d M Y')); ?><br>
                                <?php echo e(\Carbon\Carbon::parse($appointment->time)->format('h:i A')); ?>

                            </td>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($appointment->name); ?></td>
                            <td><?php echo e($appointment->phone); ?></td>
                            <td><?php echo e($appointment->car_model); ?></td>
                            
                            <td><?php echo e($appointment->note ?? '-'); ?></td>
                            <td>
                                <span class="badge badge-<?php echo e($appointment->status === 'connected' ? 'success' : 'secondary'); ?>">
                                    <?php echo e(ucfirst($appointment->status ?? 'not connected')); ?>

                                </span>
                            </td>
                            <td>
                                <form action="<?php echo e(route('admin.appointment.updateStatus', $appointment->id)); ?>" method="POST" style="display: inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="status" value="connected">
                                    <button type="submit" class="btn btn-sm btn-success" <?php echo e($appointment->status === 'connected' ? 'disabled' : ''); ?>>
                                        Connected
                                    </button>
                                </form>
                                <form action="<?php echo e(route('admin.appointment.updateStatus', $appointment->id)); ?>" method="POST" style="display: inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="status" value="not connected">
                                    <button type="submit" class="btn btn-sm btn-secondary" <?php echo e($appointment->status === 'not connected' ? 'disabled' : ''); ?>>
                                        Not Connected
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <?php echo e($appointments->links()); ?>

        </div>
        <?php endif; ?>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

<style>
.appointment-stats .badge {
    font-size: 14px;
    padding: 8px 12px;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Solartech_Services_Foundation\resources\views/backend/content/appointment.blade.php ENDPATH**/ ?>