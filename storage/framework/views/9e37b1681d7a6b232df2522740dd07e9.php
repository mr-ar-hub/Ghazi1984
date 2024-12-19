
    <?php $__env->startSection('title'); ?>
        Ghazi 1984
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('css'); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('style'); ?>
    <style>
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
                    <li class="breadcrumb-item active">Bank Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
                    <h5>Bank Details</h5>
                    <div style="margin-left: auto;">
                        <a href="<?php echo e(route('addBankDetail')); ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp; 
                            Add New
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-hover table-sm table-bordered">
                    <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Account Holder Name</th>
                        <th>Bank</th>
                        <th>Branch</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo $count++."." ?></td>
                                <td><?php echo e($items->account_holder_name); ?></td>
                                <td><?php echo e($items->bank_name); ?></td>
                                <td><?php echo e($items->branch); ?></td>
                                <td>
                                    <form id="status-form-<?php echo e($items->id); ?>" method="POST" action="<?php echo e(route('updateBankDetailStatus', ['id' => $items->id])); ?>">
                                        <?php echo csrf_field(); ?>
                                        <label class="switch">
                                            <input type="checkbox" onChange='submitForm(<?php echo e($items->id); ?>);' <?php if($items->status): ?> checked <?php endif; ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-success btn-sm" href="<?php echo e(route('editBankDetail', ['id' => $items->id])); ?>"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" href="<?php echo e(route('deleteBankDetail', ['id' => $items->id])); ?>"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "ordering": false,
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
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/bankdetails/bankDetails.blade.php ENDPATH**/ ?>