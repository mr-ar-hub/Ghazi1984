
<?php $__env->startSection('content'); ?>
<!-- 
    --------------------------------
    ------ / page title / ----------
    --------------------------------
     -->
     <div class="page-title">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">My Account</h1>
                <div class="breadcrumbs">
                    <a href="<?php echo e(route('index')); ?>">Home</a> » <span class="current">Account</span>
                </div>
            </header>
        </div>
    </div>

    <!-- 
    --------------------------------
    -------- / account / -----------
    --------------------------------
     -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div id="register-form" class="form-container">
                    <h2 class="form-title">Register</h2>
                    <form action="#" class="account-form">
                        <div class="form-group">
                            <label for="username">Email Address <span class="red">*</span></label>
                            <input type="text" class="form-control username" id="username">
                        </div>
                        <div class="register-guidelines">
                            <p>A password will be sent to your email address.</p>
                            <p>Your personal data will be used to support your experience throughout this website,
                                to
                                manage
                                access to your account, and for other purposes described in our <a
                                    href="privacy-policy.html">privacy policy</a>.</p>
                        </div>
                        <button type="submit" class="login-btn">Regsiter</button>
                    </form>
                </div>
                <div id="login-form" class="form-container" style="display: none;">
                    <h2 class="form-title">Login</h2>
                    <form action="#" class="account-form">
                        <div class="form-group">
                            <label for="username">Username or Email <span class="red">*</span></label>
                            <input type="text" class="form-control username" id="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span class="red">*</span></label>
                            <input type="password" class="form-control password" id="password">
                        </div>
                        <button type="submit" class="login-btn">Login</button>
                        <div class="form-check mt-3 d-flex justify-content-between align-items-center">
                            <div class="rememberMe">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <a href="lost-password.html" class="text-end lost-password">Lost your password?</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 text-center d-flex flex-column justify-content-center my-5 my-md-0">
                <h2 class="form-title">LOGIN</h2>
                <p class="form-text">Registering for this site allows you to access your order status and history.
                    Just
                    fill in the fields below, and we'll get a new account set up for you in no time. We will only
                    ask
                    you for information necessary to make the purchase process faster and easier.</p>
                <button id="toggle-form-btn">Login</button>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/frontend/account.blade.php ENDPATH**/ ?>