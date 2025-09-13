@extends('layouts.app')

@section('title', 'Pagos Realizados')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header con título y decoración -->
<div class="relative mb-8">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl opacity-5"></div>
    <div class="relative bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
        <div class="flex items-center space-x-4">
            <!-- Botón de Atrás -->
            <a href="{{ route('administrador.pagos.index') }}" class="text-gray-500 hover:text-gray-700 transition duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            
            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Pagos Realizados</h1>
                <p class="text-gray-600 mt-1">Gestiona y consulta todos los pagos activos</p>
            </div>
        </div>
    </div>
</div>
        
        <!-- Formulario de búsqueda mejorado -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900">Filtros de Búsqueda</h2>
                </div>
                
                <form id="filterForm" action="{{ route('administrador.pagos.realizados') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Campo de búsqueda por usuario -->
                    <div class="space-y-2">
                        <label for="search" class="block text-sm font-semibold text-gray-700">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Buscar usuario</span>
                            </div>
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                name="search" 
                                id="search"
                                placeholder="Ingresa el nombre del usuario..." 
                                value="{{ request('search') }}"
                                class="w-full px-4 py-3 pl-10 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 bg-gray-50 hover:bg-white"
                                oninput="debounceFilter()"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Select para filtrar por plan -->
                    <div class="space-y-2">
                        <label for="plan" class="block text-sm font-semibold text-gray-700">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <span>Filtrar por plan</span>
                            </div>
                        </label>
                        <div class="relative">
                            <select 
                                name="plan" 
                                id="plan"
                                class="w-full px-4 py-3 pl-10 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 bg-gray-50 hover:bg-white appearance-none"
                                onchange="filterResults()"
                            >
                                <option value="">Todos los planes disponibles</option>
                                @foreach($planes as $plan)
                                    <option value="{{ $plan->id }}" {{ request('plan') == $plan->id ? 'selected' : '' }}>
                                        {{ $plan->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Botones de acción -->
                    <div class="flex items-end space-x-3">
                        <button 
                            type="submit" 
                            id="filterButton"
                            class="flex-1 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-6 py-3 rounded-xl font-semibold transition duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            <span>Filtrar</span>
                        </button>
                        
                        @if(request('search') || request('plan'))
                            <a 
                                href="{{ route('administrador.pagos.realizados') }}" 
                                class="px-4 py-3 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition duration-200 flex items-center space-x-2 border border-gray-200"
                                title="Limpiar filtros"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span class="hidden sm:inline">Limpiar</span>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de resultados -->
        <div id="resultsContainer" class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Resultados</h3>
                </div>
            </div>
            <div class="overflow-hidden">
                @include('administrador.pagos._results', ['pagos' => $pagos])
            </div>
        </div>
    </div>
</div>

<script>
// Función para filtrar resultados cuando cambia el select
function filterResults() {
    document.getElementById('filterForm').submit();
}

// Función debounce para el input de búsqueda
let debounceTimer;
function debounceFilter() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        filterResults();
    }, 500); // 500ms de retraso después de que el usuario deja de escribir
}

// Opcional: Si prefieres usar AJAX para una experiencia más fluida
function filterResultsWithAjax() {
    const form = document.getElementById('filterForm');
    const formData = new FormData(form);
    
    fetch(form.action + '?ajax=1', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: new URLSearchParams(formData)
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById('resultsContainer').innerHTML = html;
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection