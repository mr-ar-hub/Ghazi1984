
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
                    <li class="breadcrumb-item active">Add Currency Rate</li>
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
                            <h5>Add Currency Rate <a href="<?php echo e(route('currency')); ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('uploadCurrency')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" placeholder="Enter Title" value="<?php echo e(old('title')); ?>" class="form-control" />
                                <?php if($errors->has('title')): ?>
                                    <div class="text-danger"><?php echo e($errors->first('title')); ?></div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="form-group">
                                <label>Currency Code</label>
                                <input type="text" name="code" placeholder="Enter Currency Code" value="<?php echo e(old('code')); ?>" class="form-control" />
                                <?php if($errors->has('code')): ?>
                                    <div class="text-danger"><?php echo e($errors->first('code')); ?></div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="form-group">
                                <label>Currency Symbol</label>
                                <input type="text" name="symbol" placeholder="Enter Currency Symbol" value="<?php echo e(old('symbol')); ?>" class="form-control" />
                                <?php if($errors->has('symbol')): ?>
                                    <div class="text-danger"><?php echo e($errors->first('symbol')); ?></div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="form-group">
                                <label>Currency Rate</label>
                                <input type="text" name="rate" placeholder="Enter Currency Rate" value="<?php echo e(old('rate')); ?>" class="form-control" />
                                <?php if($errors->has('rate')): ?>
                                    <div class="text-danger"><?php echo e($errors->first('rate')); ?></div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="form-group">
                                <label>Position</label>
                                <select name="position" class="form-control">
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                </select>
                                <?php if($errors->has('position')): ?>
                                    <div class="text-danger"><?php echo e($errors->first('position')); ?></div>
                                <?php endif; ?>
                            </div>                            
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Submit</button>
                                    <a href="<?php echo e(route('addCurrency')); ?>" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
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
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/currency/create.blade.php ENDPATH**/ ?>