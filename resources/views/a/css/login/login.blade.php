<style>
    
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
            color: white;
            overflow-x: hidden;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
           
             background-image: url('../imagenes/herofondo.png');
    background-size: cover;
    background-position: center;
            background-attachment: fixed;
       
        }

        /* Elementos decorativos de fondo */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(164, 23, 225, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
            z-index: 0;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 80%;
            height: 80%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
            animation: float 8s ease-in-out infinite reverse;
            z-index: 0;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        /* Grid pattern de fondo */
        .grid-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
            z-index: 0;
        }

        @keyframes gridMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        /* Contenedor principal */
        .auth-container {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 450px;
            padding: 2.5rem;
            margin: 2rem;
            animation: slideInUp 0.8s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header */
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            font-family: 'Poppins', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #a855f7 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
           
        }

        .logo img {
            height: 30px;
            width: auto;
        }
        .auth-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 400;
        }

        /* Formularios */
        .form-container {
            position: relative;
            overflow: hidden;
        }

        .form {
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .form.hidden {
            transform: translateX(100%);
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .form.slide-left {
            transform: translateX(-100%);
            opacity: 0;
        }

        /* Grupos de input */
        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-label {
            display: block;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0.5rem;
            letter-spacing: 0.3px;
        }

        .input-field {
            width: 100%;
            padding: 1rem 1.25rem;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .input-field:focus {
            outline: none;
            border-color: #a855f7;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
            transform: translateY(-2px);
        }

        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        /* Botones */
        .btn {
            width: 100%;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.3px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #a855f7 0%, #3b82f6 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(168, 85, 247, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(168, 85, 247, 0.4);
        }

        .btn-google {
            background: rgba(255, 255, 255, 0.95);
            color: #1f2937;
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .btn-google:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.15);
        }

        .btn-google::before {
            content: "G";
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            background: linear-gradient(45deg, #4285f4, #34a853, #fbbc05, #ea4335);
            color: white;
            border-radius: 3px;
            font-weight: bold;
            font-size: 12px;
        }

        /* Efecto ripple para botones */
        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:active::after {
            width: 300px;
            height: 300px;
        }

        /* Divisor */
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.875rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.15);
        }

        .divider span {
            padding: 0 1rem;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
        }

        /* Enlaces de cambio */
        .form-switch {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .form-switch p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .switch-link {
            color: #a855f7;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .switch-link:hover {
            color: #3b82f6;
            text-shadow: 0 0 10px rgba(168, 85, 247, 0.5);
        }

        .switch-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #a855f7 0%, #3b82f6 100%);
            transition: width 0.3s ease;
        }

        .switch-link:hover::after {
            width: 100%;
        }

        /* Elementos flotantes decorativos */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);
            animation: floatElements 4s ease-in-out infinite;
            z-index: 1;
        }

        .floating-element:nth-child(1) {
            width: 60px;
            height: 60px;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 40px;
            height: 40px;
            top: 70%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 10%;
            animation-delay: 1s;
        }

        @keyframes floatElements {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Animaciones de validación */
        .input-error {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .success-message {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22c55e;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            text-align: center;
            animation: slideInDown 0.5s ease-out;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading state */
        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .auth-container {
                padding: 2rem;
                margin: 1rem;
                border-radius: 20px;
            }
            
            .auth-title {
                font-size: 1.5rem;
            }
            
            .logo {
                font-size: 1.75rem;
            }
        }

        @media (max-width: 480px) {
            .auth-container {
                padding: 1.5rem;
            }
            
            .input-field {
                padding: 0.875rem 1rem;
            }
            
            .btn {
                padding: 0.875rem 1.25rem;
            }
        }

        /* Mejoras de accesibilidad */
        .input-field:focus,
        .btn:focus {
            outline: 2px solid #a855f7;
            outline-offset: 2px;
        }

        /* Animación de carga inicial */
        .auth-container {
            animation-delay: 0.2s;
            animation-fill-mode: both;
        }
   

        /* Estilos para el botón de volver */
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            z-index: 100;
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-3px);
        }

        .back-button i {
            font-size: 0.9em;
        }

        /* Mejoras para los botones de Google */
        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-google i {
            font-size: 1.2em;
        }

        /* Estilos para el ojito de contraseña */
        .password-group {
            position: relative;
        }

        .password-input-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toggle-password:hover {
            color: #555;
        }

        /* Ajuste para el input de contraseña */
        .password-group .input-field {
            padding-right: 40px;
        }

        
</style>