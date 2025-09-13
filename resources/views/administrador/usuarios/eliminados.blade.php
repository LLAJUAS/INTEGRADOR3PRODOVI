@extends('layouts.app')

@section('title', 'Usuarios Eliminados')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Usuarios Eliminados</h1>
        <a href="{{ route('administrador.usuarios.index') }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
            Ver usuarios activos
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 font-semibold text-sm text-gray-700 text-left">Nombre</th>
                        <th class="py-3 px-4 font-semibold text-sm text-gray-700 text-left">Email</th>
                       
                        <th class="py-3 px-4 font-semibold text-sm text-gray-700 text-left">Rol</th>
                        <th class="py-3 px-4 font-semibold text-sm text-gray-700 text-left">Eliminado el</th>
                        <th class="py-3 px-4 font-semibold text-sm text-gray-700 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $user->name }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $user->email }}</td>
                           
                            <td class="py-3 px-4 text-sm text-gray-700">
                                @if($user->roles->isNotEmpty())
                                    {{ $user->roles->first()->nombre_rol }}
                                @else
                                    Usuario
                                @endif
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $user->deleted_at->format('d/m/Y H:i') }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">
                                <form action="{{ route('administrador.usuarios.restore', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition duration-200">
                                        Restaurar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center text-sm text-gray-500">
                                No hay usuarios eliminados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($users->hasPages())
            <div class="px-4 py-3 bg-gray-100 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection