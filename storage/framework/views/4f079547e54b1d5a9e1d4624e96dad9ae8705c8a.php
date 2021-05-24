<?php $__env->startSection('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profile</h1>

    <?php if( Session::has('message') ): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>

    <div class="jumbotron p-0">
        <div class="row justify-content-center">
            <?php if($user['photo'] != null): ?>
                <img class="mt-5" height="200" src="<?php echo e(asset('images/'.$user['photo'])); ?>" alt="">
            <?php else: ?>
                <img class="mt-5" height="200" src="<?php echo e(asset('img/icons/user.png')); ?>" alt="">
            <?php endif; ?>
        </div>
        <div class="row justify-content-center">
            <a href="#" class="btn btn-success m-3" data-toggle="modal" data-target="#ChangePhoto">Change Photo</a>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-lg-6">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row m-3">
                            <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm ml-3">
                                <p id="nip" class="form-control m-0"><?php echo e($user['nip']); ?></p>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm ml-3">
                                <p id="name" class="form-control m-0"><?php echo e($user['name']); ?></p>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm ml-3">
                                <textarea name="address" class="form-control m-0" id="address" cols="30" rows="3" disabled><?php echo e($user['address']); ?></textarea>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="phone" class="col-sm-3 col-form-label">No Telp</label>
                            <div class="col-sm ml-3">
                                <p id="phone" class="form-control m-0"><?php echo e($user['phone']); ?></p>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="office_name" class="col-sm-3 col-form-label">Kantor</label>
                            <div class="col-sm ml-3">
                                <p id="office_name" class="form-control m-0"><?php echo e($user['office_name']); ?></p>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="town_name" class="col-sm-3 col-form-label">Kabupaten/Kota</label>
                            <div class="col-sm ml-3">
                                <p id="town_name" class="form-control m-0"><?php echo e($user['town_slug'].' '.$user['town_name']); ?></p>
                            </div>
                        </div>
                        <div class="row justify-content-end m-3">
                            <a href="#" class="btn btn-success mt-3" data-toggle="modal" data-target="#editModal">Edit</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>

    <!-- Photo Modal-->
    <div class="modal fade" id="ChangePhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Photo</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?php echo e(route('dinas.cPhoto', Auth::user()->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row m-2">
                            <label for="cPhoto" class="col-sm-3 col-form-label">Select a file</label>
                            <div class="col-sm-8 ml-3">
                                <input type="file" class="form-control form-control-user" id="cPhoto" name="cPhoto">
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

    <!-- Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?php echo e(route('dinas.update', Auth::user()->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="modal-body">
                        <div class="row m-3">
                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm ml-3">
                                <input type="text" name="name" id="name" class="form-control m-0" value="<?php echo e($user['name']); ?>">
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm ml-3">
                                <textarea name="address" class="form-control m-0" id="address" cols="30" rows="3"><?php echo e($user['address']); ?></textarea>
                            </div>
                        </div>
                        <div class="row m-3">
                            <label for="phone" class="col-sm-3 col-form-label">No Telp</label>
                            <div class="col-sm ml-3">
                                <input type="text" name="phone" id="phone" class="form-control m-0" value="<?php echo e($user['phone']); ?>">
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
<!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dinas.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\disnaker\resources\views/dinas/profile.blade.php ENDPATH**/ ?>