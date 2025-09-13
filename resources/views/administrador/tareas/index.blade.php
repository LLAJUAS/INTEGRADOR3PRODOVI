<!-- TAREAS -->
<div class="mt-8">
    <h2 class="text-xl font-semibold mb-4">Tareas de la Campaña</h2>
    <a href="{{ route('administrador.tareas.create', $campania->id) }}"
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Agregar Nueva Tarea
        </a>
    
    @if($campania->tareas->count() > 0)
        <div class="bg-white rounded-lg shadow-md overflow-hidden mt-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asignado a</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prioridad</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Límite</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($campania->tareas as $tarea)
                    <tr>
                        
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tarea->titulo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tarea->asignado->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($tarea->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                @elseif($tarea->estado == 'en_progreso') bg-blue-100 text-blue-800
                                @elseif($tarea->estado == 'completada') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $tarea->estado)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($tarea->prioridad == 'baja') bg-green-100 text-green-800
                                @elseif($tarea->prioridad == 'media') bg-blue-100 text-blue-800
                                @elseif($tarea->prioridad == 'alta') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($tarea->prioridad) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tarea->fecha_limite->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                            <!-- Botón Subir Tarea (solo visible para el asignado) -->
                           @if($tarea->asignado_id == auth()->id())

                                 <!-- Botón Editar Tarea -->
                            <a href="{{ route('administrador.tareas.show', $tarea->id) }}" 
                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">
                                Subir Tarea
                            </a>

                            @endif
                            
                            <!-- Botón Ver Tarea (visible para todos) -->
                            <a href="{{ route('administrador.tareas.ver-subidas', $tarea->id) }}" 
                            class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">
                                Ver Tarea
                            </a>

                            
                             <!-- Botón Editar Tarea -->
                            <a href="{{ route('administrador.tareas.edit', $tarea->id) }}" 
                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">
                                Editar
                            </a>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500 mt-4">No hay tareas para esta campaña.</p>
    @endif
    
</div>