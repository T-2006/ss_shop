<?php
    $tallas = $producto->variants->pluck('talla')->unique();
    $stockTotal = $producto->variants->sum('stock');
?>

<div class="col-sm-6 col-lg-4 col-xl-3 producto-item" data-categoria="<?php echo e($producto->category->slug); ?>">
    <div class="tarjeta-producto h-100">

        <div class="etiqueta-precio fuente-mono">
            $<?php echo e(number_format($producto->precio, 0, ',', '.')); ?>

        </div>

        <div class="tarjeta-producto__imagen d-flex align-items-center justify-content-center">
            <?php if($producto->imagen): ?>
                <img src="<?php echo e(asset('storage/'.$producto->imagen)); ?>" alt="<?php echo e($producto->nombre); ?>" class="img-fluid">
            <?php else: ?>
                <span class="fuente-display text-uppercase" style="color:#B8B2A4; font-size:1.4rem;"><?php echo e($producto->category->nombre); ?></span>
            <?php endif; ?>
        </div>

        <div class="p-3">
            <p class="mb-1 fuente-mono text-uppercase" style="font-size:0.7rem; color: var(--gold);"><?php echo e($producto->category->nombre); ?></p>
            <h3 class="h6 mb-2"><?php echo e($producto->nombre); ?></h3>

            <div class="d-flex flex-wrap gap-1 mb-2">
                <?php $__currentLoopData = $tallas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $talla): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="talla-badge"><?php echo e($talla); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($stockTotal > 0): ?>
                <p class="mb-0 small text-success">Disponible</p>
            <?php else: ?>
                <p class="mb-0 small text-danger">Agotado</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Administrator\ss_shop\resources\views/partials/tarjeta-producto.blade.php ENDPATH**/ ?>