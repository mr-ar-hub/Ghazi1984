@extends('layouts.layout')
@section('css')
    <style>
        .selected-color {
            box-shadow: 0 0 10px rgba(0, 0, 0, 1);
        }
        .slick-prev, .slick-next {
            display: block !important;
            opacity: 1 !important;
            height: 50px !important;
            width: 50px !important;
            z-index: 10;
        }

        .slick-prev:before, .slick-next:before {
            color: black !important; 
            font-size: 30px !important; 
        }

        .slick-prev {
            left: 10px;
        }

        .slick-next {
            right: 10px;
        }
        .rating-stars {
            display: inline-block;
            font-size: 24px;
            direction: rtl;
            unicode-bidi: bidi-override;
        }

        .rating-stars input[type="radio"] {
            display: none;
        }

        .rating-stars label {
            color: lightgray;
            cursor: pointer;
            display: inline-block;
            transition: color 0.2s;
        }

        .rating-stars input[type="radio"]:checked ~ label {
            color: gold;
        }

        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: gold;
        }
    </style>
@endsection
@section('content')
<!-- 
    --------------------------------
    -- / product details / ---------
    --------------------------------
     -->
     <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="slider-for">
                    @foreach($product->CarouselImg as $index => $image)
                        @if($index == 1)
                            @if(isset($product->ProductImg) && isset($product->ProductImg->image_name))
                                <div>
                                    <img src="{{asset('storage/'.$product->ProductImg->image_name)}}" class="img-fluid" alt="">
                                </div>
                            @endif
                        @endif
                        <div class="{{ $index == 0 ? 'active' : 'test' }}" >
                            @if(isset($image->image_name))
                                <img src="{{asset('storage/'.$image->image_name)}}" class="img-fluid" alt="">
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="slider-nav mt-2">
                    @foreach ($product->CarouselImg as $carouselImage)
                        <div>
                            <img src="{{ asset('storage/' . $carouselImage->image_name) }}" class="img-fluid" alt="{{ $product->name }}">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories', ['id' => $product->catName->parent->id]) }}">{{ $product->catName->parent->cat_name }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products', ['id' => $product->cat_id]) }}">{{ $product->catName->cat_name }}</a></li>
                        <li class="breadcrumb-item active final-page">{{ $product->name }}</li>
                    </ol>
                </nav>
                <h1 class="product-name">{{ $product->name }}</h1>
                <p class="price">
                    <del>
                        @if ($product->discount != null)
                            @php
                                $finalPrice = round(($product->price / (100 - $product->discount) ) * 100);
                            @endphp
                            {{ format_price($finalPrice) }}
                        @endif
                    </del> 
                    <strong>{{ format_price($product->price) }}</strong>
                </p>
                <p class="product-detail">Product details</p>
                <div class="product-detail-content">
                    {!! $product->description !!}
                </div>
                <div class="mb-3">
                    <label for="sizeSelect" class="size-label">Size: <span id="selectedSize"></span></label>
                    <div id="sizeSelect" class="d-flex flex-wrap" role="group">
                        @foreach ($sizes as $size)
                            @php
                                $sizeName = $size->name;
                                $sizeId = 'size_' . str_replace(' ', '', $sizeName);
                            @endphp
                            <input type="radio" class="btn-check" name="size" id="{{ $sizeId }}" value="{{ $sizeName }}" data-size-name="{{ $sizeName }}">
                            <label class="btn select-size" for="{{ $sizeId }}">{{ $sizeName }}</label>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <label for="colorSelect" class="form-label">Color: <span id="selectedColor"></span></label><br>
                    <div id="colorSelect" class="btn-group" role="group"></div>
                </div>
                <p class="price">
                    <del>
                        @if ($product->discount != null)
                            @php
                                $finalPrice = round(($product->price / (100 - $product->discount) ) * 100);
                            @endphp
                            {{ format_price($finalPrice) }}
                        @endif
                    </del> 
                    <strong>{{ format_price($product->price) }}</strong>
                </p>
                @if ($product->stock != 0)
                    <p><strong>{{$product->stock}} In stock</strong></p>
                @else
                    <p><strong>Sold Out</strong></p>
                @endif
                @if ($product->gender != 0)
                    <div class="mb-3">
                        <label for="genderSelect" class="form-label">Select Gender <span class="red">*</span></label>
                        <div id="genderSelect" class="btn-group" role="group">
                            <input type="radio" name="gender" id="genderMale" value="male" checked>
                            <label for="genderMale">Male</label>
                        
                            <input type="radio" name="gender" id="genderFemale" value="female">
                            <label for="genderFemale">Female</label>
                        </div>
                    </div>
                @endif
                <div class="mb-3 product-detail-btns">
                    <input type="number" id="quantity" min="1" value="1">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="add-to-cart" value="add-to-cart">Add to Cart</button>
                    <button class="buy-now" value="buy-now">Buy Now</button>
                    <button><a href="{{ route('bulkOrder') }}" style="color: white;">Bulk Order</a></button>
                    @if($product->size_chart_id != 0)
                        <button type="button" data-bs-toggle="modal" data-bs-target="#sizeChartModal" data-image="{{ asset('storage/' . $product->sizeChartImage->image_name) }}">
                            Size Chart
                        </button>
                    @endif
                </div>
                <!-- Modal -->
                @if($product->size_chart_id != 0)
                    <div class="modal fade" id="sizeChartModal" tabindex="-1" aria-labelledby="sizeChartModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="sizeChartModalLabel">Size Chart Image</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img id="sizeChartImage" src="" alt="{{ $product->sizeChartImage->name }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="product-details-actions">
                    <a href="#"> <i class="fa-solid fa-code-compare"></i>Compare</a>
                    <a href="#"> <i class="fa-regular fa-heart"></i>Add to wishlist</a>
                </div>
                <hr>
                @if ($product->artical_name != null)
                    <p class="article-number"><span>SKU: </span>{{$product->artical_name}}</p>
                @endif

                <p class="product-detail-categories">Categories:
                    <a href="{{ route('products', ['id' => $product->cat_id]) }}">{{ $product->catName->cat_name }}</a>
                </p>
                <div class="mt-3 product-detail-share">
                    <span>Share:</span>
                    <a href="https://www.facebook.com/Ghazi1984thebrand" target="_blank"><i
                            class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://twitter.com/ApparelGhazi" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.instagram.com/ghazi1984thebrand" target="_blank"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.youtube.com/channel/UCfd-JXr9ZkIWzDfjiJ2fLIg" target="_blank"><i
                            class="fa-brands fa-youtube"></i></a>
                    <a href="https://www.pinterest.com/Ghazi1984TheBrand" target="_blank"><i
                            class="fa-brands fa-pinterest"></i></a>
                </div>
            </div>
        </div>
        <div class="my-5">
            <ul class="nav nav-tabs" id="productTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                        type="button" role="tab" aria-controls="info" aria-selected="true">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                        type="button" role="tab" aria-controls="reviews" aria-selected="false">Addtional
                        Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button"
                        role="tab" aria-controls="specs" aria-selected="false">Reviews ({{$totalreview}})</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="faqs-tab" data-bs-toggle="tab" data-bs-target="#faqs" type="button"
                        role="tab" aria-controls="faqs" aria-selected="false">Terms & Conditions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="warranty-tab" data-bs-toggle="tab" data-bs-target="#warranty"
                        type="button" role="tab" aria-controls="warranty" aria-selected="false">Product Video</button>
                </li>
            </ul>
            <div class="tab-content" id="productTabContent">
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    {!! $product->short_description !!}
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab"></div>
                <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="specs-tab">
                    <div class="row">
                        <div class="col-md-6">
                            @if (!$totalreview == 0)
                                <h2>{{$totalreview}} Review For {{ $product->name }}</h2>
                                @foreach ($reviews as $data)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>
                                                <strong>{{ $data->user_name }}</strong> – {{ $data->created_at->format('F d, Y') }}
                                            </p>
                                            <p class="mb-2">{{ $data->review }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="star-rating" style="float: right;">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span class="star" style="color: {{ $i <= $data->rating ? 'gold' : 'lightgray' }}">&#9733;</span>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h2>Reviews</h2>
                                <p>There are no reviews yet.</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if (!$totalreview == 0)
                                <h2>Add a review</h2>
                            @else
                                <h2>Be the first to review “{{ $product->name }}”</h2>
                                <p>Your email address will not be published. Required fields are marked<span style="color: red;"> *</span></p>
                            @endif
                            <div>
                                <form action="{{ route('storeReview') }}" method="post" onsubmit="return validateForm()">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div>
                                        <label>Your rating<span style="color: red;"> *</span> :</label>
                                        <div class="rating-stars">
                                            <input type="radio" id="star5" name="rating" value="5" required>
                                            <label for="star5" class="star">&#9733;</label>
                                    
                                            <input type="radio" id="star4" name="rating" value="4" required>
                                            <label for="star4" class="star">&#9733;</label>
                                    
                                            <input type="radio" id="star3" name="rating" value="3" required>
                                            <label for="star3" class="star">&#9733;</label>
                                    
                                            <input type="radio" id="star2" name="rating" value="2" required>
                                            <label for="star2" class="star">&#9733;</label>
                                    
                                            <input type="radio" id="star1" name="rating" value="1" required>
                                            <label for="star1" class="star">&#9733;</label>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label>Your review&nbsp;<span style="color: red;"> *</span> :</label>
                                        <textarea cols="45" rows="8" style="width: 537px; height: 77px; border: none; border-bottom: 1px solid lightgray; box-shadow: none;outline: none;" name="review" required required=""></textarea>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="form-group col-6">
                                            <label>Name&nbsp;<span style="color: red;"> *</span> :</label>
                                            <input type="text" name="user_name" value="{{ old('user_name') }}" class="form-control" required required=""/>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>E-mail&nbsp;<span style="color: red;"> *</span> :</label>
                                            <input type="text" name="user_email" value="{{ old('user_email') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label style="display: flex; align-items: center;">
                                            <input type="checkbox" id="save_info" style="margin-right: 8px;">
                                            <p>Save my name, email, and website in this browser for the next time I comment.</p>
                                        </label>
                                    </div>
                                    <div class="product-detail-btns mt-4">
                                        <button type="submit">SUBMIT</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="faqs" role="tabpanel" aria-labelledby="faqs-tab">
                    <h2>Dispatch time:</h2>
                        <p class="mb-3">
                            GHAZI APPAREL 1984 aims to dispatch every order within  6 to 7 working days once the order has been confirmed.
                            After the order has been dispatched it usually may take 2-3working days to deliver to your location.
                            However, there may be any situation where delivery takes more than 3 days due to any technical issues, such as; Bad weather, Law & Order situations, etc., or in InteriorAreas.
                        </p>
                        <h2>Delivery information &Shipment Charges:</h2>
                        <p class="mb-3">
                            We process cash on Delivery viaT.C.S & Leopard courier service. Delivery is 200 across Pakistan.
                            If you have not received your order after a week, please contact us.
                        </p>
                        <h2>Payment Information</h2>
                        <p class="mb-3">
                            Cash on delivery (COD): You can pay in cash at the time of delivery.
                            We also can receive payment through jazz cash account & bank account.
                            Most GHAZI APPAREL 1984 products displayed attheSiteare available while supplies last. The prices displayed at the Site are quoted in Pakistani Rupees (PKR) and are valid and effective only in Pakistan.
                            We do our own shoots and display only our genuine products.
                            These products are manufactured, dyed, and stitched in our own factory.
                            We do not believe in showing pictures of other Brands/Google/Yahoo to mislead our valuable customers.
                            Colors: We have made every effort to display as accurately as possible the colors of our products that appear on the Page. However, as the actual colors, you see will depend on your monitor/LCD/LED.
                        </p>
                        <h2>Size Exchange Policy</h2>
                        <p class="mb-3">
                            Ghazi apparel provides 7 days size exchange policy for you.
                            To exchange your product courier, it back to Ghazi apparel and the product will be exchanged. (PLEASE DON'T REMOVE THE TAG)
                            The address is written on our parcel. You can use any courier service you want to send us back the parcel. Please write a note inside about the size you want. Also, make sure the size you want is available on our website.
                            It will be beneficial for you and for us if you can measure your size first and then order as it will save you money.
                            Charges for replacement will only be Rs.150 (due to reshipment). Also please note that this process may take 5-7 working days.
                            Ghazi apparel does not offer a “refund” or “Money Back Guarantee” on purchased items.
                        </p>
                        <h2>For Further Queries, Please CONTACT US</h2>
                        <p class="mb-3">
                            Call Us: <a>+923099026655</a><br>
                            Email: <a>ghaziapparel1984@gmail.com </a>
                        </p>
                        
                </div>
                <div class="tab-pane fade" id="warranty" role="tabpanel" aria-labelledby="warranty-tab"></div>
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
            <div class="section-title">
                <h4 class="heading-title">Related Products</h4>
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
                                        $finalPrice = round(($items->price / (100 - $items->discount) ) * 100);
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

    <!-- Cart Sidebar -->
    <div id="cartSidebar" class="cart-sidebar position-fixed top-0 end-0 bg-white shadow-lg d-none"
        style="width: 400px; height: 100vh; z-index: 1000;">
        <div class="d-flex flex-column">
            <div class="cart-sidebar-bar d-flex justify-content-between align-items-center p-3 border-bottom">
                <div>
                    <span class="border-dark border p-1">{{ count($cart) }}</span>
                    <span class="fw-bold">Your Cart</span>
                </div>
                <button type="button" class="btn-close" id="closeCartSidebar"></button>
            </div>
            <div class="cart-body p-3">
                @foreach ($cart as $item)
                    <div class="d-flex mb-3 cart-item" data-item-id="{{ $item->id }}">
                        <a href="{{ route('productDetail', ['id' => $items->id]) }}">
                            <img src="{{ asset('storage/'.$item->product->ProductImg->image_name) }}" alt="{{ $item->product->name }}" class="img-fluid" style="width: 120px; height: 120px">
                        </a>
                        <div class="ms-3">
                            <a href="{{ route('productDetail', ['id' => $items->id]) }}" class="text-dark fw-bold d-block mb-1">{{ $item->product->name }}</a>
                            <p>Select Gender:</p>
                            <p>{{ $item->gender }}</p>
                            <div class="mt-4">
                                <span>{{ $item->quantity }}</span> X <span>{{get_currency_symbol()}} {{ format_price_only($item->product->price) }}</span> = <span>{{get_currency_symbol()}} {{ format_price_only($item->quantity * $item->product->price) }}</span>
                            </div>
                        </div>
                        <button class="btn btn-link text-dark ms-auto delete-cart-item">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="cart-footer fixed-bottom bg-light p-3">
                <div>
                    <div class="cart-price">
                        <span class="subtotal-label fw-bold me-2">Subtotal:</span>
                        <span class="subtotal-value">{{get_currency_symbol()}} {{ format_price_only($total) }}</span>
                    </div>
                    <div class="cart-buttons">
                        <a href="{{ route('shop') }}">Continue Shopping</a>
                        <a href="{{ route('cart') }}">View Cart</a>
                        <a href="{{ route('checkout') }}">Checkout - <span class="">{{get_currency_symbol()}} {{ format_price_only($total) }}</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sizeButtons = document.querySelectorAll('input[name="size"]');
            const colorContainer = document.getElementById('colorSelect');
            const selectedSizeSpan = document.getElementById('selectedSize');
            const selectedColorSpan = document.getElementById('selectedColor');
    
            const sizeColorMap = @json($sizeColorMap);
    
            function updateColorOptions(sizeName) {
                colorContainer.innerHTML = '';
                if (sizeColorMap[sizeName]) {
                    sizeColorMap[sizeName].forEach((color, index) => {
                        const colorId = 'color' + sizeName.replace(/\s+/g, '') + color.name.replace(/\s+/g, '');
                        const colorInput = document.createElement('input');
                        colorInput.type = 'radio';
                        colorInput.className = 'btn-check';
                        colorInput.name = 'color';
                        colorInput.id = colorId;
                        colorInput.value = color.name;
                        colorInput.autocomplete = 'off';
    
                        const colorLabel = document.createElement('label');
                        colorLabel.className = 'btn select-color';
                        colorLabel.htmlFor = colorId;
                        colorLabel.style.backgroundColor = color.code;
                        colorLabel.setAttribute('colorSelect', color.name);
    
                        colorContainer.appendChild(colorInput);
                        colorContainer.appendChild(colorLabel);
    
                        // Auto-select the first color
                        if (index === 0) {
                            colorInput.checked = true;
                            selectedColorSpan.textContent = color.name;
                            colorLabel.classList.add('selected-color'); // Highlight the first color
                        }
    
                        // Add event listener to color input
                        colorInput.addEventListener('change', function() {
                            if (this.checked) {
                                selectedColorSpan.textContent = this.value;
                                // Remove highlight from previously selected color
                                document.querySelectorAll('#colorSelect .select-color').forEach(label => {
                                    label.classList.remove('selected-color');
                                });
                                // Add highlight to the currently selected color
                                colorLabel.classList.add('selected-color');
                            }
                        });
                    });
                } else {
                    selectedColorSpan.textContent = 'No color';
                }
            }
    
            sizeButtons.forEach(button => {
                button.addEventListener('change', function() {
                    if (this.checked) {
                        selectedSizeSpan.textContent = this.getAttribute('data-size-name');
                        updateColorOptions(this.value);
                    }
                });
            });
    
            if (sizeButtons.length > 0) {
                sizeButtons[0].checked = true;
                sizeButtons[0].dispatchEvent(new Event('change'));
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function getSelectedGender() {
                let genderRadios = document.querySelectorAll('input[name="gender"]');
                for (let radio of genderRadios) {
                    if (radio.checked) {
                        return radio.nextElementSibling.textContent; 
                    }
                }
                return null;
            }

            function getSelectedSize() {
                let sizeRadios = document.querySelectorAll('input[name="size"]:checked');
                return sizeRadios.length > 0 ? sizeRadios[0].value : null;
            }

            function getSelectedColor() {
                let selectedColorSpan = document.getElementById('selectedColor');
                return selectedColorSpan.textContent.trim();
            }

            document.querySelector('button.add-to-cart').addEventListener('click', function() {
                let productId = document.querySelector('input[name="product_id"]').value;
                let gender = getSelectedGender();
                let size = getSelectedSize();
                let color = getSelectedColor();
                let quantity = document.querySelector('#quantity').value;
                let addToCart = document.querySelector('.add-to-cart').value;
                
                let data = {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    gender: gender,
                    size: size,
                    color: color,
                    quantity: quantity,
                    session_id: '{{ session()->getId() }}',
                    action: addToCart
                };

                fetch('{{ route("addToCart") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success('Product added to cart successfully!');
                        
                        sessionStorage.setItem('showCartSidebar', 'true');
                        window.location.reload();
                    } else {
                        toastr.error('Failed to add product to cart.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });

            function handleCartSidebarVisibility() {
            let cartSidebar = document.getElementById('cartSidebar');
            if (sessionStorage.getItem('showCartSidebar') === 'true') {
                cartSidebar.classList.remove('d-none');
                cartSidebar.classList.add('d-block');
                sessionStorage.removeItem('showCartSidebar'); // Remove flag after showing
            } else {
                cartSidebar.classList.add('d-none');
                cartSidebar.classList.remove('d-block');
            }
            }

            // Handle cart sidebar visibility on page load
            handleCartSidebarVisibility();

            document.addEventListener('click', function(event) {
                let cartSidebar = document.getElementById('cartSidebar');
                let isClickInside = cartSidebar.contains(event.target);
                let isButtonClick = event.target.closest('.add-to-cart');

                // Hide cart sidebar if clicking outside
                if (!isClickInside && !isButtonClick) {
                    cartSidebar.classList.add('d-none');
                    cartSidebar.classList.remove('d-block');
                }
            });

            document.getElementById('closeCartSidebar').addEventListener('click', function() {
                document.getElementById('cartSidebar').classList.add('d-none');
                document.getElementById('cartSidebar').classList.remove('d-block');
            });

            
            // buy  now

            document.querySelector('button.buy-now').addEventListener('click', function() {
                let productId = document.querySelector('input[name="product_id"]').value;
                let gender = getSelectedGender();
                let size = getSelectedSize();
                let color = getSelectedColor();
                let quantity = document.querySelector('#quantity').value;
                let buynow = document.querySelector('.buy-now').value;
                
        
                let data = {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    gender: gender,
                    size: size,
                    color: color,
                    quantity: quantity,
                    session_id: '{{ session()->getId() }}',
                    action: buynow
                };
        
                fetch('{{ route("buyNow") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success('Add the Address Detail please!');
                        setTimeout(function() {
                            window.location.href = '{{ route("checkout") }}';
                        }, 1500);
                    } else {
                        toastr.error('Failed to buy this product.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ({{ count($cart) }} > 0) {
                document.getElementById('cartSidebar').classList.add('show');
                document.getElementById('cartSidebar').style.display = 'block';
            }

            document.querySelectorAll('.delete-cart-item').forEach(function(button) {
                button.addEventListener('click', function() {
                    let cartItemElement = this.closest('.cart-item');
                    let itemId = cartItemElement.getAttribute('data-item-id');

                    fetch('{{ route("removeFromCart") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            _token: '{{ csrf_token() }}',
                            item_id: itemId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.success('Item removed from cart successfully!');
                            cartItemElement.remove(); 
                                window.location.reload();
                        } else {
                            toastr.error('Failed to remove item from cart.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sizeChartModal = document.getElementById('sizeChartModal');
            sizeChartModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var imageSrc = button.getAttribute('data-image');
                
                var modalImage = sizeChartModal.querySelector('#sizeChartImage');
                modalImage.src = imageSrc;
            });
        });
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.rating-stars input');
            stars.forEach(star => {
                star.addEventListener('change', (event) => {
                    const value = event.target.value;
                    stars.forEach(s => {
                        s.nextElementSibling.style.color = s.value <= value ? 'gold' : 'lightgray';
                    });
                });
            });
        });
    </script>
   <script>
    document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.rating-stars .star');
    const radios = document.querySelectorAll('.rating-stars input[type="radio"]');

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            radios[index].checked = true; // Check the radio button
            highlightStars(index); // Highlight the stars
        });
    });

    function highlightStars(index) {
        stars.forEach((star, i) => {
            if (i <= index) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });
    }

    document.querySelector('form').addEventListener('submit', (event) => {
        const rating = document.querySelector('input[name="rating"]:checked');
        if (!rating) {
            alert("Please select a rating");
            event.preventDefault(); // Prevent form submission if no rating is selected
        }
    });
});
</script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load saved data from localStorage if available
            if (localStorage.getItem('saveInfo') === 'true') {
                document.getElementById('user_name').value = localStorage.getItem('user_name');
                document.getElementById('user_email').value = localStorage.getItem('user_email');
                document.getElementById('save_info').checked = true;
            }
        });
    
        function validateForm() {
            const name = document.getElementById('user_name').value;
            const email = document.getElementById('user_email').value;
            const saveInfo = document.getElementById('save_info').checked;
    
            if (saveInfo) {
                // Save data to localStorage
                localStorage.setItem('user_name', name);
                localStorage.setItem('user_email', email);
                localStorage.setItem('saveInfo', 'true');
            } else {
                // Clear data from localStorage
                localStorage.removeItem('user_name');
                localStorage.removeItem('user_email');
                localStorage.removeItem('saveInfo');
            }
    
            return true;
        }
    </script>
@endsection