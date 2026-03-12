@extends('layouts.app2')

@section('title', 'Analíticas')

@section('content')
<!-- Métricas Clave - Versión Mejorada -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Analíticas de Rendimiento</h2>
        </div>
        <div class="flex space-x-3 mt-4 sm:mt-0">
            <select id="timeRange" class="bg-gray-50 border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-sm">
                <option value="7">Últimos 7 días</option>
                <option value="30" selected>Últimos 30 días</option>
                <option value="365">Este año</option>
            </select>
            <button onclick="exportData(event)" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Exportar
            </button>
        </div>
    </div>
    
    <!-- Contenedor para las métricas dinámicas -->
    <div id="metricsContainer">
        @include('clientes.analiticas.partials.analiticas')
    </div>
</div>

<!-- Scripts para gráficos y funcionalidad -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Función para cargar métricas según el rango de tiempo seleccionado
    document.getElementById('timeRange').addEventListener('change', function() {
        const timeRange = this.value;
        let viewName;
        
        switch(timeRange) {
            case '7':
                viewName = '7dias';
                break;
            case '30':
                viewName = '30dias';
                break;
            case '365':
                viewName = 'anual';
                break;
            default:
                viewName = '30dias';
        }
        
        // Cargar la vista correspondiente
        fetch(`/clientes/analiticas/load-view?view=${viewName}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('metricsContainer').innerHTML = html;
                initCharts(); // Reiniciar gráficos después de cargar nuevo contenido
            });
    });

    // Función para inicializar todos los gráficos
    function initCharts() {
        if (!window.analiticasData) return;
        const data = window.analiticasData;

        // Gráfico de engagement (mini)
        const engagementCtx = document.getElementById('engagementChart').getContext('2d');
        if (window.engagementChartInstance) window.engagementChartInstance.destroy();
        window.engagementChartInstance = new Chart(engagementCtx, {
            type: 'line',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                datasets: [{
                    data: data.engagement.chart_data,
                    borderColor: '#6366F1',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { display: false },
                    y: { display: false }
                }
            }
        });

        // Gráfico de reach (mini)
        const reachCtx = document.getElementById('reachChart').getContext('2d');
        if (window.reachChartInstance) window.reachChartInstance.destroy();
        window.reachChartInstance = new Chart(reachCtx, {
            type: 'line',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                datasets: [{
                    data: data.reach.chart_data,
                    borderColor: '#8B5CF6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { display: false },
                    y: { display: false }
                }
            }
        });

        // Gráfico de conversión (mini)
        const conversionCtx = document.getElementById('conversionChart').getContext('2d');
        if (window.conversionChartInstance) window.conversionChartInstance.destroy();
        window.conversionChartInstance = new Chart(conversionCtx, {
            type: 'line',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
                datasets: [{
                    data: data.conversion.chart_data,
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { display: false },
                    y: { display: false }
                }
            }
        });

        // Gráfico de crecimiento de seguidores
        const growthCtx = document.getElementById('followersGrowthChart').getContext('2d');
        if (window.followersGrowthChartInstance) window.followersGrowthChartInstance.destroy();
        window.followersGrowthChartInstance = new Chart(growthCtx, {
            type: 'line',
            data: {
                labels: data.followers.growth_labels,
                datasets: [
                    {
                        label: 'Facebook',
                        data: data.followers.growth_facebook,
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.05)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Instagram',
                        data: data.followers.growth_instagram,
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
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            drawBorder: false
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

        // Gráfico de distribución de engagement
        const distributionCtx = document.getElementById('engagementDistributionChart').getContext('2d');
        if (window.engagementDistributionChartInstance) window.engagementDistributionChartInstance.destroy();
        
        const platformData = {
            labels: ['Facebook', 'Instagram'],
            datasets: [{
                data: [data.distribution.platform.facebook, data.distribution.platform.instagram],
                backgroundColor: ['#3B82F6', '#EC4899'],
                borderWidth: 0,
                cutout: '70%'
            }]
        };
        
        window.engagementDistributionChartInstance = new Chart(distributionCtx, {
            type: 'doughnut',
            data: platformData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw}%`;
                            }
                        }
                    }
                }
            }
        });

        // Manejar cambio en el select de distribución de engagement
        const selectDist = document.getElementById('engagementDistribution');
        if(selectDist) {
            // Eliminar listeners viejos si existen clonando el nodo
            const newSelectDist = selectDist.cloneNode(true);
            selectDist.parentNode.replaceChild(newSelectDist, selectDist);
            
            newSelectDist.addEventListener('change', function() {
                const selectedOption = this.value;
                if (selectedOption === 'hour') {
                    window.engagementDistributionChartInstance.data.labels = data.distribution.time.labels;
                    window.engagementDistributionChartInstance.data.datasets[0].data = data.distribution.time.data;
                    window.engagementDistributionChartInstance.data.datasets[0].backgroundColor = [
                        '#6366F1', '#8B5CF6', '#EC4899', '#F97316', '#10B981', '#3B82F6'
                    ];
                } else {
                    window.engagementDistributionChartInstance.data.labels = ['Facebook', 'Instagram'];
                    window.engagementDistributionChartInstance.data.datasets[0].data = [data.distribution.platform.facebook, data.distribution.platform.instagram];
                    window.engagementDistributionChartInstance.data.datasets[0].backgroundColor = [
                        '#3B82F6', '#EC4899'
                    ];
                }
                window.engagementDistributionChartInstance.update();
            });
        }
    }

    // Inicializar gráficos cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', initCharts);

   function exportData(event) {
    // Mostrar un spinner o indicador de carga
    const btnExportar = event ? (event.currentTarget || event.target) : document.querySelector('button[onclick="exportData()"]');
    const originalHtml = btnExportar.innerHTML;
    btnExportar.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Generando informe...';
    btnExportar.disabled = true;

    // Obtener el periodo seleccionado
    const timeRangeSelect = document.getElementById('timeRange');
    let periodo = '30dias';
    if(timeRangeSelect) {
        switch(timeRangeSelect.value) {
            case '7': periodo = '7dias'; break;
            case '30': periodo = '30dias'; break;
            case '365': periodo = 'anual'; break;
        }
    }
    
    // Hacer la petición al servidor
    fetch(`/clientes/analiticas/exportar-pdf?periodo=${periodo}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/pdf',
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => response.blob())
    .then(blob => {
        // Crear un enlace para descargar el PDF
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `informe_analiticas_${periodo}.pdf`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        
        // Restaurar el botón
        btnExportar.innerHTML = originalHtml;
        btnExportar.disabled = false;
    })
    .catch(error => {
        console.error('Error al exportar:', error);
        btnExportar.innerHTML = originalHtml;
        btnExportar.disabled = false;
        alert('Ocurrió un error al generar el informe. Por favor, inténtalo de nuevo.');
    });
}
</script>
@endsection