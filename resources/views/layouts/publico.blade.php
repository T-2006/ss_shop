<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Blanco y Negro - Salón de Belleza')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 (solo en las vistas públicas) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --salon-dark: #9d174d;
            --salon-accent: #db2777;
        }
        body {
            font-family: 'Poppins', sans-serif;
            color: #374151;
        }
        .fuente-titulo { font-family: 'Playfair Display', serif; }
        .btn-salon {
            background-color: var(--salon-accent);
            border-color: var(--salon-accent);
            color: #fff;
        }
        .btn-salon:hover {
            background-color: var(--salon-dark);
            border-color: var(--salon-dark);
            color: #fff;
        }
        .btn-salon-outline {
            border: 2px solid var(--salon-accent);
            color: var(--salon-accent);
            background: transparent;
        }
        .btn-salon-outline:hover {
            background-color: var(--salon-accent);
            color: #fff;
        }
        .texto-salon-dark { color: var(--salon-dark); }
        .texto-salon-accent { color: var(--salon-accent); }

        .navbar-salon {
            background-color: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid #fce7f3;
        }
        .navbar-salon .nav-link {
            color: #6b7280;
            font-weight: 500;
        }
        .navbar-salon .nav-link.active,
        .navbar-salon .nav-link:hover {
            color: var(--salon-accent);
        }

        .card-producto, .card-servicio {
            border: 1px solid #fce7f3;
            border-radius: 1rem;
            overflow: hidden;
            transition: transform .2s ease;
            height: 100%;
        }
        .card-producto:hover, .card-servicio:hover {
            transform: translateY(-4px);
        }
        .card-producto .card-img-top, .card-servicio .card-img-top {
            height: 220px;
            object-fit: cover;
            background-color: #fdf2f8;
        }
        .precio-tachado {
            text-decoration: line-through;
            color: #9ca3af;
            font-size: .85rem;
        }
        .badge-promo { background-color: var(--salon-accent); }

        footer {
            background-color: #fff;
            border-top: 1px solid #fce7f3;
        }
    </style>

    @stack('estilos')
</head>
<body>

    <!-- Header / navbar -->
    <nav class="navbar navbar-expand-md navbar-salon sticky-top py-3">
        <div class="container">
            <a class="navbar-brand fuente-titulo fw-bold texto-salon-dark" href="{{ route('home') }}">
                Blanco y Negro
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navSalon">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navSalon">
                <ul class="navbar-nav mx-auto gap-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('catalogo.productos') ? 'active' : '' }}" href="{{ route('catalogo.productos') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('catalogo.servicios*') ? 'active' : '' }}" href="{{ route('catalogo.servicios') }}">Servicios</a>
                    </li>
                </ul>
                <a href="{{ route('login') }}" class="btn btn-salon rounded-pill px-4 fw-semibold">
                    Iniciar sesión
                </a>
            </div>
        </div>
    </nav>

    @yield('contenido')

    <footer class="py-4 text-center small text-muted">
        &copy; {{ date('Y') }} Blanco y Negro — Salón de Belleza
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
