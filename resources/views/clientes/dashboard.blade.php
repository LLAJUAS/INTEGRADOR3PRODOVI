@extends('layouts.app2')

@section('title', 'Dashboard del Cliente')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        
        <!-- Header Section -->
        <div class="relative overflow-hidden bg-gradient-to-r from-purple-400 via-indigo-400 to-blue-500 rounded-2xl shadow-xl">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute -top-4 -right-4 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
            <div class="absolute -bottom-8 -left-8 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
            <div class="relative px-8 py-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-5">
                            ¡Hola, {{ $user->name }}! 
                            <span class="inline-block animate-bounce">👋</span>
                        </h1>
                        <p class="text-blue-100 text-lg font-medium">
                            Aquí tienes el resumen de tu campaña de la semana
                        </p>
                       
                    </div>
                    <div class="hidden lg:block">
                        
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Analytics Overview -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
            <div class="px-8 py-6 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Métricas Clave</h2>
                        <p class="text-gray-600 mt-1">Resumen semanal de rendimiento</p>
                    </div>
                    <button onclick="window.location.href='{{ route('clientes.analiticas') }}'" 
                            class="mt-4 sm:mt-0 group relative overflow-hidden bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <div class="absolute inset-0 bg-white/20 translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                        <div class="relative flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>Ver Analíticas</span>
                        </div>
                    </button>
                </div>
            </div>
            
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <!-- Publicaciones Card -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl p-6 border border-blue-200/50 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-blue-500/10 rounded-full -translate-y-4 translate-x-4"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-blue-500 rounded-xl shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full">
                                    +2
                                </div>
                            </div>
                            <h3 class="text-sm font-medium text-gray-600 mb-1">Publicaciones esta semana</h3>
                            <p class="text-3xl font-bold text-gray-900 mb-2">4</p>
                            <div class="flex items-center text-sm">
                                <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                
                                <span class="text-gray-500 ml-1">publicaciones esta semana</span>
                            </div>
                        </div>
                    </div>

                    <!-- Interacciones Card -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-purple-50 to-pink-100 rounded-2xl p-6 border border-purple-200/50 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-purple-500/10 rounded-full -translate-y-4 translate-x-4"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="p-3 bg-purple-500 rounded-xl shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                    </svg>
                                </div>
                                <div class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full">
                                    +15%
                                </div>
                            </div>
                            <h3 class="text-sm font-medium text-gray-600 mb-1">Total de interacciones</h3>
                            <p class="text-3xl font-bold text-gray-900 mb-2">1,248</p>
                            <div class="flex items-center text-sm">
                                <svg class="w-4 h-4 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-green-600 font-medium">15%</span>
                                <span class="text-gray-500 ml-1">desde la semana pasada</span>
                            </div>
                        </div>
                    </div>

                    <!-- Facebook Card -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-6 text-white hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-8 translate-x-8"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold">Facebook</span>
                                </div>
                                <div class="bg-white/20 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    +45
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-2xl font-bold">320</span>
                                    <span class="text-sm opacity-80">seguidores</span>
                                </div>
                                <div class="w-full bg-white/20 rounded-full h-2">
                                    <div class="bg-white h-2 rounded-full transition-all duration-500 ease-out" style="width: 65%"></div>
                                </div>
                            </div>
                            <p class="text-sm opacity-80">Meta mensual: 500 seguidores</p>
                        </div>
                    </div>

                    <!-- Instagram Card -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-pink-500 to-purple-600 rounded-2xl p-6 text-white hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-8 translate-x-8"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold">Instagram</span>
                                </div>
                                <div class="bg-white/20 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    +28
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-2xl font-bold">215</span>
                                    <span class="text-sm opacity-80">seguidores</span>
                                </div>
                                <div class="w-full bg-white/20 rounded-full h-2">
                                    <div class="bg-white h-2 rounded-full transition-all duration-500 ease-out" style="width: 45%"></div>
                                </div>
                            </div>
                            <p class="text-sm opacity-80">Meta mensual: 400 seguidores</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- Accesos rápidos -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Accesos rápidos</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="#" class="group">
                <div class="bg-gray-50 hover:bg-blue-50 rounded-lg p-4 border border-gray-200 group-hover:border-blue-300 transition duration-200">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="font-medium text-gray-700 group-hover:text-blue-700">Aprobar contenidos</span>
                    </div>
                </div>
            </a>
            
            <a href="#" class="group">
                <div class="bg-gray-50 hover:bg-purple-50 rounded-lg p-4 border border-gray-200 group-hover:border-purple-300 transition duration-200">
                    <div class="flex items-center">
                        <div class="bg-purple-100 p-2 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="font-medium text-gray-700 group-hover:text-purple-700">Ver recursos</span>
                    </div>
                </div>
            </a>
            
           <a href="{{ route('clientes.analiticas.exportar-pdf', ['periodo' => '7dias']) }}" class="group">
    <div class="bg-gray-50 hover:bg-green-50 rounded-lg p-4 border border-gray-200 group-hover:border-green-300 transition duration-200">
        <div class="flex items-center">
            <div class="bg-green-100 p-2 rounded-lg mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <span class="font-medium text-gray-700 group-hover:text-green-700">Descargar informe semanal</span>
        </div>
    </div>
