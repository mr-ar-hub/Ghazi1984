
    <?php $__env->startSection('title'); ?>
        Ghazi 1984
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('css'); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('style'); ?>
    <style>
        .sortable-handle {
            cursor: grab;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sortable-handle svg {
            fill: #181717;
            width: 30px;
            margin-top: 30px;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            text-align: center;
        }
        
        .switch input { 
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        
        input:checked + .slider {
            background-color: #51BB25;
        }
        
        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }
        
        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
        .slider.round {
            border-radius: 34px;
        }
        
        .slider.round:before {
            border-radius: 50%;
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
                    <li class="breadcrumb-item active">Carousel Images</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="width: 100%;">
                    <h5>Carousel Images<a href="<?php echo e(route('addNewImage')); ?>" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Add Carousel Image</a></h5>
                </div>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-hover table-sm table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <td>Carousel Image</td>
                            <td>status</td>
                            <td class="text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody id="first-body">
                        <?php $__currentLoopData = $carousel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="item-drag" data-id="<?php echo e($item->id); ?>">
                                <td class="sortable-handle">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M10,4c0,1.1-0.9,2-2,2S6,5.1,6,4s0.9-2,2-2S10,2.9,10,4z M16,2c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S17.1,2,16,2z M8,10 c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S9.1,10,8,10z M16,10c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S17.1,10,16,10z M8,18 c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S9.1,18,8,18z M16,18c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S17.1,18,16,18z"></path>
                                    </svg>
                                </td>
                                <td>
                                    <img src="<?php echo e(asset('storage/' . $item->image_name)); ?>" width="100px" height="100px" data-toggle="modal" data-target="#imagePreviewModal" data-src="<?php echo e(asset('storage/' . $item->image_name)); ?>">
                                </td>
                                <td>
                                    <form id="status-form-<?php echo e($item->id); ?>" action="<?php echo e(route('updateCarouselStatus', ['id' => $item->id])); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <label class="switch mt-4">
                                            <input type="checkbox" onChange='submitForm(<?php echo e($item->id); ?>);' <?php if($item->status): ?> checked <?php endif; ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-danger btn-sm mt-4" href="<?php echo e(route('deletecarouselImage', ['id' => $item->id])); ?>"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>  
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagePreviewModalLabel">Image Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="previewImage" src="" alt="Image Preview" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    
<script src="https://unpkg.com/sortablejs@1.14.0/Sortable.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "ordering": false,
        });
    });
</script>
<script>
    $(document).ready(function() {

        var sortable = new Sortable(document.getElementById('first-body'), {
            handle: '.sortable-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            dataIdAttr: 'data-id',
            draggable: '.item-drag',
            onEnd(evt) {
                const newOrder = sortable.toArray(); 
                updateOrderNo(newOrder);
            }
        });

        function updateOrderNo(currentOrderList) {
            $.ajax({
                type: 'POST',
                url: "<?php echo e(route('updateCarouselImageOrder')); ?>",
                data: { "currentOrderList": currentOrderList },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function(msg) {
                if (msg.status) {
                    toastr.success(msg.message, "Success!");
                } else {
                    toastr.error(msg.message);
                }
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('img[data-toggle="modal"]').on('click', function() {
            var imgSrc = $(this).data('src');
            $('#previewImage').attr('src', imgSrc);
            $('#imagePreviewModal').modal('show');
        });
    });

    function submitForm(itemId) {
        var form = $('#status-form-' + itemId);

        var isChecked = form.find('input[type="checkbox"]').is(':checked');

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: {
                _token: form.find('input[name="_token"]').val(),
                status: isChecked ? 1 : 0
            },
            success: function(response) {
                toastr.success('Status updated successfully!', 'Success');
            },
            error: function(xhr, status, error) {
                toastr.error('Error updating status. Please try again.', 'Error');
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/carousel/carouselImages.blade.php ENDPATH**/ ?>