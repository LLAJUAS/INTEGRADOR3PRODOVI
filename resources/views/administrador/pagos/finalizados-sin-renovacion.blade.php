@extends('layouts.app')

@section('title', 'Pagos Finalizados y Cancelados')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-purple-50 to-pink-50">
    <div class="container mx-auto px-4 py-8">
       <!-- Header con título y decoración -->
<div class="relative mb-8">
    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl opacity-5"></div>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Pagos Finalizados y Cancelados</h1>
                <p class="text-gray-600 mt-1">Consulta el historial completo de pagos procesados y cancelados</p>
            </div>
        </div>
    </div>
</div>
        
        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="mb-6">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 rounded-r-xl p-4 shadow-md">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-400 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Formulario de búsqueda mejorado -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-indigo-500  rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900">Búsqueda en Historial</h2>
                </div>
                
                <form id="filterForm" action="{{ route('administrador.pagos.finalizados') }}" method="GET" class="flex flex-col sm:flex-row items-end gap-4">
                    <!-- Campo de búsqueda por usuario -->
                    <div class="flex-1 w-full space-y-2">
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
                                placeholder="Ingresa el nombre del usuario para buscar..." 
                                value="{{ request('search') }}"
                                class="w-full px-4 py-3 pl-10 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 bg-gray-50 hover:bg-white"
                                oninput="debounceFilter()"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Botón Limpiar -->
                    @if(request('search'))
                        <div class="flex items-end">
                            <a 
                                href="{{ route('administrador.pagos.finalizados') }}" 
                                class="px-4 py-3 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition duration-200 flex items-center space-x-2 border border-gray-200 h-[50px]"
                                title="Limpiar búsqueda"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span class="hidden sm:inline">Limpiar</span>
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Tabla de resultados -->
        <div id="resultsContainer" class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-indigo-500  rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Historial de Pagos</h3>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                            <span class="text-xs text-gray-600">Finalizados</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                            <span class="text-xs text-gray-600">Cancelados</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="overflow-hidden">
                @include('administrador.pagos._finalizados_results', ['pagos' => $pagos])
            </div>
        </div>
    </div>
</div>

<script>
// Función debounce para el input de búsqueda
let debounceTimer;
function debounceFilter() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        document.getElementById('filterForm').submit();
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