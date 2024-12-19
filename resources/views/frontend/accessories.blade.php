@extends('layouts.layout')
@section('content')
<!-- 
    --------------------------------
    ------ / page title / ----------
    --------------------------------
     -->
     <div class="page-title">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">Accessories</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('index') }}">Home</a> » <span class="current">Accessories</span>
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
                    <form action="#">
                        <div class="price_slider_wrapper">
                            <input type="range" class="form-control-range" id="priceRange" min="0" max="11500"
                                step="100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="price_label">
                                    <span class="price">Price: </span><span class="price-unit">Rs </span><span
                                        id="priceFrom">0</span> — <span class="price-unit">Rs </span><span
                                        id="priceTo">11,500</span>
                                </div>
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
                    <div class="recent-product-item mt-3">
                        <a href="#"><img src="{{ asset('assets/images/product-3.webp') }}" class="img-fluid" alt="Recent Blog 1"></a>
                        <div>
                            <h3><a href="#">Tracksuit Jackets</a></h3>
                            <div class="price">
                                <span class="original-price">$80.00</span>
                                <span class="sale-price">$50.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="recent-product-item mt-3">
                        <a href="#"><img src="{{ asset('assets/images/product-6.webp') }}" class="img-fluid" alt="Recent Blog 1"></a>
                        <div>
                            <h3><a href="#">Tracksuit Jackets</a></h3>
                            <div class="price">
                                <span class="original-price">$80.00</span>
                                <span class="sale-price">$50.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="recent-product-item mt-3">
                        <a href="#"><img src="{{ asset('assets/images/product-8.webp') }}" class="img-fluid" alt="Recent Blog 1"></a>
                        <div>
                            <h3><a href="#">Tracksuit Jackets</a></h3>
                            <div class="price">
                                <span class="original-price">$80.00</span>
                                <span class="sale-price">$50.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 left-part">
                <button id="sidebar-toggle" class="d-lg-none sidebar-btn"><i class="fa-solid fa-bars"></i>SHOW
                    SIDEBAR</button>
                <div class="blog-categories-section">
                    <div class="category-item">
                        <div class="category-image">
                            <a href="#"><img src="{{ asset('assets/images/category-1.webp') }}" alt="Category 1" class="category-img"></a>
                        </div>
                        <div class="category-info">
                            <h3>WINTER COLLECTION</h3>
                            <a href="#">
                                <p>products 12</p>
                            </a>
                        </div>
                    </div>
                    <div class="category-item">
                        <div class="category-image">
                            <a href="#"><img src="{{ asset('assets/images/category-2.webp') }}" alt="Category 2" class="category-img"></a>
                        </div>
                        <div class="category-info">
                            <h3>WINDBREAKER & JACKETS</h3>
                            <a href="#">
                                <p>products 5</p>
                            </a>
                        </div>
                    </div>
                    <div class="category-item">
                        <div class="category-image">
                            <a href="#"><img src="{{ asset('assets/images/category-3.webp') }}" alt="Category 3" class="category-img"></a>
                        </div>
                        <div class="category-info">
                            <h3>TEE'S</h3>
                            <a href="#">
                                <p>products 2</p>
                            </a>
                        </div>
                    </div>
                    <div class="category-item">
                        <div class="category-image">
                            <a href="#"><img src="{{ asset('assets/images/category-4.webp') }}" alt="Category 4" class="category-img"></a>
                        </div>
                        <div class="category-info">
                            <h3>SOCKS</h3>
                            <a href="#">
                                <p>products 17</p>
                            </a>
                        </div>
                    </div>
                    <div class="category-item">
                        <div class="category-image">
                            <a href="#"><img src="{{ asset('assets/images/category-5.webp') }}" alt="Category 5" class="category-img"></a>
                        </div>
                        <div class="category-info">
                            <h3>SHORTS</h3>
                            <a href="#">
                                <p>products 9</p>
                            </a>
                        </div>
                    </div>
                    <div class="category-item">
                        <div class="category-image">
                            <a href="#"><img src="{{ asset('assets/images/category-6.webp') }}" alt="Category 6" class="category-img"></a>
                        </div>
                        <div class="category-info">
                            <h3>sANDOS & TANK TOP</h3>
                            <a href="#">
                                <p>products 26</p>
                            </a>
                        </div>
                    </div>
                    <div class="category-item">
                        <div class="category-image">
                            <a href="#"><img src="{{ asset('assets/images/category-7.webp') }}" alt="Category 7" class="category-img"></a>
                        </div>
                        <div class="category-info">
                            <h3>POLO TEE'S</h3>
                            <a href="#">
                                <p>products 23</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection