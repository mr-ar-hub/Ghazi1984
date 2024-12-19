
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
                    <li class="breadcrumb-item active">All Orders</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
                    <h5>All Orders</h5>
                </div>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-hover table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Order Number</th>
                        <th>Customer Name</th>
                        <th>Total Bill</th>
                        <th>Order At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo $count++."." ?></td>
                                <td>
                                    <a href="<?php echo e(route('viewOrder', ['id' => $items->id])); ?>">
                                        #<?php echo e($items->created_at->format('ym')); ?>00<?php echo e($items->id); ?>

                                    </a>
                                </td>
                                <td><?php echo e($items->first_name); ?> <?php echo e($items->last_name); ?></td>
                                <td>Rs <?php echo e(number_format($items->order_total, 0)); ?></td>
                                <td><?php echo e($items->created_at->format('Y-m-d')); ?></td>
                                <td class="text-center">
                                    <?php if($items->status == 'pending'): ?>
                                        <span class="badge bg-danger"><?php echo e($items->status); ?></span>
                                    <?php elseif($items->status == 'booked'): ?>
                                        <span class="badge bg-primary"><?php echo e($items->status); ?></span>
                                    <?php elseif($items->status == 'deliver'): ?>
                                        <span class="badge bg-success"><?php echo e($items->status); ?></span>
                                    <?php elseif($items->status == 'cancel'): ?>
                                        <span class="badge bg-danger"><?php echo e($items->status); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter-<?php echo e($items->id); ?>">
                                        View Order
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter-<?php echo e($items->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">All Products</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr no</th>
                                                                <th>Image</th>
                                                                <th colspan="2">Product</th>
                                                                <th>Color</th>
                                                                <th>Size</th>
                                                                <th>Gender</th>
                                                                <th>Price</th>
                                                                <th>Qty</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $count = 1;
                                                            ?>
                                                            <?php $__currentLoopData = $items->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td style="vertical-align: middle;"><?php echo $count++."." ?></td>
                                                                    <td style="vertical-align: middle;"><img src="<?php echo e(asset('storage/'.$product->product->ProductImg->image_name)); ?>" alt="" style="width:100px; height:100px; border-radius:50%; object-fit:cover;"></td>
                                                                    <td style="vertical-align: middle; text-transform:capitalize;" colspan="2"><?php echo e($product->product->name); ?></td>
                                                                    <td style="vertical-align: middle;"><?php echo e($product->color); ?></td>
                                                                    <td style="vertical-align: middle;"><?php echo e($product->size); ?></td>
                                                                    <td style="vertical-align: middle;"><?php echo e($product->gender); ?></td>
                                                                    <td style="vertical-align: middle;"><?php echo e($product->product->price); ?></td>
                                                                    <td style="vertical-align: middle;"><?php echo e($product->quantity); ?></td>
                                                                    <td style="vertical-align: middle;">Rs <?php echo e(number_format($product->quantity * $product->product->price, 0)); ?></td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <tfoot>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td colspan="2"></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><strong>Shipping Charges:</strong></td>
                                                                    <td>Rs <?php echo e($shippingCharges); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td colspan="2"></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><strong>Total Bill:</strong></td>
                                                                    <td>Rs <?php echo e(number_format($items->order_total, 0)); ?></td>
                                                                </tr>
                                                            </tfoot>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?php echo e(route('viewOrder', ['id' => $items->id])); ?>"><span class="btn btn-success btn-sm">Edit</span></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/order/order.blade.php ENDPATH**/ ?>