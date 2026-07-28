@php
    // $paginador debe ser un objeto paginado (LengthAwarePaginator), ej: $productos, $variantes
    $inicioVentana = max(1, $paginador->currentPage() - 2);
    $finVentana = min($paginador->lastPage(), $paginador->currentPage() + 2);
@endphp

@if ($paginador->hasPages())
    <nav aria-label="Paginación" class="paginacion-ss d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
        <ul class="pagination mb-0">
            {{-- Botón anterior --}}
            <li class="page-item {{ $paginador->onFirstPage() ? 'disabled' : '' }}">
                @if ($paginador->onFirstPage())
                    <span class="page-link">‹ Anterior</span>
                @else
                    <a class="page-link" href="{{ $paginador->previousPageUrl() }}">‹ Anterior</a>
                @endif
            </li>

            {{-- Primera página + puntos suspensivos si hace falta --}}
            @if ($inicioVentana > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $paginador->url(1) }}">1</a>
                </li>
                @if ($inicioVentana > 2)
                    <li class="page-item disabled"><span class="page-link">…</span></li>
                @endif
            @endif

            {{-- Páginas cercanas a la actual --}}
            @for ($pagina = $inicioVentana; $pagina <= $finVentana; $pagina++)
                <li class="page-item {{ $pagina == $paginador->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $paginador->url($pagina) }}">{{ $pagina }}</a>
                </li>
            @endfor

            {{-- Puntos suspensivos + última página si hace falta --}}
            @if ($finVentana < $paginador->lastPage())
                @if ($finVentana < $paginador->lastPage() - 1)
                    <li class="page-item disabled"><span class="page-link">…</span></li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $paginador->url($paginador->lastPage()) }}">{{ $paginador->lastPage() }}</a>
                </li>
            @endif

            {{-- Botón siguiente --}}
            <li class="page-item {{ ! $paginador->hasMorePages() ? 'disabled' : '' }}">
                @if ($paginador->hasMorePages())
                    <a class="page-link" href="{{ $paginador->nextPageUrl() }}">Siguiente ›</a>
                @else
                    <span class="page-link">Siguiente ›</span>
                @endif
            </li>
        </ul>

        <p class="text-muted small mb-0">
            Mostrando {{ $paginador->firstItem() }}–{{ $paginador->lastItem() }} de {{ $paginador->total() }} resultados
        </p>
    </nav>
@endif