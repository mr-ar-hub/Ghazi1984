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
                    <li class="breadcrumb-item active">Edit Shippings Cost</li>
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
                            <h5>Edit Shippings Cost<a href="{{ route('shipping') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="{{ route('updateShipping', ['id' => $shipping->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Country Name</label>
                                <input type="text" name="country_name" value="{{ $shipping->country_name }}"  class="form-control" readonly/>
                            </div>
                            <div class="form-group">
                                <label>Shipping Cost</label>
                                <input type="number" name="shipping" value="{{ $shipping->shipping }}"  class="form-control" />
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Update</button>
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