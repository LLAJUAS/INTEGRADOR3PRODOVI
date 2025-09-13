document.addEventListener("DOMContentLoaded", () => {
    const chatbotHTML = `
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    #chatbot {
        position: fixed;
        bottom: 80px;
        right: 20px;
        width: 350px;
        max-height: 500px;
        background: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 15px;
        display: none;
        flex-direction: column;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        z-index: 9999;
        transform: translateZ(0);
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    #chatbot.visible {
        display: flex;
    }
    
    #chat-header {
        background: linear-gradient(135deg, #129600, #0d7400);
        color: white;
        padding: 15px;
        text-align: center;
        font-weight: 600;
        border-radius: 15px 15px 0 0;
        font-size: 16px;
        position: relative;
    }

    #close-btn {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        padding: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    #chat-window {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
        font-size: 14px;
        color: #333;
        max-height: 350px;
    }
    
    #messages .message {
        margin: 8px 0;
        padding: 12px 15px;
        border-radius: 18px;
        max-width: 85%;
        word-wrap: break-word;
        line-height: 1.4;
    }
    
    #messages .user {
        align-self: flex-end;
        background: #129600;
        color: white;
        border-radius: 18px 18px 4px 18px;
        margin-left: auto;
        margin-right: 0;
    }
    
    #messages .bot {
        align-self: flex-start;
        background: #f5f5f5;
        color: #333;
        border-radius: 18px 18px 18px 4px;
        margin-left: 0;
        margin-right: auto;
    }

    /* Estilos para cards de pagos */
    .payments-container {
        margin: 10px 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .payment-card {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
    }

    .payment-card:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .payment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #129600;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
    }

    .user-name {
        font-weight: 600;
        font-size: 14px;
        color: #333;
    }

    .approve-btn {
        background: #48bb78;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }

    .approve-btn:hover {
        background: #38a169;
        transform: scale(1.05);
    }

    .payment-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin-bottom: 10px;
        font-size: 12px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-label {
        color: #666;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .detail-value {
        color: #333;
        font-weight: 500;
    }

    .plan-badge {
        background: #e6f3ff;
        color: #0066cc;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .amount {
        font-size: 16px;
        font-weight: 700;
        color: #129600;
    }

    .date {
        color: #666;
        font-size: 11px;
    }

    /* Estilos existentes para otros elementos */
    .message-image {
        max-width: 100%;
        border-radius: 12px;
        margin: 8px 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .quick-replies {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }

    .quick-reply-btn {
        background: #129600;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.2s;
        font-family: 'Poppins', sans-serif;
    }

    .quick-reply-btn:hover {
        background: #0d7400;
        transform: scale(1.05);
    }

    .typing-indicator {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        margin: 8px 0;
        background: #f5f5f5;
        border-radius: 18px 18px 18px 4px;
        max-width: 85%;
    }

    .typing-dots {
        display: flex;
        gap: 4px;
    }

    .typing-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #999;
        animation: typing 1.4s infinite;
    }

    .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    .typing-dot:nth-child(3) { animation-delay: 0.4s; }

    @keyframes typing {
        0%, 60%, 100% { transform: translateY(0); }
        30% { transform: translateY(-10px); }
    }
    
    #input-area {
        display: flex;
        padding: 15px;
        border-top: 1px solid #e0e0e0;
        background: #ffffff;
        border-radius: 0 0 15px 15px;
        gap: 10px;
    }
    
    #user-input {
        flex: 1;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 25px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.2s;
    }

    #user-input:focus {
        border-color: #129600;
    }
    
    #send-btn {
        background: #129600;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 25px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.2s;
        min-width: 60px;
    }
    
    #send-btn:hover {
        background: #0d7400;
        transform: scale(1.05);
    }

    #send-btn:disabled {
        background: #ccc;
        cursor: not-allowed;
        transform: none;
    }
    
    #bot-icon {
        position: fixed;
        bottom: 20px;
        right: 20px;
        cursor: pointer;
        transition: transform 0.2s;
        z-index: 1001;
        margin: 0;
        padding: 0;
    }

    #bot-icon:hover {
        transform: scale(1.1);
    }

    @media (max-width: 480px) {
        #chatbot {
            width: calc(100vw - 40px);
            right: 20px;
            left: 20px;
            bottom: 80px;
        }
    }
    </style>
    
    <div id="chatbot">
        <div id="chat-header">
            🤖 Asistente Virtual
            <button id="close-btn">×</button>
        </div>
        <div id="chat-window">
            <div id="messages"></div>
        </div>
        <div id="input-area">
            <input type="text" id="user-input" placeholder="Escribe tu mensaje aquí..." />
            <button id="send-btn">Enviar</button>
        </div>
    </div>
    
    <div id="bot-icon">
        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="30" cy="30" r="30" fill="#129600"/>
            <path d="M20 25C20 23.8954 20.8954 23 22 23H38C39.1046 23 40 23.8954 40 25V35C40 36.1046 39.1046 37 38 37H22C20.8954 37 20 36.1046 20 35V25Z" fill="white"/>
            <circle cx="26" cy="29" r="2" fill="#129600"/>
            <circle cx="34" cy="29" r="2" fill="#129600"/>
            <path d="M26 33H34" stroke="#129600" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </div>
    `;

    document.body.insertAdjacentHTML("beforeend", chatbotHTML);

    const chatBot = document.getElementById("chatbot");
    const botIcon = document.getElementById("bot-icon");
    const closeBtn = document.getElementById("close-btn");
    const sendBtn = document.getElementById("send-btn");
    const userInput = document.getElementById("user-input");
    const messages = document.getElementById("messages");

    // Base de conocimientos con datos de pagos
   // Base de conocimientos con datos de pagos
    const knowledgeBase = {
        // Pagos pendientes como cards
        pagos: {
            type: 'payments',
            items: [
                {
                    user: 'Sole Perez',
                    avatar: 'S',
                    codigo: 'FIS41357',
                    plan: 'KIT PRO',
                    monto: '800.00 BS',
                    fecha: '23/06/2025 02:28',
                    id: 'payment1'
                },
                {
                    user: 'Nicole Nicole',
                    avatar: 'N',
                    codigo: 'FIS75238',
                    plan: 'KIT JUNIOR',
                    monto: '500.00 BS',
                    fecha: '22/06/2025 23:21',
                    id: 'payment2'
                }
            ]
        },

        // Usuarios sin campaña como cards
        usuariossincampaa: {
            type: 'users',
            items: [
                {
                    user: 'Rafael Fabiani',
                    avatar: 'R',
                    email: 'rafafabiani1909@gmail.com',
                    plan: 'KIT PRO',
                    fin_suscripcion: '23/07/2025',
                    id: 'user1'
                },
                {
                    user: 'cliente prueba',
                    avatar: 'C',
                    email: 'cliente@gmail.com',
                    plan: 'KIT SÚPER PRO',
                    fin_suscripcion: '23/07/2025',
                    id: 'user2'
                }
            ]
        },

        // Respuestas con quick replies
        servicios: {
            type: 'quick_replies',
            text: '¿Qué servicio te interesa más?',
            replies: ['Delivery', 'Pedidos Personalizados', 'Catering', 'Consultas']
        },

        // Respuesta con imagen
        ubicacion: {
            type: 'image',
            text: '📍 Nos encontramos en:',
            image: 'https://via.placeholder.com/300x200/129600/ffffff?text=Mapa+Ubicación',
            description: 'Calle 17 de Calacote, edificio Río Beni, No 560'
        }
    };

    // Reglas de conversación
    const conversationRules = [
        // Saludos
        { 
            patterns: ['hola', 'buenos días', 'buenas tardes', 'buenas noches', 'hey', 'hi'],
            response: {
                type: 'text_with_quick_replies',
                text: '¡Hola! 👋 Bienvenido a nuestro sistema de gestión. ¿En qué puedo ayudarte hoy?',
                quick_replies: ['Pagos Pendientes', 'Campañas activas', 'Usuarios sin campaña', 'Tareas Pendientes']
            }
        },

        // Pagos pendientes
        {
            patterns: ['pagos', 'pagos pendientes', 'pendientes', 'deudas', 'cobros'],
            response: knowledgeBase.pagos
        },

        // Campañas
        {
            patterns: ['campañas', 'campañas activas', 'activas', 'marketing'],
            response: {
                type: 'text_with_quick_replies',
                text: '📊 Campañas Activas:\n\n• Campaña Navideña - 85% completada\n• Promoción KIT PRO - 62% completada\n• Black Friday - En preparación\n\n¿Qué te gustaría revisar?',
                quick_replies: ['Ver Detalles', 'Crear Nueva', 'Estadísticas']
            }
        },

        // Usuarios sin campaña
       {
    patterns: ['usuarios sin campaña', 'sin campaña', 'usuarios'],
    response: {
        type: 'users',
        items: [
            {
                user: 'Rafael Fabiani',
                avatar: 'R',
                email: 'rafafabiani1909@gmail.com',
                plan: 'KIT PRO',
                fin_suscripcion: '23/07/2025',
                id: 'user1'
            },
            {
                user: 'cliente prueba',
                avatar: 'C',
                email: 'cliente@gmail.com',
                plan: 'KIT SÚPER PRO',
                fin_suscripcion: '23/07/2025',
                id: 'user2'
            }
        ]
    }
},

        // Tareas pendientes
        {
            patterns: ['tareas', 'tareas pendientes', 'pendientes', 'por hacer'],
            response: {
                type: 'text_with_quick_replies',
                text: '✅ Tareas Pendientes:\n\n• Revisar pagos (2)\n• Aprobar campañas (3)\n• Actualizar perfiles (5)\n• Generar reportes (1)\n\n¿Por cuál empezamos?',
                quick_replies: ['Revisar Pagos', 'Aprobar Campañas', 'Ver Todas']
            }
        },

        // Contacto humano
        {
            patterns: ['humano', 'persona', 'operador', 'ayuda personal'],
            response: {
                type: 'text',
                text: '👥 Te conectaré con un administrador.\n\n¿Podrías indicar el motivo de tu consulta para derivarte correctamente?',
                quick_replies: ['Problema Técnico', 'Consulta Comercial', 'Soporte General']
            }
        }
    ];

    // Funciones
    const showTypingIndicator = () => {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'typing-indicator';
        typingDiv.innerHTML = `
            <div class="typing-dots">
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
            </div>
        `;
        messages.appendChild(typingDiv);
        scrollToBottom();
        return typingDiv;
    };

    const addMessage = (sender, content) => {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}`;

        if (typeof content === 'string') {
            messageDiv.textContent = content;
        } else {
            // Manejar diferentes tipos de contenido
            switch (content.type) {
                case 'payments':
                    messageDiv.innerHTML = `
                        <div style="margin-bottom: 10px;">💰 Pagos Pendientes de Aprobación:</div>
                        ${createPaymentCards(content.items)}
                    `;
                    break;
                case 'image':
                    messageDiv.innerHTML = `
                        <div>${content.text}</div>
                        <img src="${content.image}" alt="Imagen" class="message-image">
                        <div style="margin-top: 8px; font-size: 12px; color: #666;">${content.description}</div>
                    `;
                    break;
                case 'text_with_quick_replies':
                case 'quick_replies':
                    messageDiv.innerHTML = `
                        <div>${content.text}</div>
                        <div class="quick-replies">
                            ${content.quick_replies ? content.quick_replies.map(reply => 
                                `<button class="quick-reply-btn" onclick="handleQuickReply('${reply}')">${reply}</button>`
                            ).join('') : ''}
                        </div>
                    `;
                    break;
                default:
                    messageDiv.textContent = content.text || content;
            }
        }

        messages.appendChild(messageDiv);
        scrollToBottom();
    };

    const createPaymentCards = (items) => {
        return `
            <div class="payments-container">
                ${items.map(item => `
                    <div class="payment-card" onclick="handlePaymentClick('${item.id}')">
                        <div class="payment-header">
                            <div class="user-info">
                                <div class="user-avatar">${item.avatar}</div>
                                <div class="user-name">${item.user}</div>
                            </div>
                            <button class="approve-btn" onclick="event.stopPropagation(); handleApproval('${item.id}')">
                                ✓ Aprobar
                            </button>
                        </div>
                        <div class="payment-details">
                            <div class="detail-item">
                                <div class="detail-label">Código</div>
                                <div class="detail-value">${item.codigo}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Plan</div>
                                <div class="detail-value">
                                    <span class="plan-badge">${item.plan}</span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Monto</div>
                                <div class="detail-value amount">${item.monto}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Fecha</div>
                                <div class="detail-value date">${item.fecha}</div>
                            </div>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
    };

    const findResponse = (input) => {
        const normalizedInput = input.toLowerCase().trim();
        
        for (const rule of conversationRules) {
            if (rule.patterns.some(pattern => normalizedInput.includes(pattern))) {
                return rule.response;
            }
        }

        // Respuesta por defecto
        return {
            type: 'text_with_quick_replies',
            text: 'Lo siento, no entendí tu consulta. 🤔\n\n¿Podrías ser más específico o elegir una de estas opciones?',
            quick_replies: ['Pagos Pendientes', 'Campañas activas', 'Usuarios sin campaña', 'Tareas Pendientes']
        };
    };

    const sendMessage = async () => {
        const input = userInput.value.trim();
        if (!input) return;

        sendBtn.disabled = true;
        userInput.disabled = true;

        addMessage('user', input);
        userInput.value = '';

        const typingIndicator = showTypingIndicator();
        await new Promise(resolve => setTimeout(resolve, 1000 + Math.random() * 1000));
        typingIndicator.remove();

        const response = findResponse(input);
        addMessage('bot', response);

        sendBtn.disabled = false;
        userInput.disabled = false;
        userInput.focus();
    };

    const scrollToBottom = () => {
        setTimeout(() => {
            const chatWindow = document.getElementById("chat-window");
            if (chatWindow) {
                chatWindow.scrollTo({
                    top: chatWindow.scrollHeight,
                    behavior: "smooth"
                });
            }
        }, 100);
    };

    // Funciones globales
    window.handleQuickReply = (reply) => {
        addMessage('user', reply);
        setTimeout(() => {
            const response = findResponse(reply);
            addMessage('bot', response);
        }, 500);
    };

    window.handlePaymentClick = (paymentId) => {
        addMessage('user', 'Ver detalles del pago');
        setTimeout(() => {
            addMessage('bot', {
                type: 'text_with_quick_replies',
                text: '📋 Detalles del pago seleccionado:\n\n¿Qué acción deseas realizar?',
                quick_replies: ['Aprobar Pago', 'Rechazar', 'Solicitar Info', 'Ver Historial']
            });
        }, 500);
    };

    window.handleApproval = (paymentId) => {
        setTimeout(() => {
            addMessage('bot', {
                type: 'text_with_quick_replies',
                text: '✅ Pago aprobado exitosamente!\n\nSe ha notificado al usuario y se ha procesado el pago.',
                quick_replies: ['Ver Otros Pagos', 'Generar Reporte', 'Menú Principal']
            });
        }, 500);
    };

    // Event listeners
    sendBtn.addEventListener("click", sendMessage);
    userInput.addEventListener("keydown", (e) => {
        if (e.key === "Enter" && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    botIcon.addEventListener("click", () => {
        chatBot.classList.add("visible");
        userInput.focus();
        
        if (messages.children.length === 0) {
            setTimeout(() => {
                addMessage('bot', {
                    type: 'text_with_quick_replies',
                    text: '¡Hola! 👋 Soy tu asistente de gestión.\n\n¿En qué puedo ayudarte hoy?',
                    quick_replies: ['Pagos Pendientes', 'Campañas activas', 'Usuarios sin campaña', 'Tareas Pendientes']
                });
            }, 500);
        }
    });

    closeBtn.addEventListener("click", () => {
        chatBot.classList.remove("visible");
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && chatBot.classList.contains("visible")) {
            chatBot.classList.remove("visible");
        }
    });
});