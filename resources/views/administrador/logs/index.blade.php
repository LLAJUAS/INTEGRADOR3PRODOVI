@extends('layouts.app')

@section('title', 'Logs del Sistema')

@section('head')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
@endsection

@section('content')
<div class="min-h-screen bg-blue-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <div class="bg-indigo-600 p-3 rounded-xl shadow-lg">
                <i class="fas fa-list-alt text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-black text-gray-800 tracking-tight">Logs del Sistema</h1>
                <p class="text-gray-600 mt-1">Monitorea los accesos y errores del servidor.</p>
            </div>
        </div>

        <!-- Filtros Globales -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-8">
            <form action="{{ route('administrador.logs.index') }}" method="GET" id="filterForm" class="flex flex-wrap items-end gap-4">
                <input type="hidden" name="tab" id="activeTabInput" value="{{ request('tab', 'access') }}">
                
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" value="{{ $fechaInicio ?? '' }}" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Fecha Fin</label>
                    <input type="date" name="fecha_fin" value="{{ $fechaFin ?? '' }}" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-indigo-700 transition-colors shadow-md shadow-indigo-100">
                        <i class="fas fa-filter mr-2"></i>Filtrar
                    </button>
                    <a href="{{ route('administrador.logs.index') }}" class="bg-gray-100 text-gray-600 px-6 py-2 rounded-lg text-sm font-bold hover:bg-gray-200 transition-colors">
                        <i class="fas fa-redo mr-2"></i>Limpiar
                    </a>
                </div>
            </form>
        </div>

        <!-- Tabs -->
        <div class="mb-6 overflow-x-auto">
            <div class="border-b border-gray-200 min-w-max">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button onclick="switchTab('access')" id="tab-access" class="border-indigo-500 text-indigo-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>Logs de Acceso
                    </button>
                    <button onclick="switchTab('security')" id="tab-security" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                        <i class="fas fa-shield-alt mr-2"></i>Logs de Seguridad
                    </button>
                    <button onclick="switchTab('audit')" id="tab-audit" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                        <i class="fas fa-history mr-2"></i>Logs de Actividad
                    </button>
                    <button onclick="switchTab('error')" id="tab-error" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Logs de Errores
                    </button>
                </nav>
            </div>
        </div>

        <!-- Tab Content: Access Logs -->
        <div id="content-access" class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100 mb-8">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Registros de Acceso</h2>
                <button onclick="exportToPdf('access')" class="bg-indigo-50 text-indigo-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-100 transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>Exportar PDF
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha y Hora</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP / Usuario</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Método / URL</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado / Tiempo</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User-Agent</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($accessLogs as $log)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $log->ip_address }}</div>
                                <div class="text-sm text-gray-500">{{ $log->user ? $log->user->name : 'Invitado' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $log->method === 'GET' ? 'bg-green-100 text-green-800' : ($log->method === 'POST' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">{{ $log->method }}</span>
                                <span class="ml-2 text-sm text-gray-600 break-all">{{ Str::limit($log->url, 50) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $log->status_code >= 400 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">{{ $log->status_code }}</span>
                                <div class="text-xs text-gray-500 mt-1">{{ $log->response_time_ms }}ms</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="{{ $log->user_agent }}">
                                {{ Str::limit($log->user_agent, 40) }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No hay registros de acceso.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($accessLogs->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $accessLogs->appends(['tab' => 'access'])->links() }}
            </div>
            @endif
        </div>

        <!-- Tab Content: Security Logs -->
        <div id="content-security" class="hidden bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100 mb-8">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Registros de Seguridad</h2>
                <button onclick="exportToPdf('security')" class="bg-indigo-50 text-indigo-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-100 transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>Exportar PDF
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha / Hora</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario / IP</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evento</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detalles</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($securityLogs as $log)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $log->user ? $log->user->name : 'Desconocido' }}</div>
                                <div class="text-sm text-gray-500">{{ $log->ip_address }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $eventColors = [
                                        'login_success' => 'bg-green-100 text-green-800',
                                        'login_failed' => 'bg-red-100 text-red-800',
                                    ];
                                    $eventLabels = [
                                        'login_success' => 'LOGUEO EXITOSO',
                                        'login_failed' => 'LOGUEO FALLIDO',
                                    ];
                                    $colorClass = $eventColors[$log->event_type] ?? 'bg-gray-100 text-gray-800';
                                    $labelText = $eventLabels[$log->event_type] ?? str_replace('_', ' ', strtoupper($log->event_type));
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colorClass }}">
                                    {{ $labelText }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @if($log->details)
                                    <pre class="text-xs bg-gray-50 p-2 rounded border border-gray-100 max-w-xs overflow-x-auto">{{ json_encode($log->details, JSON_PRETTY_PRINT) }}</pre>
                                @else
                                    - 
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No hay registros de seguridad.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($securityLogs->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $securityLogs->appends(['tab' => 'security'])->links() }}
            </div>
            @endif
        </div>

        <!-- Tab Content: Audit Logs -->
        <div id="content-audit" class="hidden bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100 mb-8">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Registros de Actividad (Auditoría)</h2>
                <button onclick="exportToPdf('audit')" class="bg-indigo-50 text-indigo-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-100 transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>Exportar PDF
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha / Hora</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción / Recurso</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cambios</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($auditLogs as $log)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 flex flex-col sm:table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $log->user ? $log->user->name : 'Sistema/Consola' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $actionColors = [
                                        'create' => 'bg-green-100 text-green-800',
                                        'update' => 'bg-yellow-100 text-yellow-800',
                                        'delete' => 'bg-red-100 text-red-800',
                                    ];
                                    $colorClass = $actionColors[$log->action] ?? 'bg-gray-100 text-gray-800';
                                    $resourceName = class_basename($log->auditable_type);
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colorClass }} mb-1">
                                    {{ strtoupper($log->action) }}
                                </span>
                                <div class="text-xs text-gray-500">Recurso: <span class="font-semibold">{{ $resourceName }}</span> (#{{ $log->auditable_id }})</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    @if($log->old_values)
                                    <div>
                                        <span class="text-xs font-bold text-red-500 block mb-1">Anterior:</span>
                                        <div class="bg-red-50 p-2 rounded border border-red-100 text-xs overflow-x-auto max-w-[200px] lg:max-w-xs max-h-32 overflow-y-auto">
                                            @foreach($log->old_values as $key => $value)
                                                <div><span class="font-semibold">{{ $key }}:</span> {{ is_array($value) ? json_encode($value) : $value }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($log->new_values)
                                    <div>
                                        <span class="text-xs font-bold text-green-500 block mb-1">Nuevo:</span>
                                        <div class="bg-green-50 p-2 rounded border border-green-100 text-xs overflow-x-auto max-w-[200px] lg:max-w-xs max-h-32 overflow-y-auto">
                                            @foreach($log->new_values as $key => $value)
                                                <div><span class="font-semibold">{{ $key }}:</span> {{ is_array($value) ? json_encode($value) : $value }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No hay registros de actividad.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($auditLogs->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $auditLogs->appends(['tab' => 'audit'])->links() }}
            </div>
            @endif
        </div>

        <!-- Tab Content: Error Logs -->
        <div id="content-error" class="hidden bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100 mb-8">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Registros de Errores</h2>
                <div class="flex gap-2">
                    <button onclick="exportToPdf('error')" class="bg-indigo-50 text-indigo-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-100 transition-colors">
                        <i class="fas fa-file-pdf mr-2"></i>Exportar PDF
                    </button>
                  
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha y Hora</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mensaje</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($errorLogs as $log)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log['datetime'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $log['is_fatal'] ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ Str::limit($log['type'], 20) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 max-w-md">
                                <div class="line-clamp-2" title="{{ $log['message'] }}">
                                    {{ $log['message'] }}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No hay registros de errores recientes.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists($errorLogs, 'hasPages') && $errorLogs->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $errorLogs->appends(['tab' => 'error'])->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        let initialTab = 'access';

        if (urlParams.has('tab')) {
            initialTab = urlParams.get('tab');
        } else if (urlParams.has('security_page')) {
            initialTab = 'security';
        } else if (urlParams.has('audit_page')) {
            initialTab = 'audit';
        } else if (urlParams.has('error_page')) {
            initialTab = 'error';
        }

        switchTab(initialTab);
    });

    function switchTab(tab) {
        const tabs = ['access', 'security', 'audit', 'error'];
        
        // Ocultar todos los contenidos y resetear estilos de botones
        tabs.forEach(t => {
            document.getElementById('content-' + t).classList.add('hidden');
            const btn = document.getElementById('tab-' + t);
            if (btn) {
                btn.classList.remove('border-indigo-500', 'text-indigo-600');
                btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            }
        });
        
        // Mostrar el contenido seleccionado
        const content = document.getElementById('content-' + tab);
        if (content) content.classList.remove('hidden');
        
        // Aplicar estilo activo al tab seleccionado
        const activeTab = document.getElementById('tab-' + tab);
        if (activeTab) {
            activeTab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            activeTab.classList.add('border-indigo-500', 'text-indigo-600');
        }
        
        // Update URL to preserve tab on reload
        const url = new URL(window.location);
        url.searchParams.set('tab', tab);
        window.history.pushState({}, '', url);

        // Update hidden input for form filters
        document.getElementById('activeTabInput').value = tab;
    }

    function exportToPdf(type) {
        const urlParams = new URLSearchParams(window.location.search);
        const fechaInicio = document.querySelector('input[name="fecha_inicio"]').value;
        const fechaFin = document.querySelector('input[name="fecha_fin"]').value;
        
        let exportUrl = `{{ url('/administrador/logs/export') }}/${type}`;
        const params = new URLSearchParams();
        if (fechaInicio) params.append('fecha_inicio', fechaInicio);
        if (fechaFin) params.append('fecha_fin', fechaFin);
        
        if (params.toString()) {
            exportUrl += `?${params.toString()}`;
        }
        
        window.location.href = exportUrl;
    }
</script>
@endsection
