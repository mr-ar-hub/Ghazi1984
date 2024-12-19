
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
                    <li class="breadcrumb-item active">Edit Social Link</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title" style="width: 100%;">
                            <h5>Edit Social Link <a href="<?php echo e(route('socialLinks')); ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('updateLink', ['id' => $socaillink->id])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="form-group">
                                <label>Platform Name</label>
                                <input type="text" name="platform" placeholder="Enter Platform Name" value="<?php echo e($socaillink->platform); ?>"  class="form-control" />
                                <?php if($errors->has('platform')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('platform')); ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="form-group">
                                <label>Platform Link</label>
                                <input type="text" name="link" placeholder="Enter Platform Link" value="<?php echo e($socaillink->link); ?>"  class="form-control" />
                                <?php if($errors->has('link')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('link')); ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="form-group">
                                <label>Platform Icon</label>
                                <input type="text" name="icon" placeholder="Enter Platform Icon" value="<?php echo e($socaillink->icon); ?>" class="form-control" />
                                <?php if($errors->has('icon')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('icon')); ?></span>
                                <?php endif; ?>
                                <span>For icon visit <a href="<?php echo e(url('https://fontawesome.com/icons')); ?>" target="blank">FontAwesome</a> and copy icon html code</span>
                            </div> 
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Icon Color</label>
                                    <input type="text" name="color" placeholder="Enter Link Color" value="<?php echo e($socaillink->color); ?>" class="form-control" />
                                    <?php if($errors->has('color')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('color')); ?></span>
                                    <?php endif; ?>
                                <span>Use hex color code with '#' or also Gradient</span>
                                </div> 
                                <div class="form-group col-md-6">
                                    <label>Icon Background Color</label>
                                    <input type="text" name="bgcolor" placeholder="Enter Background Color" value="<?php echo e($socaillink->bgcolor); ?>" class="form-control" />
                                    <?php if($errors->has('bgcolor')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('bgcolor')); ?></span>
                                    <?php endif; ?>
                                <span>Use hex color code with '#' or also Gradient</span>
                                </div> 
                            </div>   
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Update</button>
                                    <a href="<?php echo e(route('editLink', ['id' => $socaillink->id])); ?>" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
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
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/sociallinks/editLink.blade.php ENDPATH**/ ?>