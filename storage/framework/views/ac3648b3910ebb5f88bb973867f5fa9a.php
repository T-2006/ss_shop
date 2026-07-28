<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('titulo', 'Panel de administración — SS Shop'); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Work+Sans:wght@400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #201D1A;
            --paper: #F7F4EE;
            --gold: #B8863B;
            --denim: #2E3A4E;
            --cream: #EFE7D6;
            --rust: #8C3F2B;
        }

        body {
            background-color: #EFEDE7;
            color: var(--ink);
            font-family: 'Work Sans', sans-serif;
        }

        .fuente-display { font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.04em; }
        .fuente-mono { font-family: 'Space Mono', monospace; }

        .barra-admin {
            width: 240px;
            min-height: 100vh;
            background-color: var(--ink);
            color: var(--cream);
        }

        .barra-admin .marca {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.6rem;
            letter-spacing: 0.08em;
            color: var(--paper);
        }

        .barra-admin a {
            color: var(--cream);
            text-decoration: none;
            display: block;
            padding: 0.6rem 1.2rem;
            border-radius: 4px;
            font-size: 0.92rem;
        }

        .barra-admin a:hover,
        .barra-admin a.activo {
            background-color: rgba(184,134,60,0.18);
            color: var(--gold);
        }

        .contenido-admin {
            flex: 1;
            padding: 2rem;
        }

        .tarjeta-kpi {
            background: #fff;
            border-radius: 6px;
            border: 1px solid #E4DFD3;
            padding: 1.2rem;
        }

        .tarjeta-kpi .valor {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.2rem;
            color: var(--ink);
        }

        .btn-ss {
            background-color: var(--ink);
            color: var(--paper);
            border: none;
            font-weight: 600;
        }

        .btn-ss:hover { background-color: var(--gold); color: var(--ink); }

        table thead th {
            font-family: 'Space Mono', monospace;
            font-size: 0.72rem;
            text-transform: uppercase;
            color: var(--denim);
            border-bottom-width: 2px;
        }

        /* Paginación propia (no depende de las vistas de paginación de Laravel) */
        .paginacion-ss .pagination {
            flex-wrap: wrap;
            gap: 4px;
            margin-bottom: 0;
        }

        .paginacion-ss .page-link {
            padding: 0.35rem 0.65rem;
            border-radius: 4px !important;
            font-size: 0.85rem;
            color: var(--denim);
            border-color: #E4DFD3;
            background-color: #fff;
        }

        .paginacion-ss .page-item.active .page-link {
            background-color: var(--ink);
            border-color: var(--ink);
            color: var(--paper);
        }

        .paginacion-ss .page-item.disabled .page-link {
            color: #B8B2A4;
            background-color: #F7F4EE;
        }
    </style>

    <?php echo $__env->yieldPushContent('estilos'); ?>
</head>
<body>
    <div class="d-flex">
        <aside class="barra-admin p-3">
            <a href="<?php echo e(route('admin.inicio')); ?>" class="marca d-block mb-4">SS SHOP · ADMIN</a>

            <nav class="d-flex flex-column gap-1">
                <a href="<?php echo e(route('admin.inicio')); ?>" class="<?php echo e(request()->routeIs('admin.inicio') ? 'activo' : ''); ?>">Resumen</a>
                <a href="<?php echo e(route('admin.productos.index')); ?>" class="<?php echo e(request()->routeIs('admin.productos.*') ? 'activo' : ''); ?>">Productos</a>
                <a href="<?php echo e(route('admin.categorias.index')); ?>" class="<?php echo e(request()->routeIs('admin.categorias.*') ? 'activo' : ''); ?>">Categorías</a>
                <a href="<?php echo e(route('admin.stock.index')); ?>" class="<?php echo e(request()->routeIs('admin.stock.*') ? 'activo' : ''); ?>">Control de stock</a>

                <hr style="border-color: rgba(255,255,255,0.1);">

                <a href="<?php echo e(route('inicio')); ?>">Ver tienda pública</a>

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-100 text-start" style="background:none;border:none;padding:0.6rem 1.2rem;color:var(--cream);">
                        Cerrar sesión
                    </button>
                </form>
            </nav>
        </aside>

        <main class="contenido-admin">
            <?php if(session('mensaje')): ?>
                <div class="alert alert-success"><?php echo e(session('mensaje')); ?></div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('contenido'); ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\Administrator\ss_shop\resources\views/layouts/admin.blade.php ENDPATH**/ ?>