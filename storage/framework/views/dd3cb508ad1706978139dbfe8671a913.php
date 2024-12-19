
<?php $__env->startSection('css'); ?>
    <style>
        .hero-carousel .owl-prev, .owl-next {
           position: absolute !important;
           top: 50% !important;
           transform: translateY(-50%) !important;
           color: white !important;
           padding: 10px !important;
           border-radius: 50% !important;
       }
       .hero-carousel .owl-prev, .owl-next i{
           font-size: 30px !important;
       }
       .hero-carousel .owl-prev {
           left: 25px !important;
       }
       
       .hero-carousel .owl-next {
           right: 25px !important;
       }
       .hero-carousel .owl-dots {
           text-align: center !important;
           margin-top: 10px !important;
       }
       .hero-carousel .owl-dots .owl-dot {
           display: inline-block !important;
           width: 10px !important;
           height: 10px !important;
           margin: 0 5px !important;
           background: white !important;
           border: solid #333 1px !important;
           border-radius: 50% !important;
           cursor: pointer !important;
       }
       .hero-carousel .owl-dots .owl-dot.active {
           background: #333 !important;
       }
       #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #035972;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .circle-container {
            position: relative;
            width: 30vw; /* Adjusted for responsiveness */
            height: 30vw; /* Adjusted for responsiveness */
            max-width: 200px; /* Ensures it doesn't get too big */
            max-height: 200px; /* Ensures it doesn't get too big */
        }
        .center-image {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%; 
            transform: translate(-50%, -50%);
            z-index: 10;
            border-radius: 50%;
        }

        .half-circle {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 200px;
            height: 100px;
            border: 5px solid rgba(6, 247, 26, 0.685);
            border-radius: 100px 100px 0 0;
            transform-origin: 50% 100%;
            transform: translate(-50%, -50%);
            animation: rotate 2s linear infinite;
            clip-path: ellipse(100% 50% at 50% 0);
            box-shadow: 0 0 15px rgba(98, 250, 106, 0.993);
            z-index: 5;
        }

        @keyframes rotate {
            0% {
                transform: translate(-50%, -100%) rotate(0deg);
            }
            100% {
                transform: translate(-50%, -100%) rotate(360deg);
            }
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- 
    --------------------------------
    ------------ / Hero / ----------
    --------------------------------
     -->
    <div id="preloader">
        <div class="circle-container">
            <div class="half-circle"></div>
            <img src="<?php echo e(asset('assets/images/ghazi_big.png')); ?>" alt="Preloader" class="center-image">
        </div>
    </div>
    <section class="hero-section">
        <div class="owl-carousel hero-carousel">
            <?php $__currentLoopData = $carousel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                    <img src="<?php echo e(asset('storage/'.$item->image_name)); ?>" alt="hero-image" class="slide-image img-fluid">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <!-- 
    --------------------------------
    -------- / Categories / --------
    --------------------------------
     -->
    <div class="categories-container container">
        <div class="section-title-content">
            <p class="pre-title">GHAZI1984 COLLECTIONS</p>
            <div class="section-title">
                <h4 class="heading-title">Categories</h4>
            </div>
            <p class="post-title">All Articles Are Available In Men Women & Kids Size</p>
        </div>
        <div class="categories-section">
            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="category-item">
                    <div class="category-image">
                        <a href="<?php echo e(route('products', ['id' => $item->id])); ?>">
                            <img src="<?php echo e(asset('storage/'.$item->cat_image)); ?>" alt="<?php echo e($item->cat_name); ?>" class="category-img">
                        </a>
                    </div>
                    <div class="category-info">
                        <h3><?php echo e($item->cat_name); ?></h3>
                        <a href="<?php echo e(route('products', ['id' => $item->id])); ?>">
                            <p><?php echo e($item->products_count); ?> products</p>
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- 
    --------------------------------
    --------- / products / ---------
    --------------------------------
     -->
    <div class="container mt-4">
        <div class="section-title-content">
            <p class="pre-title">GHAZI1984 COLLECTIONS</p>
            <div class="section-title">
                <h4 class="heading-title">OUR BEST SELLERs</h4>
            </div>
        </div>
        <div class="owl-carousel products-carousel mb-5">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product-item">
                    <div class="product-element-top">
                        <a href="<?php echo e(route('productDetail', ['id' => $items->id])); ?>" class="product-image-link">
                            <img src="<?php echo e(asset('storage/' . $items->ProductImg->image_name)); ?>" alt="Product 1">
                            <?php
                                $carouselImg = $items->CarouselImg->first();
                            ?>
                            <?php if($carouselImg): ?>
                                <div class="hover-img" style="background-image: url('<?php echo e(asset('storage/' . $carouselImg->image_name)); ?>');"></div>
                            <?php endif; ?>
                            <?php if($items->discount): ?>
                                <div class="badge-sale">-<?php echo e($items->discount); ?>% off</div>
                            <?php endif; ?>
                            <?php if($items->status == 1): ?>
                                <div class="badge-keyword"><span>HOT</span></div>
                            <?php elseif($items->status == 0): ?>
                                <div class="badge-sale" style="top: 50px !important; background-color: #f34848 !important;"><span>NEW ARRIVAL</span></div>
                            <?php endif; ?>
                            <div class="hover-buttons">
                                <a href="#" class="compare-btn">
                                    <i class="fa-solid fa-code-compare"></i>
                                    <div class="hover-message">Compare</div>
                                </a>
                                <a href="#" class="quick-view-btn">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <div class="hover-message">Quick view</div>
                                </a>
                                <a href="#" class="wishlist-btn">
                                    <i class="fa-regular fa-heart"></i>
                                    <div class="hover-message">Add to wishlist</div>
                                </a>
                            </div>
                            <div class="select-option-bar">
                                <span>Select Option</span>
                                <a href="<?php echo e(route('productDetail', ['id' => $items->id])); ?>"><i class="cart-icon fas fa-shopping-cart"></i></a>
                            </div>
                        </a>
                    </div>
                    <div class="product-info">
                        <h3><a href="#"><?php echo e($items->name); ?></a></h3>
                        <div class="price">
                            <span class="original-price">
                                <?php if($items->discount != null): ?>
                                    <?php
                                        $finalPrice =round( ($items->price / (100 - $items->discount) ) * 100);
                                        
                                    ?>
                                    <?php echo e(format_price($finalPrice)); ?>

                                <?php endif; ?>
                            </span>
                            <span class="sale-price"><?php echo e(format_price($items->price)); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- 
    --------------------------------
    -------- / Big Image / ---------
    --------------------------------
     -->
    <div class="big-image-container">
        <div class="container">
            <div class="row big-image-content">
                <div class="col-md-6 col-12 parallex-box">
                    <div class="parallex-box-text">
                        <p class="big-image-date">2024</p>
                        <h3>YOUR MOST AWAITED</h3>
                        <p>APPAREL LAUNCHED TODAY</p>
                    </div>
                    <a href="<?php echo e(route('shop')); ?>" class="parallex-btn">Shop Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- 
    --------------------------------
    --------- / products / ---------
    --------------------------------
     -->
    <div class="container mt-4">
        <div class="section-title-content">
            <p class="pre-title">GHAZI1984 PRODUCTS</p>
            <div class="section-title">
                <h4 class="heading-title">NEW ARRIVAL</h4>
            </div>
        </div>
        <div class="owl-carousel products-carousel mb-5">
            <?php $__currentLoopData = $newproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product-item">
                    <div class="product-element-top">
                        <a href="<?php echo e(route('productDetail', ['id' => $items->id])); ?>" class="product-image-link">
                            <img src="<?php echo e(asset('storage/' . $items->ProductImg->image_name)); ?>" alt="Product 1">
                            <div class="hover-img" style="background-image: url('<?php echo e(asset('storage/' . $items->CarouselImg->first()->image_name)); ?>');"></div>
                            <?php if($items->discount): ?>
                                <div class="badge-sale">-<?php echo e($items->discount); ?>% off</div>
                            <?php endif; ?>
                            <?php if($items->status == 0): ?>
                                <div class="badge-sale" style="top: 50px !important; background-color: #f34848 !important;"><span>NEW ARRIVAL</span></div>
                            <?php endif; ?>
                            <div class="hover-buttons">
                                <a href="#" class="compare-btn">
                                    <i class="fa-solid fa-code-compare"></i>
                                    <div class="hover-message">Compare</div>
                                </a>
                                <a href="#" class="quick-view-btn">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <div class="hover-message">Quick view</div>
                                </a>
                                <a href="#" class="wishlist-btn">
                                    <i class="fa-regular fa-heart"></i>
                                    <div class="hover-message">Add to wishlist</div>
                                </a>
                            </div>
                            <div class="select-option-bar">
                                <span>Select Option</span>
                                <a href="<?php echo e(route('productDetail', ['id' => $items->id])); ?>"><i class="cart-icon fas fa-shopping-cart"></i></a>
                            </div>
                        </a>
                    </div>
                    <div class="product-info">
                        <h3><a href="#"><?php echo e($items->name); ?></a></h3>
                        <div class="price">
                            <span class="original-price">
                                <?php if($items->discount != null): ?>
                                    <?php
                                        $finalPrice =round( ($items->price / (100 - $items->discount) ) * 100);
                                        
                                    ?>
                                    <?php echo e(format_price($finalPrice)); ?>

                                <?php endif; ?>
                            </span>
                            <span class="sale-price"><?php echo e(format_price($items->price)); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- 
    --------------------------------
    ----------- / celebrity / ----------
    --------------------------------
     -->
    <div class="container my-5">
        <div class="section-title-content">
            <p class="pre-title">GHAZI1984</p>
            <div class="section-title">
                <h4 class="heading-title">SPOTTED IN GHAZI 1984</h4>
            </div>
        </div>
        <div class="celebrity-owl-carousel owl-carousel">
            <?php $__currentLoopData = $spotted; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="celebrity-item">
                    <a>
                        <?php if($item->SpottedImage): ?>
                            <img src="<?php echo e(asset('storage/' . $item->SpottedImage->image_name)); ?>" class="img-fluid celebrity-image" alt="<?php echo e($item->name); ?>">
                        <?php endif; ?>
                        <p class="celebrity-name"><?php echo e($item->name); ?></p>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>


    <!-- 
    --------------------------------
    ----------- / blogs / ----------
    --------------------------------
     -->
     <?php if($blog->isNotEmpty()): ?>
        <div class="container my-5">
            <div class="section-title-content">
                <p class="pre-title">BLOGS</p>
                <div class="section-title">
                    <h4 class="heading-title">OUR LATEST NEWS</h4>
                </div>
            </div>
            <div class="blog-owl-carousel owl-carousel mt-5">
                <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="blog-post">
                        <div class="blog-image-wrapper">
                            <a href="<?php echo e(route('blogDetail', ['slug' => $item->slug])); ?>"><img src="<?php echo e(asset('storage/' . $item->BlogImage->image_name)); ?>" class="img-fluid blog-image"
                                    alt="Blog Image 1"></a>
                            <div class="blog-dots">•••</div>
                        </div>
                        <div class="blog-content">
                            <h3 class="blog-title"><?php echo e($item->title); ?></h3>
                            <div class="share-icon">
                                <i class="fas fa-share-alt"></i>
                                <div class="blog-post-icons">
                                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <p class="blog-description"><?php echo e($item->short_description); ?></p>
                            <a href="<?php echo e(route('blogDetail', ['slug' => $item->slug])); ?>" class="blog-detail-link">Continue reading</a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="container brands-section">
        <div class="section-title-content">
            <div class="section-title">
                <h4 class="heading-title">Follow us on Instagram</h4>
            </div>
        </div>
        <div class="instagram-owl-carousel owl-carousel">
            <?php $__currentLoopData = $instaimg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="insta-item">
                        <a href="<?php echo e($item->postlink); ?>" target="__blank">
                        <?php if(strpos($item->image, '.webp') || strpos($item->image,'.png') || strpos($item->image, '.jpg') || strpos($item->image, '.jpeg') || strpos($item->image, '.heic')): ?>
                            <img src="<?php echo e($item->image); ?>" alt="Image" class="img-fluid">
                        <?php endif; ?>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- 
    --------------------------------
    ---------- / brands / ----------
    --------------------------------
     -->
    <div class="container brands-section">
        <div class="section-title-content">
            <div class="section-title">
                <h4 class="heading-title">OUR COMPLIANCES</h4>
            </div>
        </div>
        <div class="brand-owl-carousel owl-carousel">
            <div class="brand-item">
                <img src="<?php echo e(asset('assets/images/brand-1.webp')); ?>" alt="Category" class="img-fluid">
            </div>
            <div class="brand-item">
                <img src="<?php echo e(asset('assets/images/brand-2.webp')); ?>" alt="Category" class="img-fluid">
            </div>
            <div class="brand-item">
                <img src="<?php echo e(asset('assets/images/brand-3.webp')); ?>" alt="Category" class="img-fluid">
            </div>
            <div class="brand-item">
                <img src="<?php echo e(asset('assets/images/brand-4.webp')); ?>" alt="Category" class="img-fluid">
            </div>
            <div class="brand-item">
                <img src="<?php echo e(asset('assets/images/brand-5.webp')); ?>" alt="Category" class="img-fluid">
            </div>
            <div class="brand-item">
                <img src="<?php echo e(asset('assets/images/brand-6.webp')); ?>" alt="Category" class="img-fluid">
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
    
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/index.blade.php ENDPATH**/ ?>