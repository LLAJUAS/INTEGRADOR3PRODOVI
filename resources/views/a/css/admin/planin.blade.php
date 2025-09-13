    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .main-container {
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e1e8ed;
        }

        .header-content h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-content h1 i {
            color: #667eea;
        }

        .subtitle {
            color: #6c757d;
            font-size: 1.1rem;
        }

        /* Botones */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-edit {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 172, 254, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        /* Alertas */
        .alert {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 20px;
            margin-bottom: 25px;
            border-radius: 12px;
            font-weight: 500;
            position: relative;
            animation: slideIn 0.3s ease;
        }

        .alert-success {
            background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
            color: white;
            border: 1px solid rgba(86, 171, 47, 0.3);
        }

        .alert-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #ffa8a8 100%);
            color: white;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        .alert-close {
            position: absolute;
            right: 15px;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1.2rem;
            opacity: 0.8;
        }

        .alert-close:hover {
            opacity: 1;
        }

        /* Grid de planes */
        .plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .plan-card {
            background: white;
            border-radius: 16px;
            padding: 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            border: 1px solid #e1e8ed;
        }

        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .plan-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            position: relative;
        }

        .plan-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .plan-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .plan-subtitle {
            opacity: 0.9;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .plan-price {
            display: flex;
            align-items: baseline;
            gap: 5px;
        }

        .price-amount {
            font-size: 2rem;
            font-weight: 800;
        }

        .price-currency {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .price-period {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .plan-features {
            padding: 25px;
        }

        .plan-features h4 {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
            color: #2c3e50;
            font-size: 1.1rem;
        }

        .features-list {
            list-style: none;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .feature-item:last-child {
            border-bottom: none;
        }

        .feature-item i {
            color: #28a745;
            font-size: 0.9rem;
        }

        .feature-frequency {
            margin-left: auto;
            background: #e9ecef;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            color: #6c757d;
        }

        .plan-actions {
            padding: 20px 25px;
            background: #f8f9fa;
            display: flex;
            gap: 12px;
        }

        .plan-actions .btn {
            flex: 1;
            justify-content: center;
            font-size: 0.9rem;
            padding: 10px 16px;
        }

        /* Estado vacío */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            margin-bottom: 10px;
            color: #495057;
        }

        .empty-state p {
            margin-bottom: 25px;
            font-size: 1.1rem;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 0;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
            padding: 20px;
            border-radius: 16px 16px 0 0;
        }

        .modal-header h3 {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            padding: 20px 25px;
            background: #f8f9fa;
            border-radius: 0 0 16px 16px;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        /* Animaciones */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                padding: 10px;
            }

            .container {
                padding: 20px;
                border-radius: 16px;
            }

            .page-header {
                flex-direction: column;
                align-items: stretch;
                gap: 20px;
            }

            .header-content h1 {
                font-size: 2rem;
            }

            .plans-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .plan-actions {
                flex-direction: column;
            }

            .modal-content {
                margin: 10% auto;
                width: 95%;
            }
        }
    </style>