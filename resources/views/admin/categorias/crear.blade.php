@extends('layouts.admin')

@section('titulo', 'Nueva categoría — Panel admin')

@section('contenido')

    <h1 class="fuente-display mb-4" style="font-size:2rem;">Nueva categoría</h1>

    <div class="tarjeta-kpi" style="max-width:520px;">
        <form method="POST" action="{{ route('admin.categorias.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}"
                       class="form-control @error('nombre') is-invalid @enderror" required autofocus>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-ss">Guardar categoría</button>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>

@endsection
