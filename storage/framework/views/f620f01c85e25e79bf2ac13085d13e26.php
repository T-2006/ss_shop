<?php $__env->startSection('titulo', 'Control de stock — Panel admin'); ?>

<?php $__env->startSection('contenido'); ?>

    <h1 class="fuente-display mb-4" style="font-size:2rem;">Control de stock</h1>

    <div class="row g-4">
        <div class="col-lg-7">
            <form method="GET" class="mb-3">
                <input type="text" name="buscar" value="<?php echo e(request('buscar')); ?>" class="form-control"
                       placeholder="Buscar por producto o SKU de variante...">
            </form>

            <div class="tarjeta-kpi">
                <table class="table table-sm align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Talla / Color</th>
                            <th>SKU variante</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $variantes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variante): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($variante->product->nombre); ?></td>
                                <td><?php echo e($variante->talla); ?> <?php if($variante->color): ?> / <?php echo e($variante->color); ?> <?php endif; ?></td>
                                <td class="fuente-mono text-muted"><?php echo e($variante->sku_variante); ?></td>
                                <td>
                                    <span class="badge <?php echo e($variante->stock <= 5 ? ($variante->stock == 0 ? 'bg-danger' : 'bg-warning text-dark') : 'bg-success'); ?>">
                                        <?php echo e($variante->stock); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No se encontraron variantes.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo $__env->make('admin.partials.paginacion', ['paginador' => $variantes], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="tarjeta-kpi mb-4">
                <h2 class="h6 mb-3">Registrar movimiento de stock</h2>

                <form method="POST" action="<?php echo e(route('admin.stock.store')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label class="form-label">Variante</label>
                        <select name="product_variant_id" class="form-select <?php $__errorArgs = ['product_variant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Selecciona una variante</option>
                            <?php $__currentLoopData = $variantes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variante): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($variante->id); ?>" <?php if(old('product_variant_id') == $variante->id): echo 'selected'; endif; ?>>
                                    <?php echo e($variante->product->nombre); ?> — <?php echo e($variante->talla); ?>

                                    <?php if($variante->color): ?> / <?php echo e($variante->color); ?> <?php endif; ?>
                                    (<?php echo e($variante->sku_variante); ?>) · stock: <?php echo e($variante->stock); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['product_variant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Tipo</label>
                            <select name="tipo" class="form-select <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="entrada" <?php if(old('tipo') == 'entrada'): echo 'selected'; endif; ?>>Entrada</option>
                                <option value="salida" <?php if(old('tipo') == 'salida'): echo 'selected'; endif; ?>>Salida</option>
                            </select>
                            <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Cantidad</label>
                            <input type="number" min="1" name="cantidad" value="<?php echo e(old('cantidad')); ?>"
                                   class="form-control <?php $__errorArgs = ['cantidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <?php $__errorArgs = ['cantidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-ss w-100">Registrar movimiento</button>
                </form>
            </div>

            <div class="tarjeta-kpi">
                <h2 class="h6 mb-3">Últimos movimientos</h2>

                <?php if($movimientosRecientes->isEmpty()): ?>
                    <p class="text-muted small mb-0">Aún no se han registrado movimientos.</p>
                <?php else: ?>
                    <ul class="list-unstyled mb-0" style="font-size:0.85rem;">
                        <?php $__currentLoopData = $movimientosRecientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movimiento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>
                                    <span class="badge <?php echo e($movimiento->tipo === 'entrada' ? 'bg-success' : 'bg-danger'); ?>">
                                        <?php echo e($movimiento->tipo === 'entrada' ? '+' : '-'); ?><?php echo e($movimiento->cantidad); ?>

                                    </span>
                                    <?php echo e($movimiento->variant->product->nombre); ?> (<?php echo e($movimiento->variant->talla); ?>)
                                </span>
                                <span class="text-muted"><?php echo e($movimiento->created_at->diffForHumans()); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Administrator\ss_shop\resources\views/admin/stock/index.blade.php ENDPATH**/ ?>