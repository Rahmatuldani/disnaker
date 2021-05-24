<?php $__env->startSection('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Office</h1>

    <a href="#" data-toggle="modal" data-target="#addOffice" class="btn btn-primary mb-3">Add Office</a>
    <?php if( Session::has('message') ): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Office</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $__currentLoopData = $office; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($u['office_name']); ?></td>
                                <td><?php echo e($u['office_address']); ?></td>
                                <td><?php echo e($u['town_slug'].' '.$u['town_name']); ?></td>
                                <td><?php echo e($u['office_phone']); ?></td>
                                <td>
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editOffice-<?php echo e($u['office_id']); ?>"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteOffice-<?php echo e($u['office_id']); ?>"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>

                            <!-- Edit Modal-->
                            <div class="modal fade" id="editOffice-<?php echo e($u['office_id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit <?php echo e($u['office_name']); ?></h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="<?php echo e(route('admin.office', 'edit')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <input type="hidden" name="office_id" value="<?php echo e($u['office_id']); ?>">
                                            <div class="row m-3">
                                                <label for="office_name" class="col-sm-3 col-form-label">Name</label>
                                                <div class="col-sm ml-3">
                                                    <input type="text" name="office_name" id="office_name" class="form-control m-0" value="<?php echo e($u['office_name']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <label for="office_address" class="col-sm-3 col-form-label">Address</label>
                                                <div class="col-sm ml-3">
                                                    <textarea name="office_address" id="office_address" cols="30" rows="3" class="form-control m-0" required><?php echo e($u['office_address']); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <label for="office_phone" class="col-sm-3 col-form-label">Phone</label>
                                                <div class="col-sm ml-3">
                                                    <input type="text" name="office_phone" id="office_phone" class="form-control m-0" value="<?php echo e($u['office_phone']); ?>"  required>
                                                </div>
                                            </div>
                                            <div class="row m-3">
                                                <label for="town_id" class="col-sm-3 col-form-label">City</label>
                                                <div class="col-sm ml-3">
                                                    <input list="townList" name="town_id" id="town_id" class="form-control" value="<?php echo e($u['town_slug'].' '.$u['town_name']); ?>" required>
                                                    <datalist id="townList">
                                                        <?php $__currentLoopData = $town; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($t['town_slug'].' '.$t['town_name']); ?>"></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </datalist>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal-->
                            <div class="modal fade" id="deleteOffice-<?php echo e($u['office_id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete <?php echo e($u['office_name']); ?>?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Apakah yakin ingin menghapus Kantor <?php echo e($u['office_name']); ?>?</div>
                                        <div class="modal-footer">
                                            <form action="<?php echo e(route('admin.office', 'delete')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="office_id" value="<?php echo e($u['office_id']); ?>">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Modal-->
    <div class="modal fade" id="addOffice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Office</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.office', 'add')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row m-3">
                            <label for="office_name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm ml-3">
                                <input type="text" name="office_name" id="office_name" class="form-control m-0" required>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="office_address" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm ml-3">
                                <textarea name="office_address" id="office_address" cols="30" rows="3" class="form-control m-0" required></textarea>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="office_phone" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm ml-3">
                                <input type="text" name="office_phone" id="office_phone" class="form-control m-0" required>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="town_id" class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm ml-3">
                                <input list="townList" name="town_id" id="town_id" class="form-control" required>
                                <datalist id="townList">
                                    <?php $__currentLoopData = $town; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($t['town_slug'].' '.$t['town_name']); ?>"></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <!-- Page level plugins -->
    <script src="<?php echo e(asset('vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo e(asset('js/demo/datatables-demo.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\disnaker\resources\views/admin/office.blade.php ENDPATH**/ ?>