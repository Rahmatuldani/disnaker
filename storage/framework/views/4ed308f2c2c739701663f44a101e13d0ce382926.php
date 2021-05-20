<?php $__env->startSection('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="jumbotron">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Basic Card Example -->
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row m-3">
                            <label for="current_password" class="col-sm-4 col-form-label">Current Password</label>
                            <div class="col-sm ml-2">
                                <input type="password" class="form-control m-0" name="current_password" id="current_password">
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="new_password" class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm ml-2">
                                <input type="password" class="form-control m-0" name="new_password" id="new_password">
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password</label>
                            <div class="col-sm ml-2">
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control m-0">
                            </div>
                        </div>
                        <div class="row justify-content-end m-3">
                            <a href="#" class="btn btn-success mt-3">Edit</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\disnaker\resources\views/admin/changePass.blade.php ENDPATH**/ ?>