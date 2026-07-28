<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'SS Shop')</title>

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
            background-color: var(--ink);
            color: var(--ink);
            font-family: 'Work Sans', sans-serif;
            min-height: 100vh;
        }

        .fuente-display {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 0.05em;
        }

        .fuente-mono {
            font-family: 'Space Mono', monospace;
        }

        .contenedor-auth {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .tarjeta-auth {
            background: var(--paper);
            border-radius: 6px;
            width: 100%;
            max-width: 440px;
            padding: 2.5rem;
            box-shadow: 0 20px 50px rgba(0,0,0,0.35);
        }

        .marca-auth {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            letter-spacing: 0.08em;
            color: var(--ink);
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .marca-auth span {
            color: var(--gold);
        }

        .form-label {
            font-family: 'Space Mono', monospace;
            font-size: 0.78rem;
            text-transform: uppercase;
            color: var(--denim);
        }

        .form-control:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 0.2rem rgba(184, 134, 60, 0.25);
        }

        .btn-ss {
            background-color: var(--ink);
            color: var(--paper);
            font-weight: 600;
            border: none;
        }

        .btn-ss:hover {
            background-color: var(--gold);
            color: var(--ink);
        }

        .enlace-ss {
            color: var(--denim);
            font-size: 0.9rem;
        }

        .enlace-ss:hover {
            color: var(--gold);
        }
    </style>
</head>
<body>
    <div class="contenedor-auth">
        <div class="tarjeta-auth">
            <a href="{{ route('inicio') }}" class="marca-auth">SS <span>SHOP</span></a>

            @yield('contenido')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>