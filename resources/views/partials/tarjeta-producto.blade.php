@php
    $tallas = $producto->variants->pluck('talla')->unique();
    $stockTotal = $producto->variants->sum('stock');
@endphp

<div class="col-sm-6 col-lg-4 col-xl-3 producto-item" data-categoria="{{ $producto->category->slug }}">
    <div class="tarjeta-producto h-100">

        <div class="etiqueta-precio fuente-mono">
            ${{ number_format($producto->precio, 0, ',', '.') }}
        </div>

        <div class="tarjeta-producto__imagen d-flex align-items-center justify-content-center">
            @if ($producto->imagen)
                <img src="{{ asset('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid">
            @else
                <span class="fuente-display text-uppercase" style="color:#B8B2A4; font-size:1.4rem;">{{ $producto->category->nombre }}</span>
            @endif
        </div>

        <div class="p-3">
            <p class="mb-1 fuente-mono text-uppercase" style="font-size:0.7rem; color: var(--gold);">{{ $producto->category->nombre }}</p>
            <h3 class="h6 mb-2">{{ $producto->nombre }}</h3>

            <div class="d-flex flex-wrap gap-1 mb-2">
                @foreach ($tallas as $talla)
                    <span class="talla-badge">{{ $talla }}</span>
                @endforeach
            </div>

            @if ($stockTotal > 0)
                <p class="mb-0 small text-success">Disponible</p>
            @else
                <p class="mb-0 small text-danger">Agotado</p>
            @endif
        </div>
    </div>
</div>
