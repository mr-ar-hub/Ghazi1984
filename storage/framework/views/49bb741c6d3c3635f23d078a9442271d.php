
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
                    <li class="breadcrumb-item active">Shippings Costs</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="width: 100%;">
                    <h5>Shippings Costs<a href="<?php echo e(route('addShipping')); ?>" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Add Category</a></h5>
                </div>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-hover table-sm table-bordered">
                    <thead>
                        <tr>
                            <td>Sr no</td>
                            <td>Country Name</td>
                            <td>Shipping Cost</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $shipping; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo $count++."." ?></td>
                                <td><?php echo e($item->country_name); ?></td>
                                <td><?php echo e($item->shipping); ?></td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="<?php echo e(route('editShipping', ['id' => $item->id])); ?>"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" href="<?php echo e(route('deleteShipping', ['id' => $item->id])); ?>"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "ordering": false,
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/shipping/shipping.blade.php ENDPATH**/ ?>