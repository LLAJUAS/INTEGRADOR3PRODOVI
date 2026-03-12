@extends('layouts.app')

@section('title', 'Editar Plan de Marketing')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header de navegación -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Editar Plan de Marketing</h1>
                <p class="text-gray-600">Empresa: {{ $planMarketing->empresa->nombre_empresa }}</p>
            </div>
            <a href="{{ route('administrador.empresas.planes-marketing.show', $planMarketing->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver al Plan
            </a>
        </div>

        <!-- Formulario de Edición -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-4 text-white">
                <h2 class="text-xl font-bold">Modifica el Contenido del Plan</h2>
                <p class="text-yellow-100 text-sm">Puedes editar el texto plano directamente. Los cambios se guardarán y se reflejarán en la vista del plan.</p>
            </div>
            
            <form action="{{ route('administrador.empresas.planes-marketing.update', $planMarketing->id) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label for="contenido" class="block text-gray-700 text-sm font-bold mb-2">Contenido del Plan de Marketing</label>
                    <textarea 
                        name="contenido" 
                        id="contenido" 
                        rows="25" 
                        class="w-full px-4 py-3 text-gray-700 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                        placeholder="Pega aquí el contenido completo del plan...">{{ $planMarketing->contenido }}</textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('administrador.empresas.planes-marketing.show', $planMarketing->id) }}" class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors font-medium">
                        Cancelar
                    </a>
                    <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium shadow-md">
                        <svg class="w-5 h-5 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection