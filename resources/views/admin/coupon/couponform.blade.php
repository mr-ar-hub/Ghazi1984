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
                    <li class="breadcrumb-item active">Couponform</li>
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
                            <h5>Coupons<a href="{{route('admincoupon')}}" class="btn btn-primary btn-sm float-right"><i class="fa fa-arrow-left"></i> Back</a></h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('adminaddcoupon')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Coupon Code</label>
                                    <input type="text" name="code" placeholder="Enter Coupon Code" value="{{old('code')}}"  class="form-control @error('code') is-invalid @enderror" />
                                        @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Coupon Name</label>
                                    <input type="text" name="name" placeholder="Enter Coupon name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" />
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Select User</label>
                                    <select name="customerid" id="customerselect" class="form-control">
                                        <option value="">Select Customer ...!</option>
                                        <option value="0">All</option>
                                        @foreach ($user as $row)
                                            <option value="{{$row->id}}">{{$row->name}} ({{$row->email}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="Enter short description"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Coupon Max Uses</label>
                                    <input type="number" name="maxuses" placeholder="Enter Coupon Maximum Uses" id="maxuses" value="" class="form-control @error('maxuses') is-invalid @enderror" />
                                        @error('maxuses')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Coupon Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Discount Amount</label>
                                    <input type="number" name="discountamount" value="{{old('discountamount')}}" class="form-control @error('discountamount') is-invalid @enderror" placeholder="Enter Discount Amount" />
                                        @error('discountamount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Coupon Minimum Amount</label>
                                    <input type="number" name="minamount" placeholder="Enter Minimum Amount" value="{{old('minamount')}}" class="form-control @error('minamount') is-invalid @enderror" />
                                        @error('minmount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Starts At</label>
                                    <input type="text" id="startat" name="startat" value="{{old('startat')}}" class="form-control @error('startat') is-invalid @enderror" placeholder="Select Start Date" style="background: transparent; " />
                                        @error('startat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Expires At</label>
                                    <input type="text" id="endat" name="endat" value="{{old('endat')}}" class="form-control @error('endat') is-invalid @enderror" placeholder="Select Expiry Date" style="background: transparent; " />
                                        @error('endat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Submit</button>
                                    <a href="{{ route('admincoupon') }}" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection