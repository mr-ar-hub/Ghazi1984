
    <?php $__env->startSection('title'); ?>
        Ghazi 1984
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.2/tagify.css" />
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Edit Metakeywords</li>
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
                            <h5>Edit Metakeywords <a href="<?php echo e(route('metakeywords')); ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-arrow-left"></i> Back</a></h5>
                        </div>  
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('updateMetakeywords' , $data->id)); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label>Keywords</label>
                                <div>
                                    <?php
                                        // Decode the existing keywords from JSON
                                        $existingKeywords = json_decode($data->keywords, true); // Assuming $item is passed to the view
                                        // Format them for Tagify
                                        $formattedKeywords = implode(',', array_column($existingKeywords, 'value'));
                                    ?>
                                    <input name="keywords" placeholder="Enter Keywords" value="<?php echo e(old('keywords', $formattedKeywords)); ?>" class="form-control" id="keywords-input" />
                                    <?php if($errors->has('keywords')): ?>
                                        <div class="text-danger"><?php echo e($errors->first('keywords')); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-success" style="float: right; margin-left: 5px; padding: 5px 50px;">Submit</button>
                                    <a href="<?php echo e(route('addMetakeywords')); ?>" class="btn btn-danger" style="float: right; padding: 5px 50px;">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

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
        

<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/meta/edit.blade.php ENDPATH**/ ?>