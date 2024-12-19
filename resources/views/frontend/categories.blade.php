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
                <h1 class="entry-title">{{ $category->first()->parent->cat_name }}</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('index') }}">Home</a> » <span class="current">{{ $category->first()->parent->cat_name }}</span>
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
            <div class="col-lg-3 col-md-12 right-part" id="sidebar">
                <div class="sidebar-close" id="sidebar-close">
                    CLOSE <i class="fa-solid fa-xmark"></i>
                </div>
                <h5 class="widget-title" style="font-weight: 700; margin-bottom: 15px;">Categories</h5>
                <ul>
                    <li class="dropdown">
                        <a class="dropdown-toggle" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $category->first()->parent->cat_name }} <span>({{ $count }})</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <div id="categoryList">
                                @foreach($categories as $subCategory)
                                    <li><a class="dropdown-item" href="{{ route('products', ['id' => $subCategory->id]) }}">{{ $subCategory->cat_name }} <span> ({{ $subCategory->products_count }})</span></a></li>
                                @endforeach
                            </div>
                        </ul>
                    </li>
                </ul>
                <hr>
                <div class="price-range-filter">
                    <h5 class="widget-title">Filter by price</h5>
                    <form action="{{ route('productsFilter') }}" method="GET">
                        @csrf   
                        <div class="price_slider_wrapper">
                            <div class="range-input">
                                <input type="range" class="range-min" min="0" max="{{$maxPriceFromDb}}" value="0" step="100">
                                <input type="range" class="range-max" min="0" max="{{$maxPriceFromDb}}" value="{{$maxPriceFromDb}}" step="100">
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="price_label">
                                    <span class="price">Price: </span>
                                    <span class="price-unit">{{get_currency_symbol()}} </span>
                                    <span id="priceFrom"></span> — 
                                    <span class="price-unit">{{get_currency_symbol()}} </span>
                                    <span id="priceTo">{{ number_format(format_price_only($maxPriceFromDb)) }}</span>
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
                    @foreach ($sideproducts as $items)
                        <div class="recent-product-item mt-3">
                            <a href="{{ route('productDetail', ['id' => $items->id]) }}"><img src="{{ asset('storage/' . $items->ProductImg->image_name) }}" class="img-fluid" alt="Recent Blog 1"></a>
                            <div>
                                <h3><a href="{{ route('productDetail', ['id' => $items->id]) }}">{{ $items->name }}</a></h3>
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
            <div class="col-lg-9 col-md-12 left-part">
                <div style="font-weight: 700; margin-bottom: 15px;">
                    <a href="{{ route('index') }}" style="color: #8E8E8E">Home / </a><span class="breadcrumb-last"> {{ $category->first()->parent->cat_name }}</span>		
                </div>
                <div class="blog-categories-section">
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
@endsection