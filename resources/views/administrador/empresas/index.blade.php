@extends('layouts.app')

@section('title', 'Empresas Registradas')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-3xl font-bold text-gray-900">Empresas Registradas</h1>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('administrador.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver al Panel
                </a>
            </div>
        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Filtros</h2>
            <form method="GET" action="{{ route('administrador.empresas.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Filtro por Usuario -->
                <div>
                    <label for="usuario_id" class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
                    <select id="usuario_id" name="usuario_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Todos los usuarios</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ request('usuario_id') == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->name }} ({{ $usuario->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por Plan -->
                <div>
                    <label for="plan_id" class="block text-sm font-medium text-gray-700 mb-1">Plan</label>
                    <select id="plan_id" name="plan_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Todos los planes</option>
                        @foreach($planes as $plan)
                            <option value="{{ $plan->id }}" {{ request('plan_id') == $plan->id ? 'selected' : '' }}>
                                {{ $plan->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por Estado -->
                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select id="estado" name="estado" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Todos los estados</option>
                        <option value="activa" {{ request('estado') == 'activa' ? 'selected' : '' }}>Activa</option>
                        <option value="inactiva" {{ request('estado') == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                    </select>
                </div>

                <!-- Botón de filtrar -->
                <div class="flex items-end">
                    <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        Filtrar
                    </button>
                </div>
            </form>
        </div>

        <!-- Contador de resultados -->
        <div class="mb-6 text-gray-600">
            Mostrando {{ $empresas->count() }} de {{ $empresas->total() }} empresas
        </div>

        <!-- Grid de empresas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($empresas as $empresa)
                <a href="{{ route('administrador.empresas.show', $empresa->id) }}" class="block transform transition-all duration-200 hover:scale-105">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden h-full">
                        <!-- Header de la card -->
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                            <div class="flex items-center">
                                @if($empresa->logo)
                                    <div class="w-16 h-16 bg-white rounded-lg p-2 mr-4">
                                        <img src="{{ Storage::url($empresa->logo) }}" alt="Logo de {{ $empresa->nombre_empresa }}" class="w-full h-full object-contain">
                                    </div>
                                @else
                                    <div class="w-16 h-16 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="text-white">
                                    <h3 class="text-xl font-bold truncate">{{ $empresa->nombre_empresa }}</h3>
                                    <p class="text-indigo-100 text-sm">{{ $empresa->tipo_empresa }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido de la card -->
                        <div class="p-6">
                            <!-- Información del usuario -->
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-1">Propietario</p>
                                <p class="text-gray-900 font-medium">{{ $empresa->usuario->name }}</p>
                                <p class="text-gray-600 text-sm">{{ $empresa->usuario->email }}</p>
                            </div>

                            <!-- Información del plan -->
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-1">Plan</p>
                                @if($empresa->usuario->suscripciones->isNotEmpty())
                                    @php
                                        $suscripcionActiva = $empresa->usuario->suscripciones->where('estado', 'activa')->first();
                                    @endphp
                                    @if($suscripcionActiva)
                                        <p class="text-gray-900 font-medium">{{ $suscripcionActiva->plan->nombre }}</p>
                                        <div class="flex items-center mt-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Activo
                                            </span>
                                            <span class="text-gray-500 text-xs ml-2">
                                                Vence: {{ $suscripcionActiva->fecha_fin->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    @else
                                        <p class="text-gray-900 font-medium">Sin suscripción activa</p>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Inactivo
                                        </span>
                                    @endif
                                @else
                                    <p class="text-gray-900 font-medium">Sin suscripción</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Sin plan
                                    </span>
                                @endif
                            </div>

                            <!-- Estado del cuestionario -->
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-1">Cuestionario</p>
                                @if($empresa->cuestionario_completado)
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-gray-900 font-medium">Completado</span>
                                    </div>
                                @else
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-amber-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-gray-900 font-medium">Pendiente</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Descripción (truncada) -->
                            @if($empresa->descripcion)
                                <div class="mb-4">
                                    <p class="text-sm text-gray-500 mb-1">Descripción</p>
                                    <p class="text-gray-700 text-sm line-clamp-3">{{ Str::limit($empresa->descripcion, 100) }}</p>
                                </div>
                            @endif

                            <!-- Fecha de registro -->
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Fecha de registro</p>
                                <p class="text-gray-700 text-sm">{{ $empresa->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No se encontraron empresas</h3>
                    <p class="mt-1 text-sm text-gray-500">Intenta ajustar los filtros para ver más resultados.</p>
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        @if($empresas->hasPages())
            <div class="mt-8">
                {{ $empresas->links() }}
            </div>
        @endif
    </div>
</div>
@endsection