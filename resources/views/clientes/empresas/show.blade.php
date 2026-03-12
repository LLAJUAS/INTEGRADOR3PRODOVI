@extends('layouts.app2')

@section('title', 'Detalles de la Empresa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                <strong class="font-bold">¡Éxito!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Tarjeta principal de la empresa -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-8">
                <div class="flex items-center space-x-6">
                    @if($empresa->logo)
                        <div class="w-24 h-24 bg-white rounded-xl p-2 shadow-lg">
                            <img src="{{ Storage::url($empresa->logo) }}" alt="Logo de {{ $empresa->nombre_empresa }}" class="w-full h-full object-contain">
                        </div>
                    @else
                        <div class="w-24 h-24 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $empresa->nombre_empresa }}</h1>
                        <p class="text-indigo-100 text-lg mt-1">{{ $empresa->tipo_empresa }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Contenido -->
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Información Principal -->
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Información de la Empresa</h2>
                            @if($empresa->descripcion)
                                <p class="text-gray-600 leading-relaxed">{{ $empresa->descripcion }}</p>
                            @else
                                <p class="text-gray-400 italic">No se ha proporcionado una descripción.</p>
                            @endif
                        </div>

                        <!-- Estado del Cuestionario -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Estado del Cuestionario</h2>
                            @if($empresa->cuestionario_completado)
                                <div class="flex items-center p-4 bg-green-50 border border-green-200 rounded-xl">
                                    <svg class="w-8 h-8 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <p class="font-semibold text-green-800">Cuestionario Completado</p>
                                        <p class="text-sm text-green-600">Gracias por proporcionar toda la información necesaria. Un administrador generará tu resumen ejecutivo pronto.</p>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center p-4 bg-amber-50 border border-amber-200 rounded-xl">
                                    <svg class="w-8 h-8 text-amber-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <p class="font-semibold text-amber-800">Cuestionario Pendiente</p>
                                        <p class="text-sm text-amber-600">Es importante que completes el cuestionario para poder empezar.</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- SECCIÓN ELIMINADA: Resumen Ejecutivo --}}
                        {{-- 
                        @if($empresa->resumen_ejecutivo)
                            <div class="mt-6 p-6 bg-blue-50 border border-blue-200 rounded-xl">
                                <h2 class="text-2xl font-bold text-blue-900 mb-4">Resumen Ejecutivo Generado</h2>
                                <div class="prose prose-sm max-w-none text-gray-700">
                                    <p>{!! nl2br(e($empresa->resumen_ejecutivo)) !!}</p>
                                </div>
                            </div>
                        @endif
                        --}}
                    </div>

                    <!-- Acciones -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-50 rounded-xl p-6 sticky top-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Acciones</h3>
                            <div class="space-y-3">
                                <a href="{{ route('empresas.edit', $empresa->id) }}" class="w-full flex items-center justify-center px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Editar Empresa
                                </a>
                                
                                <a href="{{ route('empresas.cuestionario', $empresa->id) }}" class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg">
                                    @if($empresa->cuestionario_completado)
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Ver Cuestionario
                                    @else
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        Completar Cuestionario
                                    @endif
                                </a>

                                {{-- BOTÓN ELIMINADO: Generar Resumen --}}
                                {{-- 
                                @if($empresa->cuestionario_completado && !$empresa->resumen_ejecutivo)
                                    <button id="generate-summary-btn" class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-green-600 to-teal-600 text-white rounded-lg hover:from-green-700 hover:to-teal-700 transition-all duration-200 shadow-md hover:shadow-lg">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                        </svg>
                                        Generar Resumen Ejecutivo
                                    </button>
                                @endif
                                --}}

                                <a href="{{ route('clientes.micuenta') }}" class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Volver 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT ELIMINADO: Llamada a la API para generar resumen --}}
{{-- 
@if($empresa->cuestionario_completado && !$empresa->resumen_ejecutivo)
<script>
// ... todo el código JavaScript para generar el resumen ...
</script>
@endif
--}}
@endsection