</a>

            
            
        </div>
    </div>

        <!-- Plan Contratado Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
            <div class="px-8 py-6 border-b border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900">Plan Contratado</h2>
                <p class="text-gray-600 mt-1">Detalles de tu suscripción actual</p>
            </div>
            
            <div class="p-8">
                <div class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 rounded-2xl border border-indigo-200/50" id="plan-contratado-container">
                    <div class="text-center py-12">
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl mx-auto flex items-center justify-center animate-pulse">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-gray-600 mt-4 font-medium">Cargando información del plan...</p>
                        <p class="text-sm text-gray-500 mt-1">Esto tomará unos segundos</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Modal para detalles del plan -->
<div id="plan-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Fondo del modal con blur -->
        <div class="fixed inset-0 transition-opacity backdrop-blur-sm" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-900/50"></div>
        </div>
        
        <!-- Contenido del modal -->
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-gray-200">
            
            <!-- Header del modal -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white" id="modal-plan-title">Detalles del Plan</h3>
                    <button type="button" id="close-modal" class="text-white/80 hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Contenido del modal -->
            <div class="bg-white px-6 py-6">
                
                <!-- Información del ciclo -->
                <div class="mb-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <h4 class="font-bold text-gray-800 mb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Ciclo de facturación
                    </h4>
                    <p class="text-gray-700 font-medium" id="modal-plan-dates"></p>
                    <p class="text-sm mt-1" id="modal-plan-status"></p>
                </div>
                
                <!-- Descripción -->
                <div class="mb-6">
                    <h4 class="font-bold text-gray-800 mb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Descripción
                    </h4>
                    <p class="text-gray-600 leading-relaxed" id="modal-plan-description"></p>
                </div>
                
                <!-- Características -->
                <div>
                    <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Características incluidas
                    </h4>
                    <div class="space-y-2" id="modal-plan-features">
                        <!-- Características se llenarán aquí -->
                    </div>
                </div>
            </div>

            <!-- Footer del modal -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex justify-end">
                    <button type="button" id="close-modal-footer" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium py-2 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchPlanContratado();
    
    function fetchPlanContratado() {
        fetch('/cliente/plan-contratado')
            .then(response => {
                if (!response.ok) {
                    throw new Error('No se pudo obtener la información del plan');
                }
                return response.json();
            })
            .then(data => {
                renderPlanContratado(data.plan);
                setupPlanModal(data.plan);
            })
            .catch(error => {
                console.error('Error:', error);
                renderErrorPlanContratado(error.message);
            });
    }
    
    function renderPlanContratado(plan) {
        const container = document.getElementById('plan-contratado-container');
        
        // Crear características HTML con diseño moderno
        let caracteristicasHtml = '';
        if (plan.caracteristicas && plan.caracteristicas.length > 0) {
            plan.caracteristicas.forEach((caracteristica, index) => {
                const colors = [
                    'from-blue-500 to-indigo-600',
                    'from-purple-500 to-pink-600', 
                    'from-green-500 to-emerald-600',
                    'from-orange-500 to-red-600',
                    'from-cyan-500 to-blue-600'
                ];
                const colorClass = colors[index % colors.length];
                
                caracteristicasHtml += `
                    <div class="group relative overflow-hidden bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br ${colorClass} opacity-10 rounded-full -translate-y-4 translate-x-4 group-hover:scale-110 transition-transform duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-3">
                                <div class="p-2 bg-gradient-to-br ${colorClass} rounded-xl shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h4 class="font-semibold text-gray-700 text-sm mb-2">${caracteristica.nombre}</h4>
                            <p class="text-3xl font-bold bg-gradient-to-r ${colorClass} bg-clip-text text-transparent">
                                ${caracteristica.cantidad}${caracteristica.unidad || ''}
                            </p>
                        </div>
                    </div>
                `;
            });
        }
        
        const statusColors = {
            'activa': 'bg-green-100 text-green-800 border-green-200',
            'pendiente': 'bg-amber-100 text-amber-800 border-amber-200',
            'inactiva': 'bg-red-100 text-red-800 border-red-200'
        };
        
        container.innerHTML = `
            <div class="p-8">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between mb-8">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="p-3 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">${plan.nombre}</h3>
                                <p class="text-gray-600">${plan.descripcion || 'Plan de marketing digital'}</p>
                            </div>
                        </div>
                        
                        <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-white/40">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-600">Ciclo actual:</span>
                                    <span class="text-sm font-semibold text-gray-800">${plan.fecha_inicio} - ${plan.fecha_fin}</span>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full border ${statusColors[plan.estado] || statusColors['inactiva']}">
                                    <div class="w-2 h-2 rounded-full bg-current mr-2"></div>
                                    ${plan.estado}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 lg:mt-0 lg:ml-8">
                        <button id="ver-detalles-btn" class="group relative overflow-hidden bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-3 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                            <div class="absolute inset-0 bg-white/20 translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                            <div class="relative flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Ver detalles</span>
                            </div>
                        </button>
                    </div>
                </div>
                
                ${caracteristicasHtml ? `
                    <div class="mt-8">
                        <h4 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Características principales
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            ${caracteristicasHtml}
                        </div>
                    </div>
                ` : ''}
            </div>
        `;
    }
    
    function setupPlanModal(plan) {
        const modal = document.getElementById('plan-modal');
        const verDetallesBtn = document.getElementById('ver-detalles-btn');
        const closeModalBtn = document.getElementById('close-modal');
        const closeModalFooterBtn = document.getElementById('close-modal-footer');
        
        // Llenar datos del modal
        document.getElementById('modal-plan-title').textContent = `Plan ${plan.nombre}`;
        document.getElementById('modal-plan-dates').textContent = `${plan.fecha_inicio} - ${plan.fecha_fin}`;
        
        const statusColors = {
            'activa': 'text-green-600',
            'pendiente': 'text-amber-600',
            'inactiva': 'text-red-600'
        };
        
        document.getElementById('modal-plan-status').innerHTML = `
            Estado: <span class="${statusColors[plan.estado] || statusColors['inactiva']} font-semibold">${plan.estado}</span>
        `;
        document.getElementById('modal-plan-description').textContent = plan.descripcion || 'No hay descripción disponible';
        
        // Llenar características con diseño moderno
        const featuresList = document.getElementById('modal-plan-features');
        featuresList.innerHTML = '';
        
        if (plan.todas_caracteristicas && plan.todas_caracteristicas.length > 0) {
            plan.todas_caracteristicas.forEach(caracteristica => {
                const div = document.createElement('div');
                div.className = 'flex items-center p-3 bg-gray-50 rounded-xl border border-gray-200';
                
                const starIcon = caracteristica.es_destacado ? 
                    '<svg class="w-5 h-5 text-amber-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>' : 
                    '<svg class="w-5 h-5 text-indigo-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                
                div.innerHTML = `
                    ${starIcon}
                    <div class="flex-1">
                        <span class="font-medium text-gray-800">${caracteristica.nombre}</span>
                        <span class="text-gray-600">: ${caracteristica.cantidad}${caracteristica.unidad || ''}</span>
                        ${caracteristica.frecuencia ? `<span class="text-sm text-gray-500 block">${caracteristica.frecuencia}</span>` : ''}
                    </div>
                `;
                featuresList.appendChild(div);
            });
        } else {
            const div = document.createElement('div');
            div.className = 'flex items-center justify-center p-6 text-gray-500';
            div.innerHTML = `
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                No se encontraron características
            `;
            featuresList.appendChild(div);
        }
        
        // Event listeners
        function openModal() {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        verDetallesBtn.addEventListener('click', openModal);
        closeModalBtn.addEventListener('click', closeModal);
        closeModalFooterBtn.addEventListener('click', closeModal);
        
        // Cerrar con Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
        
        // Cerrar al hacer clic fuera del modal
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });
    }  
        
    function renderErrorPlanContratado(message) {
        const container = document.getElementById('plan-contratado-container');
        container.innerHTML = `
            <div class="text-center py-16">
                <div class="relative">
                    <div class="w-20 h-20 bg-red-100 rounded-2xl mx-auto flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Error al cargar el plan</h3>
                <p class="text-gray-600 mb-6">${message}</p>
                <button onclick="fetchPlanContratado()" class="group relative overflow-hidden bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <div class="absolute inset-0 bg-white/20 translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                    <div class="relative flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span>Reintentar</span>
                    </div>
                </button>
            </div>
        `;
    }
    
    // Hacer la función accesible globalmente para el botón de reintento
    window.fetchPlanContratado = fetchPlanContratado;
});
</script>
@endpush

@endsection