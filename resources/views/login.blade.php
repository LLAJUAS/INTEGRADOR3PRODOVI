<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODOVI - Login & Registro</title>
    <!-- Google Fonts profesionales -->
     <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('a.css.login.login')
    @include('a.js.login.login')
   
</head>
<body style="height: 95vh;">
    <div class="grid-pattern"></div>
    
    <!-- Elementos flotantes decorativos -->
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    
    <!-- Botón de volver atrás -->
    <a href="{{ url()->previous() }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
    
    <div style="margin-top: 300px" class="auth-container">
        <div class="auth-header">
            <div class="logo">
                 <img src="{{ asset('imagenes/logoblanco.png') }}" alt="PRODOVI Logo" >
            </div>
            <h2 class="auth-title" id="form-title">Iniciar Sesión</h2>
            <p class="auth-subtitle" id="form-subtitle">Accede a tu cuenta para continuar</p>
        </div>

        <div class="form-container">
           <!-- Formulario de Login -->
<form class="form" id="login-form" method="POST" action="{{ route('login.post') }}">
    @csrf
    <a href="{{ route('auth.google.redirect') }}" class="btn btn-google" id="google-login">
        Continuar con Google
    </a>
    
    <div class="divider">
        <span>o continúa con email</span>
    </div>

    <div class="input-group">
        <label class="input-label" for="login-email">Email</label>
        <input type="email" class="input-field" id="login-email" name="email" placeholder="tu@email.com" required>
    </div>

    <div class="input-group password-group">
        <label class="input-label" for="login-password">Contraseña</label>
        <div class="password-input-wrapper">
            <input type="password" class="input-field" id="login-password" name="password" placeholder="••••••••" required>
            <i class="fas fa-eye toggle-password" toggle="#login-password"></i>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        Iniciar Sesión
    </button>

    <div class="form-switch">
        <p>¿No tienes una cuenta?</p>
        <a href="#" class="switch-link" id="show-register">Crear cuenta nueva</a>
    </div>
</form>

<!-- Formulario de Registro -->
<form class="form hidden" id="register-form" method="POST" action="{{ route('register') }}">
    @csrf
    <a href="{{ route('auth.google.redirect') }}" class="btn btn-google" id="google-register">
        Registrarse con Google
    </a>
    
    <div class="divider">
        <span>o regístrate con email</span>
    </div>

    <div class="input-group">
        <label class="input-label" for="register-name">Nombre completo</label>
        <input type="text" class="input-field" id="register-name" name="name" placeholder="Tu nombre completo" required>
    </div>

    <div class="input-group">
        <label class="input-label" for="register-email">Email</label>
        <input type="email" class="input-field" id="register-email" name="email" placeholder="tu@email.com" required>
    </div>

    <div class="input-group">
        <label class="input-label" for="register-phone">Número de celular</label>
        <input type="tel" class="input-field" id="register-phone" name="phone" placeholder="+591 6239...." required>
    </div>

    <div class="input-group password-group">
        <label class="input-label" for="register-password">Contraseña</label>
        <div class="password-input-wrapper">
            <input type="password" class="input-field" id="register-password" name="password" placeholder="••••••••" required>
            <i class="fas fa-eye toggle-password" toggle="#register-password"></i>
        </div>
    </div>

    <div class="input-group password-group">
        <label class="input-label" for="register-password-confirm">Confirmar Contraseña</label>
        <div class="password-input-wrapper">
            <input type="password" class="input-field" id="register-password-confirm" name="password_confirmation" placeholder="••••••••" required>
            <i class="fas fa-eye toggle-password" toggle="#register-password-confirm"></i>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        Crear Cuenta
    </button>

    <div class="form-switch">
        <p>¿Ya tienes una cuenta?</p>
        <a href="#" class="switch-link" id="show-login">Iniciar sesión</a>
    </div>
</form>
        </div>
    </div>

    
</body>
</html>