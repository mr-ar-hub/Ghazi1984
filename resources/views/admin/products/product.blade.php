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
                    <li class="breadcrumb-item active">All Products</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
                    <h5>All Products</h5>
                    <div style="margin-left: auto;">
                        <a href="{{ route('addSize') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp; 
                            Add Size
                        </a>
                        <a href="{{ route('addProducts') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp; 
                            Add New Product
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-hover table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Product</th>
                        <th>Product Slug</th>
                        <th>Actual Price</th>
                        <th>Discountable Price</th>
                        <th>Discount</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach($products as $item)
                            <tr>
                                <td>@php echo $count++."." @endphp</td>
                                <td><a href="{{ route('editProduct', ['id' => $item->id]) }}">{{ $item->name }}</a></td>
                                <td>{{ $item->slug }}</td>
                                <td>
                                    @if ($item->price)
                                    @php
                                        $finalPrice = ($item->price / (100 - $item->discount) ) * 100;
                                    @endphp
                                        RS: {{ round($finalPrice) }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    RS: {{ $item->price }}
                                </td>
                                <td>
                                    @if ($item->discount)
                                        -{{ $item->discount }}% off
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $item->stock }}</td>
                                <td>
                                    <a href="{{ route('editProduct', ['id' => $item->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('deleteProduct', ['id' => $item->id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "ordering": false,
        });
    });
</script>
@endsection