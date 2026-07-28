<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Panel') - Salón Blanco y Negro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-pink-50 min-h-screen font-sans text-gray-800">

    <div class="flex min-h-screen">

        <!-- Barra lateral -->
        <aside class="w-64 bg-white/90 border-r border-pink-100 flex flex-col">
            <div class="px-6 py-6 border-b border-pink-100">
                <h1 class="text-xl font-bold text-salon-dark" style="font-family: 'Playfair Display', serif;">Blanco y Negro</h1>
                <p class="text-xs text-gray-500 mt-1">Panel de Gestión</p>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1">
                @auth
                    @if(auth()->user()->rol === 'admin')
                        <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-salon-dark hover:bg-pink-50">Inicio</a>
                        <a href="{{ route('admin.productos.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-salon-dark hover:bg-pink-50">Productos</a>
                        <a href="{{ route('admin.banners.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-salon-dark hover:bg-pink-50">Carrusel / Promociones</a>
                        <a href="{{ route('admin.servicios.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-salon-dark hover:bg-pink-50">Servicios</a>
                        <a href="{{ route('admin.citas.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-salon-dark hover:bg-pink-50">Citas</a>
                        <a href="{{ route('admin.tarifas.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-salon-dark hover:bg-pink-50">Tarifas de envío</a>
                        <a href="{{ route('admin.reportes.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-salon-dark hover:bg-pink-50">Reportes de pedidos</a>
                        <a href="{{ route('admin.usuarios.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-salon-dark hover:bg-pink-50">Usuarios</a>
                    @elseif(auth()->user()->rol === 'empleado')
                        <a href="{{ route('empleado.citas.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-salon-dark hover:bg-pink-50">Mi agenda</a>
                        <a href="{{ route('empleado.trabajos.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-salon-dark hover:bg-pink-50">Mi portafolio</a>
                    @elseif(auth()->user()->rol === 'bodega')
                        <a href="{{ route('bodega.dashboard') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-salon-dark hover:bg-pink-50">Panel de bodega</a>
                        <a href="{{ route('admin.productos.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-salon-dark hover:bg-pink-50">Productos</a>
                    @else
                        <a href="{{ url('/mi-perfil') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-salon-dark hover:bg-pink-50">Mi perfil</a>
                    @endif
                @endauth
            </nav>

            <div class="px-4 py-4 border-t border-pink-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-rose-700 hover:bg-rose-50">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        <!-- Contenido principal -->
        <div class="flex-1 flex flex-col">

            <header class="bg-white/90 border-b border-pink-100 px-8 py-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-700">@yield('titulo', 'Panel')</h2>
                @auth
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                        <span class="text-xs px-2 py-1 rounded-full bg-pink-100 text-salon-dark font-medium capitalize">
                            {{ auth()->user()->rol }}
                        </span>
                    </div>
                @endauth
            </header>

            <main class="flex-1 p-8">
                @yield('contenido')
            </main>

        </div>
    </div>

</body>
</html>