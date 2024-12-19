
    <?php $__env->startSection('title'); ?>
        Ghazi 1984
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('css'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('adminassets/dropzone/dropzone.css')); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <?php $__env->stopSection(); ?>
    
    <?php $__env->startSection('style'); ?>
    <style>
        input[type="file"] {
            height: auto;
        }
        .ck-editor__editable_inline {
            min-height: 250px;
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
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Add Blog</li>
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
                            <h5>Add New Blog <a href="<?php echo e(route('blogs')); ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('uploadBlog')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label>Blog title</label>
                                <input type="text" name="title" placeholder="Enter Blog Title" value="<?php echo e(old('title')); ?>"  class="form-control" />
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Auther Name</label>
                                        <input type="text" name="auther_name" placeholder="Enter auther name" value="<?php echo e(old('auther_name')); ?>"  class="form-control" />
                                </div>
                                <div class="form-group col-4">
                                    <label>Blog Date</label>
                                        <input type="date" name="blog_date" value="<?php echo e(old('blog_date')); ?>"  class="form-control" />
                                </div>
                                <div class="form-group col-2">
                                    <label>Feature</label>
                                    <div>
                                        <input type="checkbox" name="feature" style="width: 20px; height: 20px; margin-top: 6px;" <?php echo e(old('feature') ? '' : 'checked'); ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Blog Short Description</label>
                                <div>
                                    <input type="text" name="short_description" value="<?php echo e(old('short_description')); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editor1">Blog Description</label>
                                <textarea id="editor1" placeholder="Enter description of blog" name="blog_description"><?php echo e(old('blog_description')); ?></textarea>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-6" id="blog_images">
                                    <input type="hidden" id="blog_id">
                                    <label for="Blog">Add Blog Image</label>
                                    <div id="blog_image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">    
                                            <br>Drag the file here or click to upload<br>                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Submit</button>
                                    <a href="<?php echo e(route('uploadBlog')); ?>" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
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
<script src="<?php echo e(asset('adminassets/dropzone/dropzone.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">    
    Dropzone.autoDiscover = false;

    const dropzone2 = new Dropzone("#blog_image", { 
        url: "<?php echo e(route('blogImage')); ?>",
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

            this.on('success', function(file, response) {
                console.log(response);
                if (response && response.id) {
                    $("#blog_id").val(response.id);
                    file.meta_data = response.id;
                    $("#blog_images").append('<input type="hidden" id="blog_images_val_'+response.id+'" name="blog_images_val[]" value="' + response.id + '">');
                    $("#blog_image").append('<input type="hidden" name="oldImage" value="' + response.id + '">');

                    // Show success toaster message
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
                formData.append('oldImage', $("#blog_image input[name='oldImage']").val());
            });

            this.on('removedfile', function(file) {
                if (file.meta_data) {
                    $("#blog_images_val_" + file.meta_data).remove();
                    deleteBlogImage(file.meta_data);
                    toastr.info('Image removed.', 'Info');
                } else {
                    console.warn("File metadata is missing for removal.");
                }
            });
        }
    });

    function deleteBlogImage(id) {
        $.ajax({
            type: "GET",
            url: "<?php echo e(route('deleteBlogImage', ['id' => ':id'])); ?>".replace(':id', id),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/blogs/addBlog.blade.php ENDPATH**/ ?>