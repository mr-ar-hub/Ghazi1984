@extends('layouts.layout')

@section('content')
<!-- Page Title -->
<div class="page-title">
    <div class="container">
        <header class="entry-header">
            <div class="breadcrumbs">
                @if($cartShow)<a href="{{ route('cart') }}">Cart</a> »@endif <span class="current">Checkout</span> » <span class="next-page">Order Completed</span>
            </div>
        </header>
    </div>
</div>

<!-- Checkout Section -->
<div class="container py-5">
    <div class="row">
        <div class="col-12 col-md-7">
            <h2 class="checkout-heading">Billing Details</h2>
            <form id="billing-form" method="POST" action="{{ route('processCheckout') }}">
                @csrf
                <div class="form-group">
                    <label for="first_name">First Name <span class="red">*</span></label>
                    <input type="text" id="first_name" value="{{old('first_name')}}" name="first_name" class="form-control" style=" box-shadow: none;outline: none;">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name <span class="red">*</span></label>
                    <input type="text" id="last_name" value="{{old('last_name')}}" name="last_name" class="form-control" style=" box-shadow: none;outline: none;">
                </div>
                <div class="form-group">
                    <label for="company_name">Company Name (optional)</label>
                    <input type="text" id="company_name" value="{{old('company_name')}}" name="company_name" class="form-control" style=" box-shadow: none;outline: none;">
                </div>
                <div class="form-group">
                    <label for="country">Country <span class="red">*</span></label>
                    <select id="country" name="country" class="form-control" style=" box-shadow: none;outline: none;">
                        <option value="">Select a country</option>
                        <option value="pakistan">Pakistan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="street_address">Street Address <span class="red">*</span></label>
                    <input type="text" id="street_address" value="{{old('street_address')}}" name="street_address" class="form-control" style=" box-shadow: none;outline: none;">
                </div>
                <div class="form-group">
                    <label for="town">Town / City <span class="red">*</span></label>
                    <input type="text" id="town" value="{{old('city')}}" name="city" class="form-control" style=" box-shadow: none;outline: none;">
                </div>
                <div class="form-group">
                    <label for="state">State <span class="red">*</span></label>
                    <input type="text" id="state" value="{{old('state')}}" name="state" class="form-control" style=" box-shadow: none;outline: none;">
                </div>
                <div class="form-group">
                    <label for="zip_code">Zip Code <span class="red">*</span></label>
                    <input type="text" id="zip_code" value="{{old('postal_code')}}" name="postal_code" class="form-control" style=" box-shadow: none;outline: none;">
                </div>
                <div class="form-group">
                    <label for="phone">Phone <span class="red">*</span></label>
                    <input type="tel" id="phone" value="{{old('phone')}}" name="phone" class="form-control" style=" box-shadow: none;outline: none;">
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="red">*</span></label>
                    <input type="email" id="email" value="{{old('email')}}" name="email" class="form-control" style=" box-shadow: none;outline: none;">
                </div>
                <div class="form-group">
                    <label for="order_note">Order Note (optional)</label>
                    <textarea id="order_note" name="order_note" style="width: 100%; height: 77px; border: none; border-bottom: 1px solid gray; box-shadow: none;outline: none;">{{ old('email') }}</textarea>
                </div>
                <input type="hidden" name="order_total" value="{{ $total }}">
                <input type="hidden" name="currency_code" value="{{ session('currency') }}">
            </div>
            <div class="cart-totals-section col-12 col-md-5">
                <div class="cart_totals checkout-cart-totals">
                    <h2 class="checkout-heading order-heading">Your order</h2>
                    @if ($cart->filter(function($item) { return $item->order_id === null; })->isNotEmpty())
                        <div class="cart-totals-inner">
                            <table class="table">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Products</th>
                                        <td>Subtotal</td>
                                    </tr>
                                    @foreach ($cart as $item)
                                        @if ($item->order_id == null)
                                            <tr class="cart-subtotal">
                                                <th>{{ $item->product->name }}</th>
                                                <td>
                                                    {{get_currency_symbol()}} {{ number_format(format_price_only($item->product->price * $item->quantity), 0) }}
                                                    <span style="color: red; margin-left: 5px; cursor: pointer;" class="removeProduct" data-item-id="{{ $item->id }}"> x </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td>{{get_currency_symbol()}} {{ number_format(format_price_only($subtotal), 0) }}</td>
                                    </tr>
                                    <tr class="shipping-totals shipping">
                                        <th>Shipping</th>
                                        <td>{{get_currency_symbol()}} {{ number_format(format_price_only($shippingCost), 0) }}</td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td><strong>{{get_currency_symbol()}} {{ number_format(format_price_only($total), 0) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="payment-methods">
                                <h3>Payment Method</h3>
                                <div>
                                    <label>
                                        <input type="radio" name="payment_method" value="direct_bank_transfer" id="bank_transfer" checked>
                                        Direct bank transfer
                                    </label>
                                </div>
                                <div id="bank_transfer_comment" style="display: none; background-color: rgba(0, 0, 0, 0.05); font-size: 12px; padding: 20px;">
                                    Make your payment directly into our bank account. Please use your Order ID as the payment reference.
                                    Your order will not be shipped until the funds have cleared in our account.
                                </div>
                                
                                <div>
                                    <label>
                                        <input type="radio" name="payment_method" value="cash_on_delivery" id="cash_on_delivery">
                                        Cash on Delivery
                                    </label>
                                </div>
                                <div id="cash_on_delivery_comment" style="display: none; background-color: rgba(0, 0, 0, 0.05); font-size: 12px; padding: 20px;">
                                    Pay with cash upon delivery.
                                </div>
                                {{-- <div>
                                    <label>
                                        <input type="radio" name="payment_method" value="bank_transfer">
                                        Bank Transfer
                                    </label>
                                </div> --}}
                            </div>
                            <div class="proceed-to-checkout">
                                <a id="submit-button" class="proceed-to-checkout-btn" style="cursor: pointer;">Place Order</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

    <!-- JavaScript to handle form submission -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        async function fetchCountries() {
            const response = await fetch('https://restcountries.com/v3.1/all');
            const countries = await response.json();
            return countries.map(country => country.name.common);
        }
    
        async function populateCountries() {
            const countrySelect = document.querySelector('#country');
            countrySelect.innerHTML = '<option value="">Country / region</option>';
    
            const countries = await fetchCountries();
            countries.forEach(country => {
                countrySelect.innerHTML += `<option value="${country}">${country}</option>`;
            });
        }

        document.addEventListener("DOMContentLoaded", populateCountries);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var submitButton = document.getElementById('submit-button');
            var form = document.getElementById('billing-form');
            submitButton.addEventListener('click', function(e) {
                e.preventDefault();
                form.submit();
            });

            $('.removeProduct').on('click', function() {
                let itemId = $(this).data('item-id');
                let token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('removeProduct', ['id' => ':id']) }}".replace(':id', itemId),
                    data: {
                        _token: token
                    },
                    success: function(response) {
                        window.location.href = '{{ route("checkout") }}';
                        toastr.success('Product removed successfully.', '', { timeOut: 1000 });
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Failed to remove product.');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            if ($('#bank_transfer').is(':checked')) {
                $('#bank_transfer_comment').show();
            }
    
            $('input[name="payment_method"]').on('change', function() {
                if ($('#bank_transfer').is(':checked')) {
                    $('#bank_transfer_comment').slideDown();
                } else {
                    $('#bank_transfer_comment').slideUp();
                }
    
                if ($('#cash_on_delivery').is(':checked')) {
                    $('#cash_on_delivery_comment').slideDown();
                } else {
                    $('#cash_on_delivery_comment').slideUp();
                }
            });
        });
    </script>
@endsection