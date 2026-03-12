@extends('layouts.app')

@section('title', 'Crear Plan de Marketing')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Crear Nuevo Plan de Marketing</h1>
            <a href="{{ route('administrador.empresas.show', $empresa->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a la Empresa
            </a>
        </div>

        <!-- Tarjeta principal -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-8">
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Empresa: {{ $empresa->nombre_empresa }}</h2>
                    <p class="text-gray-600">Este plan se generará para la suscripción activa del usuario <strong>{{ $empresa->usuario->name }}</strong>.</p>
                </div>

                <div class="mb-6 p-4 bg-indigo-50 border border-indigo-200 rounded-xl">
                    <h3 class="text-lg font-semibold text-indigo-900 mb-2">Plan de Suscripción Activo: {{ $suscripcionActiva->plan->nombre }}</h3>
                    <p class="text-indigo-700 text-sm mb-3">El plan de marketing se adaptará a las siguientes características:</p>
                    <ul class="list-disc list-inside text-sm text-indigo-600 space-y-1">
                        @foreach($caracteristicasPlan as $caracteristica)
                            <li>{{ $caracteristica->nombre }} ({{ $caracteristica->pivot->frecuencia }})</li>
                        @endforeach
                    </ul>
                </div>

                <form id="crear-plan-form" action="{{ route('administrador.empresas.planes-marketing.store', $empresa->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="suscripcion_id" value="{{ $suscripcionActiva->id }}">

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <p class="text-sm text-yellow-800">
                            <strong>Nota:</strong> Al hacer clic en "Generar Plan", el sistema creará un documento personalizado. Este proceso puede tardar uno o dos minutos.
                        </p>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" id="generar-plan-btn" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span id="btn-text">Generar Plan de Marketing</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('crear-plan-form');
    const btn = document.getElementById('generar-plan-btn');
    const btnText = document.getElementById('btn-text');

    if (form) {
        form.addEventListener('submit', function() {
            // Deshabilitar el botón y mostrar estado de carga
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            btnText.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Generando...
            `;
        });
    }
});
</script>
@endsection