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
            --shadow-glow: 0 8px 32px rgba(168, 85, 247, 0.3);
            --shadow-soft: 0 8px 32px rgba(0, 0, 0, 0.3);
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
            background-image: url('../../imagenes/fondolargo2.png');
            background-size: cover;
            background-attachment: fixed;
        }

        /* Animated background particles */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(168, 85, 247, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(245, 87, 108, 0.1) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
            pointer-events: none;
            z-index: -1;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(1deg); }
            66% { transform: translateY(10px) rotate(-1deg); }
        }
        
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            padding-top: 120px;
            position: relative;
            z-index: 1;
        }
        
        .payment-header {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        .payment-header::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
            box-shadow: 0 0 20px rgba(168, 85, 247, 0.5);
        }
        
        .payment-title {
            font-family: 'Rowdies', sans-serif;
            font-size: 3rem;
            background: var(--primary-gradient);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
            text-shadow: 0 0 30px rgba(168, 85, 247, 0.3);
            animation: titleGlow 3s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            from { filter: drop-shadow(0 0 10px rgba(168, 85, 247, 0.3)); }
            to { filter: drop-shadow(0 0 20px rgba(168, 85, 247, 0.6)); }
        }
        
        .plan-name {
            font-size: 1.8rem;
            background: var(--accent-gradient);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .payment-summary {
            backdrop-filter: blur(20px);
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: var(--shadow-glow);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .payment-summary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .payment-summary:hover::before {
            left: 100%;
        }

        .payment-summary:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(168, 85, 247, 0.4);
        }
        
        .summary-title {
            font-family: 'Rowdies', sans-serif;
            font-size: 1.6rem;
            color: var(--text-primary);
            margin-bottom: 25px;
            border-bottom: 2px solid rgba(168, 85, 247, 0.3);
            padding-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .summary-title::before {
            content: '💳';
            font-size: 1.2em;
        }
        
        .summary-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .summary-details:hover {
            background: rgba(255, 255, 255, 0.05);
            padding-left: 10px;
            border-radius: 8px;
        }
        
        .summary-label {
            font-weight: 600;
            color: var(--text-secondary);
        }
        
        .summary-value {
            font-weight: 700;
            color: var(--text-primary);
        }
        
        .total-amount {
            font-size: 1.4rem;
            background: var(--success-gradient);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid rgba(79, 172, 254, 0.3);
            text-align: center;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 25px;
            margin-bottom: 50px;
        }
        
        .payment-option {
            backdrop-filter: blur(20px);
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow-soft);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .payment-option::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary-gradient);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .payment-option:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-glow);
        }

        .payment-option:hover::before {
            transform: scaleX(1);
        }
        
        .option-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .option-header:hover {
            transform: translateX(5px);
        }
        
        .option-title {
            font-size: 1.4rem;
            margin-left: 20px;
            color: var(--text-primary);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .option-title:hover {
            background: var(--primary-gradient);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .option-content {
            display: none;
            margin-top: 25px;
            animation: slideIn 0.5s ease;
        }
        
        @keyframes slideIn {
            from { 
                opacity: 0; 
                transform: translateY(20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        .qr-code {
            text-align: center;
            padding: 30px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .qr-code img {
            max-width: 250px;
            border: 3px solid rgba(168, 85, 247, 0.3);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(168, 85, 247, 0.2);
            transition: all 0.3s ease;
        }

        .qr-code img:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(168, 85, 247, 0.4);
        }

        .qr-code p {
            margin-top: 20px;
            color: var(--text-secondary);
            font-size: 1.1rem;
        }
        
        .physical-payment {
            background: rgba(255, 255, 255, 0.05);
            padding: 25px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .physical-payment::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--secondary-gradient);
        }

        .physical-payment p {
            color: var(--text-secondary);
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        
        .payment-code {
            font-size: 1.5rem;
            background: var(--accent-gradient);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            margin: 20px 0;
            padding: 15px 20px;
          
            border: 2px solid rgba(245, 87, 108, 0.3);
            border-radius: 10px;
            display: inline-block;
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
            animation: codeGlow 2s ease-in-out infinite alternate;
        }

        @keyframes codeGlow {
            from { box-shadow: 0 0 10px rgba(245, 87, 108, 0.3); }
            to { box-shadow: 0 0 20px rgba(245, 87, 108, 0.6); }
        }
        
        .done-btn {
            display: block;
            width: 250px;
            margin: 0 auto;
            padding: 18px 30px;
            background: var(--success-gradient);
            color: var(--text-primary);
            border: none;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);
            position: relative;
            overflow: hidden;
        }

        .done-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .done-btn:hover::before {
            left: 100%;
        }
        
        .done-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 20px 40px rgba(79, 172, 254, 0.4);
        }

        .done-btn:active {
            transform: translateY(-2px) scale(1.02);
        }
        
        /* Custom Checkbox */
        input[type="checkbox"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 28px;
            height: 28px;
            border: 2px solid rgba(168, 85, 247, 0.5);
            border-radius: 8px;
            outline: none;
            cursor: pointer;
            position: relative;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        input[type="checkbox"]:hover {
            border-color: rgba(168, 85, 247, 0.8);
            box-shadow: 0 0 15px rgba(168, 85, 247, 0.3);
            transform: scale(1.1);
        }
        
        input[type="checkbox"]:checked {
            background: var(--primary-gradient);
            border-color: transparent;
            box-shadow: 0 0 20px rgba(168, 85, 247, 0.5);
        }
        
        input[type="checkbox"]:checked::after {
            content: "✓";
            position: absolute;
            color: white;
            font-size: 18px;
            font-weight: bold;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(1);
            animation: checkmark 0.3s ease;
        }

        @keyframes checkmark {
            0% { transform: translate(-50%, -50%) scale(0) rotate(180deg); }
            100% { transform: translate(-50%, -50%) scale(1) rotate(0deg); }
        }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            backdrop-filter: blur(20px);
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 450px;
            width: 90%;
            animation: modalSlideIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: var(--shadow-glow);
            position: relative;
            overflow: hidden;
        }

        .modal-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--success-gradient);
        }
        
        @keyframes modalSlideIn {
            from { 
                opacity: 0; 
                transform: scale(0.7) translateY(50px); 
            }
            to { 
                opacity: 1; 
                transform: scale(1) translateY(0); 
            }
        }
        
        .modal-title {
            font-size: 2rem;
            background: var(--success-gradient);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .modal-content p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .modal-btn {
            padding: 15px 30px;
            background: var(--primary-gradient);
            color: var(--text-primary);
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(168, 85, 247, 0.3);
        }

        .modal-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(168, 85, 247, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .payment-title {
                font-size: 2.2rem;
            }
            
            .plan-name {
                font-size: 1.4rem;
            }
            
            .main-container {
                padding: 15px;
                padding-top: 100px;
            }
            
            .payment-summary,
            .payment-option {
                padding: 20px;
            }
            
            .done-btn {
                width: 200px;
                font-size: 1.1rem;
            }

            /* Ajustes para el diseño de dos columnas */
            .payment-container {
                flex-direction: column;
            }
        }

        /* Loading animation for QR code */
        .qr-loading {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 3px solid rgba(168, 85, 247, 0.3);
            border-radius: 50%;
            border-top-color: #a855f7;
            animation: spin 1s ease-in-out infinite;
            margin: 20px 0;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Nuevos estilos para el diseño de dos columnas */
        .payment-container {
            display: flex;
            gap: 30px;
            margin-bottom: 40px;
        }

        .payment-summary-column {
            flex: 1;
            min-width: 0;
        }

        .payment-options-column {
            flex: 1;
            min-width: 0;
        }
        /* Estilo para el botón de volver */
        .back-button {
            position: absolute;
            top: 130px;
            left: 30px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            backdrop-filter: blur(10px);
            z-index: 10;
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-5px);
        }

       
        .back-button i {
            transition: transform 0.3s ease;
            
        }

        .back-button:hover i {
            transform: translateX(-3px);
        }

        /* Ajuste para el main-container cuando hay botón de volver */
        .main-container {
            position: relative;
            padding-top: 130px; /* Reducido para acomodar el botón */
        }

        @media (max-width: 768px) {
            .back-button {
                top: 15px;
                left: 15px;
                padding: 8px 15px;
                font-size: 0.9rem;
            }
            
            .main-container {
                padding-top: 70px;
            }
        }
    </style>

