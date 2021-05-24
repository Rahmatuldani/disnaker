<?php $__env->startSection('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">IPK III/1</h1>

    <a href="#" class="btn btn-info mb-4" data-toggle="modal" data-target="#printIpk">Cetak Laporan</a>

    <!-- Print Modal-->
    <div class="modal fade" id="printIpk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="#" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body m-2">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="row m-3">
                            <label for="month" class="col-sm-4 col-form-label">Bulan</label>
                            <input type="month" class="form-control col-sm-6 m-0" name="month" id="month" required>
                        </div>
                        <div class="row justify-content-around m-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenisCetak" id="excel" value="excel" checked>
                                <label class="form-check-label" for="pencaker">Excel</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenisCetak" id="PDF" value="PDF">
                                <label class="form-check-label" for="perusahaan">PDF</label>
                            </div>
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
            <h6 class="m-0 font-weight-bold text-primary">Laporan IPK III/1 Bulan <?php echo e(date('M Y', strtotime($month))); ?></h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th rowspan="3">Pencari Kerja</th>
                        <th colspan="10">Kelompok Umur</th>
                        <th colspan="3" rowspan="2">Jumlah</th>
                        
                    </tr>
                    <tr>
                        <th colspan="2">15-19</th>
                        <th colspan="2">20-29</th>
                        <th colspan="2">30-44</th>
                        <th colspan="2">45-54</th>
                        <th colspan="2">55+</th>
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
                        <th>L</th>
                        <th>P</th>
                        <th>JML</th>
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
                        <th>12</th>
                        <th>13</th>
                        <th>14</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $ipk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($u['ipk1_name']); ?></td>
                            <td><?php echo e($u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('15-19l')); ?></td>
                            <td><?php echo e($u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('15-19p')); ?></td>
                            <td><?php echo e($u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('20-29l')); ?></td>
                            <td><?php echo e($u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('20-29p')); ?></td>
                            <td><?php echo e($u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('30-44l')); ?></td>
                            <td><?php echo e($u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('30-44p')); ?></td>
                            <td><?php echo e($u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('45-54l')); ?></td>
                            <td><?php echo e($u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('45-54p')); ?></td>
                            <td><?php echo e($u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('55l')); ?></td>
                            <td><?php echo e($u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('55p')); ?></td>
                            <td><?php echo e($u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('15-19l')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('20-29l')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('30-44l')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('45-54l')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('55l')); ?></td>
                            <td><?php echo e($u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('15-19p')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('20-29p')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('30-44p')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('45-54p')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('55p')); ?></td>
                            <td><?php echo e($u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('15-19l')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('20-29l')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('30-44l')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('45-54l')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('55l')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('15-19p')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('20-29p')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('30-44p')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('45-54p')+$u->where('ipk1_name_id', $u['ipk1_name_id'])->sum('55p')); ?></td>
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

<?php echo $__env->make('dinas.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\disnaker\resources\views/dinas/laporan/ipk1.blade.php ENDPATH**/ ?>