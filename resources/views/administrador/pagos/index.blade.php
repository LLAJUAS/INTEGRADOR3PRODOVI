@extends('layouts.app')

@section('title', 'Gestión de Pagos')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Alerts -->
            @if(session('success'))
                <div
                    class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-xl"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.style.display='none'" class="text-green-500 hover:text-green-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div
                    class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.style.display='none'" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- Header Section -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-credit-card mr-3 text-indigo-600"></i>
                            Gestión de Pagos
                        </h1>
                        <p class="text-gray-600 mt-2">Administra y monitorea el estado de todas las suscripciones</p>
                    </div>
                </div>
            </div>
          
          
            @include('administrador.pagos.filtroPagos')

            <!-- Stats Cards -->
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

            <!-- Quick Actions Section -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg p-3 mr-4">
                        <i class="fas fa-bolt text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Acciones Rápidas</h2>
                        <p class="text-gray-600">Herramientas esenciales para la gestión de pagos</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div
                        class="bg-blue-50 border border-blue-200 rounded-lg p-4 cursor-pointer transition-all duration-200 hover:shadow-md hover:border-blue-300">
                        <div class="flex items-center mb-3">
                            <div class="bg-blue-500 rounded-md p-2 mr-3">
                                <i class="fas fa-plus text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Nuevo Pago</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-3">Registrar un nuevo pago manualmente</p>
                        <span
                            class="inline-flex items-center text-xs font-medium text-blue-700 bg-blue-100 rounded-full px-2.5 py-0.5">
                            <i class="fas fa-mouse-pointer mr-1"></i> Click para acceder
                        </span>
                    </div>

                    <div
                        class="bg-purple-50 border border-purple-200 rounded-lg p-4 cursor-pointer transition-all duration-200 hover:shadow-md hover:border-purple-300">
                        <div class="flex items-center mb-3">
                            <div class="bg-purple-500 rounded-md p-2 mr-3">
                                <i class="fas fa-chart-bar text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Reporte Mensual</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-3">Descarga el reporte mensual de pagos</p>
                        <span
                            class="inline-flex items-center text-xs font-medium text-purple-700 bg-purple-100 rounded-full px-2.5 py-0.5">
                            <i class="fas fa-mouse-pointer mr-1"></i> Click para acceder
                        </span>
                    </div>
                </div>
            </div>

            <!-- Modal para Reporte Mensual -->
<div id="reporteMensualModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-purple-100">
                <i class="fas fa-chart-bar text-purple-600 text-xl"></i>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Reporte Mensual</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Se generará un reporte con todas las transacciones del mes actual.
                    Elige el formato que prefieres:
                </p>
            </div>
            <div class="flex justify-center space-x-4 mt-4">
                <button id="btnPdfMensual" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <i class="fas fa-file-pdf mr-2"></i> Descargar PDF
                </button>
                <button id="btnExcelMensual" class="px-4 py-2 bg-green-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <i class="fas fa-file-excel mr-2"></i> Descargar Excel
                </button>
            </div>
            <div class="items-center px-4 py-3">
                <button id="cerrarModal" class="px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>


        </div>
    </div>

<script>
    // Evento para abrir el modal de reporte mensual
document.addEventListener('DOMContentLoaded', function() {
    // ... tu código existente ...

    // Agregar evento click a la tarjeta de Reporte Mensual
    const reporteMensualCard = document.querySelector('.bg-purple-50.border.border-purple-200');
    if (reporteMensualCard) {
        reporteMensualCard.addEventListener('click', function() {
            document.getElementById('reporteMensualModal').classList.remove('hidden');
        });
    }

    // Evento para cerrar el modal
    document.getElementById('cerrarModal').addEventListener('click', function() {
        document.getElementById('reporteMensualModal').classList.add('hidden');
    });

    // Evento para descargar PDF mensual
    document.getElementById('btnPdfMensual').addEventListener('click', function() {
        document.getElementById('reporteMensualModal').classList.add('hidden');
        window.open('/administrador/pagos/reporte-mensual/pdf', '_blank');
    });

    // Evento para descargar Excel mensual
    document.getElementById('btnExcelMensual').addEventListener('click', function() {
        document.getElementById('reporteMensualModal').classList.add('hidden');
        window.open('/administrador/pagos/reporte-mensual/excel', '_blank');
    });
});
</script>

@endsection