@extends('layouts.invitado')

@section('titulo', 'Crear cuenta — SS Shop')

@section('contenido')

    <h1 class="h4 mb-1">Crea tu cuenta</h1>
    <p class="text-muted mb-4" style="font-size:0.9rem;">Regístrate para comprar y recibir promociones.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre completo</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror"
                   required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono (opcional)</label>
            <input id="telefono" type="text" name="telefono" value="{{ old('telefono') }}"
                   class="form-control @error('telefono') is-invalid @enderror"
                   autocomplete="tel">
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="form-control" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-ss w-100 py-2">Crear cuenta</button>
    </form>

    <p class="text-center mt-4 mb-0" style="font-size:0.9rem;">
        ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="enlace-ss fw-semibold">Inicia sesión</a>
    </p>

@endsection
