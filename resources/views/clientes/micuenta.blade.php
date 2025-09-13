@extends('layouts.app2')

@section('title', 'Mi Cuenta')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna izquierda - Datos del cliente -->
        <div class="lg:col-span-1">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                <!-- Header -->
                <div class="px-8 py-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900">Mis Datos</h2>
                    <p class="text-gray-600 mt-1">Información de tu cuenta</p>
                </div>
                
                <!-- Contenido -->
                <div class="p-8">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ Auth::user()->name }}</h3>
                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 pt-1">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500">Teléfono</p>
                                <p class="text-sm text-gray-900">{{ Auth::user()->phone ?? 'No registrado' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 pt-1">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500">Rol</p>
                                <p class="text-sm text-gray-900">
                                    @foreach(Auth::user()->roles as $role)
                                        {{ $role->nombre_rol }}
                                        @if(!$loop->last), @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 pt-1">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-500">Miembro desde</p>
                                <p class="text-sm text-gray-900">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Editar perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Columna derecha - Plan contratado -->
        <div class="lg:col-span-2">
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