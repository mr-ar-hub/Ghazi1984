
    <?php $__env->startSection('title'); ?>
        Ghazi 1984
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                    <li class="breadcrumb-item active">All Product Size Charts</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
                    <h5>All Product Size Charts</h5>
                    <div style="margin-left: auto;">
                        <a href="<?php echo e(route('addProductSizeChart')); ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp; 
                            Add New Product Size Charts
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-hover table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>Size Chart Name</th>
                        <th>Size Chart</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $sizeCharts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->name); ?></td>
                            <td>
                                <img src="<?php echo e(asset('storage/' . $item->image_name)); ?>" width="100px" height="100px" data-toggle="modal" data-target="#imagePreviewModal" data-src="<?php echo e(asset('storage/' . $item->image_name)); ?>">
                            </td>
                            <td>
                                <a href="<?php echo e(route('deleteSizeChart', ['id' => $item->id])); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
                <h5 class="modal-title" id="imagePreviewModalLabel">Size Chart Preview</h5>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "ordering": false,
        });
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
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/products/productsizechart/sizeCharts.blade.php ENDPATH**/ ?>