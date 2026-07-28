<?php $__env->startSection('titulo', 'Productos — Panel admin'); ?>

<?php $__env->startSection('contenido'); ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fuente-display mb-0" style="font-size:2rem;">Productos</h1>
        <a href="<?php echo e(route('admin.productos.create')); ?>" class="btn btn-ss">+ Nuevo producto</a>
    </div>

    <form method="GET" class="mb-3" style="max-width:360px;">
        <input type="text" name="buscar" value="<?php echo e(request('buscar')); ?>" class="form-control"
               placeholder="Buscar por nombre o SKU...">
    </form>

    <div class="tarjeta-kpi">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>SKU</th>
                    <th>Precio</th>
                    <th>Stock total</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($producto->nombre); ?></td>
                        <td><?php echo e($producto->category->nombre); ?></td>
                        <td class="fuente-mono text-muted"><?php echo e($producto->sku); ?></td>
                        <td>$<?php echo e(number_format($producto->precio, 0, ',', '.')); ?></td>
                        <td><?php echo e($producto->variants->sum('stock')); ?></td>
                        <td>
                            <?php if($producto->activo): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end">
                            <a href="<?php echo e(route('admin.productos.edit', $producto)); ?>" class="btn btn-sm btn-outline-secondary">Editar</a>
                            <form action="<?php echo e(route('admin.productos.destroy', $producto)); ?>" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar este producto y todas sus variantes?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No se encontraron productos.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <?php echo $__env->make('admin.partials.paginacion', ['paginador' => $productos], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Administrator\ss_shop\resources\views/admin/productos/index.blade.php ENDPATH**/ ?>