    <?php $__env->startSection('title'); ?>
        Ghazi 1984 Credentials
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Credentials</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active">Credentials</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form class="needs-validation" action="<?php echo e(route('updatecredential', ['id' => $credential->id])); ?>" method="POST" novalidate="">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <?php if($credential->name == 'google' || $credential->name == 'facebook'): ?>
                        <div class="form-group">
                            <label>Client id</label>
                            <input type="text" class="form-control required" name="client_id" required="" value="<?php echo e($credential->client_id); ?>" >
                        </div>
                        <div class="form-group mt-3">
                            <label>Client Secret</label>
                            <input type="text" class="form-control required" name="client_secret" required="" value="<?php echo e($credential->client_secret); ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label>Redirect URL</label>
                            <input type="text" class="form-control required" name="redirect" required="" value="<?php echo e($credential->redirect); ?>">
                        </div>
                    <?php endif; ?>
                    <?php if($credential->name == 'instagram'): ?>
                        <div class="form-group">
                            <label>Access Token</label>
                            <input type="text" class="form-control required" name="access_token" required="" value="<?php echo e($credential->access_token); ?>" >
                        </div>
                        <div class="form-group col-md-4 mt-3">
                            <label>No of Active Posts</label>
                            <input type="number" class="form-control required" name="no_ig_posts" min="6" value="<?php echo e($credential->no_ig_posts); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-sm-12 mt-2">
                            <button type="submit" class="btn btn-success ml-2" style="float: right; margin-left: 5px;">Update</button>
                            <a href="<?php echo e(route('editcredential', ['id' => $credential->id])); ?>" class="btn btn-danger" style="float: right;">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/credential/editCredential.blade.php ENDPATH**/ ?>