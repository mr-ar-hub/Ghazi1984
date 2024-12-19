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
                    <li class="breadcrumb-item active">Add New Social Link</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title" style="width: 100%;">
                            <h5>Add New Social Link <a href="{{ route('socialLinks') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="{{ route('uploadNewLink') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Platform Name</label>
                                <input type="text" name="platform" placeholder="Enter Platform Name" value="{{ old('platform') }}" class="form-control" />
                                @if ($errors->has('platform'))
                                    <span class="text-danger">{{ $errors->first('platform') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label>Platform Link</label>
                                <input type="text" name="link" placeholder="Enter Platform Link" value="{{ old('link') }}" class="form-control" />
                                @if ($errors->has('link'))
                                    <span class="text-danger">{{ $errors->first('link') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label>Platform Icon</label>
                                <input type="text" name="icon" placeholder="Enter Platform Icon" value="{{ old('icon') }}" class="form-control" />
                                @if ($errors->has('icon'))
                                    <span class="text-danger">{{ $errors->first('icon') }}</span>
                                @endif
                                <span>For icon visit <a href="{{ url('https://fontawesome.com/icons') }}" target="blank">FontAwesome</a> and copy icon html code</span>
                            </div>  
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Icon Color</label>
                                    <input type="text" name="color" placeholder="Enter Link Color" value="{{ old('color', '#fff') }}" class="form-control" />
                                    @if ($errors->has('color'))
                                        <span class="text-danger">{{ $errors->first('color') }}</span>
                                    @endif
                                <span>Use hex color code with '#' or Gradient</span>
                                </div> 
                                <div class="form-group col-md-6">
                                    <label>Icon Background Color</label>
                                    <input type="text" name="bgcolor" placeholder="Enter Background Color" value="{{ old('bgcolor') }}" class="form-control" />
                                    @if ($errors->has('bgcolor'))
                                        <span class="text-danger">{{ $errors->first('bgcolor') }}</span>
                                    @endif
                                <span>Use hex color code with '#' or Gradient</span>
                                </div> 
                            </div>                         
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Submit</button>
                                    <a href="{{ route('addNewLink') }}" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
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