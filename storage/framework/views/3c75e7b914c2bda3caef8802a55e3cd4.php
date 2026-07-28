<?php $__env->startSection('titulo', 'Nuevo producto — Panel admin'); ?>

<?php $__env->startSection('contenido'); ?>

    <h1 class="fuente-display mb-4" style="font-size:2rem;">Nuevo producto</h1>

    <div class="tarjeta-kpi" style="max-width:720px;">
        <form method="POST" action="<?php echo e(route('admin.productos.store')); ?>" enctype="multipart/form-data" id="formulario-producto">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select name="category_id" id="selector_categoria" class="form-select <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="">Selecciona una categoría</option>
                    <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($categoria->id); ?>" <?php if(old('category_id') == $categoria->id): echo 'selected'; endif; ?>>
                            <?php echo e($categoria->nombre); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['category_id'];
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

            <div class="mb-3">
                <label class="form-label">Nombre del producto</label>
                <input type="text" name="nombre" value="<?php echo e(old('nombre')); ?>"
                       class="form-control <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <?php $__errorArgs = ['nombre'];
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

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" rows="3" class="form-control"><?php echo e(old('descripcion')); ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">SKU</label>
                    <input type="text" name="sku" id="campo_sku" value="<?php echo e(old('sku')); ?>"
                           class="form-control fuente-mono <?php $__errorArgs = ['sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <?php $__errorArgs = ['sku'];
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
                <div class="col-md-6 mb-3">
                    <label class="form-label">Precio (COP)</label>
                    <input type="number" step="0.01" min="0" name="precio" value="<?php echo e(old('precio')); ?>"
                           class="form-control <?php $__errorArgs = ['precio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <?php $__errorArgs = ['precio'];
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

            <div class="mb-3">
                <label class="form-label">Imagen del producto</label>
                <input type="file" name="imagen" class="form-control <?php $__errorArgs = ['imagen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*">
                <?php $__errorArgs = ['imagen'];
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

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="activo" id="activo" value="1" checked>
                <label class="form-check-label" for="activo">Producto activo (visible en la tienda)</label>
            </div>

            <hr>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label mb-0">Tallas, colores y stock inicial</label>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="boton_agregar_talla">
                        + Agregar talla
                    </button>
                </div>
                <p class="text-muted small mb-3">
                    Opcional: puedes dejarlo vacío y agregar las tallas después desde la pantalla de edición.
                    Selecciona primero una categoría para ver tallas sugeridas.
                </p>

                <div id="contenedor_variantes"></div>

                <template id="plantilla_fila_variante">
                    <div class="row g-2 align-items-end mb-2 fila-variante">
                        <div class="col-6 col-md-3 campo-talla">
                            <label class="form-label small">Talla</label>
                            <select class="form-select form-select-sm selector-talla" required>
                                <option value="">Selecciona categoría primero</option>
                            </select>
                            <input type="text" class="form-control form-control-sm mt-1 talla-otra d-none"
                                   placeholder="Escribe la talla">
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label small">Color</label>
                            <input type="text" class="form-control form-control-sm campo-color">
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="form-label small">Stock</label>
                            <input type="number" min="0" value="0" class="form-control form-control-sm campo-stock">
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label small">SKU variante</label>
                            <input type="text" class="form-control form-control-sm fuente-mono campo-sku-variante"
                                   placeholder="Automático si se deja vacío">
                        </div>
                        <div class="col-12 col-md-1 text-end">
                            <button type="button" class="btn btn-sm btn-outline-danger btn-quitar-variante" title="Quitar talla">✕</button>
                        </div>
                    </div>
                </template>
            </div>

            <button type="submit" class="btn btn-ss">Crear producto</button>
            <a href="<?php echo e(route('admin.productos.index')); ?>" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Tallas sugeridas por categoría (id de categoría => lista de tallas)
    const tallasPorCategoria = <?php echo json_encode($tallasPorCategoria, 15, 512) ?>;

    const contenedorVariantes = document.getElementById('contenedor_variantes');
    const plantillaFila = document.getElementById('plantilla_fila_variante');
    const selectorCategoria = document.getElementById('selector_categoria');
    const botonAgregarTalla = document.getElementById('boton_agregar_talla');

    let contadorVariantes = 0;

    function opcionesTallaActual() {
        const idCategoria = selectorCategoria.value;
        return tallasPorCategoria[idCategoria] || [];
    }

    function poblarSelectorTalla(select) {
        const tallas = opcionesTallaActual();
        const valorPrevio = select.value;

        select.innerHTML = '';

        if (tallas.length === 0) {
            const opcionVacia = document.createElement('option');
            opcionVacia.value = '';
            opcionVacia.textContent = 'Selecciona categoría primero';
            select.appendChild(opcionVacia);
            return;
        }

        const opcionInicial = document.createElement('option');
        opcionInicial.value = '';
        opcionInicial.textContent = 'Selecciona...';
        select.appendChild(opcionInicial);

        tallas.forEach(function (talla) {
            const opcion = document.createElement('option');
            opcion.value = talla;
            opcion.textContent = talla;
            select.appendChild(opcion);
        });

        const opcionOtra = document.createElement('option');
        opcionOtra.value = '__otra__';
        opcionOtra.textContent = 'Otra (especificar)...';
        select.appendChild(opcionOtra);

        // Si la talla que ya tenía seleccionada sigue siendo válida, la conserva
        if (tallas.includes(valorPrevio)) {
            select.value = valorPrevio;
        }
    }

    function manejarSelectorTallaDinamico(select) {
        const contenedor = select.closest('.campo-talla');
        const input = contenedor.querySelector('.talla-otra');

        if (select.value === '__otra__') {
            input.classList.remove('d-none');
            input.focus();
        } else {
            input.classList.add('d-none');
            input.value = '';
        }
    }

    function agregarFilaVariante() {
        const fragmento = plantillaFila.content.cloneNode(true);
        const fila = fragmento.querySelector('.fila-variante');
        const selectTalla = fila.querySelector('.selector-talla');

        poblarSelectorTalla(selectTalla);

        selectTalla.addEventListener('change', function () {
            manejarSelectorTallaDinamico(selectTalla);
        });

        fila.querySelector('.btn-quitar-variante').addEventListener('click', function () {
            fila.remove();
        });

        contenedorVariantes.appendChild(fragmento);
        contadorVariantes++;
    }

    // Cuando cambia la categoría, actualiza las opciones de todas las filas ya agregadas
    selectorCategoria.addEventListener('change', function () {
        document.querySelectorAll('.selector-talla').forEach(function (select) {
            poblarSelectorTalla(select);
        });
    });

    botonAgregarTalla.addEventListener('click', agregarFilaVariante);

    // Antes de enviar el formulario, convierte las filas dinámicas en
    // inputs con name="variantes[i][campo]" para que Laravel los reciba como arreglo
    document.getElementById('formulario-producto').addEventListener('submit', function () {
        const filas = contenedorVariantes.querySelectorAll('.fila-variante');

        filas.forEach(function (fila, indice) {
            const selectTalla = fila.querySelector('.selector-talla');
            const inputOtra = fila.querySelector('.talla-otra');
            const valorTalla = selectTalla.value === '__otra__' ? inputOtra.value : selectTalla.value;

            agregarCampoOculto(fila, `variantes[${indice}][talla]`, valorTalla);
            agregarCampoOculto(fila, `variantes[${indice}][color]`, fila.querySelector('.campo-color').value);
            agregarCampoOculto(fila, `variantes[${indice}][stock]`, fila.querySelector('.campo-stock').value);
            agregarCampoOculto(fila, `variantes[${indice}][sku_variante]`, fila.querySelector('.campo-sku-variante').value);
        });
    });

    function agregarCampoOculto(contenedor, nombre, valor) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = nombre;
        input.value = valor;
        contenedor.appendChild(input);
    }

    // Agrega automáticamente una primera fila vacía al cargar la página
    document.addEventListener('DOMContentLoaded', function () {
        agregarFilaVariante();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Administrator\ss_shop\resources\views/admin/productos/crear.blade.php ENDPATH**/ ?>