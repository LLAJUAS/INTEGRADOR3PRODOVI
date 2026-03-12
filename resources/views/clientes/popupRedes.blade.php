<!-- Aviso superior para vincular cuentas -->
<div id="social-accounts-alert" class="hidden fixed top-0 left-0 right-0 z-40 bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-3  shadow-lg transform transition-transform duration-300">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="font-small">Para aprovechar al máximo nuestros servicios, vincula tus cuentas de redes sociales</p>
            </div>
            <div class="flex items-center space-x-3">
                <button id="link-now-btn" class="bg-white text-blue-600 hover:bg-blue-50 font-medium py-2 px-4 rounded-md transition-colors duration-200">
                    Vincular ahora
                </button>
                <button id="dismiss-alert-btn" class="text-white hover:text-blue-200 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para vincular cuentas de redes sociales -->
<div id="link-social-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Fondo del modal con blur -->
        <div class="fixed inset-0 transition-opacity backdrop-blur-sm" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-900/50"></div>
        </div>
        
        <!-- Contenido del modal -->
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-200">
            
            <!-- Header del modal -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">Vincula tus cuentas</h3>
                    <button type="button" id="close-modal-btn" class="text-white/80 hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Contenido del modal -->
            <div class="bg-white px-6 py-6">
                <p class="text-gray-700 mb-6">Conecta tus cuentas de redes sociales para que podamos gestionar tu presencia en línea de manera efectiva.</p>
                
                <!-- Opciones de redes sociales -->
                <div class="space-y-4 mb-6">
                    <button class="social-link-btn w-full flex items-center justify-between p-4 bg-gray-50 hover:bg-blue-50 rounded-xl border border-gray-200 hover:border-blue-300 transition-all duration-200" data-provider="facebook">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-800">Facebook</span>
                        </div>
                        <div class="link-status" data-provider="facebook">
                            <span class="text-sm text-gray-500">No vinculado</span>
                        </div>
                    </button>
                    
                    <button class="social-link-btn w-full flex items-center justify-between p-4 bg-gray-50 hover:bg-pink-50 rounded-xl border border-gray-200 hover:border-pink-300 transition-all duration-200" data-provider="instagram">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/>
                                    <path d="M12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4z"/>
                                    <circle cx="18.406" cy="5.594" r="1.44"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-800">Instagram</span>
                        </div>
                        <div class="link-status" data-provider="instagram">
                            <span class="text-sm text-gray-500">No vinculado</span>
                        </div>
                    </button>
                    
                    <button class="social-link-btn w-full flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-900 rounded-xl border border-gray-200 hover:border-gray-900 transition-all duration-200" data-provider="tiktok">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.36-4.08-1.1-1.75-1.01-3.06-2.82-3.32-4.85-.05-.5-.06-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-800">TikTok</span>
                        </div>
                        <div class="link-status" data-provider="tiktok">
                            <span class="text-sm text-gray-500">No vinculado</span>
                        </div>
                    </button>
                </div>
                
                <!-- Botón para usuarios sin cuentas -->
                <div class="text-center">
                    <button id="no-accounts-btn" class="text-gray-600 hover:text-gray-800 font-medium text-sm underline transition-colors duration-200">
                        No tengo cuentas
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
