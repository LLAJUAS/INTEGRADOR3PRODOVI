@extends('layouts.app2')

@section('title', 'Historial de Pagos')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Historial de Pagos</h1>
              
            </div>

            <!-- Tabla de historial de pagos -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Código de Pago
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Plan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Monto
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Método
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha de Pago
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($pagos as $pago)
                                        <tr class="hover:bg-gray-50">
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ $pago->comprobantePago->numero_formateado ?? 'N/A' }}
                                            </th>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pago->plan->nombre ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pago->moneda }} {{ number_format($pago->monto, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $pago->metodo === 'qr' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                                    {{ ucfirst($pago->metodo) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $pago->estado === 'completado' ? 'bg-green-100 text-green-800' :
                            ($pago->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' :
                                'bg-red-100 text-red-800') }}">
                                                    {{ ucfirst($pago->estado) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pago->fecha_pago ? $pago->fecha_pago->format('d/m/Y H:i') : 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="verComprobante({{ $pago->id }})"
                                                    class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                    <i class="fas fa-eye"></i> Ver
                                                </button>
                                                @if($pago->estado === 'completado')
                                                    <button onclick="descargarComprobante({{ $pago->id }})"
                                                        class="text-green-600 hover:text-green-900">
                                                        <i class="fas fa-download"></i> Descargar
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    No se encontraron registros de pagos.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if(method_exists($pagos, 'links'))
                <div class="mt-6">
                    {{ $pagos->links() }}
                </div>
            @endif
        </div>
    </div>

        <!-- Modal para ver comprobante -->
    <div id="modalComprobante" 
         class="fixed inset-0 z-50 overflow-y-auto hidden"
         aria-labelledby="modal-title" 
         role="dialog" 
         aria-modal="true">
        <!-- Fondo con animación de fundido -->
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0 transition-opacity">
            <!-- Elemento que oscurece el fondo -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="cerrarModal()"></div>

            <!-- Contenedor del Modal con animaciones -->
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full"
                 id="modalContentPanel">
                
                <!-- Header del Modal -->
                <header class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-gray-800" id="modal-title">
                            <i class="fas fa-file-invoice-dollar mr-2 text-blue-600"></i>
                            Comprobante de Pago
                        </h3>
                        <button onclick="cerrarModal()" type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                            <span class="sr-only">Cerrar</span>
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>
                </header>

                <!-- Body del Modal -->
                <main id="contenidoComprobante" class="bg-white px-6 py-4 max-h-[70vh] overflow-y-auto">
                    <!-- El contenido del comprobante o el spinner de carga se cargarán aquí -->
                </main>

                <!-- Footer del Modal -->
                <footer class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                    <div class="flex justify-end">
                        <button onclick="cerrarModal()" type="button"
                            class="inline-flex justify-center px-6 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                            Cerrar
                        </button>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Añadir listener para la tecla Escape
            document.addEventListener('keydown', function(event) {
                if (event.key === "Escape") {
                    cerrarModal();
                }
            });
        });

        function verComprobante(pagoId) {
            const modal = document.getElementById('modalComprobante');
            const contentPanel = document.getElementById('modalContentPanel');
            const contenidoComprobante = document.getElementById('contenidoComprobante');

            // 1. Mostrar el modal con animación
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.add('opacity-100');
                contentPanel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
                contentPanel.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
            }, 10); // Pequeño delay para que la transición CSS se active

            // 2. Mostrar un spinner de carga
            contenidoComprobante.innerHTML = `
                <div class="flex justify-center items-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                </div>
            `;

            // 3. Cargar el contenido del comprobante mediante AJAX
            fetch(`/clientes/pagos/comprobante/${pagoId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    contenidoComprobante.innerHTML = data.html;
                })
                .catch(error => {
                    console.error('Error al cargar el comprobante:', error);
                    contenidoComprobante.innerHTML = `
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 my-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">
                                        <strong>Error:</strong> No se pudo cargar el comprobante. Inténtelo de nuevo más tarde.
                                    </p>
                                </div>
                            </div>
                        </div>
                    `;
                });
        }

        function descargarComprobante(pagoId) {
            window.location.href = `/clientes/pagos/descargar/${pagoId}`;
        }

        function cerrarModal() {
            const modal = document.getElementById('modalComprobante');
            const contentPanel = document.getElementById('modalContentPanel');

            // Ocultar con animación
            modal.classList.remove('opacity-100');
            contentPanel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
            contentPanel.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');

            // Esperar a que termine la animación para ocultar el elemento completamente
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Duración de la transición en milisegundos
        }
    </script>