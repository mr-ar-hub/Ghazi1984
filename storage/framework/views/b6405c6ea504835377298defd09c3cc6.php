

<?php $__env->startSection('content'); ?>
<h1>New Order: #<?php echo e($id); ?></h1>
<p style="padding-top: 5px;">You've received the following order from <?php echo e($first_name); ?> <?php echo e($last_name); ?></p>
<h3>[Order: #<?php echo e($id); ?>] (<?php echo e(\Carbon\Carbon::parse($created_at)->format('F j, Y')); ?>) </h3>
<h2 style="padding-top: 5px;">Products</h2>
<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $subtotal = 0;
        ?>

        <?php $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($item->order_id == $id): ?>
                <tr>
                    <td>
                        <?php if($item->product->ProductImg): ?>
                            <img src="<?php echo e(asset('storage/'.$item->product->ProductImg->image_name)); ?>" width="150px" height="150px" alt="Product Image">
                        <?php else: ?>
                            No image available
                        <?php endif; ?>
                        <a href="<?php echo e(route('productDetail', ['id' => $item->product->id])); ?>">
                            <?php echo e($item->product->name); ?>

                        </a>
                        <br>
                        <span>Size: <?php echo e($item->size); ?></span>
                        <br>
                        <span>Color: <?php echo e($item->color); ?></span>
                    </td>
                    <td><?php echo e($item->quantity); ?></td>
                    <td>
                        <span><bdi><span>₨</span>&nbsp;<?php echo e(number_format($item->quantity * $item->product->price, 0)); ?></bdi></span>
                    </td>

                    <?php
                        $subtotal += $item->quantity * $item->product->price;
                    ?>
                </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <th>Subtotal</th>
            <td><span><bdi><span>₨</span>&nbsp;<?php echo e(number_format($subtotal, 0)); ?></bdi></span></td>
        </tr>
        <tr>
            <td></td>
            <th>Shipping</th>
            <td>Rs 250.00 via Flat Rate</td>
        </tr>
        <tr>
            <td></td>
            <th>Payment Method</th>
            <td><?php echo e(ucfirst(str_replace('_', ' ', $order->payment_method))); ?></td>
        </tr>
        <tr>
            <td></td>
            <th>Total</th>
            <td>
                <span><bdi><span>₨</span>&nbsp;<?php echo e(number_format($subtotal + 250, 0)); ?></bdi></span>
            </td>
        </tr>
    </tfoot>
</table>
<div style="display:flex; flex-direction:row; justify-content:space-between; flex-wrap:wrap; padding-top:20px">
    <div style="width:58%; box-sizing: border-box;">
        <h2 style="padding-bottom: 20px;">Billing Address</h2>
        <div style="border:1px solid grey; padding: 10px; box-sizing: border-box;">
            <p><?php echo e($first_name); ?> <?php echo e($last_name); ?></p>
            <p><?php echo e($street_address); ?></p>
            <p><?php echo e($city); ?></p> <!-- Fixed the extra < -->
            <p><?php echo e($country); ?></p> <!-- Fixed the extra < -->
            <p><?php echo e($phone); ?></p>
            <p><?php echo e($email); ?></p>
        </div>
    </div>
    <div style="width:39%; box-sizing: border-box; margin-left:20px">
        <h2 style="padding-bottom: 20px;">Shipping Address</h2>
        <div style="border:1px solid grey; padding: 10px; box-sizing: border-box;">
            <p><?php echo e($first_name); ?> <?php echo e($last_name); ?></p>
            <p><?php echo e($street_address); ?></p>
            <p><?php echo e($city); ?></p> <!-- Fixed the extra < -->
            <p><?php echo e($country); ?></p> <!-- Fixed the extra < -->
        </div>
    </div>
</div>
<?php if($order_note ): ?>
<p><strong>Order Note:</strong> <?php echo e($order_note); ?></p>
<?php endif; ?>

<?php $__env->stopSection(); ?>
            
<?php echo $__env->make('emails.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/emails/orderEmail.blade.php ENDPATH**/ ?>