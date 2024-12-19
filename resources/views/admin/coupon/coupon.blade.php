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
                    <li class="breadcrumb-item active">Coupons</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title" style="width: 100%;">
                            <h5>Coupons<a href="{{route('admincouponform')}}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Add Coupon</a></h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="myDataTable" class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <td>Sr no</td>
                                    <td >Coupon Code</td>
                                    <td>Name</td>
                                    <td>Discount</td>
                                    <td>Customer</td>
                                    <td>Start Date</td>
                                    <td>Expiry Date</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                    @foreach($list as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>@if ($item->type == 'percentage')
                                                {{ $item->discount_amount}} %
                                                @else
                                                Rs {{ number_format($item->discount_amount, 0) }}
                                            @endif</td>
                                            <td>@if ($item->customer_id == '0')
                                                {{'All'}}
                                                @else
                                                @php
                                                    $dbHost = 'localhost';
                                                    $dbUser = $_ENV['DB_USERNAME'];
                                                    $dbPassword = $_ENV['DB_PASSWORD'];
                                                    $dbName = $_ENV['DB_DATABASE'];
                                                    
                                                    $con = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
                                                    $sql = "SELECT * FROM users WHERE id = $item->customer_id";
                                                    $query = mysqli_query($con, $sql);
                                                    while($data = mysqli_fetch_assoc($query))
                                                    {
                                            @endphp
                                            {{$data['name']}}
                                            @php
                                            }
                                            @endphp
                                            @endif</td>
                                            <td>{{ $item->start_at }}</td>
                                            <td>{{ $item->end_at }}</td>
                                        </tr>
                                        @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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