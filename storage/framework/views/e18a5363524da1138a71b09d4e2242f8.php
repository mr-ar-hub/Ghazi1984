    <?php $__env->startSection('title'); ?>
        Ghazi 1984 Credentials
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Credentials</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Credentials</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h5 class="text-center fw-bold">Instagram Access Token</h5>
                            <table id="myDataTable" class="table table-hover table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Access Token</th>
                                        <th>No of Active Posts</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $credential; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($item->name == 'instagram'): ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('editcredential', ['id' => $item->id])); ?>"><?php echo e($item->name); ?></a>
                                                </td>
                                                <td style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word; max-width: 600px;"><?php echo e($item->access_token); ?></td>
                                                <td><?php echo e($item->no_ig_posts); ?></td>
                                            </tr>
                                        <?php endif; ?>
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
    <script>
        $(document).ready(function() {
            $('#myDataTable').DataTable({
                "ordering": false,
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/credential/credentials.blade.php ENDPATH**/ ?>