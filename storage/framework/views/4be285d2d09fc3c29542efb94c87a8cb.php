<?php if($paginator->hasPages()): ?>
    <nav>
        <ul class="pagination">
            
            <?php if($paginator->onFirstPage()): ?>
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&lsaquo;</span>
                </li>
            <?php else: ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">&lsaquo;</a>
                </li>
            <?php endif; ?>

            
            <?php
                $currentPage = $paginator->currentPage();
                $totalPages = $paginator->lastPage();
                $pageLimit = 10;

                $start = max($currentPage - floor($pageLimit / 2), 1);
                $end = min($start + $pageLimit - 1, $totalPages);

                if ($end - $start + 1 < $pageLimit) {
                    $start = max($end - $pageLimit + 1, 1);
                }
            ?>

            
            <?php if($start > 1): ?>
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">...</span>
                </li>
            <?php endif; ?>

            
            <?php for($i = $start; $i <= $end; $i++): ?>
                <?php if($i == $currentPage): ?>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link"><?php echo e($i); ?></span>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo e($paginator->url($i)); ?>"><?php echo e($i); ?></a>
                    </li>
                <?php endif; ?>
            <?php endfor; ?>

            
            <?php if($end < $totalPages): ?>
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">...</span>
                </li>
            <?php endif; ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">&rsaquo;</a>
                </li>
            <?php else: ?>
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&rsaquo;</span>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH /home/ghazi1984/public_html/resources/views/vendor/pagination/bootstrap-5.blade.php ENDPATH**/ ?>