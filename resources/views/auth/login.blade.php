@extends('layouts.invitado')

@section('titulo', 'Iniciar sesión — SS Shop')

@section('contenido')

    <h1 class="h4 mb-1">Inicia sesión</h1>
    <p class="text-muted mb-4" style="font-size:0.9rem;">Ingresa tus datos para continuar comprando.</p>

    @if (session('status'))
        <div class="alert alert-success py-2" style="font-size:0.85rem;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember" style="font-size:0.9rem;">
                    Recordarme
                </label>
            </div>

            @if (Route::has('password.request'))
                <a class="enlace-ss" href="{{ route('password.request') }}" style="font-size:0.85rem;">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-ss w-100 py-2">Iniciar sesión</button>
    </form>

    @if (Route::has('register'))
        <p class="text-center mt-4 mb-0" style="font-size:0.9rem;">
            ¿No tienes cuenta? <a href="{{ route('register') }}" class="enlace-ss fw-semibold">Regístrate aquí</a>
        </p>
    @endif

@endsection
