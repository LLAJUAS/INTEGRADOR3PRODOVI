<!-- Sección de Comentarios -->
<div class="p-6 border-t border-gray-200">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Comentarios</h3>
    
    <!-- Formulario para nuevo comentario -->
    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
        <form action="{{ route('administrador.tareas.comentarios.store', $tarea->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="contenido" class="sr-only">Nuevo comentario</label>
                <textarea name="contenido" id="contenido" rows="3" 
                          class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" 
                          placeholder="Escribe tu comentario..." required></textarea>
            </div>
            <div class="mb-4">
                <label for="archivos" class="block text-sm font-medium text-gray-700">Archivos adjuntos</label>
                <input type="file" name="archivos[]" id="archivos" multiple
                       class="mt-1 block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-md file:border-0
                              file:text-sm file:font-semibold
                              file:bg-blue-50 file:text-blue-700
                              hover:file:bg-blue-100">
                <p class="mt-1 text-xs text-gray-500">Puedes adjuntar múltiples archivos (máx. 10MB cada uno)</p>
            </div>
            <div class="flex justify-end">
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Publicar comentario
                </button>
            </div>
        </form>
    </div>
    
    <!-- Lista de comentarios -->
    <div class="space-y-4">
        @forelse($tarea->comentarios as $comentario)
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <div class="flex justify-between items-start">
                <div class="flex items-center space-x-3">
                    <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($comentario->user->name) }}&color=7F9CF5&background=EBF4FF" alt="">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $comentario->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @if(Auth::id() == $comentario->user_id || Auth::user()->hasRole('admin'))
                <form action="{{ route('administrador.tareas.comentarios.destroy', ['tarea' => $tarea->id, 'comentario' => $comentario->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>
                @endif
            </div>
            <div class="mt-3 text-sm text-gray-700">
                {!! nl2br(e($comentario->contenido)) !!}
            </div>
            
            <!-- Archivos adjuntos al comentario -->
            @if($comentario->archivos->count() > 0)
            <div class="mt-3 border-t border-gray-100 pt-3">
                <h4 class="text-xs font-medium text-gray-500 mb-2">ARCHIVOS ADJUNTOS</h4>
                <div class="space-y-2">
                    @foreach($comentario->archivos as $archivo)
                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                        <div class="flex items-center">
                            <span class="text-gray-500 mr-2">
                                @switch($archivo->extension)
                                    @case('pdf') 📄 @break
                                    @case('doc') @case('docx') 📝 @break
                                    @case('xls') @case('xlsx') 📊 @break
                                    @case('jpg') @case('jpeg') @case('png') @case('gif') 📷 @break
                                    @case('zip') @case('rar') 🗄️ @break
                                    @default 📁
                                @endswitch
                            </span>
                            <span class="text-xs font-medium text-gray-700">{{ $archivo->nombre_original }}</span>
                        </div>
                        <a href="{{ Storage::url($archivo->ruta_archivo) }}" download class="text-blue-500 hover:text-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @empty
        <div class="text-center py-8 bg-gray-50 rounded-lg">
            <p class="text-gray-500">No hay comentarios aún</p>
        </div>
        @endforelse
    </div>
</div>