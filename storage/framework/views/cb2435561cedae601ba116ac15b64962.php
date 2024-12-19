
<?php $__env->startSection('css'); ?>
    <style>
        .checkout:hover {
            color: white !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- 
    --------------------------------
    ------ / page title / ----------
    --------------------------------
     -->
    <div class="page-title">
        <div class="container">
            <header class="entry-header">
                <div class="breadcrumbs">
                    <a href="<?php echo e(route('cart')); ?>"><span class="current">Cart</span></a>&nbsp;&nbsp; » <a href="<?php echo e(route('checkout')); ?>"><span class="next-page checkout">Checkout</span></a>&nbsp;&nbsp; » <span class="next-page">Order Completed</span>
                </div>
            </header>
        </div>
    </div>

    <!-- 
    --------------------------------
    ------- / fill cart / ----------
    --------------------------------
     -->
    <?php if($cartShow): ?>
        <div class="container py-md-5">
            <div class="row">
                <div class="col-12 col-lg-7 col-xl-8 cart-table-section">
                    <div class="table-responsive">
                        <table class="product-table table">
                            <thead>
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($items->order_id == null && $items->action == 'add-to-cart'): ?> <!-- Ensure you are checking if the cart item is not yet part of an order -->
                                        <tr class="product-table-body">
                                            <td>
                                                <a href="<?php echo e(route('deleteCart', ['id' => $items->id])); ?>" class="product-remove">x</a>
                                            </td>
                                            <td class="product-thumbnail" data-title="Thumbnail">
                                                <a href="#"><img src="<?php echo e(asset('storage/'.$items->product->ProductImg->image_name)); ?>" alt="Product Image" width="80" height="80"></a>
                                            </td>
                                            <td class="product-table-name">
                                                <a href="#"><?php echo e($items->product->name); ?></a>
                                                <ul class="variation">
                                                    <li class="variation-SelectGender">
                                                        <span class="item-variation-name">Select Gender:</span>
                                                        <span class="item-variation-value">
                                                            <p><?php echo e($items->gender); ?></p>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="product-cart-price">
                                                <span><bdi><span><?php echo e(get_currency_symbol()); ?></span>&nbsp;<?php echo e(format_price_only($items->product->price)); ?></bdi></span>
                                            </td>
                                            <td class="product-quantity">
                                                <input type="number" class="quantity-input" min="1" data-id="<?php echo e($items->id); ?>" value="<?php echo e($items->quantity); ?>">
                                            </td>
                                            <td class="product-cart-subtotal">
                                                <span><bdi><span><?php echo e(get_currency_symbol()); ?></span>&nbsp;<?php echo e(format_price_only($items->quantity * $items->product->price)); ?></bdi></span>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row cart-actions">
                        <div class="col-12 col-lg-8 mb-2 mb-md-4">
                            <div class="coupon d-flex align-items-center">
                                <input type="text" name="code" class="form-control me-2" id="coupon_code" placeholder="Coupon code">
                                <button type="button" id="applydiscount" class="coupon-btn" name="apply_coupon">Apply coupon</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cart-totals-section col-12 col-lg-5 col-xl-4">
                    <div class="cart_totals">
                        <div class="cart-totals-inner">
                            <h2>Cart totals</h2>
                            <table class="table">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td><span><bdi><span><?php echo e(get_currency_symbol()); ?></span>&nbsp;<?php echo e(number_format(format_price_only($subtotal), 0)); ?></bdi></span></td>
                                    </tr>
                                    <tr class="shipping-totals shipping">
                                        <th>Shipping</th>
                                        <td>
                                            <ul id="shipping_method">
                                                <li>
                                                    <label for="shipping_method">Flat rate: <span class="Price-amount amount"><bdi><span><?php echo e(get_currency_symbol()); ?></span>&nbsp;<?php echo e(number_format(format_price_only($shippingCost), 0)); ?></bdi></span></label>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td><strong>
                                                <span><bdi><span><?php echo e(get_currency_symbol()); ?></span>&nbsp;<?php echo e(number_format(format_price_only($total), 0)); ?></bdi></span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="proceed-to-checkout">
                                <a href="<?php echo e(route('checkout')); ?>" class="proceed-to-checkout-btn">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- 
    --------------------------------
    ------ / empty cart / ----------
    --------------------------------
     -->
    <?php else: ?>
        <div class="cart-empty">
            <i class="fa-solid fa-cart-shopping"></i>
            <h2>Cart is empty</h2>
            <p>You don't have any products in the wishlist yet.<br>
                You will find a lot of interesting products on our "Shop" page.</p>
            <a href="<?php echo e(route('shop')); ?>">return to shop</a>
        </div>
    <?php endif; ?>

    <!-- JavaScript code -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.shipping-calculator-button').click(function(e) {
                e.preventDefault();
                $('#shipping-calculator-form').slideToggle();
            });

            $("#applydiscount").click(function(e) {
                e.preventDefault();
                var billValue = parseFloat($("#bill").val());
                $.ajax({
                    method: 'POST',
                    url: '<?php echo e(route("applyCoupon")); ?>',
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        code: $("#coupon_code").val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        
                        if (response.discount) {
                            var discount = parseFloat(response.discount);
                            $("#discountvalue").text("₨ " + discount);
                            var finalBill = billValue - discount;
                            $("#bill").val(finalBill);
                            $("#grandtotal").text("₨ " + finalBill);
                            $("#checkout").text("₨ " + finalBill);
                            $("#couponid").val(response.coupon_id);
                            $("#applydiscount").prop('disabled', true);
                            toastr.success('Coupon applied successfully!');
                        } else if (response.errormsg) {
                            toastr.error(response.errormsg);
                        } else {
                            toastr.error('Unexpected error occurred');
                        }
                    },
                    error: function() {
                        toastr.error('An error occurred while applying the coupon');
                    }
                });
            });

            $(document).on('click', '.quantity-input', function() {
                var cartData = [];

                $('.quantity-input').each(function() {
                    var cartItemId = $(this).data('id');
                    var newQuantity = $(this).val();

                    cartData.push({
                        id: cartItemId,
                        quantity: newQuantity
                    });
                });

                $.ajax({
                    url: '<?php echo e(route("updateCart")); ?>',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    data: {
                        cart: cartData
                    },
                    success: function(data) {
                        if (data.success) {
                            toastr.success('Cart updated successfully!');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error('There was an error updating the cart.');
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        toastr.error('Error occurred while updating the cart.');
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/frontend/cart.blade.php ENDPATH**/ ?>