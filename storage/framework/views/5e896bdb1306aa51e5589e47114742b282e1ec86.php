<?php $__env->startSection('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard Dinas</h1>

</div>
<!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <!-- Page level plugins -->
    <script src="<?php echo e(asset('vendor/chart.js/Chart.min.js')); ?>"></script>

    <script src="<?php echo e(asset('js/demo/chart-bar-demo.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('dinas.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\disnaker\resources\views/dinas/home.blade.php ENDPATH**/ ?>