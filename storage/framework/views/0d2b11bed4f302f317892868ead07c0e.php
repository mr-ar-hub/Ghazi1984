
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
                    <li class="breadcrumb-item active">Coupons</li>
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
                            <h5>Coupons<a href="<?php echo e(route('admincouponform')); ?>" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Add Coupon</a></h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="myDataTable" class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <td>Sr no</td>
                                    <td >Coupon Code</td>
                                    <td>Name</td>
                                    <td>Discount</td>
                                    <td>Customer</td>
                                    <td>Start Date</td>
                                    <td>Expiry Date</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1;
                                ?>
                                    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($i++); ?></td>
                                            <td><?php echo e($item->code); ?></td>
                                            <td><?php echo e($item->name); ?></td>
                                            <td><?php if($item->type == 'percentage'): ?>
                                                <?php echo e($item->discount_amount); ?> %
                                                <?php else: ?>
                                                Rs <?php echo e(number_format($item->discount_amount, 0)); ?>

                                            <?php endif; ?></td>
                                            <td><?php if($item->customer_id == '0'): ?>
                                                <?php echo e('All'); ?>

                                                <?php else: ?>
                                                <?php
                                                    $dbHost = 'localhost';
                                                    $dbUser = $_ENV['DB_USERNAME'];
                                                    $dbPassword = $_ENV['DB_PASSWORD'];
                                                    $dbName = $_ENV['DB_DATABASE'];
                                                    
                                                    $con = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
                                                    $sql = "SELECT * FROM users WHERE id = $item->customer_id";
                                                    $query = mysqli_query($con, $sql);
                                                    while($data = mysqli_fetch_assoc($query))
                                                    {
                                            ?>
                                            <?php echo e($data['name']); ?>

                                            <?php
                                            }
                                            ?>
                                            <?php endif; ?></td>
                                            <td><?php echo e($item->start_at); ?></td>
                                            <td><?php echo e($item->end_at); ?></td>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "ordering": false,
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/coupon/coupon.blade.php ENDPATH**/ ?>