<!-- resources/views/componentes/navbar.blade.php -->
<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo -->
        <div class="navbar-brand">
            <a href="/">
                <img src="{{ asset('imagenes/logoblanco.png') }}" alt="PRODOVI Logo" class="navbar-logo">
            </a>
        </div>

        <!-- Menú para desktop -->
        <div class="navbar-menu">
            <ul class="navbar-links">
                <li class="navbar-item">
                    <a href="#conocenos" class="navbar-link">Conócenos</a>
                </li>
                <li class="navbar-item">
                    <a href="#proyectos" class="navbar-link">Proyectos</a>
                </li>
                <li class="navbar-item">
                    <a href="#servicios" class="navbar-link">Servicios</a>
                </li>
            </ul>

            <div class="navbar-actions">
                <a href="{{ route('login') }}" class="login-button">
                    Iniciar Sesión
                </a>
            </div>
        </div>

        <!-- Menú móvil (hamburguesa) -->
        <div class="navbar-mobile">
            <button class="mobile-menu-button" id="mobileMenuButton">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <!-- Menú móvil desplegable -->
    <div class="mobile-menu" id="mobileMenu">
        <ul>
            <li><a href="#conocenos">Conócenos</a></li>
            <li><a href="#proyectos">Proyectos</a></li>
            <li><a href="#servicios">Servicios</a></li>
            <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
        </ul>
    </div>
</nav>

<style>
    /* Estilos del Navbar */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        padding: 1rem 2rem;
        transition: all 0.3s ease;
        background: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
    }

    .navbar.scrolled {
        background: rgba(0, 0, 0, 0.9);
        padding: 0.5rem 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .navbar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .navbar-brand img {
        height: 35px;
        width: auto;
    
        transition: all 0.3s ease;
    }

    .navbar.scrolled .navbar-brand img {
        height: 33px;
    }

    .navbar-menu {
        display: flex;
        align-items: center;
    }

    .navbar-links {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .navbar-item {
        margin: 0 1rem;
        position: relative;
    }

    .navbar-link {
        color: white;
        text-decoration: none;
        font-family: "Varela Round", sans-serif;
        font-size: 1rem;
        font-weight: 500;
        padding: 0.5rem 0;
        position: relative;
        transition: all 0.3s ease;
    }

    .navbar-link:after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: #a855f7;
        transition: width 0.3s ease;
    }

    .navbar-link:hover:after {
        width: 100%;
    }

    .navbar-link:hover {
        color: #a855f7;
    }

    .login-button {
        background: linear-gradient(45deg, #a855f7, #3b82f6);
        color: white;
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 25px;
        font-family: "Varela Round", sans-serif;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-left: 1.5rem;
        box-shadow: 0 4px 15px rgba(168, 85, 247, 0.3);
    }

    .login-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(168, 85, 247, 0.4);
    }

    /* Estilos para el menú móvil */
    .navbar-mobile {
        display: none;
    }

    .mobile-menu-button {
        background: transparent;
        border: none;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 24px;
        width: 30px;
        padding: 0;
    }

    .mobile-menu-button span {
        display: block;
        width: 100%;
        height: 3px;
        background: white;
        transition: all 0.3s ease;
    }

    .mobile-menu {
        position: fixed;
        top: 80px;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.95);
        backdrop-filter: blur(10px);
        padding: 1rem 2rem;
        transform: translateY(-150%);
        transition: transform 0.3s ease;
        z-index: 999;
    }

    .mobile-menu.active {
        transform: translateY(0);
    }

    .mobile-menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mobile-menu li {
        margin: 1.5rem 0;
    }

    .mobile-menu a {
        color: white;
        text-decoration: none;
        font-family: "Varela Round", sans-serif;
        font-size: 1.2rem;
        transition: color 0.3s ease;
    }

    .mobile-menu a:hover {
        color: #a855f7;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .navbar {
            padding: 1rem;
        }

        .navbar-menu {
            display: none;
        }

        .navbar-mobile {
            display: block;
        }
    }

    @media (max-width: 768px) {
        .navbar-brand img {
            height: 40px;
        }
    }
</style>

<script>
    // Script para el navbar
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar');
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        // Efecto de scroll
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Menú móvil
        mobileMenuButton.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        });

        // Cerrar menú al hacer clic en un enlace
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenuButton.classList.remove('active');
                mobileMenu.classList.remove('active');
            });
        });
    });
</script>