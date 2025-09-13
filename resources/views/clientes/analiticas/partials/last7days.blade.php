<!-- Primera fila de métricas para últimos 7 días -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Engagement Rate -->
    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Tasa de Engagement</p>
                <p class="text-3xl font-bold text-gray-800">5.1%</p>
                <div class="flex items-center mt-1">
                    <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-green-100 text-green-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                        </svg>
                        8.5%
                    </span>
                    <span class="text-xs text-gray-500 ml-2">vs semana anterior</span>
                </div>
            </div>
            <div class="bg-white p-2 rounded-lg shadow-xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <canvas id="engagementChart" height="80"></canvas>
        </div>
    </div>

    <!-- Alcance Total -->
    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Alcance Total</p>
                <p class="text-3xl font-bold text-gray-800">12.8K</p>
                <div class="flex items-center mt-1">
                    <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-green-100 text-green-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                        </svg>
                        6.7%
                    </span>
                    <span class="text-xs text-gray-500 ml-2">vs semana anterior</span>
                </div>
            </div>
            <div class="bg-white p-2 rounded-lg shadow-xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <canvas id="reachChart" height="80"></canvas>
        </div>
    </div>

    <!-- Nuevos Seguidores -->
    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Nuevos Seguidores</p>
                <p class="text-3xl font-bold text-gray-800">142</p>
                <div class="flex items-center mt-1">
                    <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-green-100 text-green-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                        </svg>
                        4.4%
                    </span>
                    <span class="text-xs text-gray-500 ml-2">vs semana anterior</span>
                </div>
            </div>
            <div class="bg-white p-2 rounded-lg shadow-xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                <span>Facebook: 85</span>
                <span>Instagram: 57</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-2 rounded-full" style="width: 60%"></div>
            </div>
        </div>
    </div>

    <!-- Tasa de Conversión -->
    <div class="bg-gradient-to-r from-green-50 to-teal-50 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Tasa de Conversión</p>
                <p class="text-3xl font-bold text-gray-800">3.5%</p>
                <div class="flex items-center mt-1">
                    <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-red-100 text-red-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1v-5a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586l-4.293-4.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd"/>
                        </svg>
                        0.9%
                    </span>
                    <span class="text-xs text-gray-500 ml-2">vs semana anterior</span>
                </div>
            </div>
            <div class="bg-white p-2 rounded-lg shadow-xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <canvas id="conversionChart" height="80"></canvas>
        </div>
    </div>
</div>

<!-- Segunda fila - Gráficos principales -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Gráfico de crecimiento de seguidores -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Crecimiento de Seguidores (7 días)</h3>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-xs bg-indigo-100 text-indigo-800 rounded-full hover:bg-indigo-200 transition-colors">Facebook</button>
                <button class="px-3 py-1 text-xs bg-pink-100 text-pink-800 rounded-full hover:bg-pink-200 transition-colors">Instagram</button>
            </div>
        </div>
        <div class="h-80">
            <canvas id="followersGrowthChart"></canvas>
        </div>
    </div>

    <!-- Distribución de engagement por plataforma -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Distribución de Engagement</h3>
            <select id="engagementDistribution" class="bg-gray-50 border border-gray-300 text-gray-700 py-1 px-3 pr-8 rounded-full focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-xs">
                <option value="platform">Por Plataforma</option>
                <option value="time">Por Hora del Día</option>
            </select>
        </div>
        <div class="h-80">
            <canvas id="engagementDistributionChart"></canvas>
        </div>
    </div>
</div>

<!-- Tercera fila - Métricas secundarias -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Horario óptimo -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Horario Óptimo (7 días)</h3>
        <div class="flex items-center mb-4">
            <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="font-medium text-gray-800">Mejor hora para publicar</p>
                <p class="text-xs text-gray-500">Basado en datos de engagement</p>
            </div>
        </div>
        <div class="bg-gray-50 p-3 rounded-lg">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-medium text-gray-700">16:00 - 17:00</span>
                <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full">+28% engagement</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-indigo-600 h-2 rounded-full" style="width: 68%"></div>
            </div>
        </div>
    </div>

    <!-- Demografía -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Audiencia Principal</h3>
        <div class="flex items-center mb-4">
            <div class="bg-pink-100 p-2 rounded-lg mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <div>
                <p class="font-medium text-gray-800">Perfil Demográfico</p>
                <p class="text-xs text-gray-500">Segmento más comprometido</p>
            </div>
        </div>
        <div class="space-y-2">
            <div>
                <div class="flex justify-between text-xs text-gray-500 mb-1">
                    <span>Mujeres 25-34</span>
                    <span>45%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-pink-500 h-1.5 rounded-full" style="width: 45%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between text-xs text-gray-500 mb-1">
                    <span>Hombres 25-34</span>
                    <span>30%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-blue-500 h-1.5 rounded-full" style="width: 30%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between text-xs text-gray-500 mb-1">
                    <span>Mujeres 18-24</span>
                    <span>18%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-purple-500 h-1.5 rounded-full" style="width: 18%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Datos específicos para 7 días
    document.addEventListener('DOMContentLoaded', function() {
        // Gráfico de crecimiento de seguidores para 7 días
        const growthCtx = document.getElementById('followersGrowthChart').getContext('2d');
        new Chart(growthCtx, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                datasets: [
                    {
                        label: 'Facebook',
                        data: [320, 325, 330, 332, 335, 338, 340],
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.05)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Instagram',
                        data: [210, 212, 213, 215, 217, 218, 220],
                        borderColor: '#EC4899',
                        backgroundColor: 'rgba(236, 72, 153, 0.05)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                }
            }
        });

        // Configurar el evento para el select de distribución de engagement
        document.getElementById('engagementDistribution').addEventListener('change', function() {
            const type = this.value;
            loadEngagementDistribution(type, '7days');
        });

        // Cargar distribución inicial
        loadEngagementDistribution('platform', '7days');
    });

    function loadEngagementDistribution(type, period) {
        const ctx = document.getElementById('engagementDistributionChart').getContext('2d');
        
        // Destruir gráfico anterior si existe
        if (window.engagementDistributionChart) {
            window.engagementDistributionChart.destroy();
        }
        
        let data;
        if (type === 'platform') {
            data = {
                labels: ['Facebook', 'Instagram'],
                datasets: [{
                    data: [58, 42],
                    backgroundColor: ['#3B82F6', '#EC4899'],
                    borderWidth: 0
                }]
            };
        } else {
            data = {
                labels: ['6-9', '9-12', '12-15', '15-18', '18-21', '21-24'],
                datasets: [{
                    data: [5, 15, 20, 35, 15, 10],
                    backgroundColor: ['#6366F1', '#8B5CF6', '#EC4899', '#F59E0B', '#10B981', '#3B82F6'],
                    borderWidth: 0
                }]
            };
        }
        
        window.engagementDistributionChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });
    }
</script>