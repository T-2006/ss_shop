@extends('layouts.admin')

@section('titulo', 'Resumen — Panel admin')

@section('contenido')

    <h1 class="fuente-display mb-4" style="font-size:2rem;">Resumen general</h1>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="tarjeta-kpi">
                <p class="fuente-mono mb-1" style="font-size:0.75rem; color: var(--gold);">PRODUCTOS</p>
                <div class="valor">{{ $totalProductos }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="tarjeta-kpi">
                <p class="fuente-mono mb-1" style="font-size:0.75rem; color: var(--gold);">CATEGORÍAS</p>
                <div class="valor">{{ $totalCategorias }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="tarjeta-kpi">
                <p class="fuente-mono mb-1" style="font-size:0.75rem; color: var(--gold);">VARIANTES</p>
                <div class="valor">{{ $totalVariantes }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="tarjeta-kpi">
                <p class="fuente-mono mb-1" style="font-size:0.75rem; color: var(--gold);">UNIDADES EN STOCK</p>
                <div class="valor">{{ $stockTotal }}</div>
            </div>
        </div>
    </div>

    <div class="tarjeta-kpi">
        <h2 class="h6 mb-3">Variantes con stock bajo (≤ 5 unidades)</h2>

        @if ($variantesBajoStock->isEmpty())
            <p class="text-muted mb-0">Ninguna variante está por debajo del umbral. Todo en orden.</p>
        @else
            <table class="table table-sm align-middle mb-0">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Talla / Color</th>
                        <th>Stock</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($variantesBajoStock as $variante)
                        <tr>
                            <td>{{ $variante->product->nombre }}</td>
                            <td>{{ $variante->talla }} @if($variante->color) / {{ $variante->color }} @endif</td>
                            <td>
                                <span class="badge {{ $variante->stock == 0 ? 'bg-danger' : 'bg-warning text-dark' }}">
                                    {{ $variante->stock }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.stock.index') }}" class="small">Reabastecer</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection
