<?php $__env->startSection('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">IPK III/6</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Laporan IPK III/6 Bulan <?php echo e(date('M Y', strtotime($month))); ?></h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2">Golongan Usaha & Lapangan Usaha</th>
                            <th colspan="2">Sisa Bulan Yang Lalu</th>
                            <th colspan="2">Terdaftar Bulan Ini</th>
                            <th colspan="2">Penempatan Bulan Ini</th>
                            <th colspan="2">Dihapuskan Bulan Ini</th>
                            <th colspan="2">Sisa Akhir Bulan Ini</th>
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
                                <td><?php echo e($u['business_field_name']); ?></td>
                                <td><?php echo e($u->where('business_field_id', $u['business_field_id'])->sum('rest_last_month_l')); ?></td>
                                <td><?php echo e($u->where('business_field_id', $u['business_field_id'])->sum('rest_last_month_p')); ?></td>
                                <td><?php echo e($u->where('business_field_id', $u['business_field_id'])->sum('registered_this_month_l')); ?></td>
                                <td><?php echo e($u->where('business_field_id', $u['business_field_id'])->sum('registered_this_month_p')); ?></td>
                                <td><?php echo e($u->where('business_field_id', $u['business_field_id'])->sum('placement_this_month_l')); ?></td>
                                <td><?php echo e($u->where('business_field_id', $u['business_field_id'])->sum('placement_this_month_p')); ?></td>
                                <td><?php echo e($u->where('business_field_id', $u['business_field_id'])->sum('deleted_this_month_l')); ?></td>
                                <td><?php echo e($u->where('business_field_id', $u['business_field_id'])->sum('deleted_this_month_p')); ?></td>
                                <td><?php echo e($u->where('business_field_id', $u['business_field_id'])->sum('rest_this_month_l')); ?></td>
                                <td><?php echo e($u->where('business_field_id', $u['business_field_id'])->sum('rest_this_month_p')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
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

<?php echo $__env->make('dinas.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\disnaker\resources\views/dinas/laporan/ipk6.blade.php ENDPATH**/ ?>