@include('layouts.app')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #2f9edf, #9405e7);
        }
        
        .glass-morphism {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .floating-card {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .morphing-border {
            border-radius: 20px;
            background: linear-gradient(45deg, #f093fb 0%, #f5576c 25%, #4facfe 50%, #00f2fe 75%, #f093fb 100%);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
            padding: 2px;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .inner-card {
            
            border-radius: 18px;
            height: 100%;
        }
        
        .icon-glow {
            filter: drop-shadow(0 0 20px rgba(99, 102, 241, 0.5));
        }
        
        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }
        
        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }
            80%, 100% {
                transform: scale(1.2);
                opacity: 0;
            }
        }
        
        .diagonal-pattern {
            background-image: linear-gradient(45deg, rgba(255,255,255,0.1) 25%, transparent 25%, transparent 50%, rgba(255,255,255,0.1) 50%, rgba(255,255,255,0.1) 75%, transparent 75%, transparent);
            background-size: 20px 20px;
        }
        
        .neon-glow {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3), 0 0 40px rgba(99, 102, 241, 0.2);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <div class="relative overflow-hidden">
        <!-- Elementos decorativos de fondo -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-20 w-32 h-32 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full opacity-20 blur-xl floating-card"></div>
            <div class="absolute top-40 right-40 w-24 h-24 bg-gradient-to-r from-indigo-400 to-blue-500 rounded-full opacity-20 blur-xl floating-card" style="animation-delay: -2s"></div>
            <div class="absolute bottom-20 left-1/3 w-28 h-28 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full opacity-20 blur-xl floating-card" style="animation-delay: -4s"></div>
        </div>
        
        <div class="relative z-10 p-6 max-w-7xl mx-auto">
            <!-- Header principal con efecto glassmorphism -->
            <div class="morphing-border mb-8">
                <div class="inner-card p-8">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                        
                        <!-- Sección de bienvenida -->
                        <div class="flex-1">
                            <div class="flex items-center gap-6 mb-4">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl blur opacity-75 pulse-ring"></div>
                                    <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 p-4 rounded-2xl icon-glow">
                                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h1 class="text-4xl font-black text-gray-800 mb-3 tracking-tight">Dashboard Administrador</h1>
                                    <div class="gradient-text">
                                        <p class="text-2xl font-bold">¡Bienvenido de vuelta, Usuario! 👋</p>
                                    </div>
                                    <p class="text-gray-600 mt-3 text-lg">Gestiona tu plataforma desde aquí. Todo está bajo control.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Calendario y reloj con diseño hexagonal -->
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl blur opacity-75"></div>
                            <div class="relative bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl p-8 text-white shadow-2xl min-w-[320px] diagonal-pattern">
                                <div class="text-center">
                                    <div class="mb-6">
                                        <div id="current-time" class="text-4xl font-black mb-3 tracking-wider"></div>
                                        <div id="current-date" class="text-xl opacity-90 font-medium"></div>
                                    </div>
                                    
                                    <div class="border-t border-white/30 pt-6">
                                        <div class="flex items-center justify-center gap-3 mb-3">
                                            <div class="bg-white/20 p-2 rounded-lg">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <span class="font-bold text-lg">Hoy es</span>
                                        </div>
                                        <div id="day-name" class="text-2xl font-black tracking-wide"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Atajos Rápidos -->
            <div class="glass-morphism rounded-3xl p-8 mb-8 neon-glow">
                <div class="flex items-center gap-4 mb-8">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl blur opacity-75"></div>
                        <div class="relative bg-gradient-to-r from-emerald-500 to-teal-600 p-4 rounded-2xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black text-gray-800">Atajos Rápidos</h2>
                        <span class="text-sm text-gray-500 bg-white/60 px-4 py-2 rounded-full font-semibold mt-2 inline-block">Acceso directo</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Usuarios -->
                    <a href="#" class="group card-hover">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 border-2 border-blue-200 hover:border-blue-400 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-blue-500/10 rounded-full -translate-y-10 translate-x-10"></div>
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-blue-500 group-hover:translate-x-1 transition-transform">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Usuarios</h3>
                                <p class="text-gray-600 font-medium">Gestionar usuarios del sistema</p>
                            </div>
                        </div>
                    </a>

                    <!-- Planes -->
                    <a href="#" class="group card-hover">
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-8 border-2 border-purple-200 hover:border-purple-400 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-purple-500/10 rounded-full -translate-y-10 translate-x-10"></div>
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-4 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-purple-500 group-hover:translate-x-1 transition-transform">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Planes</h3>
                                <p class="text-gray-600 font-medium">Administrar planes de suscripción</p>
                            </div>
                        </div>
                    </a>

                    <!-- Pagos -->
                    <a href="#" class="group card-hover">
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 border-2 border-green-200 hover:border-green-400 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-green-500/10 rounded-full -translate-y-10 translate-x-10"></div>
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="bg-gradient-to-r from-green-500 to-green-600 p-4 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-green-500 group-hover:translate-x-1 transition-transform">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Pagos</h3>
                                <p class="text-gray-600 font-medium">Revisar transacciones y pagos</p>
                            </div>
                        </div>
                    </a>

                    <!-- Campañas -->
                    <a href="#" class="group card-hover">
                        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-8 border-2 border-orange-200 hover:border-orange-400 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-orange-500/10 rounded-full -translate-y-10 translate-x-10"></div>
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-4 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-orange-500 group-hover:translate-x-1 transition-transform">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Campañas</h3>
                                <p class="text-gray-600 font-medium">Gestionar campañas de marketing</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Fila adicional para Analíticas -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-8">
                    <a href="#" class="group card-hover">
                        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl p-8 border-2 border-indigo-200 hover:border-indigo-400 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-indigo-500/10 rounded-full -translate-y-10 translate-x-10"></div>
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 p-4 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-indigo-500 group-hover:translate-x-1 transition-transform">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Analíticas</h3>
                                <p class="text-gray-600 font-medium">Ver estadísticas y métricas</p>
                            </div>
                        </div>
                    </a>

                    <!-- Tarjeta de próximamente -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 border-2 border-dashed border-gray-300 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-gray-400/5 to-gray-500/5"></div>
                        <div class="relative z-10 flex items-center justify-center h-full">
                            <div class="text-center text-gray-500">
                                <div class="bg-gray-400 p-4 rounded-xl mb-4 inline-block">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <p class="font-bold text-lg">Próximamente</p>
                                <p class="text-sm opacity-75">Nuevas funciones</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateDateTime() {
            const now = new Date();
            
            const timeOptions = { 
                hour: '2-digit', 
                minute: '2-digit',
                second: '2-digit',
                hour12: false 
            };
            
            const dateOptions = { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric'
            };
            
            const dayOptions = { 
                weekday: 'long'
            };
            
            document.getElementById('current-time').textContent = now.toLocaleTimeString('es-ES', timeOptions);
            document.getElementById('current-date').textContent = now.toLocaleDateString('es-ES', dateOptions);
            document.getElementById('day-name').textContent = now.toLocaleDateString('es-ES', dayOptions);
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>