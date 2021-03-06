<?php $__env->startSection('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">IPK III/4</h1>

    <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addIpk4">Tambah laporan baru</a>
    <a href="#" class="btn btn-info mb-4">Cetak Laporan</a>

    <!-- Print Modal-->
    


    <div class="row">
        <div class="col-lg-4">
            <!-- Basic Card Example -->
            <div class="card shadow mb-3 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Per Bulan</h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="#" method="POST">
                        <?php echo csrf_field(); ?>
                        <label for="month" class="col-sm-3 col-form-label">Bulan</label>
                        <div class="col-auto">
                            <input type="month" class="form-control" name="month" id="month">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Basic Card Example -->
        <div class="card shadow mb-3 ">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan IPK III/4 Bulan <?php echo e(date('M Y', strtotime($month))); ?></h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2">Jenis Pendidikan</th>
                            <th colspan="2">Sisa Bulan Yang Lalu</th>
                            <th colspan="2">Terdaftar Bulan Ini</th>
                            <th colspan="2">Penempatan Bulan Ini</th>
                            <th colspan="2">Dihapuskan Bulan Ini</th>
                            <th colspan="2">Sisa Akhir Bulan Ini</th>
                            <th rowspan="3">Action</th>
                        </tr>
                        <tr>
                            <th>L</th>
                            <th>P</th>
                            <th>L</th>
                            <th>P</th>
                            <th>L</th>
                            <th>P</th>
                            <th>L</th>
                            <th>P</th>
                            <th>L</th>
                            <th>P</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>9</th>
                            <th>10</th>
                            <th>11</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $ipk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($u['education_name']); ?></td>
                                <td><?php echo e($u['rest_last_month_l']); ?></td>
                                <td><?php echo e($u['rest_last_month_p']); ?></td>
                                <td><?php echo e($u['registered_this_month_l']); ?></td>
                                <td><?php echo e($u['registered_this_month_p']); ?></td>
                                <td><?php echo e($u['placement_this_month_l']); ?></td>
                                <td><?php echo e($u['placement_this_month_p']); ?></td>
                                <td><?php echo e($u['deleted_this_month_l']); ?></td>
                                <td><?php echo e($u['deleted_this_month_p']); ?></td>
                                <td><?php echo e($u['rest_this_month_l']); ?></td>
                                <td><?php echo e($u['rest_this_month_p']); ?></td>
                                <td>
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editIpk-<?php echo e($u['ipk4_id']); ?>"><i class="fas fa-edit"></i></a>
                                    
                                </td>
                            </tr>

                            <!-- Edit Modal-->
                            <div class="modal fade" id="editIpk-<?php echo e($u['ipk4_id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo e($u['education_name']); ?>?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">??</span>
                                            </button>
                                        </div>
                                        <form action="<?php echo e(route('user.ipk4', 'edit')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-body">
                                                <input type="hidden" name="ipk4_id" value="<?php echo e($u['ipk4_id']); ?>">
                                                <div class="row m-3">
                                                    <label for="" class="col-sm-4 col-form-label">Sisa Bulan Lalu</label>
                                                    <div class="col-sm">
                                                        <label for="rest_last_month_l" class="col-sm-5 col-form-label">Laki-laki</label>
                                                        <input type="number" class="form-control col-sm-5 m-0" name="rest_last_month_l" id="rest_last_month_l" value="<?php echo e($u['rest_last_month_l']); ?>">
                                                    </div>
                                                    <div class="col-sm">
                                                        <label for="rest_last_month_p" class="col-sm-6 col-form-label">Perempuan</label>
                                                        <input type="number" class="form-control col-sm-5 m-0" name="rest_last_month_p" id="rest_last_month_p" value="<?php echo e($u['rest_last_month_p']); ?>">
                                                    </div>
                                                </div>
                                                <div class="row m-3">
                                                    <label for="" class="col-sm-4 col-form-label">Terdaftar Bulan ini</label>
                                                    <div class="col-sm">
                                                        <label for="registered_this_month_l" class="col-sm-5 col-form-label">Laki-laki</label>
                                                        <input type="number" class="form-control col-sm-5 m-0" name="registered_this_month_l" id="registered_this_month_l" value="<?php echo e($u['registered_this_month_l']); ?>">
                                                    </div>
                                                    <div class="col-sm">
                                                        <label for="registered_this_month_p" class="col-sm-6 col-form-label">Perempuan</label>
                                                        <input type="number" class="form-control col-sm-5 m-0" name="registered_this_month_p" id="registered_this_month_p" value="<?php echo e($u['registered_this_month_p']); ?>">
                                                    </div>
                                                </div>
                                                <div class="row m-3">
                                                    <label for="" class="col-sm-4 col-form-label">Penempatan Bulan Ini</label>
                                                    <div class="col-sm">
                                                        <label for="placement_this_month_l" class="col-sm-5 col-form-label">Laki-laki</label>
                                                        <input type="number" class="form-control col-sm-5 m-0" name="placement_this_month_l" id="placement_this_month_l" value="<?php echo e($u['placement_this_month_l']); ?>">
                                                    </div>
                                                    <div class="col-sm">
                                                        <label for="placement_this_month_p" class="col-sm-6 col-form-label">Perempuan</label>
                                                        <input type="number" class="form-control col-sm-5 m-0" name="placement_this_month_p" id="placement_this_month_p" value="<?php echo e($u['placement_this_month_p']); ?>">
                                                    </div>
                                                </div>
                                                <div class="row m-3">
                                                    <label for="" class="col-sm-4 col-form-label">Dihapuskan Bulan Ini</label>
                                                    <div class="col-sm">
                                                        <label for="deleted_this_month_l" class="col-sm-5 col-form-label">Laki-laki</label>
                                                        <input type="number" class="form-control col-sm-5 m-0" name="deleted_this_month_l" id="deleted_this_month_l" value="<?php echo e($u['deleted_this_month_l']); ?>">
                                                    </div>
                                                    <div class="col-sm">
                                                        <label for="deleted_this_month_p" class="col-sm-6 col-form-label">Perempuan</label>
                                                        <input type="number" class="form-control col-sm-5 m-0" name="deleted_this_month_p" id="deleted_this_month_p" value="<?php echo e($u['deleted_this_month_p']); ?>">
                                                    </div>
                                                </div>
                                                <div class="row m-3">
                                                    <label for="" class="col-sm-4 col-form-label">Sisa Akhir Bulan Ini</label>
                                                    <div class="col-sm">
                                                        <label for="rest_this_month_l" class="col-sm-5 col-form-label">Laki-laki</label>
                                                        <input type="number" class="form-control col-sm-5 m-0" name="rest_this_month_l" id="rest_this_month_l" value="<?php echo e($u['rest_this_month_l']); ?>">
                                                    </div>
                                                    <div class="col-sm">
                                                        <label for="rest_this_month_p" class="col-sm-6 col-form-label">Perempuan</label>
                                                        <input type="number" class="form-control col-sm-5 m-0" name="rest_this_month_p" id="rest_this_month_p" value="<?php echo e($u['rest_this_month_p']); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

    <!-- Add Modal-->
    <div class="modal fade" id="addIpk4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="<?php echo e(route('user.ipk4', 'add')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body m-2">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">??</span>
                        </button>
                        <div class="row m-3">
                            <label for="month" class="col-sm-4 col-form-label">Bulan</label>
                            <input type="month" class="form-control col-sm-6 m-0" name="month" id="month" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Tambah</button>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\disnaker\resources\views/laporan/ipk4.blade.php ENDPATH**/ ?>