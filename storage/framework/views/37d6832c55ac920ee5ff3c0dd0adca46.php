<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Home - Ghazi 1984</title>
    <meta property="og:image" content="https://ghazi1984.com/assets/images/ghazi_big_updated.png?v=1">
    <meta property="og:type" content="website">
        <?php
    use App\Models\Metakeyword;

    // Fetch the keywords (assuming there's only one entry, adjust as necessary)
    $metaKeywords = Metakeyword::first();
    $keywords = $metaKeywords->keywords;
    $keywords = Metakeyword::all()->pluck('keywords');
    $keywords = $keywords ? json_decode($keywords, true) : [];
    $keywords = implode(', ', array_column($keywords, 'value'));
   // dd(Metakeyword::all()->pluck('keywords')->filter()->toArray());
    ?>

    <meta name="keywords" content="<?php echo e($keywords); ?>">
    <link rel="icon" href="<?php echo e(asset('assets/images/fav_icon.png')); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/fav_icon.png')); ?>" type="image/x-icon">

    <!-- bootstrap CSS CDN -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">

    <!-- Owl Carousel CDN -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/owl.theme.default.min.css')); ?>">


    <!-- Fontawesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/slick.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/slick-theme.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/toastr.min.css')); ?>">
  
    <!-- Custom CSS link -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
    <!-- Meta Pixel Code -->
    <?php
        use App\Models\FacebookPixcel;
        use App\Models\SocialLinks;

        $fbpixcel = FacebookPixcel::find(1);
        $socialLinks = SocialLinks::get();

    ?>
    <?php if($fbpixcel && $fbpixcel->facebook_pixcel): ?>
        <?php echo $fbpixcel->facebook_pixcel; ?>

    <?php endif; ?>
    <!-- End Meta Pixel Code -->
        
</head>

