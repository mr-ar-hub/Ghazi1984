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
                <h1 class="entry-title">Wishlist</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('index') }}">Home</a> » <span class="current">Wishlist</span>
                </div>
            </header>
        </div>
    </div>

    <!-- 
    --------------------------------
    --- / fill wishlist / ----------
    --------------------------------
     -->
    <div class="container py-5">
        <h2 class="wishlist-heading">Your wishlist products</h2>
        <hr>
        <div class="wishlist-products">
            <div class="product-item">
                <div class="remove-product">
                    <p><a href="#">Remove <i class="fa-solid fa-xmark"></i></a></p>
                </div>
                <div class="product-element-top">
                    <a href="#" class="product-image-link">
                        <img src="{{ asset('assets/images/product-3.webp') }}" alt="Product 1">
                        <div class="hover-img" style="background-image: url('assets/images/product-4.webp');"></div>
                        <div class="badge-sale">-52% off</div>
                        <div class="badge-keyword"><span>HOT</span></div>
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
                    <h3><a href="#">Fat Bunner</a></h3>
                    <div class="price">
                        <span class="original-price">$150.00</span>
                        <span class="sale-price">$100.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 
    --------------------------------
    -- / empty wishlist / ----------
    --------------------------------
     -->
    <div class="wishlist-empty">
        <i class="fa-regular fa-heart"></i>
        <h2>Wishlist is empty</h2>
        <p>You don't have any products in the wishlist yet.<br>
            You will find a lot of interesting products on our "Shop" page.</p>
        <a href="{{ route('shop') }}">return to shop</a>
    </div>
@endsection