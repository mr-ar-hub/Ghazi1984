
<?php $__env->startSection('title'); ?>
    Ghazi 1984 Instagram
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
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Instagram</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active">Instagram</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mb-2">
            <a href="<?php echo e(route('instafetchpost')); ?>" class="btn btn-success" style="float: right"><i class="fa fa-plus"></i>&nbsp Fetch</a>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myDataTable" class="table table-hover table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Link</th>
                                    <th>Media Type</th>
                                    <th>Posts</th>
                                </tr>
                            </thead>    
                            <tbody id="first-body"> <!-- Added id="first-body" -->
                                <?php $__currentLoopData = $instagram; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="item-drag" data-id="<?php echo e($item->id); ?>">
                                    <td class="sortable-handle">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M10,4c0,1.1-0.9,2-2,2S6,5.1,6,4s0.9-2,2-2S10,2.9,10,4z M16,2c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S17.1,2,16,2z M8,10 c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S9.1,10,8,10z M16,10c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S17.1,10,16,10z M8,18 c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S9.1,18,8,18z M16,18c-1.1,0-2,0.9-2,2s0.9,2,2,2s2-0.9,2-2S17.1,18,16,18z"></path>
                                        </svg>
                                    </td>
                                    <td><?php echo e($item->postlink); ?></td>
                                    <td><?php echo e($item->posttype); ?></td>
                                    <td>
                                        <?php if(strpos($item->image, '.webp') || strpos($item->image,'.png') || strpos($item->image, '.jpg') || strpos($item->image, '.jpeg')|| strpos($item->image, '.heic')): ?>
                                            <img src="<?php echo e($item->image); ?>" alt="Image" width="100px" height="100px">
                                        <?php elseif(strpos($item->image, '.mp4') !== false || strpos($item->image, '.mov') !== false || strpos($item->image, '.avi') !== false || strpos($item->image, '.webm') !== false): ?>
                                            <video controls width="100px" height="100px">
                                                <source src="<?php echo e($item->image); ?>" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>    
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script> <!-- Ensure you include SortableJS -->
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "ordering": false,
        });

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
                url: "<?php echo e(route('updateInstagramOrder')); ?>",
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/instagram/instagram.blade.php ENDPATH**/ ?>