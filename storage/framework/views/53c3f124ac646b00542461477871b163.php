
<?php $__env->startSection('content'); ?>
<!-- 
    --------------------------------
    ------ / page title / ----------
    --------------------------------
     -->
     <div class="page-title">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">Blog</h1>
                <div class="breadcrumbs">
                    <a href="<?php echo e(route('index')); ?>">Home</a> » <span class="current">Blog</span>
                </div>
            </header>
        </div>
    </div>

    <!-- 
    --------------------------------
    ---------- / blog / ------------
    --------------------------------
     -->
    <div class="container">
        <div class="blog-section mt-5">
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="blog-post">
                <div class="blog-image-wrapper">
                    <?php
                        $date = \Carbon\Carbon::parse($item->blog_date);
                    ?>
                    <!--<div class="blog-date"><span><?php echo e($date->format('d')); ?></span><span><?php echo e(strtoupper($date->format('M'))); ?></span></div>-->
                    <a href="<?php echo e(route('blogDetail', ['slug' => $item->slug])); ?>"><img src="<?php echo e(asset('storage/' . $item->BlogImage->image_name)); ?>" class="img-fluid blog-image"
                            alt="Blog Image 1"></a>
                    <div class="blog-dots">•••</div>
                    <div class="blog-tag"><a href="#">ghazi1984</a></div>
                </div>
                <div class="blog-content">
                    <h3 class="blog-title"><?php echo e($item->title); ?></h3>
                    <div class="blog-info">
                        <a href="#">By <?php echo e($item->auther_name); ?></a>
                        <a href="#"><i class="fa-regular fa-comment"></i></a>
                        <div class="share-icon">
                            <i class="fas fa-share-alt"></i>
                            <div class="blog-post-icons">
                                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <p class="blog-description"><?php echo e($item->short_description); ?></p>
                    <a href="<?php echo e(route('blogDetail', ['slug' => $item->slug])); ?>" class="blog-detail-link">Continue reading</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/frontend/blog.blade.php ENDPATH**/ ?>