<body>

    <!-- 
    --------------------------------
    ---------- / Headline / --------
    --------------------------------
     -->

    <div class="headline">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="headline-text">
                <p>We Deliver In 6 To 7 Working Days , Will Live On Forever.</p>
            </div>
            <div class="headline-right">
                    <div class="social-media">
                    <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($socialLink->link); ?>" target="_blank">
                            <?php echo $socialLink->icon; ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <p>
                    <a href="<?php echo e(route('contactUs')); ?>" class="headline-cta">Get a Quote</a>
                </p>
            </div>
        </div>
    </div>

    <!-- 
    --------------------------------
    ---------- / Header / ----------
    --------------------------------
     -->
    <header>
        <div class="main-desktop-header">
            <!-- desktop header middle -->
            <div class="container desktop-header">
                <div class="nav-bar">
                    <ul class="nav-bar-links nav-bar-list">
                        <li><a href="<?php echo e(route('index')); ?>" class="nav-bar-link">Home</a></li>
                        <li><a href="<?php echo e(route('aboutUs')); ?>" class="nav-bar-link">About us</a></li>
                        <li><a href="<?php echo e(route('shop')); ?>" class="nav-bar-link">Shop</a></li>
                        <li><a href="<?php echo e(route('blog')); ?>" class="nav-bar-link">Blog</a></li>
                        <li><a href="<?php echo e(route('contactUs')); ?>" class="nav-bar-link">Contact us</a></li>
                    </ul>
                </div>
                <div class="header-logo">
                    <a href="<?php echo e(route('index')); ?>"><img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Ghazi 1984 Logo"></a>
                </div>
                <?php
                    use App\Models\Categories;
                    use App\Models\Cart;
                    $parentCategories = Categories::where('cat_pid', 0)->get();
                    
                    $sessionID = session()->getId();
                    $cart = Cart::where('session_id', $sessionID)->where('order_id', null)->where('action', '=', 'add-to-cart')->count();
    
                    $cartTotal = Cart::where('session_id', $sessionID)->where('order_id', null)->where('action', '=', 'add-to-cart')->get();
                    $subtotal = 0;
                    foreach ($cartTotal as $item) {
                        $subtotal += ($item->quantity * $item->product->price);
                    }
                    $total = $subtotal;
                ?>
                <div class="header-icons nav-bar-list">
                    <ul class="d-flex justify-content-between align-items-center">
                        <li><a href="#" id="account-sidebar-btn"><i class="fa-solid fa-user"></i></a></li>
                        <li class="search-toggle">
                            <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                            <div class="search-box">
                                <form  action="<?php echo e(route('search')); ?>" method='GET'>
                                    <input type="search" name="search" id="search" placeholder="Search for products">
                                </form>
                                <div><i class="fa-solid fa-magnifying-glass"></i></div>
                            </div>
                        </li>
                        <li><a href="<?php echo e(route('wishlist')); ?>"><i class="fa-regular fa-heart"></i></a></li>
                        <li>
                            <a href="<?php echo e(route('cart')); ?>"><i class="fa-solid fa-cart-shopping"></i>
                                <span style="position: absolute; top: 72px; background: #035972; width: 14px; height: 14px; line-height: 14px; text-align: center; color: #fff; border-radius: 100%; font-size: 9px;"><?php echo e($cart); ?></span>
                                <span style="margin-left: 15px"><?php echo e(get_currency_symbol()); ?> <?php echo e(number_format(format_price_only($total), 0)); ?></span>
                          </a>
                    </li>
                        
                    </ul>
                </div>
            </div>
            <!-- desktop header bottom -->
            <div class="header-bottom">
                <div class="container">
                    <nav class="navbar navbar-expand-lg justify-content-center">
                        <ul class="navbar-nav">
                            <?php $__currentLoopData = $parentCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="<?php echo e(route('categories', ['id' => $parentCategory->id])); ?>" id="dropdown<?php echo e($parentCategory->id); ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo e($parentCategory->cat_name); ?><i class="fa-solid fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdown<?php echo e($parentCategory->id); ?>">
                                        <?php
                                            $subCategories = Categories::where('cat_pid', $parentCategory->id)->get();
                                        ?>
                                        <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a class="dropdown-item" href="<?php echo e(route('products', ['id' => $subCategory->id])); ?>"><?php echo e($subCategory->cat_name); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('bulkOrder')); ?>">Bulk order</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- mobile header -->
        <div class="mobile-header container">
            <div class="mobile-menu" onclick="toggleMobileNavbar()">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="header-mobile-logo">
                <a href="<?php echo e(route('index')); ?>">
                    <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Logo">
                </a>
            </div>
            <div class="quick-tabs">
                <div class="cart-tab">
                    <a href="<?php echo e(route('cart')); ?>"><i class="fa-solid fa-cart-shopping"></i>
                        <span style="position: absolute; background: #035972; width: 14px; height: 14px; line-height: 14px; text-align: center; color: #fff; border-radius: 100%; font-size: 9px;"><?php echo e($cart); ?></span>
                        <span style="margin-left: 15px"><?php echo e(get_currency_symbol()); ?> <?php echo e(number_format(format_price_only($total), 0)); ?></span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Mobile side bar -->
        <div class="mobile-navbar" id="mobileNavbar">
            <div class="mobile-nav-top">
                <form action="#">
                    <input type="search" id="search" placeholder="Search for products">
                </form>
                <div class="close-icon" onclick="closeMobileNavbar()">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
            <div class="tab">
                <button class="tablinks" id="defaultOpen" onclick="openTab(event, 'menu')">Menu</button>
                <button class="tablinks" onclick="openTab(event, 'categories')">Categories</button>
            </div>
            <!-- Tab content -->
            <div id="menu" class="tabcontent">
                <ul>
                    <li><a href="<?php echo e(route('index')); ?>">Home</a></li>
                    <li><a href="<?php echo e(route('aboutUs')); ?>">About Us</a></li>
                    <li><a href="<?php echo e(route('shop')); ?>">Shop</a></li>
                    <li><a href="<?php echo e(route('blog')); ?>">Blog</a></li>
                    <li><a href="<?php echo e(route('contactUs')); ?>">Contact Us</a></li>
                    <li><a href="<?php echo e(route('wishlist')); ?>"><i class="fa-regular fa-heart"></i>Wishlist</a></li>
                    <li><a href="<?php echo e(route('account')); ?>"><i class="fa-solid fa-user"></i>Login / Register</a></li>
                </ul>
            </div>
            <div id="categories" class="tabcontent">
                <ul>
                    <?php $__currentLoopData = $parentCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('categories', ['id' => $parentCategory->id])); ?>">
                                <?php echo e($parentCategory->cat_name); ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(route('bulkOrder')); ?>">Bulk Order</a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- account side bar -->
    <div id="account-sidebar" class="account-sidebar">
        <div class="account-sidebar-header">
            <h4>Sign In</h4>
            <div class="account-close-btn" id="account-sidebar-close">
                Close <i class="fas fa-times"></i>
            </div>
        </div>
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
            <div class="form-check mt-3">
                <div class="rememberMe">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <a href="<?php echo e(route('lostPassword')); ?>" class="text-end">Lost your password?</a>
            </div>
        </form>
        <div class="account-section mt-4">
            <i class="fas fa-user"></i>
            <div>
                <p class="mb-0">No account yet?</p>
                <a href="<?php echo e(route('account')); ?>">Create an account</a>
            </div>
        </div>
        <hr>
    </div>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- 
    --------------------------------
    -------- / Info boxes / --------
    --------------------------------
     -->
     <div class="info-boxes-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-lg-0">
                    <div class="info-box-wrapper d-flex">
                        <img src="<?php echo e(asset('assets/images/info-box-1.webp')); ?>" class="info-icon" alt="Free Shipping">
                        <div class="info-box-text">
                            <h4>Shipping</h4>
                            <p>We Deliver In 6-7 Working Days</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-lg-0">
                    <div class="info-box-wrapper d-flex align-items-center">
                        <img src="<?php echo e(asset('assets/images/info-box-2.webp')); ?>" class="info-icon" alt="24/7 Support">
                        <div class="info-box-text">
                            <h4>24/7 Support</h4>
                            <p>We Are Always Here For You</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-lg-0">
                    <div class="info-box-wrapper d-flex align-items-center">
                        <img src="<?php echo e(asset('assets/images/info-box-3.webp')); ?>" class="info-icon" alt="Online Payment">
                        <div class="info-box-text">
                            <h4>Online Payment</h4>
                            <p>Make Your Transactions Quick And Easy</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-lg-0">
                    <div class="info-box-wrapper d-flex align-items-center">
                        <img src="<?php echo e(asset('assets/images/info-box-4.webp')); ?>" class="info-icon" alt="Bulk Order">
                        <div class="info-box-text">
                            <h4>Bulk Order</h4>
                            <p>We Accept Bulk Orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 
    --------------------------------
    ---------- / Footer / ----------
    --------------------------------
     -->
    <footer class="footer-container">
        <div class="container">
            <div class="row pb-md-5">
                <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                    <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="logo-footer" class="img-fluid mb-5">
                    <p>Morph into a stronger, more powerful you with GHAZI's 1984, an electrifying new sports
                        collection
                        by Naveed Raza.</p>
                        <div class="social-icons">
                        <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($socialLink->link); ?>" target="_blank" style="background: <?php echo e($socialLink->bgcolor); ?>; color: <?php echo e($socialLink->color); ?>;">
                                <?php echo $socialLink->icon; ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                    <h4>Useful Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo e(route('aboutUs')); ?>">About Us</a></li>
                        <li><a href="<?php echo e(route('shop')); ?>">Shop</a></li>
                        <li><a href="<?php echo e(route('blog')); ?>">Blog</a></li>
                        <li><a href="<?php echo e(route('contactUs')); ?>">Contact Us</a></li>
                        <li><a href="<?php echo e(route('privacyPolicy')); ?>">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                    <h4>Our Collections</h4>
                    <ul class="list-unstyled">
                        <?php $__currentLoopData = $parentCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(route('categories', ['id' => $parentCategory->id])); ?>">
                                    <?php echo e($parentCategory->cat_name); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route('bulkOrder')); ?>">Bulk Order</a></li>
                    </ul>
                </div>
                <div class="footer-column col-lg-3 col-md-6 col-sm-12">
                    <h4>Store Information</h4>
                    <ul class="list-unstyled contact-list">
                        <li><i class="fa fa-map-marker-alt"></i> Address: GHAZI1984 Shop No 1, Plot No 5c, Lord
                            Sports
                            Main Badar commercial DHA PHASE 5, Karachi, 75500.</li>
                        <li><i class="fa-solid fa-phone-flip"></i> Contact Us: +923099026655</li>  
                         <li><i class="fa-regular fa-envelope"></i> Email: <a
                                href="mailto:ghaziapparel1984@gmail.com">ghaziapparel1984@gmail.com</a></li>
                        <li><i class="fa-regular fa-envelope"></i> Email: <a
                                href="mailto:info@ghazi1984.com">info@ghazi1984.com</a></li>
                        <li><i class="fa-regular fa-envelope"></i> Email: <a
                                href="mailto:sales@ghazi1984@gmail.com">sales@ghazi1984.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="copyrights-wrapper">
            <div class="container d-flex justify-content-between align-items-center flex-column flex-md-row">
                <p class="mb-0">&copy; 2022 | All Rights Reserved | Develope by <a href="https://agilesolutionshub.com" target="_blank">Agile Solutions</a></p>
                <img src="<?php echo e(asset('assets/images/payment-methods.webp')); ?>" alt="payment" class="payment-img">
            </div>
        </div>
    </footer>

    <!-- Back to top -->
    <button id="backToTopBtn"><i class="fa-solid fa-angle-up"></i></button>

    <!-- whatsapp -->
    <a href="https://wa.me/+923099026655" target="_blank" id="whatsappBtn">
        <img src="<?php echo e(asset('assets/images/whatsapp-logo.png')); ?>" alt="Chat on WhatsApp">
    </a>

    <div class="currency-convert-area">
        <div class="woocommerce-multi-currency wmc-right style-1 wmc-collapse wmc-bottom wmc-sidebar">
            <div class="wmc-list-currencies">
                <div class="wmc-title">
                    Select your currency
                </div>
                <?php $__currentLoopData = \App\Models\Currency::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="wmc-currency <?php echo e(session('currency') == $currency->currency_code ? 'wmc-active' : ''); ?>" data-currency="<?php echo e($currency->currency_code); ?>">
                        <a href="<?php echo e(route('switch.currency', $currency->currency_code)); ?>" rel="nofollow" class="wmc-currency-redirect">
                            <span class="wmc-currency-content-left"><?php echo e($currency->currency_code); ?></span>
                            <span class="wmc-currency-content-right"><?php echo e($currency->title); ?></span>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="wmc-sidebar-open"></div>
            </div>
        </div>
    </div>
    <style>
    .currency-convert-area{
    position: fixed;
    top: 40%;
    right: 1px;
    z-index: 255;
    cursor: pointer;
    }
    .wmc-sidebar-open:before {
    content: "+";
    width: 100%;
    text-align: center;
    }
    .wmc-sidebar-open {
    position: absolute !important;
    right: 0px !important;
    height: 40px;
    width: 40px;
    background: rgba(153, 153, 153, .2);
    border-radius: 50%;
    margin: 10px 0 0;
    line-height: 40px;
    cursor: pointer;
    text-align: center;
    color: #ccc;
    font-weight: 700;
    font-size: 28px;
    }
    .wmc-title {
    text-align: center;
    color: #fff;
    font: 300 14px Arial;
    margin: 0;
    text-transform: uppercase;
    background: #212121 !important;
    padding: 16px 0;
    transition: all .25s ease;
    width: 250px;
}
.wmc-currency {
    background: #212121 !important;
    text-transform: uppercase;
    letter-spacing: 1px;
    width: 100%;
    z-index: 1000;
    font: 10px Arial;
    margin: 4px 0 0;
    transition: all .25s ease;
    position: relative;
    cursor: pointer;
    clear: both;
    display: inline-block;
    height: 40px;
}
.wmc-currency:hover {
    background: #035972 !important;
}
.wmc-currency a {
    color: #fff;
    text-decoration: none;
    text-align: center;
    line-height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
}

