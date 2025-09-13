@extends('layouts.app')

@section('title', 'Gestión de Usuarios')
@include('a.css.admin.index-usuarios')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <div class="container mx-auto px-6 py-8">
            <!-- Header Section -->
          

        @include('administrador.usuarios.cardsusu')
            
            <!-- Search and Filters -->
            <div class="card-glass p-6 rounded-2xl shadow-xl mb-8 animate-fade-up" style="animation-delay: 0.2s">
                <form action="{{ route('administrador.usuarios.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">Buscar Usuario</label>
                        <div class="relative">
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                   class="search-input w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-0" 
                                   placeholder="Nombre del usuario...">
                            <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <div>
                        <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Filtrar por Rol</label>
                        <select name="role" id="role" class="search-input w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-0">
                            <option value="">Todos los roles</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>
                                    {{ $role->nombre_rol }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Estado</label>
                        <select name="status" id="status" class="search-input w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-0">
                            <option value="">Todos los estados</option>
                            <option value="admin" {{ request('status') == 'admin' ? 'selected' : '' }}>Administrador</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Activo</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                            <option value="no_plan" {{ request('status') == 'no_plan' ? 'selected' : '' }}>Sin plan</option>
                        </select>
                    </div>
                    
                    <div class="flex items-end space-x-3">
                        <button type="submit" class="btn-primary text-white px-6 py-3 rounded-xl flex items-center font-semibold flex-1">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Buscar
                        </button>
                        <a href="{{ route('administrador.usuarios.index') }}" class="btn-secondary px-6 py-3 rounded-xl flex items-center font-semibold">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>
            
            <!-- Users Table -->
            <div class="table-container animate-fade-up" style="animation-delay: 0.3s">
                <div class="bg-white">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Usuario</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Rol</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($users as $user)
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                                                <div class="text-xs text-gray-500">Usuario</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-600">{{ $user->email }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">
                                            @foreach($user->roles as $role)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    {{ $role->nombre_rol }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $isAdmin = $user->roles->where('nombre_rol', 'Administrador')->isNotEmpty();
                                            $hasActiveSubscription = $user->suscripciones->where('estado', 'activa')->where('fecha_fin', '>', now())->isNotEmpty();
                                            $hasInactiveSubscription = $user->suscripciones->where('estado', '!=', 'activa')->isNotEmpty();
                                        @endphp
                                        
                                        @if($isAdmin)
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full status-admin">
                                                <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1.002 1.002 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd"></path>
                                                </svg>
                                                Administrador
                                            </span>
                                        @elseif($hasActiveSubscription)
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full status-active">
                                                <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Activo
                                            </span>
                                        @elseif($hasInactiveSubscription)
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full status-inactive">
                                                <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                </svg>
                                                Inactivo
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full status-no-plan">
                                                <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                </svg>
                                                Sin Plan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="#" class="action-btn text-blue-600 hover:text-blue-800 hover:bg-blue-50">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Editar
                                            </a>
                                            <form action="{{ route('administrador.usuarios.destroy', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')" class="action-btn text-red-600 hover:text-red-800 hover:bg-red-50">
                                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="mt-8 animate-fade-up" style="animation-delay: 0.4s">
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('add-user-btn').addEventListener('click', function() {
            alert('La funcionalidad de agregar usuario estará disponible pronto.');
        });

        // Animación de carga suave para los elementos
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1
            });

            // Observar elementos con animación
            document.querySelectorAll('.animate-fade-up').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                observer.observe(el);
            });
        });

        // Efecto de búsqueda en tiempo real (opcional)
        let searchTimeout;
        document.getElementById('search').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const searchTerm = this.value.toLowerCase();
            
            if (searchTerm.length > 0) {
                searchTimeout = setTimeout(() => {
                    // Aquí puedes agregar lógica de búsqueda AJAX si lo deseas
                    console.log('Buscando:', searchTerm);
                }, 300);
            }
        });

        // Efecto hover mejorado para las filas de la tabla
        document.querySelectorAll('.table-row').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.background = 'linear-gradient(135deg, #F8FAFC, #F1F5F9)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.background = '';
            });
        });
    </script>
    @endpush
@endsection