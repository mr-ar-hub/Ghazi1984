@extends('layouts.adminmaster')
    @section('title')
        Ghazi 1984
    @endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.2/tagify.css" />
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Add Metakeywords</li>
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
                            <h5>Add Metakeywords <a href="{{ route('metakeywords') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="{{route('uploadMetakeywords')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Keywords</label>
                                <div>
                                    <input name="keywords" placeholder="Enter Keywords" value="{{ old('keywords') }}" class="form-control" id="keywords-input" />
                                    @if ($errors->has('keywords'))
                                        <div class="text-danger">{{ $errors->first('keywords') }}</div>
                                    @endif
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Submit</button>
                                    <a href="{{ route('addMetakeywords') }}" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
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

    <!-- Tagify JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.2/tagify.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var input = document.querySelector('#keywords-input');
            new Tagify(input, {
                // Optional configurations
                delimiters: ",",
                pattern: /^[^,]+$/,
            });
        });
        </script>
        
