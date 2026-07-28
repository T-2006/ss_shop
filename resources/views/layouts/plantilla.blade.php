<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'SS Shop')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tipografías -->
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
            background-color: var(--paper);
            color: var(--ink);
            font-family: 'Work Sans', sans-serif;
        }

        .fuente-display {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 0.03em;
        }

        .fuente-mono {
            font-family: 'Space Mono', monospace;
        }

        .navbar-ss {
            background-color: var(--ink);
            border-bottom: 3px solid var(--gold);
        }

        .navbar-ss .navbar-brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.8rem;
            letter-spacing: 0.08em;
            color: var(--paper) !important;
        }

        .navbar-ss .nav-link {
            color: var(--paper) !important;
            font-size: 0.95rem;
        }

        .navbar-ss .nav-link:hover {
            color: var(--gold) !important;
        }

        footer {
            background-color: var(--ink);
            color: var(--cream);
        }
    </style>

    @stack('estilos')
</head>
<body>

    <nav class="navbar navbar-ss navbar-expand-lg py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('inicio') }}">SS SHOP</a>

            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('inicio') }}">Inicio</a>
                    </li>

                    @auth
                        @if (auth()->user()->isAdmin() && Route::has('admin.inicio'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.inicio') }}">Panel admin</a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <span class="nav-link fuente-mono" style="font-size:0.8rem; opacity:0.85;">
                                Hola, {{ explode(' ', auth()->user()->name)[0] }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-sm px-3" style="background-color: var(--gold); color: var(--ink); font-weight:600; border:none;">
                                    Cerrar sesión
                                </button>
                            </form>
                        </li>
                    @else
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm px-3" style="background-color: var(--gold); color: var(--ink); font-weight:600;" href="{{ route('register') }}">Registrarse</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('contenido')
    </main>

    <footer class="py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0 fuente-mono" style="font-size: 0.8rem;">&copy; {{ date('Y') }} SS Shop — Ropa y accesorios</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
