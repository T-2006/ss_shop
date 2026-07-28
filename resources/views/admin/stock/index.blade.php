@extends('layouts.admin')

@section('titulo', 'Control de stock — Panel admin')

@section('contenido')

    <h1 class="fuente-display mb-4" style="font-size:2rem;">Control de stock</h1>

    <div class="row g-4">
        <div class="col-lg-7">
            <form method="GET" class="mb-3">
                <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control"
                       placeholder="Buscar por producto o SKU de variante...">
            </form>

            <div class="tarjeta-kpi">
                <table class="table table-sm align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Talla / Color</th>
                            <th>SKU variante</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($variantes as $variante)
                            <tr>
                                <td>{{ $variante->product->nombre }}</td>
                                <td>{{ $variante->talla }} @if($variante->color) / {{ $variante->color }} @endif</td>
                                <td class="fuente-mono text-muted">{{ $variante->sku_variante }}</td>
                                <td>
                                    <span class="badge {{ $variante->stock <= 5 ? ($variante->stock == 0 ? 'bg-danger' : 'bg-warning text-dark') : 'bg-success' }}">
                                        {{ $variante->stock }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No se encontraron variantes.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                @include('admin.partials.paginacion', ['paginador' => $variantes])
            </div>
        </div>

        <div class="col-lg-5">
            <div class="tarjeta-kpi mb-4">
                <h2 class="h6 mb-3">Registrar movimiento de stock</h2>

                <form method="POST" action="{{ route('admin.stock.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Variante</label>
                        <select name="product_variant_id" class="form-select @error('product_variant_id') is-invalid @enderror" required>
                            <option value="">Selecciona una variante</option>
                            @foreach ($variantes as $variante)
                                <option value="{{ $variante->id }}" @selected(old('product_variant_id') == $variante->id)>
                                    {{ $variante->product->nombre }} — {{ $variante->talla }}
                                    @if($variante->color) / {{ $variante->color }} @endif
                                    ({{ $variante->sku_variante }}) · stock: {{ $variante->stock }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_variant_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Tipo</label>
                            <select name="tipo" class="form-select @error('tipo') is-invalid @enderror" required>
                                <option value="entrada" @selected(old('tipo') == 'entrada')>Entrada</option>
                                <option value="salida" @selected(old('tipo') == 'salida')>Salida</option>
                            </select>
                            @error('tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Cantidad</label>
                            <input type="number" min="1" name="cantidad" value="{{ old('cantidad') }}"
                                   class="form-control @error('cantidad') is-invalid @enderror" required>
                            @error('cantidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-ss w-100">Registrar movimiento</button>
                </form>
            </div>

            <div class="tarjeta-kpi">
                <h2 class="h6 mb-3">Últimos movimientos</h2>

                @if ($movimientosRecientes->isEmpty())
                    <p class="text-muted small mb-0">Aún no se han registrado movimientos.</p>
                @else
                    <ul class="list-unstyled mb-0" style="font-size:0.85rem;">
                        @foreach ($movimientosRecientes as $movimiento)
                            <li class="d-flex justify-content-between border-bottom py-2">
                                <span>
                                    <span class="badge {{ $movimiento->tipo === 'entrada' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $movimiento->tipo === 'entrada' ? '+' : '-' }}{{ $movimiento->cantidad }}
                                    </span>
                                    {{ $movimiento->variant->product->nombre }} ({{ $movimiento->variant->talla }})
                                </span>
                                <span class="text-muted">{{ $movimiento->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

@endsection
