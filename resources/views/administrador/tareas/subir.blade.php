@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h4 class="text-xl font-semibold text-gray-800">Subir archivos a la tarea: {{ $tarea->titulo }}</h4>
        </div>

        <div class="p-6">
            <form action="{{ route('administrador.tareas.archivos.store', $tarea->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="archivos" class="block text-sm font-medium text-gray-700">Archivos:</label>
                    <div class="mt-1">
                        <input type="file" name="archivos[]" id="archivos" class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            multiple required>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">
                        Formatos permitidos: mp4, mp3, pdf, doc, docx, xls, xlsx, ppt, pptx, jpg, jpeg, png, gif, webp, zip. Tamaño máximo: 10MB por archivo.
                    </p>
                </div>

                <div class="space-y-2">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción (opcional):</label>
                    <textarea name="descripcion" id="descripcion" rows="3" 
                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2"></textarea>
                </div>

                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('administrador.tareas.show', $tarea->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Cancelar
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        Subir Archivos
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection