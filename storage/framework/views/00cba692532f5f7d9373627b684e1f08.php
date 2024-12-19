
    <?php $__env->startSection('title'); ?>
        Ghazi 1984
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
                    <li class="breadcrumb-item active">Comments</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title" style="width: 100%;">
                    <h5>Blog Comments</h5>
                </div>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-hover table-sm table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Blog Title</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><a href="<?php echo e(route('viewComment', $comment->id)); ?>"><?php echo e($comment->name); ?></a></td>
                        <td><?php echo e($comment->blogs->title); ?></td>
                        <td><?php echo e($comment->email); ?></td>
                        <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width:200px; display: block;">
                            <?php echo e($comment->message); ?></td>
                        <td> 
                            <a class="btn btn-success btn-sm" href="<?php echo e(route('viewComment', $comment->id)); ?>"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-danger btn-sm" href="<?php echo e(route('deleteComment', $comment->id)); ?>"><i class="fa fa-trash"></i></a>
                        </td>               
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                 
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminmaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ghazi1984/public_html/resources/views/admin/comments/comment.blade.php ENDPATH**/ ?>