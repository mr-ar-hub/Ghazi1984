
<?php $__env->startSection('content'); ?>
    <!-- 
    --------------------------------
    ------ / page title / ----------
    --------------------------------
     -->
     <div class="page-title">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">Shop</h1>
                <div class="breadcrumbs">
                    <a href="<?php echo e(route('index')); ?>">Home</a> » <span class="current">Shop</span>
                </div>
            </header>
        </div>
    </div>
    <!-- 
    --------------------------------
    --------- / side bar / ---------
    --------------------------------
     -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4 col-md-12 right-part" id="sidebar">
                <div class="sidebar-close" id="sidebar-close">
                    CLOSE <i class="fa-solid fa-xmark"></i>
                </div>
                <ul>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Categorice <span>(11)</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <div class="px-3 py-2">
                                    <input type="text" class="form-control" id="categorySearch">
                                </div>
                            </li>
                            <div id="categoryList">
                                <li><a class="dropdown-item" href="#">Beach Wear</a></li>
                                <li><a class="dropdown-item" href="#">Compressions & Tights</a></li>
                                <li><a class="dropdown-item" href="#">Fight Club MMA/BOXING</a></li>
                                <li><a class="dropdown-item" href="#">Polo Tee's</a></li>
                                <li><a class="dropdown-item" href="#">Sandos & Tank Top</a></li>
                                <li><a class="dropdown-item" href="#">Shorts</a></li>
                                <li><a class="dropdown-item" href="#">Sleeveless Tee's</a></li>
                                <li><a class="dropdown-item" href="#">Winter Collection</a></li>
                                <li><a class="dropdown-item" href="#">Tee's</a></li>
                                <li><a class="dropdown-item" href="#">Tracksuit & Trousers</a></li>
                                <li><a class="dropdown-item" href="#">Windbreaker & Jackets</a></li>
                            </div>
                        </ul>
                    </li>
                </ul>
                <hr>
                <div class="price-range-filter">
                    <h5 class="widget-title">Filter by price</h5>
                    <form action="<?php echo e(route('productsFilter')); ?>" method="GET">
                        <?php echo csrf_field(); ?>   
                        <div class="price_slider_wrapper">
                            <div class="range-input">
                                <input type="range" class="range-min" min="0" max="<?php echo e($maxPriceFromDb); ?>" value="0" step="100">
                                <input type="range" class="range-max" min="0" max="<?php echo e($maxPriceFromDb); ?>" value="<?php echo e($maxPriceFromDb); ?>" step="100">
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="price_label">
                                    <span class="price">Price: </span>
                                    <span class="price-unit"><?php echo e(get_currency_symbol()); ?> </span>
                                    <span id="priceFrom"></span> — 
                                    <span class="price-unit"><?php echo e(get_currency_symbol()); ?> </span>
                                    <span id="priceTo"><?php echo e(number_format(format_price_only($maxPriceFromDb))); ?></span>
                                </div>
                                <input type="hidden" name="min_price" id="minPrice">
                                <input type="hidden" name="max_price" id="maxPrice">
                                <button type="submit" class="filter-btn">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="filter-by-color">
                    <h5 class="widget-title">Filter by color</h5>
                    <ul class="filter-color-list">
                        <li>
                            <a href="#" class="d-flex justify-content-between align-items-center my-3 color-item">
                                <span class="swatch-inner">
                                    <span class="filter-swatch" style="background-color: #000000;"></span>
                                    <span class="color-name">Black</span>
                                </span>
                                <span class="count">14</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="d-flex justify-content-between align-items-center my-3 color-item">
                                <span class="swatch-inner">
                                    <span class="filter-swatch" style="background-color: #f804046e;"></span>
                                    <span class="color-name">Pink</span>
                                </span>
                                <span class="count">9</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="d-flex justify-content-between align-items-center my-3 color-item">
                                <span class="swatch-inner">
                                    <span class="filter-swatch" style="background-color: #0e0036;"></span>
                                    <span class="color-name">Navy</span>
                                </span>
                                <span class="count">20</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="d-flex justify-content-between align-items-center my-3 color-item">
                                <span class="swatch-inner">
                                    <span class="filter-swatch" style="background-color: #87fd00;"></span>
                                    <span class="color-name">Green</span>
                                </span>
                                <span class="count">14</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="recent-products">
                    <h5 class="widget-title">PRODUCTS</h5>
                    <?php $__currentLoopData = $sideproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="recent-product-item mt-3">
                            <a href="<?php echo e(route('productDetail', ['id' => $items->id])); ?>"><img src="<?php echo e(asset('storage/' . $items->ProductImg->image_name)); ?>" class="img-fluid" alt="Recent Blog 1"></a>
                            <div>
                                <h3><a href="<?php echo e(route('productDetail', ['id' => $items->id])); ?>"><?php echo e($items->name); ?></a></h3>
                                <div class="price">
                                    <span class="original-price">
                                        <?php if($items->discount != null): ?>
                                            <?php
                                                $finalPrice = round(($items->price / (100 - $items->discount) ) * 100);
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
            <div class="col-lg-8 col-md-12 left-part">
                <button id="sidebar-toggle" class="d-lg-none sidebar-btn"><i class="fa-solid fa-bars"></i>SHOW
                    SIDEBAR</button>
                <div class="products-container mb-5">
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
                                        <a href="#"><i class="cart-icon fas fa-shopping-cart"></i></a>
                                    </div>
                                </a>
                            </div>
                            <div class="product-info">
                                <h3><a href="#"><?php echo e($items->name); ?></a></h3>
                                <div class="price">
                                    <span class="original-price">
                                        <?php if($items->discount != null): ?>
                                            <?php
                                                $finalPrice = round(($items->price / (100 - $items->discount) ) * 100);
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
                <div class="pagination-container">
                    <div>
                        <?php echo e($pagination->appends(request()->query())->links('vendor.pagination.bootstrap-5')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const rangeInputs = document.querySelectorAll(".range-input input");
        const priceFrom = document.getElementById("priceFrom");
        const priceTo = document.getElementById("priceTo");
        const minPriceInput = document.getElementById("minPrice");
        const maxPriceInput = document.getElementById("maxPrice");
        const rangeGap = 100;

        function updateRangeBackground(minValue, maxValue) {
            const rangeInputElement = document.querySelector(".range-input");
            const minPercent = (minValue / rangeInputs[0].max) * 100;
            const maxPercent = (maxValue / rangeInputs[1].max) * 100;

            rangeInputElement.style.background = `linear-gradient(to right, #ddd ${minPercent}%, var(--main-color) ${minPercent}%, var(--main-color) ${maxPercent}%, #ddd ${maxPercent}%)`;
        }

        rangeInputs.forEach(input => {
            input.addEventListener("input", (e) => {
                let minVal = parseInt(rangeInputs[0].value);
                let maxVal = parseInt(rangeInputs[1].value);

                if ((maxVal - minVal) < rangeGap) {
                    if (e.target.className === "range-min") {
                        rangeInputs[0].value = maxVal - rangeGap;
                    } else {
                        rangeInputs[1].value = minVal + rangeGap;
                    }
                } else {
                    priceFrom.textContent = minVal.toLocaleString();
                    priceTo.textContent = maxVal.toLocaleString();

                    // Update hidden inputs with the current min and max values
                    minPriceInput.value = minVal;
                    maxPriceInput.value = maxVal;

                    updateRangeBackground(minVal, maxVal);
                }
            });
        });

        // Initialize hidden input values on page load
        minPriceInput.value = rangeInputs[0].value;
        maxPriceInput.value = rangeInputs[1].value;

        updateRangeBackground(rangeInputs[0].value, rangeInputs[1].value);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/frontend/shop.blade.php ENDPATH**/ ?>