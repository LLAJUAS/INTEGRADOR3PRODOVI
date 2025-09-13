document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const formTitle = document.getElementById('form-title');
    const formSubtitle = document.getElementById('form-subtitle');
    const showRegisterLink = document.getElementById('show-register');
    const showLoginLink = document.getElementById('show-login');
    const googleLoginBtn = document.getElementById('google-login');
    const googleRegisterBtn = document.getElementById('google-register');

    // Estado actual del formulario
    let currentForm = 'login';

    // Mostrar errores del servidor si existen
    if (document.querySelector('.error-message') || document.querySelector('.invalid-feedback')) {
        if (window.location.hash === '#register' || 
            document.querySelector('#register-form .invalid-feedback')) {
            switchForm('register');
        } else {
            switchForm('login');
        }
    }

    // Función para cambiar entre formularios
    function switchForm(targetForm) {
        if (currentForm === targetForm) return;

        const currentFormElement = currentForm === 'login' ? loginForm : registerForm;
        const targetFormElement = targetForm === 'login' ? loginForm : registerForm;

        // Animación de salida
        currentFormElement.classList.add('slide-left');
        
        setTimeout(() => {
            currentFormElement.classList.add('hidden');
            currentFormElement.classList.remove('slide-left');
            
            // Mostrar nuevo formulario
            targetFormElement.classList.remove('hidden');
            
            // Actualizar contenido del header
            if (targetForm === 'login') {
                formTitle.textContent = 'Iniciar Sesión';
                formSubtitle.textContent = 'Accede a tu cuenta para continuar';
            } else {
                formTitle.textContent = 'Crear Cuenta';
                formSubtitle.textContent = 'Regístrate para comenzar tu experiencia';
            }
            
            currentForm = targetForm;
        }, 250);
    }

    // Event listeners para cambio de formulario
    showRegisterLink.addEventListener('click', (e) => {
        e.preventDefault();
        switchForm('register');
    });

    showLoginLink.addEventListener('click', (e) => {
        e.preventDefault();
        switchForm('login');
    });

    // Función para validar email
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Función para validar teléfono
    function validatePhone(phone) {
        const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
        return phoneRegex.test(phone.replace(/\s+/g, ''));
    }

    // Función para mostrar error en input
    function showInputError(input, message) {
        const inputGroup = input.closest('.input-group');
        if (!inputGroup) return;

        // Eliminar mensajes de error existentes
        const existingError = inputGroup.querySelector('.error-text');
        if (existingError) {
            existingError.remove();
        }

        // Crear y mostrar nuevo mensaje de error
        const errorText = document.createElement('p');
        errorText.className = 'error-text';
        errorText.textContent = message;
        inputGroup.appendChild(errorText);

        input.classList.add('input-error');
        setTimeout(() => {
            input.classList.remove('input-error');
        }, 3000);
    }

    // Función para mostrar mensaje de éxito
    function showSuccessMessage(form, message) {
        const existingMessage = form.querySelector('.success-message');
        if (existingMessage) {
            existingMessage.remove();
        }

        const successDiv = document.createElement('div');
        successDiv.className = 'success-message';
        successDiv.textContent = message;
        form.insertBefore(successDiv, form.firstChild);

        setTimeout(() => {
            successDiv.remove();
        }, 5000);
    }

    // Función para simular carga en botón
    function setButtonLoading(button, isLoading) {
        if (isLoading) {
            button.classList.add('btn-loading');
            button.disabled = true;
        } else {
            button.classList.remove('btn-loading');
            button.disabled = false;
        }
    }

    // Script para el ojito de contraseña
    const togglePassword = document.querySelectorAll('.toggle-password');
    
    togglePassword.forEach(icon => {
        icon.addEventListener('click', function() {
            const passwordInput = document.querySelector(this.getAttribute('toggle'));
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Cambiar el ícono
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });

    // Validación en tiempo real para el formulario de login
    if (loginForm) {
        const loginEmail = document.getElementById('login-email');
        const loginPassword = document.getElementById('login-password');

        loginEmail.addEventListener('blur', () => {
            if (loginEmail.value && !validateEmail(loginEmail.value)) {
                showInputError(loginEmail, 'Email inválido');
            }
        });

        loginPassword.addEventListener('blur', () => {
            if (loginPassword.value && loginPassword.value.length < 6) {
                showInputError(loginPassword, 'Mínimo 6 caracteres');
            }
        });
    }

    // Validación en tiempo real para el formulario de registro
    if (registerForm) {
        const registerName = document.getElementById('register-name');
        const registerEmail = document.getElementById('register-email');
        const registerPhone = document.getElementById('register-phone');
        const registerPassword = document.getElementById('register-password');
        const registerPasswordConfirm = document.getElementById('register-password-confirm');

       
         // Establecer +591 automáticamente al enfocar el campo si está vacío
    registerPhone.addEventListener('focus', function() {
        if (!this.value) {
            this.value = '+591 ';
        }
    });
    
    // Validar que no se elimine el +591
    registerPhone.addEventListener('blur', function() {
        if (!this.value.startsWith('+591')) {
            this.value = '+591 ' + this.value.replace(/\D/g, '');
        }
        
        // Validación del teléfono (ahora espera 8 dígitos después de +591)
        const phoneDigits = this.value.replace(/\D/g, '').substring(3); // Quita el +591
        if (phoneDigits.length < 8) {
            showInputError(registerPhone, 'Debe tener 8 dígitos después del +591');
        }
    });

    // Formateo automático del número de teléfono
    registerPhone.addEventListener('input', function(e) {
        // Asegurar que siempre comience con +591
        if (!this.value.startsWith('+591')) {
            this.value = '+591 ' + this.value.replace(/\D/g, '');
            return;
        }
        
        // Obtener solo los dígitos después del +591
        let digits = this.value.replace(/\D/g, '').substring(3);
        
        // Limitar a 8 dígitos
        if (digits.length > 8) {
            digits = digits.substring(0, 8);
        }
        
        // Formatear con espacio después de los primeros 3 dígitos
        let formattedValue = '+591';
        if (digits.length > 0) {
            formattedValue += ' ' + digits.substring(0, 3);
        }
        if (digits.length > 3) {
            formattedValue += ' ' + digits.substring(3, 6);
        }
        if (digits.length > 6) {
            formattedValue += digits.substring(6);
        }
        
        this.value = formattedValue;
    });

        
    }

    // Efectos visuales mejorados
    let mouseTrails = [];
    const maxTrails = 8;

    document.addEventListener('mousemove', (e) => {
        // Limpiar trails antiguos
        if (mouseTrails.length >= maxTrails) {
            const oldTrail = mouseTrails.shift();
            if (oldTrail && oldTrail.parentNode) {
                oldTrail.parentNode.removeChild(oldTrail);
            }
        }

        const trail = document.createElement('div');
        trail.style.cssText = `
            position: fixed;
            left: ${e.clientX}px;
            top: ${e.clientY}px;
            width: 4px;
            height: 4px;
            background: linear-gradient(45deg, #a855f7, #3b82f6);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            animation: cursorFade 1s ease-out forwards;
            box-shadow: 0 0 8px rgba(168, 85, 247, 0.4);
        `;
        
        document.body.appendChild(trail);
        mouseTrails.push(trail);
    });

    // Agregar estilos de animación
    const style = document.createElement('style');
    style.textContent = `
        @keyframes cursorFade {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }
            100% {
                transform: scale(2.5);
                opacity: 0;
            }
        }

        .error-text {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }

        .input-error {
            border-color: #ef4444 !important;
        }

        .btn-loading {
            position: relative;
            pointer-events: none;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            border: 3px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: button-loading-spinner 1s ease infinite;
        }

        @keyframes button-loading-spinner {
            from {
                transform: rotate(0turn);
            }
            to {
                transform: rotate(1turn);
            }
        }

        .success-message {
            background-color: #10b981;
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            text-align: center;
        }
    `;
    document.head.appendChild(style);

    // Efectos de parallax para elementos flotantes
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.floating-element');
        
        parallaxElements.forEach((element, index) => {
            const speed = 0.2 + (index * 0.1);
            const yPos = -(scrolled * speed);
            element.style.transform = `translateY(${yPos}px) rotate(${scrolled * 0.05}deg)`;
        });
    });

    // Mejorar la experiencia de carga
    window.addEventListener('load', () => {
        document.body.style.opacity = '1';
        document.body.style.transition = 'opacity 0.5s ease-in-out';
    });
});