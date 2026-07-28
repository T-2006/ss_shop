@extends('layouts.admin')

@section('titulo', 'Editar producto — Panel admin')

@section('contenido')

    <h1 class="fuente-display mb-4" style="font-size:2rem;">Editar producto</h1>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="tarjeta-kpi">
                <h2 class="h6 mb-3">Datos del producto</h2>

                <form method="POST" action="{{ route('admin.productos.update', $producto) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" @selected(old('category_id', $producto->category_id) == $categoria->id)>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre del producto</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}"
                               class="form-control @error('nombre') is-invalid @enderror" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" rows="3" class="form-control">{{ old('descripcion', $producto->descripcion) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" value="{{ old('sku', $producto->sku) }}"
                                   class="form-control fuente-mono @error('sku') is-invalid @enderror" required>
                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Precio (COP)</label>
                            <input type="number" step="0.01" min="0" name="precio" value="{{ old('precio', $producto->precio) }}"
                                   class="form-control @error('precio') is-invalid @enderror" required>
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        @if ($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}"
                                 style="max-width:120px; border-radius:4px;" class="mb-2 d-block">
                        @endif
                        <label class="form-label">Cambiar imagen</label>
                        <input type="file" name="imagen" class="form-control @error('imagen') is-invalid @enderror" accept="image/*">
                        @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="activo" id="activo" value="1"
                               @checked(old('activo', $producto->activo))>
                        <label class="form-check-label" for="activo">Producto activo (visible en la tienda)</label>
                    </div>

                    <button type="submit" class="btn btn-ss">Guardar cambios</button>
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-outline-secondary">Volver</a>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="tarjeta-kpi mb-3">
                <h2 class="h6 mb-3">Tallas, colores y stock</h2>

                @if ($producto->variants->isEmpty())
                    <p class="text-muted small mb-3">Este producto aún no tiene variantes. Agrega la primera abajo.</p>
                @else
                    <table class="table table-sm align-middle">
                        <thead>
                            <tr>
                                <th>Talla</th>
                                <th>Color</th>
                                <th>Stock</th>
                                <th>SKU variante</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($producto->variants as $variante)
                                @php $idFormulario = 'variante-' . $variante->id; @endphp
                                <tr>
                                    <td style="width:18%">
                                        <input form="{{ $idFormulario }}" type="text" name="talla" value="{{ $variante->talla }}" class="form-control form-control-sm" required>
                                    </td>
                                    <td style="width:22%">
                                        <input form="{{ $idFormulario }}" type="text" name="color" value="{{ $variante->color }}" class="form-control form-control-sm">
                                    </td>
                                    <td style="width:15%">
                                        <input form="{{ $idFormulario }}" type="number" min="0" name="stock" value="{{ $variante->stock }}" class="form-control form-control-sm">
                                    </td>
                                    <td style="width:30%">
                                        <input form="{{ $idFormulario }}" type="text" name="sku_variante" value="{{ $variante->sku_variante }}" class="form-control form-control-sm fuente-mono">
                                    </td>
                                    <td class="text-end" style="white-space:nowrap;">
                                        <button form="{{ $idFormulario }}" type="submit" class="btn btn-sm btn-outline-secondary">Guardar</button>
                                        <button form="eliminar-{{ $idFormulario }}" type="submit" class="btn btn-sm btn-outline-danger">✕</button>
                                    </td>
                                </tr>

                                <!-- Formularios reales, fuera de la tabla, vinculados por el atributo form= -->
                                <form id="{{ $idFormulario }}" action="{{ route('admin.productos.variantes.update', [$producto, $variante]) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('PUT')
                                </form>
                                <form id="eliminar-{{ $idFormulario }}" action="{{ route('admin.productos.variantes.destroy', [$producto, $variante]) }}" method="POST" class="d-none"
                                      onsubmit="return confirm('¿Eliminar esta variante?');">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="tarjeta-kpi">
                <h2 class="h6 mb-3">Agregar nueva variante</h2>

                @php
                    $tallasSugeridas = \App\Support\Tallas::porCategoria($producto->category->slug);
                @endphp

                <form action="{{ route('admin.productos.variantes.store', $producto) }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col-6 col-md-3 campo-talla">
                            <label class="form-label small">Talla</label>
                            <select name="talla" class="form-select form-select-sm"
                                    onchange="manejarSelectorTalla(this)" required>
                                <option value="">Selecciona...</option>
                                @foreach ($tallasSugeridas as $talla)
                                    <option value="{{ $talla }}">{{ $talla }}</option>
                                @endforeach
                                <option value="__otra__">Otra (especificar)...</option>
                            </select>
                            <input type="text" class="form-control form-control-sm mt-1 talla-otra d-none"
                                   placeholder="Escribe la talla" disabled>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label small">Color</label>
                            <input type="text" name="color" class="form-control form-control-sm">
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="form-label small">Stock</label>
                            <input type="number" min="0" name="stock" value="0" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label small">SKU variante</label>
                            <input type="text" name="sku_variante" class="form-control form-control-sm fuente-mono" required
                                   placeholder="{{ $producto->sku }}-N">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-ss btn-sm mt-3">+ Agregar variante</button>
                </form>
            </div>

            <script>
                function manejarSelectorTalla(select) {
                    const contenedor = select.closest('.campo-talla');
                    const input = contenedor.querySelector('.talla-otra');

                    if (select.value === '__otra__') {
                        select.removeAttribute('name');
                        input.removeAttribute('disabled');
                        input.name = 'talla';
                        input.classList.remove('d-none');
                        input.required = true;
                        input.focus();
                    } else {
                        input.setAttribute('disabled', 'disabled');
                        input.removeAttribute('name');
                        input.required = false;
                        input.classList.add('d-none');
                        select.setAttribute('name', 'talla');
                    }
                }
            </script>
        </div>
    </div>

@endsection
