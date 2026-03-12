@extends('layouts.app')

@section('title', 'Dashboard del Administrador')

@section('head')
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
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

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
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
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
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

            80%,
            100% {
                transform: scale(1.2);
                opacity: 0;
            }
        }

        .diagonal-pattern {
            background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.1) 50%, rgba(255, 255, 255, 0.1) 75%, transparent 75%, transparent);
            background-size: 20px 20px;
        }

        .neon-glow {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3), 0 0 40px rgba(99, 102, 241, 0.2);
        }

        /* Nuevos estilos para los contenedores de gráficos */
        .chart-container {
            position: relative;
            height: 300px;
            /* Altura fija para el gráfico mensual */
            width: 100%;
        }

        .chart-container-small {
            position: relative;
            height: 250px;
            /* Altura fija para el gráfico anual */
            width: 100%;
        }

        .chart-container-donut {
            position: relative;
            height: 250px;
            /* Altura fija para el gráfico de dona */
            width: 100%;
            max-width: 250px;
            /* Ancho máximo para el gráfico de dona */
            margin: 0 auto;
            /* Centrar el gráfico de dona */
        }
    </style>
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <div class="min-h-screen bg-blue-50">
        <div class="relative overflow-hidden">
            <!-- Elementos decorativos de fondo -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute top-20 left-20 w-32 h-32 bg-purple-400 rounded-full opacity-20 blur-xl floating-card">
                </div>
                <div class="absolute top-40 right-40 w-24 h-24 bg-blue-400 rounded-full opacity-20 blur-xl floating-card"
                    style="animation-delay: -2s"></div>
                <div class="absolute bottom-20 left-1/3 w-28 h-28 bg-pink-400 rounded-full opacity-20 blur-xl floating-card"
                    style="animation-delay: -4s"></div>
            </div>

            <div class="relative z-10 p-6 max-w-7xl mx-auto">
                <!-- Header principal con efecto glassmorphism -->
                <div class="morphing-border mb-8">
                    <div class="inner-card p-8 bg-white">
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">

                            <!-- Sección de bienvenida -->
                            <div class="flex-1">
                                <div class="flex items-center gap-6 mb-4">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-indigo-500 rounded-2xl blur opacity-75 pulse-ring">
                                        </div>
                                        <div class="relative bg-indigo-600 p-4 rounded-2xl icon-glow">
                                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h1 class="text-4xl font-black text-gray-800 mb-3 tracking-tight">Dashboard
                                            Administrador</h1>
                                        <p class="text-2xl font-bold text-purple-600">¡Bienvenido de vuelta,
                                            {{ auth()->user()->name }}! 👋
                                        </p>
                                        <p class="text-gray-600 mt-3 text-lg">Gestiona tu plataforma desde aquí.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Calendario y reloj con diseño hexagonal -->
                            <div class="relative">
                                <div class="absolute inset-0 bg-indigo-600 rounded-3xl blur opacity-75"></div>
                                <div
                                    class="relative bg-indigo-600 rounded-3xl p-8 text-white shadow-2xl min-w-[320px] diagonal-pattern">
                                    <div class="text-center">
                                        <div class="mb-6">
                                            <div id="current-time" class="text-4xl font-black mb-3 tracking-wider"></div>
                                            <div id="current-date" class="text-xl opacity-90 font-medium"></div>
                                        </div>

                                        <div class="border-t border-white/30 pt-6">
                                            <div class="flex items-center justify-center gap-3 mb-3">
                                                <div class="bg-white/20 p-2 rounded-lg">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                        </path>
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



                <!-- Sección de Estadísticas Principales -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Campañas Activas -->
                    <a href="{{ route('administrador.campañas.index') }}" class="card-hover">
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 h-full">
                            <div class="flex items-center justify-between mb-4">
                                <div class="bg-orange-100 p-3 rounded-xl">
                                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-orange-600 bg-orange-100 px-2 py-1 rounded-full">Ver
                                    todas</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $activeCampaigns }}</h3>
                            <p class="text-gray-600 font-medium">Campañas Activas</p>
                        </div>
                    </a>

                    <!-- Usuarios Registrados -->
                    <a href="{{ route('administrador.usuarios.index') }}" class="card-hover">
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 h-full">
                            <div class="flex items-center justify-between mb-4">
                                <div class="bg-blue-100 p-3 rounded-xl">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13.5 5.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Ver
                                    todos</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalUsers }}</h3>
                            <p class="text-gray-600 font-medium">Usuarios Registrados</p>
                        </div>
                    </a>

                    <!-- Empresas Registradas -->
                    <a href="#" class="card-hover">
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 h-full">
                            <div class="flex items-center justify-between mb-4">
                                <div class="bg-purple-100 p-3 rounded-xl">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-purple-600 bg-purple-100 px-2 py-1 rounded-full">Ver
                                    todas</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalCompanies }}</h3>
                            <p class="text-gray-600 font-medium">Empresas Registradas</p>
                        </div>
                    </a>

                    <!-- Ingresos Mensuales -->
                    <a href="{{ route('administrador.pagos.index') }}" class="card-hover">
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 h-full">
                            <div class="flex items-center justify-between mb-4">
                                <div class="bg-green-100 p-3 rounded-xl">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">Ver
                                    detalles</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-800 mb-1">
                                {{ number_format($currentMonthIncome, 2, ',', '.') }}Bs</h3>
                            <p class="text-gray-600 font-medium">Ingresos Mensuales</p>
                            <div class="mt-2">
                                @if($monthlyIncomeChangePercentage !== null)
                                    @if($monthlyIncomeChangePercentage > 0)
                                        <span class="text-xs text-green-600 font-semibold">
                                            <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                            </svg>
                                            +{{ round($monthlyIncomeChangePercentage, 1) }}% vs mes anterior
                                        </span>
                                    @else
                                        <span class="text-xs text-red-600 font-semibold">
                                            <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                            </svg>
                                            {{ round(abs($monthlyIncomeChangePercentage), 1) }}% vs mes anterior
                                        </span>
                                    @endif
                                @else
                                    <span class="text-xs text-gray-500 font-semibold">
                                        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Sin datos del mes anterior
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                                <!-- Gráficos en una sola fila -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Gráfico Mensual -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Ingresos Mensuales</h3>
                        <div class="chart-container">
                            <canvas id="monthlyChart"></canvas>
                        </div>
                    </div>

                    <!-- Gráfico de Dona - Distribución de Pagos -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Distribución de Suscripciones</h3>
                        <div class="chart-container-donut">
                            <canvas id="donutChart"></canvas>
                        </div>
                        <div class="mt-4 text-center">
                            <div class="flex justify-center space-x-4">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                    <span class="text-sm text-gray-600">Activos ({{ $countActivos }})</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                                    <span class="text-sm text-gray-600">Pendientes ({{ $countPendientes }})</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-gray-500 rounded-full mr-2"></div>
                                    <span class="text-sm text-gray-600">Finalizados ({{ $countFinalizados }})</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gráfico Anual -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Ingresos Anuales</h3>
                        <div class="chart-container-small">
                            <canvas id="yearlyChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Sección de Suscripciones -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Suscripciones Activas -->
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 h-2"></div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="bg-green-100 rounded-full p-3">
                                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-gray-800">{{ $countActivos }}</div>
                                </div>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Suscripciones Activas</h3>
                            <p class="text-gray-600 text-sm mb-4">Usuarios con pagos al día</p>
                            <a href="{{ route('administrador.pagos.realizados') }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors duration-200">
                                <i class="fas fa-eye mr-2"></i>
                                Ver detalles
                            </a>
                        </div>
                    </div>

                    <!-- Pagos Pendientes -->
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
                        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 h-2"></div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="bg-yellow-100 rounded-full p-3">
                                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-gray-800">{{ $countPendientes }}</div>
                                </div>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Pagos Pendientes</h3>
                            <p class="text-gray-600 text-sm mb-4">Requieren atención inmediata</p>
                            <a href="{{ route('administrador.pagos.pendientes-fisicos') }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors duration-200">
                                <i class="fas fa-clock mr-2"></i>
                                Ver detalles
                            </a>
                        </div>
                    </div>

                    <!-- Finalizados/Cancelados -->
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
                        <div class="bg-gradient-to-r from-gray-500 to-gray-600 h-2"></div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="bg-gray-100 rounded-full p-3">
                                    <i class="fas fa-archive text-gray-600 text-xl"></i>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-gray-800">{{ $countFinalizados }}</div>
                                </div>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Finalizados/Cancelados</h3>
                            <p class="text-gray-600 text-sm mb-4">Suscripciones completadas</p>
                            <a href="{{ route('administrador.pagos.finalizados') }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors duration-200">
                                <i class="fas fa-archive mr-2"></i>
                                Ver detalles
                            </a>
                        </div>
                    </div>
                </div>







                <!-- Plan Más Contratado -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Plan Más Contratado</h3>
                    @if($mostContractedPlan)
                        <div class="text-center">
                            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl p-6 text-white mb-4">
                                <h4 class="text-2xl font-bold mb-2">{{ $mostContractedPlan->nombre }}</h4>
                                <p class="text-3xl font-bold">{{ number_format($mostContractedPlan->precio, 2, ',', '.') }}Bs
                                </p>
                                <p class="text-sm opacity-90 mt-2">{{ $mostContractedPlan->subtitulo }}</p>
                            </div>
                            <p class="text-gray-600">
                                <span class="font-bold">{{ $mostContractedPlan->suscripciones_count }}</span> suscripciones
                                activas
                            </p>
                        </div>
                    @else
                        <div class="text-center text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <p>No hay planes contratados aún</p>
                        </div>
                    @endif
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

        // Esperar a que el DOM esté completamente cargado
        document.addEventListener('DOMContentLoaded', function () {
            // Obtener los datos de los gráficos desde Laravel
            const monthlyIncomeData = @json($monthlyIncome->toArray());
            const yearlyIncomeData = @json($yearlyIncome->toArray());

            // Datos para el gráfico de dona
            const paymentStatusData = {
                activos: {{ $countActivos }},
                pendientes: {{ $countPendientes }},
                finalizados: {{ $countFinalizados }}
                };

            // Configuración del gráfico mensual
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');

            if (monthlyIncomeData.length > 0) {
                const monthlyLabels = monthlyIncomeData.map(item => {
                    const date = new Date(item.year, item.month - 1);
                    return date.toLocaleDateString('es-ES', { year: 'numeric', month: 'short' });
                });
                const monthlyDataValues = monthlyIncomeData.map(item => item.total);

                new Chart(monthlyCtx, {
                    type: 'line',
                    data: {
                        labels: monthlyLabels,
                        datasets: [{
                            label: 'Ingresos Mensuales',
                            data: monthlyDataValues,
                            backgroundColor: 'rgba(99, 102, 241, 0.2)',
                            borderColor: 'rgba(99, 102, 241, 1)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 1000,
                            easing: 'easeInOutQuart'
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                padding: 12,
                                displayColors: false,
                                callbacks: {
                                    label: function (context) {
                                        return 'Ingresos: Bs' + context.parsed.y.toLocaleString('es-ES');
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    callback: function (value) {
                                        return 'Bs' + value.toLocaleString('es-ES');
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            } else {
                // Mostrar mensaje si no hay datos
                document.querySelector('.chart-container').innerHTML = `
                        <div class="flex items-center justify-center h-full">
                            <p class="text-gray-500 text-center">No hay datos de ingresos mensuales para mostrar.<br>Asegúrate de tener pagos con estado "completado" y fecha de pago registrada.</p>
                        </div>
                    `;
            }

            // Configuración del gráfico de dona
            const donutCtx = document.getElementById('donutChart').getContext('2d');

            new Chart(donutCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Activos', 'Pendientes', 'Finalizados'],
                    datasets: [{
                        data: [paymentStatusData.activos, paymentStatusData.pendientes, paymentStatusData.finalizados],
                        backgroundColor: [
                            'rgba(34, 197, 94, 0.8)',
                            'rgba(234, 179, 8, 0.8)',
                            'rgba(107, 114, 128, 0.8)'
                        ],
                        borderColor: [
                            'rgba(34, 197, 94, 1)',
                            'rgba(234, 179, 8, 1)',
                            'rgba(107, 114, 128, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        animateRotate: true,
                        animateScale: true,
                        duration: 1000,
                        easing: 'easeInOutQuart'
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            padding: 12,
                            displayColors: true,
                            callbacks: {
                                label: function (context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((context.parsed / total) * 100);
                                    return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                                }
                            }
                        }
                    },
                    cutout: '60%'
                }
            });

            // Configuración del gráfico anual
            const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');

            if (yearlyIncomeData.length > 0) {
                const yearlyLabels = yearlyIncomeData.map(item => item.year);
                const yearlyDataValues = yearlyIncomeData.map(item => item.total);

                new Chart(yearlyCtx, {
                    type: 'bar',
                    data: {
                        labels: yearlyLabels,
                        datasets: [{
                            label: 'Ingresos Anuales',
                            data: yearlyDataValues,
                            backgroundColor: 'rgba(99, 102, 241, 0.7)',
                            borderColor: 'rgba(99, 102, 241, 1)',
                            borderWidth: 1,
                            borderRadius: 5,
                            barPercentage: 0.6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 1000,
                            easing: 'easeInOutQuart'
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                padding: 12,
                                displayColors: false,
                                callbacks: {
                                    label: function (context) {
                                        return 'Ingresos: Bs' + context.parsed.y.toLocaleString('es-ES');
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    callback: function (value) {
                                        return 'Bs' + value.toLocaleString('es-ES');
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            } else {
                // Mostrar mensaje si no hay datos
                document.querySelector('.chart-container-small').innerHTML = `
                        <div class="flex items-center justify-center h-full">
                            <p class="text-gray-500 text-center">No hay datos de ingresos anuales para mostrar.<br>Asegúrate de tener pagos con estado "completado" y fecha de pago registrada.</p>
                        </div>
                    `;
            }
        });
    </script>
@endsection