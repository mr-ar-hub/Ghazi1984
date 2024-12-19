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
                    <li class="breadcrumb-item active">All Products</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
                    <h5>All Products</h5>
                    <div style="margin-left: auto;">
                        <a href="<?php echo e(route('addSize')); ?>" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp; 
                            Add Size
                        </a>
                        <a href="<?php echo e(route('addProducts')); ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp; 
                            Add New Product
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-hover table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Product</th>
                        <th>Product Slug</th>
                        <th>Actual Price</th>
                        <th>Discountable Price</th>
                        <th>Discount</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo $count++."." ?></td>
                                <td><a href="<?php echo e(route('editProduct', ['id' => $item->id])); ?>"><?php echo e($item->name); ?></a></td>
                                <td><?php echo e($item->slug); ?></td>
                                <td>
                                    <?php if($item->price): ?>
                                    <?php
                                        $finalPrice = ($item->price / (100 - $item->discount) ) * 100;
                                    ?>
                                        RS: <?php echo e(round($finalPrice)); ?>

                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                    RS: <?php echo e($item->price); ?>

                                </td>
                                <td>
                                    <?php if($item->discount): ?>
                                        -<?php echo e($item->discount); ?>% off
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($item->stock); ?></td>
                                <td>
                                    <a href="<?php echo e(route('editProduct', ['id' => $item->id])); ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo e(route('deleteProduct', ['id' => $item->id])); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/products/product.blade.php ENDPATH**/ ?>