        <style>
            :root {
                --primary-gradient: linear-gradient(135deg, #a855f7, #3b82f6);
                --secondary-gradient: linear-gradient(135deg, #667eea, #764ba2);
                --accent-gradient: linear-gradient(135deg, #f093fb, #f5576c);
                --success-gradient: linear-gradient(135deg, #4facfe, #00f2fe);
                --dark-bg: rgba(0, 0, 0, 0.95);
                --glass-bg: rgba(255, 255, 255, 0.1);
                --glass-border: rgba(255, 255, 255, 0.2);
                --text-primary: #ffffff;
                --text-secondary: rgba(255, 255, 255, 0.8);
                --text-muted: rgba(255, 255, 255, 0.6);
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Varela Round', sans-serif;
                line-height: 1.6;
                color: var(--text-primary);
                background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
                min-height: 100vh;
                overflow-x: hidden;
                position: relative;
                  background-image: url('../imagenes/fondolargo2.png');
                  
                  background-size: cover;
               
 
            }

            /* Efectos de fondo animados */
            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: 
                    radial-gradient(circle at 20% 80%, rgba(168, 85, 247, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 40% 40%, rgba(16, 185, 129, 0.05) 0%, transparent 50%);
                z-index: -1;
                animation: backgroundShift 20s ease-in-out infinite;
            }

            @keyframes backgroundShift {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.8; }
            }

            .main-container {
                
   
                max-width: 1400px;
                margin: 0 auto;
                padding: 120px 20px 40px;
                position: relative;
                z-index: 1;
            }

            /* Mensaje de bienvenida mejorado */
            .welcome-section {
                text-align: center;
                margin-bottom: 60px;
                position: relative;
            }

            .welcome-card {
                background: var(--glass-bg);
                backdrop-filter: blur(20px);
                border: 1px solid var(--glass-border);
                border-radius: 24px;
                padding: 40px;
                position: relative;
                overflow: hidden;
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
                animation: fadeInUp 0.8s ease-out;
            }

            .welcome-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 2px;
                background: var(--primary-gradient);
                animation: shimmer 3s ease-in-out infinite;
            }

            @keyframes shimmer {
                0% { left: -100%; }
                50% { left: 100%; }
                100% { left: 100%; }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .welcome-title {
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 20px;
                background: var(--primary-gradient);
                font-family: "Rowdies", sans-serif;
        
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                animation: glow 2s ease-in-out infinite alternate;
            }

            @keyframes glow {
                from { filter: brightness(1); }
                to { filter: brightness(1.2); }
            }

            .welcome-subtitle {
                font-size: 1.2rem;
                color: var(--text-secondary);
                max-width: 800px;
                margin: 0 auto;
                line-height: 1.7;
            }

            .highlight {
                background: var(--accent-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                font-weight: 600;
            }

            /* Contenedor de planes mejorado */
            .plans-section {
                margin-bottom: 80px;
            }

            .section-title {
                text-align: center;
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 50px;
                color: var(--text-primary);
            }

            .plans-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: 30px;
                padding: 0 20px;
            }

            .plan {
                background: var(--glass-bg);
                backdrop-filter: blur(20px);
                border: 1px solid var(--glass-border);
                border-radius: 20px;
                padding: 30px;
                position: relative;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
                animation: fadeInUp 0.8s ease-out;
            }

            .plan:nth-child(2) { animation-delay: 0.2s; }
            .plan:nth-child(3) { animation-delay: 0.4s; }

            .plan:hover {
                transform: translateY(-10px) scale(1.02);
                box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
                border-color: rgba(255, 255, 255, 0.3);
            }

            .plan::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                transition: all 0.3s ease;
            }

            .junior::before {
                background: linear-gradient(135deg, #ffd700, #ff8c00);
            }

            .pro::before {
                background: linear-gradient(135deg, #ff4500, #ff6347);
            }

            .super-pro::before {
                background: linear-gradient(135deg, #9370db, #663399);
            }

            .plan-header {
                text-align: center;
                margin-bottom: 30px;
                padding-bottom: 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                position: relative;
            }

            .plan-title {
                font-size: 1.8rem;
                font-weight: 700;
                margin-bottom: 8px;
                color: var(--text-primary);
            }

            .plan-subtitle {
                font-size: 1rem;
                color: var(--text-muted);
                font-weight: 500;
            }

            .plan-features {
                margin-bottom: 30px;
            }

            .feature {
                display: flex;
                align-items: center;
                margin-bottom: 12px;
                font-size: 0.95rem;
                color: var(--text-secondary);
                transition: all 0.3s ease;
            }

            .feature:hover {
                color: var(--text-primary);
                transform: translateX(5px);
            }

            .feature::before {
                content: "✨";
                margin-right: 12px;
                font-size: 1rem;
            }

            .choose-btn {
                width: 100%;
                padding: 15px 30px;
                background: var(--primary-gradient);
                color: white;
                border: none;
                border-radius: 50px;
                font-family: 'Varela Round', sans-serif;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .choose-btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.5s ease;
            }

            .choose-btn:hover::before {
                left: 100%;
            }

            .choose-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 15px 30px rgba(168, 85, 247, 0.4);
            }

            /* Sección de contacto mejorada */
            .contact-section {
                background: var(--glass-bg);
                backdrop-filter: blur(20px);
                border: 1px solid var(--glass-border);
                border-radius: 24px;
                padding: 50px;
                text-align: center;
                position: relative;
                overflow: hidden;
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
                animation: fadeInUp 1s ease-out;
            }

            .contact-section::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: conic-gradient(from 0deg, transparent, rgba(168, 85, 247, 0.1), transparent, rgba(59, 130, 246, 0.1), transparent);
                animation: rotate 20s linear infinite;
                z-index: -1;
            }

            @keyframes rotate {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }

            .contact-title {
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 20px;
                background: var(--success-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .contact-description {
                font-size: 1.1rem;
                color: var(--text-secondary);
                margin-bottom: 30px;
                line-height: 1.8;
            }

            .contact-info {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 30px;
                margin-top: 30px;
            }

            .contact-item {
                background: rgba(255, 255, 255, 0.05);
                border-radius: 16px;
                padding: 25px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                transition: all 0.3s ease;
            }

            .contact-item:hover {
                background: rgba(255, 255, 255, 0.1);
                transform: translateY(-5px);
            }

            .contact-item h4 {
                color: var(--text-primary);
                font-size: 1.2rem;
                font-weight: 600;
                margin-bottom: 10px;
            }

            .contact-item p {
                color: var(--text-secondary);
                font-size: 1rem;
                line-height: 1.6;
            }

            /* Nuevos estilos para precios */
            .plan-price {
                font-size: 1.5rem;
                font-weight: 700;
                margin: 15px 0;
                background: linear-gradient(135deg, #6780e5, #a658e1);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                position: relative;
                display: inline-block;
            }
            
            .plan-price::after {
                content: '/mes';
                font-size: 1rem;
                position: absolute;
                right: -45px;
                bottom: 10px;
                color: var(--text-muted);
                font-weight: 400;
            }
            
            .price-savings {
                display: block;
                font-size: 0.9rem;
                color: #4ade80;
                margin-top: 5px;
            }
            
            .
            
            /* Fin de nuevos estilos */
            /* Responsive Design */
            @media (max-width: 768px) {
                .main-container {
                    padding: 100px 15px 30px;
                }

                .welcome-title {
                    font-size: 2rem;
                }

                .welcome-card {
                    padding: 30px 20px;
                }

                .plans-container {
                    grid-template-columns: 1fr;
                    gap: 20px;
                    padding: 0;
                }

                .plan {
                    padding: 25px 20px;
                }

                .contact-section {
                    padding: 30px 20px;
                }

                .contact-info {
                    grid-template-columns: 1fr;
                    gap: 20px;
                }
            }

            @media (max-width: 480px) {
                .welcome-title {
                    font-size: 1.8rem;
                }

                .plan-title {
                    font-size: 1.5rem;
                }

                .contact-title {
                    font-size: 1.8rem;
                }
            }
            .no-plans {
    grid-column: 1 / -1;
    text-align: center;
    padding: 40px;
    background: #f8f9fa;
    border-radius: 8px;
    color: #6c757d;
    font-size: 1.2em;
}
        </style>