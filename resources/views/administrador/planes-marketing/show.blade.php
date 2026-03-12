@extends('layouts.app')

@section('title', 'Plan de Marketing')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header de navegación -->
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Plan de Marketing</h1>
            <div class="flex space-x-3">
                {{-- =============================================
                     BLOQUE DE BOTONES DE ACCIÓN (EDICIÓN, DESCARGAS)
                     ============================================= --}}
                
                <!-- Botón de Editar (ahora es un enlace a la vista de edición) -->
                <a href="{{ route('administrador.empresas.planes-marketing.edit', $planMarketing->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar Plan
                </a>
                
                <!-- Botón de Descargar Word -->
                <a href="{{ route('administrador.empresas.planes-marketing.download-word', $planMarketing->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Descargar Word
                </a>
                
                <!-- Botón de Descargar PDF -->
                <a href="{{ route('administrador.empresas.planes-marketing.download-pdf', $planMarketing->id) }}" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Descargar PDF
                </a>
                
                <!-- Botón para Volver a la Empresa -->
                <a href="{{ route('administrador.empresas.show', $planMarketing->empresa->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver a la Empresa
                </a>
            </div>
        </div>

        <!-- Contenedor del plan -->
        <div id="reporte-contenido" class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Portada -->
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-8 py-12 text-white">
                <div class="text-center">
                    <h1 class="text-4xl font-bold mb-2">Plan de Marketing</h1>
                    <h2 class="text-2xl font-light mb-8">{{ $planMarketing->empresa->nombre_empresa }}</h2>
                    <div class="flex justify-center items-center space-x-4 text-sm">
                        <span>{{ $planMarketing->suscripcion->plan->nombre }}</span>
                        <span>•</span>
                        <span>{{ $planMarketing->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Contenido del plan (Vista) -->
            <div id="vista-contenido" class="px-8 py-8">
                @php
                    // 1. Dividir el contenido en secciones basadas en los encabezados ##
                    $contenidoCompleto = $planMarketing->contenido;
                    $partes = preg_split('/^##\s+(.+)$/m', $contenidoCompleto, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
                    
                    $seccionesParseadas = [];
                    for ($i = 0; $i < count($partes); $i += 2) {
                        if (isset($partes[$i+1])) {
                            $titulo = trim($partes[$i]);
                            $contenido = trim($partes[$i+1]);
                            
                            // 2. Parsear el contenido de cada sección a HTML
                            $contenidoHtml = $contenido;
                            $contenidoHtml = preg_replace('/^-{3,}\s*$/m', '', $contenidoHtml);
                            $contenidoHtml = preg_replace('/^###\s+(.+)$/m', '<strong>$1</strong>', $contenidoHtml);
                            $contenidoHtml = preg_replace('/(^- .+$(\r?\n)?)+/m', '<ul>$0</ul>', $contenidoHtml);
                            $contenidoHtml = preg_replace('/^- (.+)$/m', '<li>$1</li>', $contenidoHtml);
                            $contenidoHtml = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $contenidoHtml);
                            $contenidoHtml = preg_replace('/\*\((.+?)\)\*/', '$1', $contenidoHtml);
                            $contenidoHtml = preg_replace('/^(?!<h|<ul|<li|<p)(<strong>.+<\/strong>)(:)$/m', '<h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">$1$2</h3>', $contenidoHtml);
                            
                            $lineas = explode("\n", $contenidoHtml);
                            $nuevoContenido = '';
                            $enLista = false;
                            foreach ($lineas as $linea) {
                                $lineaLimpia = trim($linea);
                                if (empty($lineaLimpia)) continue;

                                if (strpos($lineaLimpia, '<li>') === 0) {
                                    $enLista = true;
                                } elseif ($enLista && strpos($lineaLimpia, '<li>') !== 0) {
                                    $enLista = false;
                                }
                                
                                if (!$enLista && strpos($lineaLimpia, '<') !== 0) {
                                    $nuevoContenido .= '<p class="mb-4">' . $lineaLimpia . '</p>';
                                } else {
                                    $nuevoContenido .= $linea . "\n";
                                }
                            }
                            $contenidoHtml = $nuevoContenido;

                            $seccionesParseadas[] = ['titulo' => $titulo, 'contenido' => $contenidoHtml];
                        }
                    }
                @endphp

                @foreach($seccionesParseadas as $seccion)
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 pb-2 border-b-2 border-purple-500">{{ $seccion['titulo'] }}</h2>
                        <div class="prose prose-lg text-gray-700 max-w-none">
                            {!! $seccion['contenido'] !!}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pie de página -->
            <div class="mt-12 pt-8 border-t border-gray-200 text-center text-sm text-gray-500">
                <p>Plan generado para: {{ $planMarketing->empresa->nombre_empresa }}</p>
                <p>Fecha de generación: {{ $planMarketing->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection