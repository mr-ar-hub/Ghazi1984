@extends('layouts.adminmaster')
    @section('title')
        Ghazi 1984
    @endsection
    @section('css')
    <link rel="stylesheet" href="{{ asset('adminassets/dropzone/dropzone.css') }}">
    @endsection
    
    @section('style')
    <style>
        .size-color-picker-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .size-input, .color-input, #addSizeColorButton {
            height: 40px;
        }

        .color-input {
            width: 40px;
            border: none;
            cursor: pointer;
        }

        #addSizeColorButton {
            padding: 0 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .size-color-box {
            display: inline-block;
            margin-right: 10px;
            padding: 20px;
            border-radius: 4px;
            color: white;
            position: relative;
            margin-top: 10px;
        }
        .remove-icon {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 15px;
            height: 15px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .remove-icon:before {
            content: '×';
            font-size: 16px;
            color: red;
            font-weight: bold;
        }
        input[type="file"] {
            height: auto;
        }
        .ck-editor__editable_inline {
            min-height: 150px;
        }.form-control[readonly] {
            background-color: transparent;
            opacity: 1;
        }
        .dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed rgb(0, 135, 247);
            border-image: none;
            max-width: 100%;
            height: 300px;
        }
        .dropzone .dz-message{
            padding: 100px 0px !important;
        }
    </style>
    @endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Add Product</li>
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
                            <h5>Add New Product <a href="{{ route('allProducts') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="{{route('postProducts')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Select Category</label>
                                    <select  class="form-control" name="cat_id">
                                        <option value="0" hidden="" selected="">Choose Category</option>
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
                                                        category($data['id'], $space.'&nbsp;-');
                                                    }
                                                }
                                        
                                                mysqli_close($con);
                                            }
                                            category();
                                        ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="name" placeholder="Enter product name" value="{{old('name')}}"  class="form-control" />
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>SKU</label>
                                        <input type="text" name="artical_name" placeholder="Article name"  value="{{old('artical_name')}}" class="form-control" />
                                </div>
                                <div class="form-group col-4">
                                    <label>Price</label>
                                        <input type="number" name="price" placeholder="Rs: " value="{{old('price')}}" min="0"  class="form-control" />
                                </div>
                                <div class="form-group col-4">
                                    <label>Discount</label>
                                        <input type="text" name="discount" placeholder="%" value="{{old('discount')}}"  class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Stock</label>
                                        <input type="number" name="stock" placeholder="Add stock" value="{{old('stock')}}"  class="form-control" />
                                </div>
                                <div class="form-group col-4">
                                    <label>Gender</label>
                                    <div>
                                        <input type="checkbox" name="gender" style="width: 20px; height: 20px; margin-top: 6px;" {{ old('gender') ? 'checked' : '' }}>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label>Feature</label>
                                    <div>
                                        <input type="radio" name="status" value="1" style="width: 20px; height: 20px; margin-top: 6px;" {{ old('status') ? 'checked' : '' }}>
                                        <label for="hot_sale"style="margin-right: 15px;">Hot Sale</label>
                                        <input type="radio" name="status" value="0" style="width: 20px; height: 20px; margin-top: 6px;" {{ old('status') ? 'checked' : '' }}>
                                        <label for="new_arrival">New Arrival</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editor1">Product Description</label>
                                <textarea id="editor1" placeholder="Enter description of product" name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="editor2">Product Short Description</label>
                                <textarea id="editor2" placeholder="Enter short description of product" name="short_description">{{ old('short_description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Select Product Size Chart</label>
                                    <select  class="form-control" name="size_chart_id">
                                        @foreach ($sizeChart as $item)
                                            <option value="0">Product Size Chart</option>
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group size-color-picker-container">
                                <label for="sizePicker">Select Size:</label>
                                <select id="sizePicker" class="size-input">
                                    @foreach ($size as $sizes)
                                        <option value="{{ $sizes->name }}">{{ $sizes->name }}</option>
                                    @endforeach
                                </select>
                                <label for="colorPicker">Select Color:</label>
                                <input type="color" id="colorPicker" class="color-input">
                                <label for="colorNameInput">Color Name:</label>
                                <input type="text" id="colorNameInput" placeholder="Enter color name">
                                <button type="button" id="addSizeColorButton" onclick="addSizeColor()">Add Size-Color</button>
                            </div>
                            <div id="selectedSizeColors"></div>
                            <input type="hidden" name="sizeColorMap" id="sizeColorMap">
                            <div class="row mt-3">
                                <div class="col-md-4" id="product_img">
                                    <input type="hidden" id="product_image_id">
                                    <label for="product_image">Product Image</label>
                                        <div id="image_product" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick">    
                                                <br>Drag the file here or click to upload<br>                                            
                                            </div>
                                        </div>
                                </div>
                                <div class="form-group col-md-8" id="carousel_images">
                                    <input type="hidden" id="carousel_id">
                                    <label for="carousel">Carousel Images</label>
                                        <div id="carousel_image" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick">    
                                                <br>Drag the file here or click to upload<br>                         
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Submit</button>
                                    <a href="{{ route('addProducts') }}" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('adminassets/dropzone/dropzone.js') }}"></script>
<script>
   
   document.addEventListener('DOMContentLoaded', function() {
        const sizeColorMapInput = document.getElementById('sizeColorMap');
        console.log('Initial sizeColorMap:', sizeColorMapInput.value);

        let sizeColorMap = JSON.parse(sizeColorMapInput.value || '{}');
        console.log('Parsed sizeColorMap:', sizeColorMap);

        updateSelectedSizeColors(sizeColorMap);

        function updateSelectedSizeColors(map) {
            const selectedSizeColorsDiv = document.getElementById('selectedSizeColors');
            selectedSizeColorsDiv.innerHTML = '';

            for (const size in map) {
                map[size].forEach(colorInfo => {
                    const box = document.createElement('div');
                    box.classList.add('size-color-box');
                    box.style.backgroundColor = colorInfo.code;
                    box.innerHTML = `${size} - ${colorInfo.name}`;
                    box.dataset.size = size;
                    box.dataset.color = colorInfo.code;
                    box.dataset.name = colorInfo.name;

                    const removeIcon = document.createElement('div');
                    removeIcon.classList.add('remove-icon');
                    removeIcon.onclick = () => removeSizeColor(size, colorInfo.code, colorInfo.name, map);
                    box.appendChild(removeIcon);

                    selectedSizeColorsDiv.appendChild(box);
                });
            }
        }

        function removeSizeColor(size, color, name, map) {
            map[size] = map[size].filter(c => !(c.code === color && c.name === name));
            if (map[size].length === 0) {
                delete map[size];
            }
            updateSelectedSizeColors(map);
            sizeColorMapInput.value = JSON.stringify(map);
        }

        document.getElementById('addSizeColorButton').onclick = function() {
            addSizeColor(sizeColorMap, sizeColorMapInput);
        };

        function addSizeColor(map, input) {
            const sizePicker = document.getElementById('sizePicker');
            const colorPicker = document.getElementById('colorPicker');
            const colorNameInput = document.getElementById('colorNameInput');
            const selectedSize = sizePicker.value;
            const selectedColor = colorPicker.value;
            const selectedColorName = colorNameInput.value.trim();

            if (!selectedColorName) {
                alert('Please enter a color name.');
                return;
            }

            if (!map[selectedSize]) {
                map[selectedSize] = [];
            }

            const colorInfo = { code: selectedColor, name: selectedColorName };

            if (!map[selectedSize].some(c => c.code === selectedColor && c.name === selectedColorName)) {
                map[selectedSize].push(colorInfo);
            }

            updateSelectedSizeColors(map);
            input.value = JSON.stringify(map);
        }
    });

</script>
<script type="text/javascript">    
    Dropzone.autoDiscover = false;
    const dropzone = new Dropzone("#image_product", { 
        url: "{{route('productimage')}}",
        maxFiles: 1,
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif,image/webp",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function() {
            this.on('addedfile', function(file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });

            this.on('success', function(file, response) {
                console.log(response);
                if (response && response.id) {
                    $("#product_image_id").val(response.id);
                    file.meta_data = response.id;
                    $("#product_img").append('<input type="hidden" id="product_val_'+response.id+'" name="product_val[]" value="' + response.id + '">');
                    $("#image_product").append('<input type="hidden" name="oldImage" value="' + response.id + '">');
                } else {
                    console.error("Invalid response format:", response);
                }
            });

            this.on('sending', function(file, xhr, formData) {
                formData.append('product_image_type', 'image');
                formData.append('oldImage', $("#image_product input[name='oldImage']").val());
            });

            this.on('removedfile', function(file) {
                if (file.meta_data) {
                    $("#product_val_" + file.meta_data).remove();
                    deleteProductImage(file.meta_data);
                } else {
                    console.warn("File metadata is missing for removal.");
                }
            });
        }
    });

    const dropzone2 = new Dropzone("#carousel_image", { 
        url: "{{route('productimage')}}",
        maxFiles: 20,
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif,image/webp",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        params: {
            product_image_type: 'carousel'
        },
        init: function() {
            this.on('addedfile', function(file) {
                if (this.files.length > 20) {
                    this.removeFile(this.files[0]);
                }
            });

            this.on('success', function(file, response) {
                if (response && response.id) {
                    file.serverId = response.id;
                    $("#carousel_images").append(`
                        <input type="hidden" id="carousel_images_val_${response.id}" name="carousel_images_val[]" value="${response.id}">
                    `);
                } else {
                    console.error("Invalid response format:", response);
                }
            });

            this.on('removedfile', function(file) {
                if (file.meta_data) {
                    $("#carousel_images_val_" + file.meta_data).remove();
                    deleteProductImage(file.meta_data);
                } else {
                    console.warn("File metadata is missing for removal.");
                }
            });
        }
    });

    function deleteProductImage(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('deleteProductImage') }}/" + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(msg) {
                // alert(msg.message);
            },
            error: function(xhr, status, error) {
                console.error("Error deleting image:", error);
            }
        });
    }
</script>
@endsection