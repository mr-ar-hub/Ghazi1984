
<?php $__env->startSection('css'); ?>
    <style>
        .thankyou{
            border: 3px dashed #779B60;
            padding: 40px 0px;
            text-align: center;
        }
        .thankyou span{
            font-weight: bold;
            color: #779B60;
            font-size: 24px;
        }
        .order_details {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            padding: 30px 0px;
            text-align: center;
        }
        .item {
            padding: 10px;
            border-right: 1px solid lightgrey; 
            flex: 1 0 20%;
            box-sizing: border-box;
        }
        .item p{
            font-weight: bold;
            color: gray;
        }
        .item span{
            font-weight: bold;
            color: black;
        }
        .item:nth-child(5n) {
            border-right: none;
        }
        .order_details::after {
            content: "";
            flex-basis: 100%;
        }
        .bank_details {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            padding: 30px 0px;
            text-align: center;
        }
        .bank_item {
            padding: 10px;
            border-right: 1px solid lightgrey; 
            flex: 1 0 20%;
            box-sizing: border-box;
        }
        .bank_item p{
            font-weight: bold;
            color: gray;
        }
        .bank_item span{
            font-weight: bold;
            color: black;
        }
        .bank_item:nth-child(4n) {
            border-right: none;
        }
        .bank_details::after {
            content: "";
            flex-basis: 100%;
        }
        .cart_data h2 {
            margin-bottom: 15px;
            font-size: 20px;
            text-transform: uppercase;
            font-weight: 800;
        }

        .cart_data th {
            text-align: left;
            font-size: 14px;
            font-weight: 800;
        }

        .cart_data td {
            text-align: right;
            font-size: 14px;
            color: #777;
        }
        .product th{
            font-size: 18px;
            color: #333;
            font-weight: 800;
        }
        .product td{
            font-size: 18px;
            color: #333;
            font-weight: 800;
        }
        .produt_detail th{
            color: #777;
            font-weight: normal;
        }
        .subtotal td span{
            color: var(--main-color);
            font-weight: 800;
        }
        .shopping td span{
            color: var(--main-color);
            font-weight: 800;
        }
        .total th {
            font-size: 24px;
            color: var(--heading-color);
            font-weight: 800;
        }

        .total td {
            font-size: 24px;
            color: var(--main-color);
            font-weight: 800;
        }
        .billing_address p{
            color: #777;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page Title -->
    <div class="page-title">
        <div class="container">
            <header class="entry-header">
                <div class="breadcrumbs">
                    <span class="next-page">Checkout</span> » <span class="current">Order Completed</span>
                </div>
            </header>
        </div>
    </div>
    <div class="container py-5">
        <?php if($orders): ?>
        <div class="thankyou mb-3">
            <span>Thank you. Your order has been received.</span>
        </div>
        <div class="order_details mb-5">
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <p>Order number:</p>
                <span>#<?php echo e($item->created_at->format('ym')); ?>00<?php echo e($item->id); ?></span>
            </div>
            <div class="item">
                <p>Date:</p>
                <span><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('F d, Y')); ?></span>
            </div>
            <div class="item">
                <p>Email:</p>
                <span><?php echo e($item->email); ?></span>
            </div>
            <div class="item">
                <p>Total:</p>
                <span><?php echo e(get_currency_symbol()); ?> <?php echo e(number_format(format_price_only($item->order_total), 0)); ?></span>
            </div>
            <div class="item">
                <p>Payment method:</p>
                <span><?php echo e(ucfirst(str_replace('_', ' ', $item->payment_method))); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php if(!$showData): ?>
            <h2 style="font-weight: bold;">OUR BANK DETAILS</h2>
            <h5 style="font-weight: bold; color: gray; margin-top: 10px;"><?php echo e($bank->account_holder_name); ?>:</h5>
            <div class="bank_details mb-5">
                <div class="bank_item">
                    <p>Bank:</p>
                    <span><?php echo e($bank->bank_name); ?></span>
                </div>
                <div class="bank_item">
                    <p>Account number:</p>
                    <span><?php echo e($bank->account_number); ?></span>
                </div>
                <div class="bank_item">
                    <p>IBAN:</p>
                    <span><?php echo e($bank->iban); ?></span>
                </div>
                <div class="bank_item">
                    <p>BIC:</p>
                    <span><?php echo e($bank->bic); ?></span>
                </div>
            </div>
        <?php endif; ?>
        <h2 style="font-weight: bold;">ORDER DETAILS</h2>
        <div class="py-4">
            <div class="cart_data ">
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="cart-totals-inner mb-5">
                        <table class="table">
                            <tbody>
                                <!-- Products Header -->
                                <tr class="product">
                                    <th>PRODUCTS</th>
                                    <td>Total</td>
                                </tr>

                                <!-- Loop through order items -->
                                <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="produt_detail">
                                    <th><?php echo e($item->product->name); ?> x <?php echo e($item->quantity); ?> <br>
                                        <strong>Color: </strong> <?php echo e($item->color); ?> <br>
                                        <strong>Select Gender: </strong> <?php echo e($item->gender); ?>

                                    </th>
                                    <td><?php echo e(get_currency_symbol()); ?> <?php echo e(number_format(format_price_only($item->product->price * $item->quantity), 0)); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
                                <!-- Subtotal -->
                                <tr class="subtotal">
                                    <th>Subtotal:</th>
                                    <td>
                                        <strong>
                                            <span><bdi><span><?php echo e(get_currency_symbol()); ?></span>&nbsp;<?php echo e(number_format(format_price_only($order->order_total), 0)); ?></bdi></span>
                                        </strong>
                                    </td>
                                </tr>
            
                                <!-- Shipping -->
                                <tr class="shopping">
                                    <th>Shipping:</th>
                                     <td>
                                        <strong>
                                            <span>
                                                <bdi>
                                                    <span><?php echo e(get_currency_symbol()); ?>&nbsp;<?php echo e(number_format(format_price_only(250), 0)); ?></span>
                                                </bdi>
                                            </span>
                                        </strong> 
                                        via flat rate
                                    </td>
                                </tr>
            
                                <!-- Payment method -->
                                <tr class="payment">
                                    <th>Payment method:</th>
                                    <td><?php echo e(ucfirst(str_replace('_', ' ', $order->payment_method))); ?></td>
                                </tr>
            
                                <!-- Total -->
                                <tr class="total">
                                    <th>TOTAL:</th>
                                    <td>
                                        <strong>
                                            <span><bdi><span><?php echo e(get_currency_symbol()); ?></span>&nbsp;<?php echo e(number_format(format_price_only($order->order_total+250), 0)); ?></bdi></span>
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6 billing_address">
                <h2 style="font-weight: bold; margin-bottom: 5px;">BILLING ADDRESS</h2>
                <p><?php echo e($address->first_name); ?></p>
                <p><?php echo e($address->last_name); ?></p>
                <p><?php echo e($address->company_name); ?></p>
                <p><?php echo e($address->street_address); ?></p>
                <p><?php echo e($address->city); ?></p>
                <p><?php echo e($address->country); ?></p>
                <p><?php echo e($address->postal_code); ?></p>
                <p><?php echo e($address->phone); ?></p>
                <p><?php echo e($address->email); ?></p>
            </div>
            <div class="col-6 billing_address">
                <h2 style="font-weight: bold; margin-bottom: 5px;">SHIPPING ADDRESS</h2>
                <p><?php echo e($address->first_name); ?> <?php echo e($address->last_name); ?></p>
                <p><?php echo e($address->company_name); ?></p>
                <p><?php echo e($address->street_address); ?></p>
                <p><?php echo e($address->city); ?></p>
                <p><?php echo e($address->country); ?></p>
                <p><?php echo e($address->postal_code); ?></p>
            </div>
        </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
    
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/frontend/orderComplete.blade.php ENDPATH**/ ?>