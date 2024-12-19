@extends('emails.master')

@section('content')
<h1>New Order: #{{$id}}</h1>
<p style="padding-top: 5px;">You've received the following order from {{ $first_name }} {{ $last_name }}</p>
<h3>[Order: #{{$id}}] ({{ \Carbon\Carbon::parse($created_at)->format('F j, Y') }}) </h3>
<h2 style="padding-top: 5px;">Products</h2>
<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @php
            $subtotal = 0;
        @endphp

        @foreach($inquiries as $order)
            @foreach ($order->products as $item)
                @if($item->order_id == $id)
                <tr>
                    <td style="padding: 5px;">
                        @if($item->product->ProductImg)
                            <img src="{{ asset('storage/'.$item->product->ProductImg->image_name) }}" width="100px" height="100px" alt="Product Image" style="display: block; margin: 0 auto;">
                        @else
                            <span>No image available</span>
                        @endif
                        <a href="{{ route('productDetail', ['id' => $item->product->id]) }}" style="display: block; margin-top: 10px; text-decoration: none; color: #000;">
                            {{ $item->product->name }}
                        </a>
                        <br>
                        <span style="display: block; margin-top: 5px;">Size: {{ $item->size }}</span>
                        <span style="display: block; margin-top: 5px;">Color: {{ $item->color }}</span>
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        <span><bdi><span>₨</span>&nbsp;{{ number_format($item->quantity * $item->product->price, 0) }}</bdi></span>
                    </td>

                    @php
                        $subtotal += $item->quantity * $item->product->price;
                    @endphp
                </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <th>Subtotal</th>
            <td><span><bdi><span>₨</span>&nbsp;{{ number_format($subtotal, 0) }}</bdi></span></td>
        </tr>
        <tr>
            <td></td>
            <th>Shipping</th>
            <td>Rs 250.00 via Flat Rate</td>
        </tr>
        <tr>
            <td></td>
            <th>Payment Method</th>
            <td>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
        </tr>
        <tr>
            <td></td>
            <th>Total</th>
            <td>
                <span><bdi><span>₨</span>&nbsp;{{ number_format($subtotal + 250, 0) }}</bdi></span>
            </td>
        </tr>
    </tfoot>
</table>
<div style="display:flex; flex-direction:row; justify-content:space-between; flex-wrap:wrap; padding-top:20px">
    <div style="width:58%; box-sizing: border-box;">
        <h2 style="padding-bottom: 20px;">Billing Address</h2>
        <div style="border:1px solid grey; padding: 10px; box-sizing: border-box;">
            <p>{{ $first_name }} {{ $last_name }}</p>
            <p>{{ $street_address }}</p>
            <p>{{ $city }}</p> <!-- Fixed the extra < -->
            <p>{{ $country }}</p> <!-- Fixed the extra < -->
            <p>{{ $phone }}</p>
            <p>{{ $email }}</p>
        </div>
    </div>
    <div style="width:39%; box-sizing: border-box; margin-left:20px">
        <h2 style="padding-bottom: 20px;">Shipping Address</h2>
        <div style="border:1px solid grey; padding: 10px; box-sizing: border-box;">
            <p>{{ $first_name }} {{ $last_name }}</p>
            <p>{{ $street_address }}</p>
            <p>{{ $city }}</p> <!-- Fixed the extra < -->
            <p>{{ $country }}</p> <!-- Fixed the extra < -->
        </div>
    </div>
</div>
@if($order_note )
<p><strong>Order Note:</strong> {{ $order_note }}</p>
@endif

@endsection
            