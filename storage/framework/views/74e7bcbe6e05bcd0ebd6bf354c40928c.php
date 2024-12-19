
    <?php $__env->startSection('title'); ?>
      Ghazi 1984
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Bulk Order Serving Record</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
          <li class="breadcrumb-item active">Bulk Order Serving Record</li>
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
                <div class="card-title" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
                    <h5>Bulk Order Serving Record</h5>
                    <div style="margin-left: auto;">
                        <a href="<?php echo e(route('addbulkSurvingOrder')); ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp; 
                            Add New
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <table id="myDataTable" class="table table-hover table-sm table-bordered">
                <thead>
                  <tr>
                    <th>Sr.</th>
                    <th>Client Name</th>
                    <th>Company Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      $count=1;
                    ?>
                    <?php $__currentLoopData = $bulkServing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo $count++."." ?></td>
                        <td><?php echo e($item->name); ?></td>
                        <td><?php echo e($item->company_name); ?></td>
                        <td>
                            <a href="<?php echo e(route('deletebulkSurvingOrder', ['id' => $item->id])); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/bulk_serving/bulkServing.blade.php ENDPATH**/ ?>