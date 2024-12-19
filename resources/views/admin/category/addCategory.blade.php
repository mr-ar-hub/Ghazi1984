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
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
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
                            <h5>Add New Category<a href="{{ route('category') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-arrow-left"></i> Back</a></h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('postCategory') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>main Category</label>
                                <select class="form-control" name="cat_pid">
                                    <option value="0" hidden="" selected="">Choose Main Category</option>
                                    <?php
                                        function category($pid = 0, $space = '')
                                        { 
                                            $dbHost = 'localhost';
                                            $dbUser = $_ENV['DB_USERNAME'];
                                            $dbPassword = $_ENV['DB_PASSWORD'];
                                            $dbName = $_ENV['DB_DATABASE'];
                                    
                                            $con = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
                                            if (!$con) {
                                                die("Connection failed: " . mysqli_connect_error());
                                            }
                                    
                                            $sql = "SELECT * FROM categories WHERE cat_pid = $pid";
                                            $query = mysqli_query($con, $sql);
                                    
                                            if ($query) {
                                                while ($data = mysqli_fetch_assoc($query)) {
                                                    echo '<option value="' . $data['id'] . '">' . $space . $data['cat_name'] . '</option>';
                                                    category($data['id'], $space . '&nbsp;&nbsp;&nbsp;&nbsp;-');
                                                }
                                            }
                                    
                                            mysqli_close($con);
                                        }
                                        category();
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="cat_name" placeholder="Enter category name" value="{{old('name')}}"  class="form-control @error('name') is-invalid @enderror" />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label>Category Description</label>
                                <textarea id="editor1"  placeholder="Enter short description of category" name="cat_description"  class=" @error('description') is-invalid @enderror" ></textarea>
                                    @error('description')
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
                                            <p id="content-action1">
                                                Upload Image
                                            </p>
                                        </div>
                                    </div>
                                    <div id="oit1" class="other-image-thumbnails"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Submit</button>
                                    <a href="{{ route('addCategory') }}" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('/adminassets/dist/js/double.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection