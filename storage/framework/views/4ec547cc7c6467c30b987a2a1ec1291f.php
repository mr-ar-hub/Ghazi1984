
    <?php $__env->startSection('title'); ?>
        Ghazi 1984
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('adminassets/dropzone/dropzone.css')); ?>">
    <?php $__env->stopSection(); ?>
    
    <?php $__env->startSection('style'); ?>
    <style>
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
            height: 200px;
        }
        .dropzone .dz-message{
            padding: 70px 0px !important;
        }
        .dropzone .dz-preview .dz-image{
            height: 170px;
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
                            <h5>Add New Product <a href="<?php echo e(route('indexbulkSurvingOrder')); ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('postBulkSurvingOrder')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row mt-3">
                                <div class="form-group col-6">
                                    <label>Customer Name</label>
                                    <input type="text" name="name" placeholder="Enter bulk order serving name" required="" value="<?php echo e(old('name')); ?>"  class="form-control" />
                                </div>
                                <div class="form-group col-6">
                                    <label>Company Name</label>
                                    <input type="text" name="company_name" placeholder="Enter company name" required="" value="<?php echo e(old('company_name')); ?>"  class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editor1">Blog Description</label>
                                <textarea id="editor1" placeholder="Enter description of bulk order serving" name="bluk_serving_description"><?php echo e(old('bluk_serving_description')); ?></textarea>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-6" id="bulk_serving_images">
                                    <input type="hidden" id="bulk_serving_id">
                                    <label for="bulk_serving">Add Bulk Order Serving Image</label>
                                    <div id="bulk_serving_image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">    
                                            <br>Drag the file here or click to upload<br>                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Submit</button>
                                    <a href="<?php echo e(route('addbulkSurvingOrder')); ?>" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
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
<script type="text/javascript">    
    Dropzone.autoDiscover = false;
    const dropzone2 = new Dropzone("#bulk_serving_image", { 
        url: "<?php echo e(route('bulkServingImage')); ?>",
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
                    $("#bulk_serving_id").val(response.id);
                    file.meta_data = response.id;
                    $("#bulk_serving_images").append('<input type="hidden" id="bulk_serving_images_val_'+response.id+'" name="bulk_serving_images_val[]" value="' + response.id + '">');
                    $("#bulk_serving_image").append('<input type="hidden" name="oldImage" value="' + response.id + '">');

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
                formData.append('oldImage', $("#bulk_serving_image input[name='oldImage']").val());
            });

            this.on('removedfile', function(file) {
                if (file.meta_data) {
                    $("#bulk_serving_images_val_" + file.meta_data).remove();
                    deletebulkServingImage(file.meta_data);
                    toastr.info('Image removed.', 'Info');
                } else {
                    console.warn("File metadata is missing for removal.");
                }
            });
        }
    });

    function deletebulkServingImage(id) {
        $.ajax({
            type: "GET",
            url: "<?php echo e(route('deletebulkServingImage')); ?>/" + id,
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/bulk_serving/addBulkServing.blade.php ENDPATH**/ ?>