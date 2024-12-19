@extends('layouts.adminmaster')
    @section('title')
        Ghazi 1984
    @endsection
    @section('css')
        <link rel="stylesheet" href="{{ asset('adminassets/dropzone/dropzone.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @endsection
    
    @section('style')
        <style>
            .dropzone {
                background: white;
                border-radius: 5px;
                border: 2px dashed rgb(0, 135, 247);
                border-image: none;
                max-width: 100%;
                height: 250px;
            }
            .dropzone .dz-message{
                padding: 90px 0px !important;
            }
            .dropzone .dz-preview .dz-image{
                height: 150px;
                width: 100%;
            }
            .dropzone .dz-preview .dz-image img{
                width: 100%;
                height: 100%;
                object-fit: contain;
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
                    <li class="breadcrumb-item active">Add New Size Chart</li>
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
                            <h5>Add New Size Chart <a href="{{ route('productSizeChart') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="{{ route('uploadProductSizeChart') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Product Size Chart Name</label>
                                <input type="text" name="name" placeholder="Enter product size chart" value="{{old('name')}}"  class="form-control" />
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6" id="size_chart_img">
                                    <input type="hidden" id="size_chart_image_id">
                                    <label for="size_chart_image">Product Image</label>
                                        <div id="image_size_chart" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick">    
                                                <br>Drag the file here or click to upload<br>                                            
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Submit</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">    
    Dropzone.autoDiscover = false;
    const dropzone = new Dropzone("#image_size_chart", { 
        url: "{{route('productSizeChartImage')}}",
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
                    $("#size_chart_image_id").val(response.id);
                    file.meta_data = response.id;
                    $("#size_chart_img").append('<input type="hidden" id="size_chart_val_'+response.id+'" name="size_chart_val[]" value="' + response.id + '">');
                    $("#image_size_chart").append('<input type="hidden" name="oldImage" value="' + response.id + '">');
                
                    toastr.success('Image uploaded successfully!', 'Success');
                } else {
                    console.error("Invalid response format:", response);
                    toastr.error('Upload failed. Please try again.', 'Error');
                }
            });

            this.on('error', function(file, errorMessage) {
                console.error("Upload error:", errorMessage);
                toastr.error('Upload failed. Please try again.', 'Error');
            });

            this.on('sending', function(file, xhr, formData) {
                formData.append('size_chart_image_type', 'image');
                formData.append('oldImage', $("#image_size_chart input[name='oldImage']").val());
            });

            this.on('removedfile', function(file) {
                if (file.meta_data) {
                    $("#size_chart_val_" + file.meta_data).remove();
                    deleteProductSizeChartImage(file.meta_data);
                    toastr.info('Image removed.', 'Info');
                } else {
                    console.warn("File metadata is missing for removal.");
                }
            });
        }
    });


    function deleteProductSizeChartImage(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('deleteSizeChartImage', ['id' => ':id']) }}".replace(':id', id),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
    }
</script>
@endsection