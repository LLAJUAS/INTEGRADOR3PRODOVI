@extends('layouts.app')

@section('title', 'Cuestionario de Información de Empresa (Vista Admin)')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header de navegación -->
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Cuestionario de la Empresa</h1>
            <a href="{{ route('administrador.empresas.show', $empresa->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a la Empresa
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-white">Cuestionario de Información de Empresa</h1>
                    <div class="text-white/80">
                        {{ $empresa->nombre_empresa }}
                    </div>
                </div>
            </div>
            
            <!-- Información de la empresa -->
            <div class="p-6">
                <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $empresa->nombre_empresa }}</h3>
                    <p class="text-gray-600">{{ $empresa->tipo_empresa }}</p>
                    <p class="text-sm text-gray-500 mt-2">Propietario: {{ $empresa->usuario->name }} ({{ $empresa->usuario->email }})</p>
                    @if($empresa->descripcion)
                        <p class="text-gray-600 mt-2">{{ $empresa->descripcion }}</p>
                    @endif
                </div>
                
                <!-- Preguntas del cuestionario (SOLO LECTURA) -->
                @foreach($temas as $tema)
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <span class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-indigo-600 font-semibold">{{ $loop->iteration }}</span>
                            </span>
                            {{ $tema->nombre_tema }}
                        </h2>
                        
                        @if($tema->descripcion_tema)
                            <p class="text-gray-600 mb-4">{{ $tema->descripcion_tema }}</p>
                        @endif
                        
                        <div class="space-y-6">
                            @foreach($tema->preguntas as $pregunta)
                                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                                    <div class="block text-gray-800 font-medium mb-2">
                                        {{ $pregunta->pregunta }}
                                        @if($pregunta->requerido)
                                            <span class="text-red-500">*</span>
                                        @endif
                                    </div>
                                    
                                    @if($pregunta->ayuda)
                                        <p class="text-sm text-gray-600 mb-3">{{ $pregunta->ayuda }}</p>
                                    @endif
                                    
                                    @if($pregunta->tipo_respuesta === 'texto_largo')
                                        <div class="bg-white p-3 rounded-lg border border-gray-200">
                                            <p class="whitespace-pre-wrap">{{ $respuestasExistentes[$pregunta->id] ?? 'No respondida' }}</p>
                                        </div>
                                    @else
                                        <div class="bg-white p-3 rounded-lg border border-gray-200">
                                            <p>{{ $respuestasExistentes[$pregunta->id] ?? 'No respondida' }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                
                <!-- Botón de acción -->
                <div class="flex justify-end mt-8">
                    <a href="{{ route('administrador.empresas.show', $empresa->id) }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        Volver a detalles de la empresa
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection