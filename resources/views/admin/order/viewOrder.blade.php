@extends('layouts.adminmaster')
    @section('title')
        Ghazi 1984
    @endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">View Order</li>
                </ol>
            </div>
        </div>
    </div>
</div>
    <div class="content">
        <div class="container-fluid">
            <div class="mb-4">
                <h2>Order  #{{ $order->created_at->format('ym') }}00{{$order->order->id}}</h2>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title" style="width: 100%;">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>Customer Information</h5>
                                        <div class="mt-3 mb-3">
                                            <div>
                                                <span><strong>Customer Name</strong></span>: <span>{{ $order->order->first_name }} {{ $order->order->last_name }}</span>
                                            </div>
                                            <div>
                                                <span><strong>Email</strong></span>: <span>{{$order->order->email}}</span>
                                            </div>
                                            <div>
                                                <span><strong>Phone no</strong></span>: <span>{{$order->order->phone}}</span>
                                            </div>
                                            <div>
                                                <span><strong>Company Name</strong></span>: 
                                                <span>{{$order->order->company_name}}</span>
                                            </div>
                                            <div>
                                                <span><strong>Address</strong></span>: 
                                                <span>{{$order->order->postal_code}}.  {{$order->order->street_address}}, {{$order->order->city}}, {{$order->order->state}}</span>
                                            </div>
                                            <div>
                                                <span><strong>Order Note:</strong></span>: 
                                                <span>{{$order->order->order_note}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mt-3 mb-3">
                                            <div>
                                                <span><strong>Order at</strong></span>: <span>{{ $order->order->created_at->format('Y-m-d') }}</span>
                                            </div>
                                            <div>
                                                <span><strong>Country</strong></span>: <span>{{$order->order->country}}</span>
                                            </div>
                                            <div>
                                                <span><strong>Status</strong></span>: 
                                                <span> 
                                                    <div class="badge bg-info">{{$order->order->comment}}</div>
                                                </span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr no</th>
                                        <th>Image</th>
                                        <th colspan="2">Product</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Gender</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($orderProduct as $items)
                                        <tr>
                                            <td style="vertical-align: middle;">@php echo $count++."." @endphp</td>
                                            <td style="vertical-align: middle;"><img src="{{asset('storage/'.$items->product->ProductImg->image_name)}}" alt="" style="width:100px; height:100px; border-radius:50%; object-fit:cover;"></td>
                                            <td style="vertical-align: middle; text-transform:capitalize;" colspan="2">{{$items->product->name}}</td>
                                            <td style="vertical-align: middle;">{{ $items->color }}</td>
                                            <td style="vertical-align: middle;">{{ $items->size }}</td>
                                            <td style="vertical-align: middle;">{{ $items->gender }}</td>
                                            <td style="vertical-align: middle;">
                                                {{$items->product->price}}
                                            </td>
                                            <td style="vertical-align: middle;">{{ $items->quantity }}</td>
                                            <td style="vertical-align: middle;">Rs {{ number_format($items->quantity * $items->product->price, 0) }}</td>
                                        </tr>
                                    @endforeach
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>Shipping Charges:</strong></td>
                                            <td>
                                                Rs {{ number_format($shippingCharges, 0) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>Total Bill:</strong></td>
                                            <td>
                                                Rs {{ number_format($totalBill, 0) }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title" style="width: 100%;">
                                <h5>Change Order Status</h5>
                                <div class="mt-3 mb-3">
                                    <form action="{{ route('orderUpdate', ['id' => $order->order->id]) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->order->id }}">
                                        <select name="status" class="form-control" id="status-select">
                                            <option value="">Select Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="cancel">Cancel</option>
                                            <option value="booked">Booked</option>
                                            <option value="deliver">Delivered</option>
                                        </select>
                                        <textarea name="comment" id="status-note" class="form-control mt-3" placeholder="Enter comment here..." style="display: none;"></textarea>
                                        <button class="btn btn-primary btn-sm mt-3" id="submit-btn">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('status-select').addEventListener('change', function() {
            var statusNote = document.getElementById('status-note');
            statusNote.style.display = 'block';
        });
    </script>
@endsection