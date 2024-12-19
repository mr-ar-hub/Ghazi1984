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
                    <li class="breadcrumb-item active">Edit Currency Rate</li>
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
                            <h5>Edit Currency Rate <a href="{{ route('currency') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="{{route('updateCurrency' , $data->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" placeholder="Enter Title" value="{{ old('title' , $data->title )}}" class="form-control" />
                                @if ($errors->has('title'))
                                    <div class="text-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label>Currency Code</label>
                                <input type="text" name="code" placeholder="Enter Currency Code" value="{{ old('code', $data->currency_code ) }}" class="form-control" />
                                @if ($errors->has('code'))
                                    <div class="text-danger">{{ $errors->first('code') }}</div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label>Currency Symbol</label>
                                <input type="text" name="symbol" placeholder="Enter Currency Symbol" value="{{ old('symbol' , $data->symbol ) }}" class="form-control" />
                                @if ($errors->has('symbol'))
                                    <div class="text-danger">{{ $errors->first('symbol') }}</div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label>Currency Rate</label>
                                <input type="text" name="rate" placeholder="Enter Currency Rate" value="{{ old('rate', $data->currency_rate ) }}" class="form-control" />
                                @if ($errors->has('rate'))
                                    <div class="text-danger">{{ $errors->first('rate') }}</div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label>Position</label>
                                <select name="position" class="form-control">
                                    <option value="left" @if($data->position === 'left') selected @endif>Left</option>
                                    <option value="right" @if($data->position === 'right') selected @endif>Right</option>
                                </select>
                                @if ($errors->has('position'))
                                    <div class="text-danger">{{ $errors->first('position') }}</div>
                                @endif
                            </div>
                                                        
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Update</button>
                                    <a href="{{ route('currency') }}" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
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