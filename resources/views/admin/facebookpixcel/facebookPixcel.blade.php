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
                        <li class="breadcrumb-item active">Facebook Pixcel</li>
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
                                <h5>Add Facebook Pixcel</h5>
                            </div>  
                        </div>
                        <div class="card-body">
                            <form action="{{ route('facebookPixcelUpload', ['id' => $fbpixcel->id]) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label >Facebook Pixcel Script</label>
                                    <textarea placeholder="Enter Facebook Pixcel Script" name="facebook_pixcel" style="height: 300px; width: 100%;">{{ $fbpixcel->facebook_pixcel }}</textarea>
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