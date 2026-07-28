@extends('layouts.admin')

@section('titulo', 'Editar categoría — Panel admin')

@section('contenido')

    <h1 class="fuente-display mb-4" style="font-size:2rem;">Editar categoría</h1>

    <div class="tarjeta-kpi" style="max-width:520px;">
        <form method="POST" action="{{ route('admin.categorias.update', $categoria) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $categoria->nombre) }}"
                       class="form-control @error('nombre') is-invalid @enderror" required autofocus>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-ss">Guardar cambios</button>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>

@endsection
