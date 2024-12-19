@extends('layouts.layout')
@section('css')
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
@endsection
@section('content')
    <!-- 
    --------------------------------
    ------------ / Hero / ----------
    --------------------------------
     -->
    <div id="preloader">
        <div class="circle-container">
            <div class="half-circle"></div>
            <img src="{{ asset('assets/images/ghazi_big.png') }}" alt="Preloader" class="center-image">
        </div>
    </div>
    <section class="hero-section">
        <div class="owl-carousel hero-carousel">
            @foreach ($carousel as $item)
                <div class="item">
                    <img src="{{ asset('storage/'.$item->image_name) }}" alt="hero-image" class="slide-image img-fluid">
                </div>
            @endforeach
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
            @foreach ($category as $item)
                <div class="category-item">
                    <div class="category-image">
                        <a href="{{ route('products', ['id' => $item->id]) }}">
                            <img src="{{ asset('storage/'.$item->cat_image) }}" alt="{{ $item->cat_name }}" class="category-img">
                        </a>
                    </div>
                    <div class="category-info">
                        <h3>{{ $item->cat_name }}</h3>
                        <a href="{{ route('products', ['id' => $item->id]) }}">
                            <p>{{ $item->products_count }} products</p>
                        </a>
                    </div>
                </div>
            @endforeach
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
            @foreach ($products as $items)
                <div class="product-item">
                    <div class="product-element-top">
                        <a href="{{ route('productDetail', ['id' => $items->id]) }}" class="product-image-link">
                            <img src="{{ asset('storage/' . $items->ProductImg->image_name) }}" alt="Product 1">
                            @php
                                $carouselImg = $items->CarouselImg->first();
                            @endphp
                            @if ($carouselImg)
                                <div class="hover-img" style="background-image: url('{{ asset('storage/' . $carouselImg->image_name) }}');"></div>
                            @endif
                            @if ($items->discount)
                                <div class="badge-sale">-{{ $items->discount }}% off</div>
                            @endif
                            @if($items->status == 1)
                                <div class="badge-keyword"><span>HOT</span></div>
                            @elseif($items->status == 0)
                                <div class="badge-sale" style="top: 50px !important; background-color: #f34848 !important;"><span>NEW ARRIVAL</span></div>
                            @endif
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
                                <a href="{{ route('productDetail', ['id' => $items->id]) }}"><i class="cart-icon fas fa-shopping-cart"></i></a>
                            </div>
                        </a>
                    </div>
                    <div class="product-info">
                        <h3><a href="#">{{ $items->name }}</a></h3>
                        <div class="price">
                            <span class="original-price">
                                @if ($items->discount != null)
                                    @php
                                        $finalPrice =round( ($items->price / (100 - $items->discount) ) * 100);
                                        
                                    @endphp
                                    {{ format_price($finalPrice) }}
                                @endif
                            </span>
                            <span class="sale-price">{{ format_price($items->price) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
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
                    <a href="{{ route('shop') }}" class="parallex-btn">Shop Now</a>
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
            @foreach ($newproducts as $items)
                <div class="product-item">
                    <div class="product-element-top">
                        <a href="{{ route('productDetail', ['id' => $items->id]) }}" class="product-image-link">
                            <img src="{{ asset('storage/' . $items->ProductImg->image_name) }}" alt="Product 1">
                            <div class="hover-img" style="background-image: url('{{ asset('storage/' . $items->CarouselImg->first()->image_name) }}');"></div>
                            @if ($items->discount)
                                <div class="badge-sale">-{{ $items->discount }}% off</div>
                            @endif
                            @if($items->status == 0)
                                <div class="badge-sale" style="top: 50px !important; background-color: #f34848 !important;"><span>NEW ARRIVAL</span></div>
                            @endif
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
                                <a href="{{ route('productDetail', ['id' => $items->id]) }}"><i class="cart-icon fas fa-shopping-cart"></i></a>
                            </div>
                        </a>
                    </div>
                    <div class="product-info">
                        <h3><a href="#">{{ $items->name }}</a></h3>
                        <div class="price">
                            <span class="original-price">
                                @if ($items->discount != null)
                                    @php
                                        $finalPrice =round( ($items->price / (100 - $items->discount) ) * 100);
                                        
                                    @endphp
                                    {{ format_price($finalPrice) }}
                                @endif
                            </span>
                            <span class="sale-price">{{ format_price($items->price) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
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
            @foreach ($spotted as $item)
                <div class="celebrity-item">
                    <a>
                        @if($item->SpottedImage)
                            <img src="{{ asset('storage/' . $item->SpottedImage->image_name) }}" class="img-fluid celebrity-image" alt="{{ $item->name }}">
                        @endif
                        <p class="celebrity-name">{{ $item->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>


    <!-- 
    --------------------------------
    ----------- / blogs / ----------
    --------------------------------
     -->
     @if($blog->isNotEmpty())
        <div class="container my-5">
            <div class="section-title-content">
                <p class="pre-title">BLOGS</p>
                <div class="section-title">
                    <h4 class="heading-title">OUR LATEST NEWS</h4>
                </div>
            </div>
            <div class="blog-owl-carousel owl-carousel mt-5">
                @foreach ($blog as $item)
                    <div class="blog-post">
                        <div class="blog-image-wrapper">
                            <a href="{{ route('blogDetail', ['slug' => $item->slug]) }}"><img src="{{ asset('storage/' . $item->BlogImage->image_name) }}" class="img-fluid blog-image"
                                    alt="Blog Image 1"></a>
                            <div class="blog-dots">•••</div>
                        </div>
                        <div class="blog-content">
                            <h3 class="blog-title">{{ $item->title }}</h3>
                            <div class="share-icon">
                                <i class="fas fa-share-alt"></i>
                                <div class="blog-post-icons">
                                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <p class="blog-description">{{ $item->short_description }}</p>
                            <a href="{{ route('blogDetail', ['slug' => $item->slug]) }}" class="blog-detail-link">Continue reading</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="container brands-section">
        <div class="section-title-content">
            <div class="section-title">
                <h4 class="heading-title">Follow us on Instagram</h4>
            </div>
        </div>
        <div class="instagram-owl-carousel owl-carousel">
            @foreach ($instaimg as $item)
                <div class="insta-item">
                        <a href="{{ $item->postlink }}" target="__blank">
                        @if (strpos($item->image, '.webp') || strpos($item->image,'.png') || strpos($item->image, '.jpg') || strpos($item->image, '.jpeg') || strpos($item->image, '.heic'))
                            <img src="{{ $item->image }}" alt="Image" class="img-fluid">
                        @endif
                    </a>
                </div>
            @endforeach
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
                <img src="{{ asset('assets/images/brand-1.webp') }}" alt="Category" class="img-fluid">
            </div>
            <div class="brand-item">
                <img src="{{ asset('assets/images/brand-2.webp') }}" alt="Category" class="img-fluid">
            </div>
            <div class="brand-item">
                <img src="{{ asset('assets/images/brand-3.webp') }}" alt="Category" class="img-fluid">
            </div>
            <div class="brand-item">
                <img src="{{ asset('assets/images/brand-4.webp') }}" alt="Category" class="img-fluid">
            </div>
            <div class="brand-item">
                <img src="{{ asset('assets/images/brand-5.webp') }}" alt="Category" class="img-fluid">
            </div>
            <div class="brand-item">
                <img src="{{ asset('assets/images/brand-6.webp') }}" alt="Category" class="img-fluid">
            </div>
        </div>
    </div>
    <!-- 
    -------------------------------  
    ------ / Review Content / -----
    -------------------------------
     -->

     <div id="myOverlay" class="overlay">
        <div class="closebtn" onclick="closeReview()" title="Close Overlay"><i class="fa-solid fa-xmark"></i></div>
        <div class="overlay-content">
            <section class="overlay-menu">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <div class="total-star-rating">
                                <div class="menu-review-stars">
                                    <span class="menu-star">★</span>
                                    <span class="menu-star">★</span>
                                    <span class="menu-star">★</span>
                                    <span class="menu-star">★</span>
                                    <span class="menu-star">★</span>
                                </div>
                                <div class="total-reviews">
                                    <button onclick="reviewDropdown()"><p>5340 Reviews <span><i class="fa-solid fa-angle-down"></i></span></p></button>
                                    <div class="total-stars" id="totalStar">
                                        <h2 class="text-center"><span style="margin-top:-2px; margin-right: 3px; color: #ffd700; font-size: 30px; font-weight: 900;">★</span>4.9</h2>
                                        <div class="all-reviews">
                                            <a href="#"><span class="menu-star">★★★★★</span><progress value="100" max="100"></progress>(4054)</a>
                                            <a href="#"><span class="menu-star">★★★★</span><progress value="90" max="100"></progress>(209)</a>
                                            <a href="#"><span class="menu-star">★★★</span><progress value="70" max="100"></progress>(203)</a>
                                            <a href="#"><span class="menu-star">★★</span><progress value="30" max="100"></progress>(4)</a>
                                            <a href="#"><span class="menu-star">★</span><progress value="5" max="100"></progress>(1)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <div class="review-filter">
                                <button onclick="filterDrop()"><i class='bx bx-sort-down'></i></button>
                                <div class="filter-dropdown" id="filterDropdown">
                                    <h2>Sort by</h2>
                                    <div class="filter-links">
                                        <a href="#" class="active">Featured</a>
                                        <a href="#">Newest</a>
                                        <a href="#">Highest Rating</a>
                                        <a href="#">Lowest Rating</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="reviews">
                <div class="container-fluid">
                    <div id="macy-container">
                        <div class="demo">
                            <a href="javascript:void(0)" onclick="openLightboxFromDiv(this)">
                                <img src="{{ asset('storage/' . $items->ProductImg->image_name) }}" class="demo-image">
                                <div class="demo_content">
                                    <h5>Person Name<span class="pt-1"><i class='bx bxs-badge-check'></i></span></h5>
                                    <h6>11/12/2024</h6>
                                    <div class="review-stars">
                                        <span class="star filled">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                    </div>
                                    <p>Here Review about image</p>
                                </div>
                            </a>
                            <a href="">
                                <div class="demo_content_end">
                                    <div class="product_image">
                                        <img src="{{ asset('storage/' . $items->ProductImg->image_name) }}" alt="" class="demo-image"> 
                                    </div>
                                    <div class="product_name">
                                        <p>Product Nmae</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Lightbox Structure -->
    <div class="custom-lightbox" id="customLightbox" style="display: none;">
        <div class="lightbox-content">
            <div class="lightbox-img">
                <img src="{{ asset('storage/' . $items->ProductImg->image_name) }}" alt="" id="lightboxImage" alt="Lightbox Image">
                <button class="lightbox-close-btn" onclick="closeLightbox()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="image-description" id="lightboxDescription">
                <div class="lightbox-image-content">
                    <h5 id="lightboxName" class="mb-2">Person Name <span><i class='bx bxs-badge-check'></i></span></h5>
                    <div class="date-stars d-flex justify-content-between mb-1">
                        <h6 id="lightboxDate">11/12/2024</h6>
                        <div class="review-stars text-end" id="lightboxStars">
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                        </div>
                    </div>
                    <p id="lightboxText">"Review come from div"</p>
                </div>
                <a href="#">
                    <div class="lightbox-product-link">
                        <div class="product_image">
                            <img src="{{ asset('storage/' . $items->ProductImg->image_name) }}" alt="" class="demo-image"> 
                        </div>
                        <div class="product_name">
                            <p>Product Name</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div id="backgroundDim" class="background-dim"></div>
    <div class="review_btn d-none d-lg-block">
        <button class="noselect" onclick="openReview()">
            <span class="icon">
                <i class="fa fa-star"></i> 
            </span>
            <span class="text">Review's</span>
        </button>
    </div> 
@endsection
    