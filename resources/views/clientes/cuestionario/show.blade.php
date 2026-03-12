@extends('layouts.app2')

@section('title', 'Cuestionario de Información de Empresa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
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
            
            <!-- Formulario -->
            <form action="{{ route('empresas.cuestionario.store', $empresa->id) }}" method="POST" class="p-6">
                @csrf
                
                <!-- Información de la empresa -->
                <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $empresa->nombre_empresa }}</h3>
                    <p class="text-gray-600">{{ $empresa->tipo_empresa }}</p>
                    @if($empresa->descripcion)
                        <p class="text-gray-600 mt-2">{{ $empresa->descripcion }}</p>
                    @endif
                </div>
                
                <!-- Preguntas del cuestionario -->
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
                                    <label for="respuesta_{{ $pregunta->id }}" class="block text-gray-800 font-medium mb-2">
                                        {{ $pregunta->pregunta }}
                                        @if($pregunta->requerido)
                                            <span class="text-red-500">*</span>
                                        @endif
                                    </label>
                                    
                                    @if($pregunta->ayuda)
                                        <p class="text-sm text-gray-600 mb-3">{{ $pregunta->ayuda }}</p>
                                    @endif
                                    
                                    @if($pregunta->tipo_respuesta === 'texto_largo')
                                        <textarea 
                                            id="respuesta_{{ $pregunta->id }}" 
                                            name="respuesta_{{ $pregunta->id }}" 
                                            rows="4" 
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                            @if($pregunta->requerido) required @endif
                                        >{{ $respuestasExistentes[$pregunta->id] ?? '' }}</textarea>
                                    @else
                                        <input 
                                            type="text" 
                                            id="respuesta_{{ $pregunta->id }}" 
                                            name="respuesta_{{ $pregunta->id }}" 
                                            value="{{ $respuestasExistentes[$pregunta->id] ?? '' }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                            @if($pregunta->requerido) required @endif
                                        >
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                
                <!-- Botones de acción -->
                <div class="flex justify-between">
                    <a href="{{ route('empresas.show', $empresa->id) }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        Cancelar
                    </a>
                    
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                        Guardar respuestas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection