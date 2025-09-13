<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Planes</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @include('a.css.admin.planin')
</head>
<body>
    @include('componentes.navbar-admin')
    
    <div class="main-container">
        <div class="container">
            <!-- Alerts mejoradas -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                    <button class="alert-close" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                    <button class="alert-close" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            <!-- Header mejorado -->
            <div class="page-header">
                <div class="header-content">
                    <h1><i class="fas fa-layer-group"></i> Administrar Planes</h1>
                    <p class="subtitle">Gestiona los planes de suscripción</p>
                </div>
                <a href="{{ route('administrador.planes.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Crear Nuevo Plan
                </a>
            </div>

            @if($planes->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3>No hay planes registrados</h3>
                    <p>¡Crea tu primer plan para comenzar!</p>
                    <a href="{{ route('administrador.planes.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Crear Primer Plan
                    </a>
                </div>
            @else
                <div class="plans-grid">
                    @foreach($planes as $plan)
                        <div class="plan-card">
                            <div class="plan-header">
                                <div class="plan-badge">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h3 class="plan-title">{{ $plan->nombre }}</h3>
                                <p class="plan-subtitle">{{ $plan->subtitulo }}</p>
                                <div class="plan-price">
                                    <span class="price-amount">{{ number_format($plan->precio) }}</span>
                                    <span class="price-currency">{{ $plan->moneda == 'BS' ? 'Bs' : '$' }}</span>
                                    <span class="price-period">/{{ $plan->periodo_facturacion }}</span>
                                </div>
                            </div>
                            
                            <div class="plan-features">
                                <h4><i class="fas fa-list-check"></i> Características</h4>
                                <ul class="features-list">
                                    @foreach($plan->planCaracteristicas as $pc)
                                        <li class="feature-item">
                                            <i class="fas fa-check"></i>
                                            <span>{{ $pc->caracteristica->nombre }}</span>
                                            @if($pc->frecuencia)
                                                <small class="feature-frequency">{{ $pc->frecuencia }}</small>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            
                            <div class="plan-actions">
                                <a href="{{ route('administrador.planes.edit', $plan->id) }}" class="btn btn-edit">
                                    <i class="fas fa-edit"></i>
                                    Editar
                                </a>
                                <form action="{{ route('administrador.planes.destroy', $plan->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">
                                        <i class="fas fa-trash"></i>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación</h3>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este plan? Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal()">Cancelar</button>
                <button class="btn btn-delete" id="confirmDelete">Eliminar</button>
            </div>
        </div>
    </div>



    <script>
        let formToSubmit = null;

        // Mejorar confirmación de eliminación con modal
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                formToSubmit = this;
                document.getElementById('deleteModal').style.display = 'block';
            });
        });

        // Confirmar eliminación
        document.getElementById('confirmDelete').addEventListener('click', function() {
            if (formToSubmit) {
                formToSubmit.submit();
            }
            closeModal();
        });

        // Cerrar modal
        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
            formToSubmit = null;
        }

        // Cerrar modal al hacer clic fuera
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                closeModal();
            }
        });

        // Auto-hide alerts después de 5 segundos
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 300);
            }, 5000);
        });
    </script>
</body>
</html>