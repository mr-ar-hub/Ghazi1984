@extends('layouts.adminmaster')
    @section('title')
        Ghazi 1984
    @endsection
@section('content')
    <style>
        input[type="file"] {
            height: auto;
        }
        .ck-editor__editable_inline {
            min-height: 150px;
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                   
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Category</li>
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
                        <div class="card-title" style="width:100%">
                            <h5>Edit Category<a href="{{ route('category') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-arrow-left"></i> Back</a></h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('updateCategory', ['id' => $category->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="cat_name"  value="{{ $category->cat_name }}"  class="form-control @error('cat_name') is-invalid @enderror" />
                                    @error('cat_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label>Category Slug</label>
                                <input type="text" name="cat_slug" value="{{ $category->cat_slug }}" class="form-control @error('cat_slug') is-invalid @enderror">
                                    @error('cat_slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label>Category Description</label>
                                <textarea id="editor1" name="cat_description"  class=" @error('cat_description') is-invalid @enderror" >{{ $category->cat_description }}</textarea>
                                    @error('cat_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Category Image</label>
                                    <input type="file" id="fileInput1" name="cat_image" hidden />
                                    <div class="uploader" id="fileSelect1">
                                        <div id="content1" class="imagetext">
                                            <img src="{{ asset('storage/'.$category->cat_image) }}" class='uploaded-img' />
                                        </div>
                                    </div>
                                    <div id="oit1" class="other-image-thumbnails"></div>
                                </div>
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
<script src="{{ asset('/adminassets/dist/js/double.js') }}"></script>
@endsection