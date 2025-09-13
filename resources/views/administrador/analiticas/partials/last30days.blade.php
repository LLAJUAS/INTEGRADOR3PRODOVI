<!-- Primera fila de métricas para gestión total -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <!-- Campañas Activas -->
    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Campañas Activas</p>
                <p class="text-3xl font-bold text-gray-800">1</p>
            </div>
            <div class="bg-white p-2 rounded-lg shadow-xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Presupuesto Total -->
    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Presupuesto Total</p>
                <p class="text-3xl font-bold text-gray-800">800 Bs</p>
            </div>
            <div class="bg-white p-2 rounded-lg shadow-xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Gráfico principal mejorado -->
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-8">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Resultados por Plataforma</h3>
        <div class="flex space-x-2">
            <button class="px-3 py-1 text-xs bg-indigo-100 text-indigo-800 rounded-full">Facebook</button>
            <button class="px-3 py-1 text-xs bg-pink-100 text-pink-800 rounded-full">Instagram</button>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Gráfico 1: Distribución del presupuesto -->
        <div>
            <h4 class="font-medium text-gray-700 mb-3 text-center">Distribución del Presupuesto</h4>
            <div class="h-64">
                <canvas id="budgetDistributionChart"></canvas>
            </div>
        </div>
        
        <!-- Gráfico 2: Resultados de alcance -->
        <div>
            <h4 class="font-medium text-gray-700 mb-3 text-center">Alcance e Interacciones</h4>
            <div class="h-64">
                <canvas id="resultsChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Gráfico de distribución del presupuesto
        const budgetCtx = document.getElementById('budgetDistributionChart').getContext('2d');
        new Chart(budgetCtx, {
            type: 'doughnut',
            data: {
                labels: ['Facebook (240 Bs)', 'Instagram (560 Bs)'],
                datasets: [{
                    data: [240, 560],
                    backgroundColor: ['#3B82F6', '#EC4899'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label;
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });

        // 2. Gráfico de resultados (alcance e interacciones)
        const resultsCtx = document.getElementById('resultsChart').getContext('2d');
        new Chart(resultsCtx, {
            type: 'bar',
            data: {
                labels: ['Personas alcanzadas', 'Me gusta'],
                datasets: [
                    {
                        label: 'Facebook',
                        data: [500, 20],
                        backgroundColor: '#3B82F6',
                        borderRadius: 6
                    },
                    {
                        label: 'Instagram',
                        data: [800, 100],
                        backgroundColor: '#EC4899',
                        borderRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.raw.toLocaleString()}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    });
</script>