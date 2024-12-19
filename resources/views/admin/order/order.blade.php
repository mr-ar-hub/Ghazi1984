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
                    <li class="breadcrumb-item active">All Orders</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
                    <h5>All Orders</h5>
                </div>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-hover table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Order Number</th>
                        <th>Customer Name</th>
                        <th>Total Bill</th>
                        <th>Order At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($order as $items)
                            <tr>
                                <td>@php echo $count++."." @endphp</td>
                                <td>
                                    <a href="{{ route('viewOrder', ['id' => $items->id]) }}">
                                        #{{ $items->created_at->format('ym') }}00{{$items->id}}
                                    </a>
                                </td>
                                <td>{{ $items->first_name }} {{ $items->last_name }}</td>
                                <td>Rs {{ number_format($items->order_total, 0) }}</td>
                                <td>{{ $items->created_at->format('Y-m-d') }}</td>
                                <td class="text-center">
                                    @if ($items->status == 'pending')
                                        <span class="badge bg-danger">{{ $items->status }}</span>
                                    @elseif ($items->status == 'booked')
                                        <span class="badge bg-primary">{{ $items->status }}</span>
                                    @elseif ($items->status == 'deliver')
                                        <span class="badge bg-success">{{ $items->status }}</span>
                                    @elseif ($items->status == 'cancel')
                                        <span class="badge bg-danger">{{ $items->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter-{{ $items->id}}">
                                        View Order
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter-{{ $items->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">All Products</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
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
                                                            @foreach ($items->products as $product)
                                                                <tr>
                                                                    <td style="vertical-align: middle;">@php echo $count++."." @endphp</td>
                                                                    <td style="vertical-align: middle;"><img src="{{asset('storage/'.$product->product->ProductImg->image_name)}}" alt="" style="width:100px; height:100px; border-radius:50%; object-fit:cover;"></td>
                                                                    <td style="vertical-align: middle; text-transform:capitalize;" colspan="2">{{ $product->product->name }}</td>
                                                                    <td style="vertical-align: middle;">{{ $product->color }}</td>
                                                                    <td style="vertical-align: middle;">{{ $product->size }}</td>
                                                                    <td style="vertical-align: middle;">{{ $product->gender }}</td>
                                                                    <td style="vertical-align: middle;">{{ $product->product->price }}</td>
                                                                    <td style="vertical-align: middle;">{{ $product->quantity }}</td>
                                                                    <td style="vertical-align: middle;">Rs {{ number_format($product->quantity * $product->product->price, 0) }}</td>
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
                                                                    <td>Rs {{ $shippingCharges }}</td>
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
                                                                    <td>Rs {{ number_format($items->order_total, 0) }}</td>
                                                                </tr>
                                                            </tfoot>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('viewOrder', ['id' => $items->id]) }}"><span class="btn btn-success btn-sm">Edit</span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection