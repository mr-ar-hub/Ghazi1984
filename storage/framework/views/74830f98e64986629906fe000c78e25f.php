
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('adminassets/dropzone/dropzone.css')); ?>">
  <style>
      input[type="file"] {
          height: auto;
      }
      .ck-editor__editable_inline {
          min-height: 150px;
      }
        .dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed rgb(0, 135, 247);
            border-image: none;
            max-width: 100%;
            height: 190px;
        }
        .dropzone .dz-message{
            padding: 50px 0px !important;
        }
  </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- 
    --------------------------------
    ------ / page title / ----------
    --------------------------------
     -->
     <div class="page-title">
        <div class="container">
            <header class="entry-header">
                <h1 class="entry-title">Bulk Order</h1>
                <div class="breadcrumbs">
                    <a href="<?php echo e(route('index')); ?>">Home</a> » <span class="current">Bulk Order</span>
                </div>
            </header>
        </div>
    </div>

    <!-- 
    --------------------------------
    ---------- / Bulk Order / ------------
    --------------------------------
     -->
     
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card" style="background-color: none; border: none;">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="section-title" style="padding: 50px">
                      <h2 class="text-center">Bulk Order Form</h2>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form action="<?php echo e(route('bulkOrderPost')); ?>" method="POST" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Name:</label>
                      <input type="text" required="" value="<?php echo e(old('name')); ?>" name="name" class="form-control" placeholder="Enter name" style=" border: none; border-bottom: 1px solid lightgray; box-shadow: none;outline: none;"/>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Email:</label>
                        <input type="email" required="" value="<?php echo e(old('email')); ?>" name="email" class="form-control" placeholder="Enter email" style=" border: none; border-bottom: 1px solid lightgray; box-shadow: none;outline: none;"/>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="form-group col-md-6">
                      <label>Company Name:</label>
                      <input type="text" required="" value="<?php echo e(old('company_name')); ?>" name="company_name" class="form-control" placeholder="Enter company name" style=" border: none; border-bottom: 1px solid lightgray; box-shadow: none;outline: none;"/>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Whatsapp No:</label>
                        <input type="number" required="" value="<?php echo e(old('phone')); ?>" name="phone" class="form-control" placeholder="Enter whatsapp no." style=" border: none; border-bottom: 1px solid lightgray; box-shadow: none;outline: none;"/>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="form-group col-md-6">
                      <label>Quantity:</label>
                      <input type="number" required="" value="<?php echo e(old('quantity')); ?>" name="quantity" min="1" class="form-control" placeholder="Enter quantity" style=" border: none; border-bottom: 1px solid lightgray; box-shadow: none;outline: none;"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Country:</label>
                            <select id="country" required="" class="form-control form-control-sm" name="country" style=" border: none; border-bottom: 1px solid lightgray; box-shadow: none;outline: none;">
                                <option value="">Country / region</option>
                            </select>
                    </div>
                  </div>
                  <div class="form-group mt-3">
                    <label>Address:</label>
                    <input type="text" required="" value="<?php echo e(old('address')); ?>" name="address" class="form-control" placeholder="Enter address" style=" border: none; border-bottom: 1px solid lightgray; box-shadow: none;outline: none;"/>
                  </div>
                  <div class="row mt-3">
                    <div class="form-group col-md-6">
                      <label>Requirements:</label>
                      <textarea id="editor1" placeholder="Enter requirement" name="requirement"><?php echo e(old('requirement')); ?></textarea>
                    </div>
                    <div class="form-group col-md-6" id="sample_images">
                        <input type="hidden" id="sample_id">
                        <label for="sample">Sapme Images:</label>
                        <div id="sample_image" class="dropzone dz-clickable">
                            <div class="dz-message needsclick">    
                                <br>Drag the file here or click to upload<br>                         
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-sm-12 mt-2 text-center" >
                      <button type="submit" class="filter-btn">ENQUIRE NOW</button>
                    </div>
                  </div>
                </form>
            	</div>
       	 	  </div>
       	 	</div>
        </div>
    	</div>
    </div>
    <div class="container my-5">
      <div class="section-title-content">
          <p class="pre-title">Proudly Serving</p>
          <div class="section-title">
              <h4 class="heading-title">Custom Bulk Orders for Top Clients</h4>
          </div>
      </div>
      <div class="blog-owl-carousel owl-carousel mt-5">
          <?php $__currentLoopData = $bulkServing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="blog-post">
                  <div class="blog-image-wrapper">
                      <img src="<?php echo e(asset('storage/' . $item->BulkSurvingImage->image_name)); ?>" class="img-fluid blog-image"alt="Blog Image 1">
                  </div>
                  <div class="blog-content">
                    <h3 class="blog-title"><?php echo e($item->name); ?></h3>
                    <p><?php echo e($item->company_name); ?></p>
                    <p><?php echo $item->bluk_serving_description; ?></p>
                  </div>
              </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="<?php echo e(asset('adminassets/dropzone/dropzone.js')); ?>"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        async function fetchCountries() {
            const response = await fetch('https://restcountries.com/v3.1/all');
            const countries = await response.json();
            return countries.map(country => country.name.common);
        }
    
        async function populateCountries() {
            const countrySelect = document.querySelector('#country');
            countrySelect.innerHTML = '<option value="">Country / region</option>';
    
            const countries = await fetchCountries();
            countries.forEach(country => {
                countrySelect.innerHTML += `<option value="${country}">${country}</option>`;
            });
        }

        document.addEventListener("DOMContentLoaded", populateCountries);
    </script>
    <script>
      function configureCKEditor(selector) {
        const element = document.querySelector(selector);
        if (element) {
          ClassicEditor
            .create(element, {
              heading: {
                options: [
                  { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                  { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                  { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                  { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
              }
            })
            .catch(error => {
              console.error(`Error initializing CKEditor for ${selector}:`, error);
            });
        } else {
          console.error(`Element with selector ${selector} not found.`);
        }
      }
      
      document.addEventListener('DOMContentLoaded', () => {
        configureCKEditor('#editor1');
        configureCKEditor('#editor2');
      });
    </script>
    <script type="text/javascript">    
      Dropzone.autoDiscover = false;
        const dropzone2 = new Dropzone("#sample_image", { 
            url: "<?php echo e(route('sampleImage')); ?>",
            maxFiles: 5,
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/webp,application/pdf",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 5) {
                        this.removeFile(this.files[0]);
                    }
                });
                this.on('success', function(file, response) {
                    console.log(response);
                    if (response && response.id) {
                        $("#sample_id").val(response.id);
                        file.meta_data = response.id;
                        $("#sample_images").append('<input type="hidden" id="bulk_sample_val_'+response.id+'" name="bulk_sample_val[]" value="' + response.id + '">');
                        $("#sample_image").append('<input type="hidden" name="oldImage" value="' + response.id + '">');
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
                    formData.append('oldImage', $("#sample_image input[name='oldImage']").val());
                });
                this.on('removedfile', function(file) {
                  if (file.meta_data) {
                    $("#bulk_sample_val_" + file.meta_data).remove();
                      deleteSampleImage(file.meta_data);
                        toastr.info('Image removed.', 'Info');
                  } else {
                    console.warn("File metadata is missing for removal.");
                  }
                });
              }
          });

        function deleteSampleImage(id) {
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('deleteSampleImage')); ?>/" + id,
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/frontend/bulkOrder.blade.php ENDPATH**/ ?>