@extends('layouts.app')

@section('title', 'Gestionar Cuestionario')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Estructura del Cuestionario</h1>
            <a href="{{ route('administrador.cuestionario.estructura.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Añadir Nuevo Tema
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-gray-200" id="temas-list">
                @forelse($temas as $tema)
                    <li class="px-6 py-4 flex items-center justify-between hover:bg-gray-50" data-id="{{ $tema->id }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3 cursor-move" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $tema->nombre_tema }}</p>
                                <p class="text-sm text-gray-500">{{ $tema->preguntas->count() }} pregunta(s)</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('administrador.cuestionario.estructura.edit', $tema->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                            <form action="{{ route('administrador.cuestionario.estructura.destroy', $tema->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este tema y todas sus preguntas?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="px-6 py-4 text-center text-gray-500">
                        No hay temas creados. <a href="{{ route('administrador.cuestionario.estructura.create') }}" class="text-indigo-600 hover:underline">Crea el primero.</a>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<!-- Script para arrastrar y soltar (reordenar) -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const el = document.getElementById('temas-list');
        if (el) {
            new Sortable(el, {
                animation: 150,
                handle: '.cursor-move',
                onEnd: function (evt) {
                    const temas = [...el.children].map(li => li.dataset.id);
                    fetch('{{ route("administrador.cuestionario.estructura.reorder") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ temas: temas })
                    })
                    .then(response => response.json())
                    .then(data => console.log('Orden actualizado:', data))
                    .catch(error => console.error('Error:', error));
                }
            });
        }
    });
</script>
@endsection