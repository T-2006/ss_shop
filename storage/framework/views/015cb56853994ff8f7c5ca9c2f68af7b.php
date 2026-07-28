<?php
    // $paginador debe ser un objeto paginado (LengthAwarePaginator), ej: $productos, $variantes
    $inicioVentana = max(1, $paginador->currentPage() - 2);
    $finVentana = min($paginador->lastPage(), $paginador->currentPage() + 2);
?>

<?php if($paginador->hasPages()): ?>
    <nav aria-label="Paginación" class="paginacion-ss d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
        <ul class="pagination mb-0">
            
            <li class="page-item <?php echo e($paginador->onFirstPage() ? 'disabled' : ''); ?>">
                <?php if($paginador->onFirstPage()): ?>
                    <span class="page-link">‹ Anterior</span>
                <?php else: ?>
                    <a class="page-link" href="<?php echo e($paginador->previousPageUrl()); ?>">‹ Anterior</a>
                <?php endif; ?>
            </li>

            
            <?php if($inicioVentana > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo e($paginador->url(1)); ?>">1</a>
                </li>
                <?php if($inicioVentana > 2): ?>
                    <li class="page-item disabled"><span class="page-link">…</span></li>
                <?php endif; ?>
            <?php endif; ?>

            
            <?php for($pagina = $inicioVentana; $pagina <= $finVentana; $pagina++): ?>
                <li class="page-item <?php echo e($pagina == $paginador->currentPage() ? 'active' : ''); ?>">
                    <a class="page-link" href="<?php echo e($paginador->url($pagina)); ?>"><?php echo e($pagina); ?></a>
                </li>
            <?php endfor; ?>

            
            <?php if($finVentana < $paginador->lastPage()): ?>
                <?php if($finVentana < $paginador->lastPage() - 1): ?>
                    <li class="page-item disabled"><span class="page-link">…</span></li>
                <?php endif; ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo e($paginador->url($paginador->lastPage())); ?>"><?php echo e($paginador->lastPage()); ?></a>
                </li>
            <?php endif; ?>

            
            <li class="page-item <?php echo e(! $paginador->hasMorePages() ? 'disabled' : ''); ?>">
                <?php if($paginador->hasMorePages()): ?>
                    <a class="page-link" href="<?php echo e($paginador->nextPageUrl()); ?>">Siguiente ›</a>
                <?php else: ?>
                    <span class="page-link">Siguiente ›</span>
                <?php endif; ?>
            </li>
        </ul>

        <p class="text-muted small mb-0">
            Mostrando <?php echo e($paginador->firstItem()); ?>–<?php echo e($paginador->lastItem()); ?> de <?php echo e($paginador->total()); ?> resultados
        </p>
    </nav>
<?php endif; ?><?php /**PATH C:\Users\Administrator\ss_shop\resources\views/admin/partials/paginacion.blade.php ENDPATH**/ ?>