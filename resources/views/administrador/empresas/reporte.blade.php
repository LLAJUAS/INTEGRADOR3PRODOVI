@extends('layouts.app')

@section('title', 'Reporte Ejecutivo')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header de navegación -->
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Reporte Ejecutivo</h1>
            <div class="flex space-x-3">
                <a href="{{ route('administrador.empresas.reporte.pdf', $empresa->id) }}" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
    </svg>
    Descargar PDF
</a>
                <a href="{{ route('administrador.empresas.show', $empresa->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver
                </a>
            </div>
        </div>

        <!-- Contenedor del reporte para impresión -->
        <div id="reporte-contenido" class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Portada -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-12 text-white">
                <div class="text-center">
                    <h1 class="text-4xl font-bold mb-2">Reporte Ejecutivo</h1>
                    <h2 class="text-2xl font-light mb-8">{{ $empresa->nombre_empresa }}</h2>
                    <div class="flex justify-center items-center space-x-4 text-sm">
                        <span>{{ $empresa->tipo_empresa }}</span>
                        <span>•</span>
                        <span>{{ now()->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Contenido del reporte -->
            <div class="px-8 py-8">
                @foreach($secciones as $seccion)
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 pb-2 border-b-2 border-blue-500">{{ $seccion['titulo'] }}</h2>
                        <div class="prose prose-lg text-gray-700 whitespace-pre-line">{{ $seccion['contenido'] }}</div>
                    </div>
                @endforeach

                <!-- Pie de página -->
                <div class="mt-12 pt-8 border-t border-gray-200 text-center text-sm text-gray-500">
                    
                    <p>Fecha de generación: {{ now()->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('download-pdf').addEventListener('click', function() {
        // Ocultar elementos que no deben aparecer en el PDF
        const elementosOcultar = document.querySelectorAll('button, a:not([href^="mailto:"])');
        elementosOcultar.forEach(el => el.style.display = 'none');
        
        // Configurar opciones de impresión
        window.print();
        
        // Restaurar elementos después de la impresión
        setTimeout(() => {
            elementosOcultar.forEach(el => el.style.display = '');
        }, 1000);
    });
});
</script>
@endsection