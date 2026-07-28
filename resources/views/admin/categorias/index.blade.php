@extends('layouts.admin')

@section('titulo', 'Categorías — Panel admin')

@section('contenido')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fuente-display mb-0" style="font-size:2rem;">Categorías</h1>
        <a href="{{ route('admin.categorias.create') }}" class="btn btn-ss">+ Nueva categoría</a>
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
                @forelse ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nombre }}</td>
                        <td class="fuente-mono text-muted">{{ $categoria->slug }}</td>
                        <td>{{ $categoria->products_count }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.categorias.edit', $categoria) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                            <form action="{{ route('admin.categorias.destroy', $categoria) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar esta categoría?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Aún no hay categorías creadas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
