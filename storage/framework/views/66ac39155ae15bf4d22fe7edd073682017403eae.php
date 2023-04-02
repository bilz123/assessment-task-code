<?php
    $isEdit = isset($event) ? true : false;
    $url = $isEdit ? route('events.update', $event->id) : route('events.store');
?>
<h5 class="title pb-3"><?php echo e($isEdit ? 'Update' : 'Add New'); ?> Event</h5>

<form action="<?php echo e($url); ?>" method="post" ajax-form data-modal="#ajax-modal" data-datatable="#events-dt">
    <?php echo csrf_field(); ?>
    <?php if($isEdit): ?>
    <?php echo method_field('put'); ?>
    <?php endif; ?>

    <div class="row gy-4">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label" for="name">Event Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg" name="event_name" id="event_name"value="<?php echo e(@$event->event_name); ?>" placeholder="Enter Title">
                <span class="invalid-feedback pb-3" role="alert"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="description">Start Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-lg" id="start_date" name="start_date" min="<?php echo e(date('Y-m-d')); ?>" value="<?php echo e($isEdit ? $event->start_date : ''); ?>">
                <span class="invalid-feedback pb-3" role="alert"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="description">End Date </label>
                <input type="date" class="form-control form-control-lg" id="end_date" name="end_date" value="<?php echo e($isEdit ? $event->end_date : ''); ?>">
                <span class="invalid-feedback pb-3" role="alert"></span>
            </div>
        </div>
       
        <div class="col-12">
            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                <li><button type="submit" class="btn btn-lg btn-primary">Save</button></li>
                <li><button type="button" class="link link-light" modal-close>Cancel</button></li>
            </ul>
        </div>
    </div>
</form><?php /**PATH C:\xampp\htdocs\NorthBankApp\resources\views/admindashboard/events/modal.blade.php ENDPATH**/ ?>