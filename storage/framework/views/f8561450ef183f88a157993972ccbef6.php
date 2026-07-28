<?php $__env->startSection('titulo', 'Resumen — Panel admin'); ?>

<?php $__env->startSection('contenido'); ?>

    <h1 class="fuente-display mb-4" style="font-size:2rem;">Resumen general</h1>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="tarjeta-kpi">
                <p class="fuente-mono mb-1" style="font-size:0.75rem; color: var(--gold);">PRODUCTOS</p>
                <div class="valor"><?php echo e($totalProductos); ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="tarjeta-kpi">
                <p class="fuente-mono mb-1" style="font-size:0.75rem; color: var(--gold);">CATEGORÍAS</p>
                <div class="valor"><?php echo e($totalCategorias); ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="tarjeta-kpi">
                <p class="fuente-mono mb-1" style="font-size:0.75rem; color: var(--gold);">VARIANTES</p>
                <div class="valor"><?php echo e($totalVariantes); ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="tarjeta-kpi">
                <p class="fuente-mono mb-1" style="font-size:0.75rem; color: var(--gold);">UNIDADES EN STOCK</p>
                <div class="valor"><?php echo e($stockTotal); ?></div>
            </div>
        </div>
    </div>

    <div class="tarjeta-kpi">
        <h2 class="h6 mb-3">Variantes con stock bajo (≤ 5 unidades)</h2>

        <?php if($variantesBajoStock->isEmpty()): ?>
            <p class="text-muted mb-0">Ninguna variante está por debajo del umbral. Todo en orden.</p>
        <?php else: ?>
            <table class="table table-sm align-middle mb-0">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Talla / Color</th>
                        <th>Stock</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $variantesBajoStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variante): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($variante->product->nombre); ?></td>
                            <td><?php echo e($variante->talla); ?> <?php if($variante->color): ?> / <?php echo e($variante->color); ?> <?php endif; ?></td>
                            <td>
                                <span class="badge <?php echo e($variante->stock == 0 ? 'bg-danger' : 'bg-warning text-dark'); ?>">
                                    <?php echo e($variante->stock); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.stock.index')); ?>" class="small">Reabastecer</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Administrator\ss_shop\resources\views/admin/panel.blade.php ENDPATH**/ ?>