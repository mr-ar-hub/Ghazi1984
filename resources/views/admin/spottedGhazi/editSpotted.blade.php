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
                height: 300px;
            }
            .dropzone .dz-message{
                padding: 100px 0px !important;
            }
            .dropzone .dz-preview .dz-image{
                height: 250px;
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
                    <li class="breadcrumb-item active">Edit Spotted In Ghazi</li>
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
                            <h5>Edit Spotted In Ghazi <a href="" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="{{ route('updateSpotted', ['id' => $spotted->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>Spotted Name</label>
                                <input type="text" name="name" placeholder="Spotted Name" value="{{ $spotted->name }}" class="form-control">
                            </div>
                            <div class="form-group col-6" id="spotted_images">
                                <input type="hidden" id="spotted_id">
                                <label for="carousel">Update Spotted Image</label>
                                <div id="spotted_image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">    
                                        <br>Drag the file here or click to upload<br>                         
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Update</button>
                                    <a href="{{ route('editSpotted', ['id' => $spotted->id]) }}" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
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

    const dropzone2 = new Dropzone("#spotted_image", { 
        url: "{{route('spottedImage')}}",
        maxFiles: 1,
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/webp",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        init: function() {
            this.on('addedfile', function(file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
            @if ($spotted->SpottedImage)
            var mockFile = { 
                    name: "{{ $spotted->SpottedImage->image_name }}", 
                    dataURL: "{{ asset('storage/' . $spotted->SpottedImage->image_name) }}", 
                    meta_data: "{{ $spotted->SpottedImage->id }}",
                    accepted: true 
                };
                this.emit('addedfile', mockFile);
                this.emit('thumbnail', mockFile, mockFile.dataURL);
                this.emit('complete', mockFile);
                this.files.push(mockFile);
                $("#spotted_images").append('<input type="hidden" id="spotted_images_val_{{ $spotted->SpottedImage->id }}" name="spotted_images_val[]" value="{{ $spotted->SpottedImage->id }}">');
            @endif
            this.on('success', function(file, response) {
                console.log(response);
                if (response && response.id) {
                    $("#spotted_id").val(response.id);
                    file.meta_data = response.id;
                    $("#spotted_images").append('<input type="hidden" id="spotted_images_val_'+response.id+'" name="spotted_images_val[]" value="' + response.id + '">');
                    $("#spotted_image").append('<input type="hidden" name="oldImage" value="' + response.id + '">');

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
                formData.append('oldImage', $("#spotted_image input[name='oldImage']").val());
            });

            this.on('removedfile', function(file) {
                if (file.meta_data) {
                    $("#spotted_images_val_" + file.meta_data).remove();
                    deleteSpottedImage(file.meta_data);
                    toastr.info('Image removed.', 'Info');
                } else {
                    console.warn("File metadata is missing for removal.");
                }
            });
        }
    });

    function deleteSpottedImage(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('deleteSpottedImage', ['id' => ':id']) }}".replace(':id', id),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
    }
</script>
@endsection