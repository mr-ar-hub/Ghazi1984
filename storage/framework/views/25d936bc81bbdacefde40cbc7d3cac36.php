
    <?php $__env->startSection('title'); ?>
      Ghazi 1984
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Bulk Orders</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
          <li class="breadcrumb-item active">Bulk Orders</li>
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
              <div class="card-title">
                <h5>My Inquiries</h5>
              </div>
            </div>
            <div class="card-body">
              <table id="myDataTable" class="table table-hover table-sm table-bordered">
                <thead>
                  <tr>
                    <th>Sr.</th>
                    <th>Company Name</th>
                    <th>Client Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $count=1;
                  ?>
                  <?php $__currentLoopData = $bulkOrder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo $count++."." ?></td>
                      <td><?php echo e($item->company_name); ?></td>
                      <td><?php echo e($item->name); ?></td>
                      <td><?php echo e($item->phone); ?></td>
                      <td><?php echo e($item->email); ?></td>
                      <td><?php echo (new DateTime($item->created_at))->format('d-m-Y'); ?></td>
                      <td>
                        <a href="<?php echo e(route('viewBulkOrder', ['id' => $item->id])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-info"></i></a>
                        <a href="<?php echo e(route('deletebulkOrder', ['id' => $item->id])); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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


<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/bulk_order/bulkOrder.blade.php ENDPATH**/ ?>