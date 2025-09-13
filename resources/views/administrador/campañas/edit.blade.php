@extends('layouts.app')

@section('title', 'Editar Campaña')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-semibold mb-6">Editar Campaña: {{ $campania->nombre }}</h1>

        <form action="{{ route('administrador.campañas.update', $campania->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Columna izquierda -->
                <div class="space-y-4">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre*</label>
                        <input type="text" name="nombre" id="nombre" 
                               value="{{ old('nombre', $campania->nombre) }}"
                               class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                        @error('nombre')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción*</label>
                        <textarea name="descripcion" id="descripcion" rows="3"
                                  class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  required>{{ old('descripcion', $campania->descripcion) }}</textarea>
                        @error('descripcion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="space-y-4">
                    <div>
                        <label for="community_manager_id" class="block text-sm font-medium text-gray-700 mb-1">Community Manager*</label>
                        <select name="community_manager_id" id="community_manager_id"
                                class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                            <option value="">Seleccione un CM</option>
                            @foreach($communityManagers as $cm)
                                <option value="{{ $cm->id }}" 
                                    {{ old('community_manager_id', $campania->community_manager_id) == $cm->id ? 'selected' : '' }}>
                                    {{ $cm->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('community_manager_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado*</label>
                        <select name="estado" id="estado"
                                class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                            <option value="activa" {{ old('estado', $campania->estado) == 'activa' ? 'selected' : '' }}>Activa</option>
                            <option value="pausada" {{ old('estado', $campania->estado) == 'pausada' ? 'selected' : '' }}>Pausada</option>
                            <option value="finalizada" {{ old('estado', $campania->estado) == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                        </select>
                        @error('estado')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Finalización*</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" 
                               value="{{ old('fecha_fin', \Carbon\Carbon::parse($campania->fecha_fin)->format('Y-m-d')) }}"

                               class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                        @error('fecha_fin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('administrador.campañas.show', $campania->id) }}" 
                   class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">
                    Cancelar
                </a>
                <button type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection