<?php $__env->startSection('titulo', 'Categorías — Panel admin'); ?>

<?php $__env->startSection('contenido'); ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fuente-display mb-0" style="font-size:2rem;">Categorías</h1>
        <a href="<?php echo e(route('admin.categorias.create')); ?>" class="btn btn-ss">+ Nueva categoría</a>
    </div>

    <div class="tarjeta-kpi">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Slug</th>
                    <th>Productos</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($categoria->nombre); ?></td>
                        <td class="fuente-mono text-muted"><?php echo e($categoria->slug); ?></td>
                        <td><?php echo e($categoria->products_count); ?></td>
                        <td class="text-end">
                            <a href="<?php echo e(route('admin.categorias.edit', $categoria)); ?>" class="btn btn-sm btn-outline-secondary">Editar</a>
                            <form action="<?php echo e(route('admin.categorias.destroy', $categoria)); ?>" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar esta categoría?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Aún no hay categorías creadas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Administrator\ss_shop\resources\views/admin/categorias/index.blade.php ENDPATH**/ ?>