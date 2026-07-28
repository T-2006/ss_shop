@extends('layouts.admin')

@section('titulo', 'Productos — Panel admin')

@section('contenido')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fuente-display mb-0" style="font-size:2rem;">Productos</h1>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-ss">+ Nuevo producto</a>
    </div>

    <form method="GET" class="mb-3" style="max-width:360px;">
        <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control"
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
                @forelse ($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->category->nombre }}</td>
                        <td class="fuente-mono text-muted">{{ $producto->sku }}</td>
                        <td>${{ number_format($producto->precio, 0, ',', '.') }}</td>
                        <td>{{ $producto->variants->sum('stock') }}</td>
                        <td>
                            @if ($producto->activo)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                            <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar este producto y todas sus variantes?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No se encontraron productos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        @include('admin.partials.paginacion', ['paginador' => $productos])
    </div>

@endsection
