    <style>
        :root {
            --primary-color: #4a6baf;
            --secondary-color: #f5f7fa;
            --accent-color: #ff6b6b;
            --text-color: #333;
            --light-gray: #e9ecef;
            --border-color: #ced4da;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .progress-container {
            width: 100%;
            background-color: var(--light-gray);
            height: 10px;
            margin: 20px 0;
        }
        
        .progress-bar {
            height: 10px;
            background-color: var(--accent-color);
            width: 0%;
            transition: width 0.3s ease;
        }
        
        .section {
            padding: 20px;
            display: none;
        }
        
        .section.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-gray);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 16px;
            transition: border 0.3s ease;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        textarea:focus,
        select:focus {
            border-color: var(--primary-color);
            outline: none;
        }
        
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .checkbox-group, .radio-group {
            margin-top: 10px;
        }
        
        .checkbox-item, .radio-item {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .checkbox-item input, .radio-item input {
            margin-right: 10px;
        }
        
        .cities-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 10px;
        }
        
        .city-checkbox {
            display: flex;
            align-items: center;
        }
        
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--light-gray);
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-prev {
            background-color: var(--light-gray);
            color: var(--text-color);
        }
        
        .btn-next, .btn-submit {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-prev:hover {
            background-color: #d1d7e0;
        }
        
        .btn-next:hover, .btn-submit:hover {
            background-color: #3a5a9a;
        }
        
        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            animation: modalFadeIn 0.3s ease;
        }
        
        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        
        .modal h3 {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-size: 24px;
        }
        
        .modal p {
            margin-bottom: 30px;
            font-size: 18px;
        }
        
        .modal-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .modal-btn:hover {
            background-color: #3a5a9a;
        }
        
        .required:after {
            content: " *";
            color: var(--accent-color);
        }
        
        @media (max-width: 768px) {
            .cities-container {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .container {
                border-radius: 0;
            }
        }
        
        @media (max-width: 480px) {
            .cities-container {
                grid-template-columns: 1fr;
            }
            
            .buttons {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>