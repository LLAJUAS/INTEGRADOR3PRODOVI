 @include('componentes.navbar-admin')
@extends('layouts.app')

@section('title', 'Crear Nuevo Plan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Crear Nuevo Plan</h1>
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('administrador.planes.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        
        <!-- Información Básica del Plan -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b border-gray-200">Información Básica del Plan</h2>
            
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Plan*</label>
                <input type="text" id="nombre" name="nombre" required value="{{ old('nombre') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('nombre')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="subtitulo" class="block text-sm font-medium text-gray-700 mb-1">Subtítulo</label>
                <input type="text" id="subtitulo" name="subtitulo" value="{{ old('subtitulo') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="precio" class="block text-sm font-medium text-gray-700 mb-1">Precio*</label>
                    <input type="number" step="0.01" id="precio" name="precio" required value="{{ old('precio') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('precio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="moneda" class="block text-sm font-medium text-gray-700 mb-1">Moneda*</label>
                    <select id="moneda" name="moneda" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="BS" {{ old('moneda') == 'BS' ? 'selected' : '' }}>Bolivianos (Bs)</option>
                        <option value="USD" {{ old('moneda') == 'USD' ? 'selected' : '' }}>Dólares (USD)</option>
                    </select>
                </div>
                <div>
                    <label for="periodo_facturacion" class="block text-sm font-medium text-gray-700 mb-1">Periodo de Facturación*</label>
                    <select id="periodo_facturacion" name="periodo_facturacion" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="mes" {{ old('periodo_facturacion') == 'mes' ? 'selected' : '' }}>Mes</option>
                        <option value="trimestre" {{ old('periodo_facturacion') == 'trimestre' ? 'selected' : '' }}>Trimestre</option>
                        <option value="semestre" {{ old('periodo_facturacion') == 'semestre' ? 'selected' : '' }}>Semestre</option>
                        <option value="año" {{ old('periodo_facturacion') == 'año' ? 'selected' : '' }}>Año</option>
                    </select>
                    @error('periodo_facturacion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="orden" class="block text-sm font-medium text-gray-700 mb-1">Orden de Visualización</label>
                    <input type="number" id="orden" name="orden" value="{{ old('orden', 0) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="activo" name="activo" value="1" {{ old('activo', true) ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="activo" class="ml-2 block text-sm text-gray-700">Plan Activo</label>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('descripcion') }}</textarea>
            </div>
        </div>
        
        <!-- Características del Plan -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-200">
                <h2 class="text-xl font-semibold">Características del Plan</h2>
                <button type="button" id="add-feature" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-plus mr-1"></i> Agregar Característica
                </button>
            </div>
            
            <div id="features-container" class="space-y-4">
                <!-- Las características se agregarán aquí dinámicamente -->
                @if(old('caracteristicas'))
                    @foreach(old('caracteristicas') as $index => $caracteristica)
                        <div class="p-4 mb-4 bg-gray-50 rounded-md border-l-4 border-indigo-500">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                <div class="md:col-span-5">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Característica*</label>
                                    <select class="feature-select w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" name="caracteristicas[{{ $index }}][id]" required>
                                        <option value="">Seleccione una característica</option>
                                        @foreach($caracteristicas as $car)
                                            <option value="{{ $car->id }}" {{ $caracteristica['id'] == $car->id ? 'selected' : '' }}>{{ $car->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('caracteristicas.'.$index.'.id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                                    <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" name="caracteristicas[{{ $index }}][cantidad]" value="{{ $caracteristica['cantidad'] ?? 1 }}" min="1">
                                </div>
                                <div class="md:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Frecuencia</label>
                                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" name="caracteristicas[{{ $index }}][frecuencia]" value="{{ $caracteristica['frecuencia'] ?? '' }}" placeholder="Ej: mensual, semanal">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Orden</label>
                                    <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" name="caracteristicas[{{ $index }}][orden]" value="{{ $caracteristica['orden'] ?? 0 }}">
                                    
                                    <div class="flex items-center mt-2">
                                        <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" name="caracteristicas[{{ $index }}][es_destacado]" value="1" {{ isset($caracteristica['es_destacado']) ? 'checked' : '' }}>
                                        <label class="ml-2 block text-sm text-gray-700">Destacado</label>
                                    </div>
                                    
                                    <button type="button" class="mt-2 px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 remove-feature">
                                        <i class="fas fa-trash mr-1"></i> Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        
        <!-- Botones de acción -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('administrador.planes.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Guardar Plan
            </button>
        </div>
    </form>
</div>

<!-- Plantilla para características (hidden) -->
<div id="feature-template" class="hidden p-4 mb-4 bg-gray-50 rounded-md border-l-4 border-indigo-500">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
        <div class="md:col-span-5">
            <label class="block text-sm font-medium text-gray-700 mb-1">Característica*</label>
            <select class="feature-select w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" name="caracteristicas[__index__][id]" required>
                <option value="">Seleccione una característica</option>
                @foreach($caracteristicas as $caracteristica)
                    <option value="{{ $caracteristica->id }}">{{ $caracteristica->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
            <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" name="caracteristicas[__index__][cantidad]" value="1" min="1">
        </div>
        <div class="md:col-span-3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Frecuencia</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" name="caracteristicas[__index__][frecuencia]" placeholder="Ej: mensual, semanal">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Orden</label>
            <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" name="caracteristicas[__index__][orden]" value="0">
            
            <div class="flex items-center mt-2">
                <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" name="caracteristicas[__index__][es_destacado]" value="1">
                <label class="ml-2 block text-sm text-gray-700">Destacado</label>
            </div>
            
            <button type="button" class="mt-2 px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 remove-feature">
                <i class="fas fa-trash mr-1"></i> Eliminar
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addButton = document.getElementById('add-feature');
    const container = document.getElementById('features-container');
    const template = document.getElementById('feature-template');
    
    // Contador para índices únicos
    let featureCount = {{ old('caracteristicas') ? count(old('caracteristicas')) : 0 }};
    
    // Agregar nueva característica
    addButton.addEventListener('click', function() {
        const newFeature = template.cloneNode(true);
        newFeature.classList.remove('hidden');
        
        // Reemplazar __index__ con el contador actual
        const html = newFeature.innerHTML.replace(/__index__/g, featureCount);
        newFeature.innerHTML = html;
        
        // Agregar al contenedor
        container.appendChild(newFeature);
        featureCount++;
    });
    
    // Eliminar característica
    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-feature')) {
            e.target.closest('.bg-gray-50').remove();
        }
    });
    
    // Agregar una característica por defecto si no hay ninguna
    if (featureCount === 0) {
        addButton.click();
    }
});
</script>
@endpush
@endsection