.wmc-currency-content-left {
    text-align: center;
    width: 40px;
    line-height: 40px;
    display: inline-flex;
    justify-content: center;
}

.wmc-currency-content-right {
    width: calc(100% - 40px);
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    line-height: 40px;
}

.wmc-list-currencies {
    display: inline-block;
}
.wmc-active {
    background: #035972 !important;
}
.wmc-list-currencies .wmc-currency:not(.wmc-active),
.wmc-title,
.wmc-currency-content-right {
    display: none;

}

.wmc-list-currencies:hover .wmc-currency,
.wmc-list-currencies:hover .wmc-title,
.wmc-list-currencies:hover .wmc-currency-content-right {
    display: block;
}

</style>

    <!-- Bootstrap JS CDN -->
    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- Jquery and owl carousel CDN -->
    <script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/owl.carousel.min.js')); ?>"></script>
    
    <script src="<?php echo e(asset('assets/js/slick.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/toastr.min.js')); ?>"></script>
    

    <!-- Hero section owl carousel -->
    <?php if(Session::has('message')): ?>
    <script>
        {
            toastr.options = {
                "progressBar" : false,
                "closeButton" : true,
            }
            toastr.success("<?php echo e(Session::get('message')); ?>", "Success!");
        }
    </script>
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
    <script>
        {
            toastr.options = {
                "progressBar" : false,
                "closeButton" : true,
            }
            toastr.error("<?php echo e(Session::get('error')); ?>");
        }
    </script>
    <?php endif; ?>
    <script>
        $(document).ready(function () {
            $(".hero-carousel").owlCarousel({
                items: 1,
                loop: true,
                margin: 0,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
            });
        });

        // products carousel
        $(".products-carousel").owlCarousel({
            items: 4,
            loop: true,
            margin: 10,
            rtl:true,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            }
        });

        // celebrity carousel
        $(".celebrity-owl-carousel").owlCarousel({
            items: 3,
            margin: 10,
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });

        // Instagram carousel

        $(".instagram-owl-carousel").owlCarousel({
            items: 5,
            margin: 5,
            loop: true,
            rtl:true,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 5
                }
            }
        });

        // blogs carousel
        $(".blog-owl-carousel").owlCarousel({
            items: 3,
            margin: 20,
            loop: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });

        // brands carousel
        $('.brand-owl-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            dots: false,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                900: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });

    </script>
    <script>
        // product detail images
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            arrows: true,
            centerMode: true,
            focusOnSelect: true
        });

        // products carousel
        $(".products-carousel").owlCarousel({
            items: 4,
            loop: true,
            margin: 10,
            rtl:true,
            responsive: {
                0: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            }
        });
    </script>

    <!-- js file -->
    <script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>
    <script>
        $(window).on('load', function() {
            if (window.location.pathname === '/') {
                $('#preloader').fadeOut('slow', function() {
                    $('body, html').css('overflow', 'auto');
                });
            } else {
                $('#preloader').hide();
                $('body, html').css('overflow', 'auto');
            }
        });
    </script>

</body>

</html><?php /**PATH /home/ghazi1984/public_html/resources/views/layouts/layout.blade.php ENDPATH**/ ?>