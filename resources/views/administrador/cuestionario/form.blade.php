@extends('layouts.app')

@section('title', isset($tema) ? 'Editar Tema' : 'Crear Nuevo Tema')

@section('content')
<style>
    /* Custom Animations */
    @keyframes slideDownAndFade {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-enter {
        animation: slideDownAndFade 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    
    /* Custom Scrollbar for Textareas */
    textarea::-webkit-scrollbar {
        width: 8px;
    }
    textarea::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    textarea::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    textarea::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<div class="min-h-screen bg-slate-50 py-8 font-sans">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ isset($tema) ? 'Editar Tema: ' . $tema->nombre_tema : 'Crear Nuevo Tema' }}
                </h1>
                <p class="mt-2 text-sm text-slate-500">
                    {{ isset($tema) ? 'Actualice la información y las preguntas de este tema.' : 'Defina el nombre, descripción y las preguntas para la estructura del cuestionario.' }}
                </p>
            </div>
            <div class="flex-shrink-0">
                <div class="h-12 w-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 shadow-sm border border-indigo-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-xl shadow-slate-200/50 rounded-2xl border border-slate-100 overflow-hidden">
            <div class="p-8">
                <form action="{{ isset($tema) ? route('administrador.cuestionario.estructura.update', $tema->id) : route('administrador.cuestionario.estructura.store') }}" method="POST">
                    @csrf
                    @if(isset($tema)) @method('PUT') @endif

                    <!-- Datos del Tema -->
                    <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8 mb-10 pb-8 border-b border-slate-100">
                        <div class="sm:col-span-2">
                            <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Información General
                            </h2>
                        </div>
                        
                        <div class="sm:col-span-1 border border-slate-200 p-4 rounded-xl shadow-sm hover:border-indigo-300 transition-colors duration-200">
                            <label for="nombre_tema" class="block text-sm font-medium text-slate-700 mb-1">Nombre del Tema <span class="text-red-500">*</span></label>
                            <input type="text" id="nombre_tema" name="nombre_tema" value="{{ old('nombre_tema', $tema->nombre_tema ?? '') }}" required placeholder="Ej: Análisis de Mercado" class="w-full rounded-lg border-slate-300 bg-slate-50 px-4 py-2.5 text-slate-900 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 sm:text-sm shadow-sm">
                        </div>
                        
                        <div class="sm:col-span-1 border border-slate-200 p-4 rounded-xl shadow-sm hover:border-indigo-300 transition-colors duration-200">
                            <label for="descripcion_tema" class="block text-sm font-medium text-slate-700 mb-1">Descripción <span class="text-slate-400 font-normal">(Opcional)</span></label>
                            <textarea id="descripcion_tema" name="descripcion_tema" rows="2" placeholder="Propósito de este bloque de preguntas..." class="w-full rounded-lg border-slate-300 bg-slate-50 px-4 py-2.5 text-slate-900 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 sm:text-sm shadow-sm">{{ old('descripcion_tema', $tema->descripcion_tema ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Preguntas Dinámicas -->
                    <div class="mb-4">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
                            <h2 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Preguntas del Tema
                            </h2>
                            <button type="button" id="add-pregunta-btn" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white text-sm font-medium rounded-lg shadow-md shadow-emerald-500/20 hover:from-emerald-600 hover:to-teal-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Añadir Pregunta
                            </button>
                        </div>
                        
                        <div id="preguntas-container" class="space-y-5 min-h-[150px]">
                            {{-- Las preguntas existentes se cargarán aquí con JavaScript --}}
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('administrador.cuestionario.estructura.index') }}" class="inline-flex items-center px-5 py-2.5 border border-slate-300 bg-white text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 hover:text-slate-900 hover:border-slate-400 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 text-white text-sm font-medium rounded-lg shadow-md shadow-indigo-500/30 hover:from-indigo-700 hover:to-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            {{ isset($tema) ? 'Guardar Cambios' : 'Crear Tema' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Template para una nueva pregunta (usado por JavaScript) -->
<template id="pregunta-template">
    <div class="pregunta-item bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group">
        <!-- Encabezado de la pregunta -->
        <div class="bg-slate-50 px-5 py-3 border-b border-slate-200 flex justify-between items-center relative">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-500"></div>
            <h3 class="text-sm font-bold text-slate-700 flex items-center gap-2 uppercase tracking-wider">
                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-indigo-100 text-indigo-700 text-xs shadow-sm">
                    <span class="pregunta-num"></span>
                </span>
                Pregunta
            </h3>
            <button type="button" title="Eliminar pregunta" class="remove-pregunta-btn p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-500/40">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        </div>
        
        <div class="p-5">
            <input type="hidden" name="preguntas[index][id]" class="pregunta-id">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 h-full">
                <!-- Texto de la pregunta -->
                <div class="lg:col-span-8 flex flex-col justify-end">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Texto de la pregunta <span class="text-red-500">*</span></label>
                    <input type="text" name="preguntas[index][pregunta]" required placeholder="Ej: ¿Cuáles son las metas principales?" class="w-full rounded-lg border-slate-300 bg-white px-4 py-2.5 text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all sm:text-sm shadow-sm pregunta-texto outline-none">
                </div>
                
                <!-- Tipo de respuesta -->
                <div class="lg:col-span-4 flex flex-col justify-end">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Tipo de respuesta <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="preguntas[index][tipo_respuesta]" class="w-full appearance-none rounded-lg border-slate-300 bg-white px-4 py-2.5 pr-10 text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all sm:text-sm shadow-sm pregunta-tipo font-medium cursor-pointer outline-none">
                            <option value="texto_corto">📝 Texto corto (1 línea)</option>
                            <option value="texto_largo">📄 Texto largo (Párrafo)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
                
                <!-- Texto de ayuda -->
                <div class="lg:col-span-8 flex flex-col justify-end">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Texto de ayuda
                        <span class="text-slate-400 font-normal text-xs">(Opcional)</span>
                    </label>
                    <input type="text" name="preguntas[index][ayuda]" placeholder="Ej: Enumera al menos 3 objetivos clave." class="w-full rounded-lg border-slate-300 bg-slate-50 px-4 py-2.5 text-slate-900 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all sm:text-sm shadow-sm pregunta-ayuda outline-none">
                </div>
                
                <!-- Requerido -->
                <div class="lg:col-span-4 flex items-end">
                    <div class="w-full border border-slate-200 rounded-lg py-2.5 px-4 bg-slate-50 flex items-center shadow-sm">
                        <label class="flex items-center cursor-pointer w-full select-none">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" name="preguntas[index][requerido]" value="1" class="peer sr-only pregunta-requerido">
                                <!-- El track del switch -->
                                <div class="w-10 h-5 bg-slate-200 rounded-full peer peer-checked:bg-emerald-500 peer-focus:ring-2 peer-focus:ring-emerald-500/40 transition-colors duration-200 ease-in-out cursor-pointer"></div>
                                <!-- El dot del switch -->
                                <div class="absolute left-[2px] w-4 h-4 bg-white rounded-full border border-slate-300 peer-checked:border-emerald-500 peer-checked:translate-x-full transition-all duration-200 shadow-sm cursor-pointer"></div>
                            </div>
                            <span class="ml-3 text-sm font-medium text-slate-700 transition-colors peer-checked:text-emerald-700">Respuesta Obligatoria</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('preguntas-container');
    const addBtn = document.getElementById('add-pregunta-btn');
    const template = document.getElementById('pregunta-template');
    let preguntaIndex = 0;

    // Cargar preguntas existentes si estamos en modo edición
    @if(isset($tema))
        const preguntasExistentes = @json($tema->preguntas);
        if (preguntasExistentes && preguntasExistentes.length > 0) {
            preguntasExistentes.forEach((p, idx) => {
                // Añadir un pequeño retraso a cada pregunta existente
                setTimeout(() => {
                    addPregunta(p, false); 
                }, idx * 80);
            });
        } else {
            addPregunta();
            setupEmptyState();
        }
    @else
        // Añadir una pregunta por defecto si es creación
        addPregunta();
    @endif

    function addPregunta(data = {}, animate = true) {
        // Remover el empty state si existe
        const emptyState = document.getElementById('empty-preguntas-state');
        if (emptyState) {
            emptyState.remove();
        }

        const clone = template.content.cloneNode(true);
        const index = preguntaIndex++;
        const itemRoot = clone.querySelector('.pregunta-item');
        
        // Animación de entrada
        if(animate) {
            itemRoot.classList.add('animate-enter');
        }
        
        // Reemplazar 'index' con el índice real en los atributos 'name'
        clone.querySelectorAll('[name*="index"]').forEach(el => {
            el.name = el.name.replace('index', index);
        });
        
        // Actualizar número de pregunta
        clone.querySelector('.pregunta-num').textContent = index + 1;
        
        // Rellenar datos si existen
        if (data.id) clone.querySelector('.pregunta-id').value = data.id;
        if (data.pregunta) clone.querySelector('.pregunta-texto').value = data.pregunta;
        if (data.tipo_respuesta) clone.querySelector('.pregunta-tipo').value = data.tipo_respuesta;
        if (data.ayuda) clone.querySelector('.pregunta-ayuda').value = data.ayuda;
        
        // Setup toggle switch
        const requiredCheckbox = clone.querySelector('.pregunta-requerido');
        if (data.requerido) {
            requiredCheckbox.checked = true;
        }

        // Evento para eliminar pregunta
        const removeBtn = clone.querySelector('.remove-pregunta-btn');
        removeBtn.addEventListener('click', function(e) {
            // Confirmación opcional si la pregunta ya estaba guardada y no está vacía
            const card = this.closest('.pregunta-item');
            const preexitingId = card.querySelector('.pregunta-id').value;
            const textInput = card.querySelector('.pregunta-texto').value;
            
            if (preexitingId && textInput) {
                if(!confirm('¿Estás seguro de eliminar esta pregunta ya guardada?')) return;
            }

            // Animación de salida (zoom out)
            card.style.transition = 'all 0.3s ease-out';
            card.style.transform = 'scale(0.95)';
            card.style.opacity = '0';
            card.style.height = '0px';
            card.style.margin = '0px';
            card.style.padding = '0px';
            card.style.overflow = 'hidden';
            
            setTimeout(() => {
                card.remove();
                updateQuestionNumbers();
                checkEmptyState();
            }, 300);
        });
        
        // Fokus inmediato si es una nueva pregunta y la página ya cargó
        if(animate && document.readyState === 'complete') {
            setTimeout(() => {
                const input = container.lastElementChild?.querySelector('.pregunta-texto');
                if(input) input.focus();
            }, 50);
        }

        container.appendChild(clone);
        updateQuestionNumbers();
    }

    function checkEmptyState() {
        const items = container.querySelectorAll('.pregunta-item');
        if (items.length === 0) {
            setupEmptyState();
        }
    }

    function setupEmptyState() {
        if (!document.getElementById('empty-preguntas-state')) {
            const emptyHtml = `
                <div id="empty-preguntas-state" class="text-center py-10 px-6 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl animate-enter">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-indigo-50 text-indigo-500 mb-4 shadow-sm border border-indigo-100">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-sm font-semibold text-slate-900">Aún no hay preguntas</h3>
                    <p class="mt-1 text-sm text-slate-500 max-w-sm mx-auto mb-5">Empieza añadiendo la primera pregunta para este bloque de cuestionario.</p>
                    <button type="button" onclick="document.getElementById('add-pregunta-btn').click()" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors gap-2">
                        <svg class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Añadir primera pregunta
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', emptyHtml);
        }
    }

    function updateQuestionNumbers() {
        const items = container.querySelectorAll('.pregunta-item');
        items.forEach((item, i) => {
            const label = item.querySelector('.pregunta-num');
            if(label) label.textContent = i + 1;
        });
    }

    addBtn.addEventListener('click', () => addPregunta(true));
});
</script>
@endsection