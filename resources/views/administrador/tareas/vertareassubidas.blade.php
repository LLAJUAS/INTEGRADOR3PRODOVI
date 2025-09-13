@extends('layouts.app')

@section('title', 'Tareas Subidas')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Encabezado -->
        <div class="bg-blue-600 px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-white">{{ $tarea->titulo }}</h1>
                <div class="flex items-center space-x-2">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold 
                        {{ $tarea->estado == 'completada' ? 'bg-green-100 text-green-800' : 
                           ($tarea->estado == 'en_progreso' ? 'bg-yellow-100 text-yellow-800' : 
                           ($tarea->estado == 'rechazada' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                        {{ str_replace('_', ' ', ucfirst($tarea->estado)) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="p-6 space-y-6">
            <!-- Información básica -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Descripción</h3>
                    <p class="mt-1 text-gray-600">{{ $tarea->descripcion }}</p>
                </div>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Fechas</h3>
                        <p class="mt-1 text-gray-600">
                            <span class="font-medium">Inicio:</span> {{ $tarea->fecha_inicio->format('d/m/Y') }}<br>
                            <span class="font-medium">Límite:</span> {{ $tarea->fecha_limite->format('d/m/Y') }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Prioridad</h3>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold 
                            {{ $tarea->prioridad == 'alta' ? 'bg-red-100 text-red-800' : 
                               ($tarea->prioridad == 'urgente' ? 'bg-purple-100 text-purple-800' : 
                               ($tarea->prioridad == 'baja' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800')) }}">
                            {{ ucfirst($tarea->prioridad) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Responsables -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Creada por</h3>
                    <div class="mt-2 flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($tarea->creador->name) }}&color=7F9CF5&background=EBF4FF" alt="">
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">{{ $tarea->creador->name }}</p>
                            <p class="text-sm text-gray-500">{{ $tarea->creador->email }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Asignado a</h3>
                    <div class="mt-2 flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($tarea->asignado->name) }}&color=7F9CF5&background=EBF4FF" alt="">
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">{{ $tarea->asignado->name }}</p>
                            <p class="text-sm text-gray-500">{{ $tarea->asignado->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Archivos -->
            <div>
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Archivos adjuntos</h3>
                    @if($tarea->archivos->count() > 0 && $tarea->archivos->contains('estado', 'aprobado'))
                    <a href="{{ route('administrador.publicaciones.publicar', ['tarea_id' => $tarea->id]) }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-semibold hover:bg-purple-700 transition-colors">
                        PUBLICAR
                    </a>
                    @endif
                </div>

                @if($tarea->archivos->count() > 0)
                <div class="mt-4 border border-gray-200 rounded-lg divide-y divide-gray-200">
                    @foreach($tarea->archivos as $archivo)
                    
                    <div class="p-4">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <span class="text-blue-600">
                                        @if(in_array($archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
                                            📷
                                        @elseif(in_array($archivo->extension, ['pdf']))
                                            📄
                                        @elseif(in_array($archivo->extension, ['doc', 'docx']))
                                            📝
                                        @elseif(in_array($archivo->extension, ['xls', 'xlsx']))
                                            📊
                                        @elseif(in_array($archivo->extension, ['mp4', 'mov', 'avi']))
                                            🎥
                                        @elseif(in_array($archivo->extension, ['mp3', 'wav']))
                                            🎵
                                        @elseif(in_array($archivo->extension, ['zip', 'rar']))
                                            🗄️
                                        @else
                                            📁
                                        @endif
                                    </span>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $archivo->nombre_original }}</p>
                                    <p class="text-xs text-gray-500">{{ number_format($archivo->tamanio / 1024, 2) }} KB · {{ strtoupper($archivo->extension) }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ Storage::url($archivo->ruta_archivo) }}" download class="text-blue-600 hover:text-blue-800" title="Descargar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Estado del archivo -->
                        <div class="mt-3 flex items-center">
                            <span class="mr-2 text-sm font-medium text-gray-700">Estado:</span>
                            <form action="{{ route('administrador.tareas.archivos.update-estado', $archivo->id) }}" method="POST" class="flex space-x-2">
                                @csrf
                                @method('PUT')
                                <select name="estado" class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm" onchange="this.form.submit()">
                                    <option value="pendiente" {{ $archivo->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="aprobado" {{ $archivo->estado == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                                    <option value="rechazado" {{ $archivo->estado == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                                </select>
                            </form>
                            
                            <span class="ml-3 px-2 py-1 rounded-full text-xs font-semibold 
                                {{ $archivo->estado == 'aprobado' ? 'bg-green-100 text-green-800' : 
                                   ($archivo->estado == 'rechazado' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($archivo->estado) }}
                            </span>
                        </div>
                        
                        @if($archivo->descripcion)
                        <div class="mt-2 text-sm text-gray-600">
                            <p>{{ $archivo->descripcion }}</p>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @else
                <div class="mt-4 text-center py-8 bg-gray-50 rounded-lg">
                    <p class="text-gray-500">No hay archivos adjuntos</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Pie de página -->
        <div class="bg-gray-50 px-6 py-4">
            <a href="{{ route('administrador.campañas.show', $tarea->campania_id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Volver a la campaña
            </a>
        </div>
    </div>
</div>

@include('administrador.tareas.comentarios', ['tarea' => $tarea])

@endsection