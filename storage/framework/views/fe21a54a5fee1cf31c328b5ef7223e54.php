
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
        <form action="#" class="account-form lost-password-from">
            <div class="register-guidelines">
                <p>Lost your password? Please enter your username or email address. You will receive a link to create a
                    new password via email.</p>
            </div>
            <hr>
            <div class="form-group">
                <label for="username">Usename or email <span class="red">*</span></label>
                <input type="text" class="form-control usernameoremail" id="emailorusername">
            </div>
            <button type="submit" class="login-btn">Reset passowrd</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/frontend/lostPassword.blade.php ENDPATH**/ ?>