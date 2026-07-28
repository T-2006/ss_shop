<?php $__env->startSection('titulo', 'SS Shop — Ropa y accesorios'); ?>

<?php $__env->startPush('estilos'); ?>
<style>
    /* Hero */
    .hero-ss {
        background-color: var(--ink);
        color: var(--paper);
        padding: 4.5rem 0 3.5rem;
        position: relative;
        overflow: hidden;
    }

    .hero-ss h1 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: clamp(3rem, 9vw, 6.5rem);
        line-height: 0.95;
        letter-spacing: 0.01em;
    }

    .hero-ss .acento {
        color: var(--gold);
    }

    .hero-ss p {
        max-width: 32rem;
        color: var(--cream);
    }

    /* Chips de categoría (como muestras de tela) */
    .chip-categoria {
        border: 1px solid var(--denim);
        background: transparent;
        color: var(--paper);
        border-radius: 999px;
        padding: 0.4rem 1rem;
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
        text-transform: uppercase;
        transition: all .15s ease;
    }

    .chip-categoria:hover,
    .chip-categoria.activo {
        background-color: var(--gold);
        border-color: var(--gold);
        color: var(--ink);
    }

    /* Tarjeta de producto */
    .tarjeta-producto {
        background: #fff;
        border: 1px solid #E4DFD3;
        border-radius: 4px;
        position: relative;
        margin-top: 18px;
    }

    .tarjeta-producto__imagen {
        height: 190px;
        background-color: var(--cream);
        border-bottom: 1px solid #E4DFD3;
    }

    /* Etiqueta de precio, estilo tag colgante de ropa */
    .etiqueta-precio {
        position: absolute;
        top: -16px;
        right: 18px;
        background: var(--cream);
        border: 1px solid var(--ink);
        border-radius: 3px;
        padding: 5px 12px;
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--ink);
        transform: rotate(4deg);
        box-shadow: 1px 2px 0 rgba(0,0,0,0.15);
        z-index: 2;
    }

    .etiqueta-precio::before {
        content: '';
        position: absolute;
        top: 5px;
        left: -4px;
        width: 8px;
        height: 8px;
        background: var(--paper);
        border: 1px solid var(--ink);
        border-radius: 50%;
    }

    .talla-badge {
        border: 1px solid var(--denim);
        color: var(--denim);
        font-family: 'Space Mono', monospace;
        font-size: 0.72rem;
        padding: 2px 8px;
        border-radius: 999px;
    }

    .seccion-catalogo {
        padding: 3rem 0 4rem;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('contenido'); ?>

    <section class="hero-ss">
        <div class="container">
            <p class="fuente-mono mb-2" style="color: var(--gold); letter-spacing: 0.15em; font-size: 0.8rem;">SS SHOP · COLECCIÓN ACTUAL</p>
            <h1>VISTE LO QUE<br><span class="acento">TE REPRESENTA</span></h1>
            <p class="mt-3 mb-4">Ropa y accesorios seleccionados con precios claros y tallas disponibles a la vista. Sin registrarte, sin vueltas: mira, compara y elige.</p>

            <?php if($categorias->count()): ?>
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <button type="button" class="chip-categoria activo" data-filtro="todos">Todos</button>
                    <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" class="chip-categoria" data-filtro="<?php echo e($categoria->slug); ?>"><?php echo e($categoria->nombre); ?></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="seccion-catalogo">
        <div class="container">
            <?php if($productos->isEmpty()): ?>
                <div class="text-center py-5">
                    <h2 class="fuente-display" style="font-size:2rem;">Aún no hay productos publicados</h2>
                    <p class="text-muted">En cuanto se agreguen productos desde el panel de administración, aparecerán aquí.</p>
                </div>
            <?php else: ?>
                <div class="row g-4" id="listaProductos">
                    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('partials.tarjeta-producto', ['producto' => $producto], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chips = document.querySelectorAll('.chip-categoria');
        const items = document.querySelectorAll('.producto-item');

        chips.forEach(function (chip) {
            chip.addEventListener('click', function () {
                chips.forEach(c => c.classList.remove('activo'));
                chip.classList.add('activo');

                const filtro = chip.dataset.filtro;

                items.forEach(function (item) {
                    if (filtro === 'todos' || item.dataset.categoria === filtro) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.plantilla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Administrator\ss_shop\resources\views/inicio.blade.php ENDPATH**/ ?>