@extends('layouts.app')

@section('title', 'Editar Resumen Ejecutivo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header de navegación -->
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Editar Resumen Ejecutivo</h1>
            <a href="{{ route('administrador.empresas.show', $empresa->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a la Empresa
            </a>
        </div>

        <!-- Tarjeta principal -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-white">Editar Resumen Ejecutivo</h1>
                    <div class="text-white/80">
                        {{ $empresa->nombre_empresa }}
                    </div>
                </div>
            </div>
            
            <!-- Formulario -->
            <form action="{{ route('administrador.empresas.update-resumen', $empresa->id) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                <!-- Información de la empresa -->
                <div class="mb-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $empresa->nombre_empresa }}</h3>
                    <p class="text-gray-600">{{ $empresa->tipo_empresa }}</p>
                    <p class="text-sm text-gray-500 mt-2">Propietario: {{ $empresa->usuario->name }} ({{ $empresa->usuario->email }})</p>
                </div>
                
                <!-- Contenido del resumen -->
                <div class="mb-6">
                    <label for="resumen_ejecutivo" class="block text-gray-800 font-medium mb-2">Contenido del Resumen Ejecutivo</label>
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4">
                        <p class="text-sm text-blue-800">
                            <strong>Nota:</strong> Puedes editar el contenido del resumen ejecutivo generado por la IA para ajustarlo según tus necesidades.
                            Asegúrate de mantener un tono profesional y enfocado en los beneficios para el cliente. Este resumen se usara para crear el plan de marketing.
                        </p>
                    </div>
                    <textarea 
                        id="resumen_ejecutivo" 
                        name="resumen_ejecutivo" 
                        rows="20" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        required>{{ $empresa->resumen_ejecutivo }}</textarea>
                    @error('resumen_ejecutivo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Botones de acción -->
                <div class="flex justify-between">
                    <a href="{{ route('administrador.empresas.show', $empresa->id) }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        Cancelar
                    </a>
                    
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection