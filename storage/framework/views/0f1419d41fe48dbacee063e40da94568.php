
    <?php $__env->startSection('title'); ?>
        Ghazi 1984
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Facebook Pixcel</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title" style="width: 100%;">
                                <h5>Add Facebook Pixcel</h5>
                            </div>  
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('facebookPixcelUpload', ['id' => $fbpixcel->id])); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('put'); ?>
                                <div class="form-group">
                                    <label >Facebook Pixcel Script</label>
                                    <textarea placeholder="Enter Facebook Pixcel Script" name="facebook_pixcel" style="height: 300px; width: 100%;"><?php echo e($fbpixcel->facebook_pixcel); ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mt-2">
                                        <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/facebookpixcel/facebookPixcel.blade.php ENDPATH**/ ?>