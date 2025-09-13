@extends('layouts.app')

@section('title', 'Gestión de Pagos')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<style>
/* Estilos adaptados de administrar planes */
.main-container {
    min-height: 100vh;
    background: white;
    border-radius: 16px;
    padding: 2rem;
    margin-top: 1rem;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Alerts */
.alert {
    display: flex;
    align-items: center;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    border-radius: 12px;
    font-weight: 500;
    position: relative;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert i {
    margin-right: 0.75rem;
    font-size: 1.1rem;
}

.alert-close {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    margin-left: auto;
    padding: 0.25rem;
    border-radius: 50%;
    transition: background-color 0.2s;
}

.alert-close:hover {
    background-color: rgba(0, 0, 0, 0.1);
}

/* Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    
    
    margin-bottom: 1rem;
   
}

.header-content h1 {
    font-size: 2.25rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0 0 0.5rem 0;
    display: flex;
    align-items: center;
}

.header-content h1 i {
    margin-right: 0.75rem;
    color: #6f69eb;
}

.subtitle {
    color: #64748b;
    font-size: 1.1rem;
    margin: 0;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    border: 2px solid transparent;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #4f46e5, #7c3aed);
}

.stat-card.success::before {
    background: linear-gradient(90deg, #10b981, #059669);
}

.stat-card.warning::before {
    background: linear-gradient(90deg, #f59e0b, #d97706);
}

.stat-card.secondary::before {
    background: linear-gradient(90deg, #6b7280, #4b5563);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    border-color: #e2e8f0;
}

.stat-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.stat-icon {
    width: 3rem;
    height: 3rem;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
}

.stat-card.success .stat-icon {
    background: linear-gradient(135deg, #10b981, #059669);
}

.stat-card.warning .stat-icon {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.stat-card.secondary .stat-icon {
    background: linear-gradient(135deg, #6b7280, #4b5563);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
    line-height: 1;
}

.stat-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.stat-description {
    color: #64748b;
    font-size: 0.875rem;
    margin-bottom: 1rem;
}

.stat-indicator {
    width: 0.5rem;
    height: 0.5rem;
    border-radius: 50%;
    background: #4f46e5;
}

.stat-card.success .stat-indicator {
    background: #10b981;
    animation: pulse 2s infinite;
}

.stat-card.warning .stat-indicator {
    background: #f59e0b;
    animation: ping 1s infinite;
}

.stat-card.secondary .stat-indicator {
    background: #6b7280;
}

/* Quick Actions */
.quick-actions {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    border: 2px solid #e2e8f0;
}

.actions-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.actions-icon {
    width: 3rem;
    height: 3rem;
    background: linear-gradient(135deg, #7c3aed, #ec4899);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    color: white;
    font-size: 1.25rem;
}

.actions-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0 0 0.25rem 0;
}

.actions-subtitle {
    color: #64748b;
    margin: 0;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.action-card {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.5rem;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
}

.action-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    border-color: #cbd5e1;
}

.action-card.primary {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    border-color: #93c5fd;
}

.action-card.success {
    background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
    border-color: #86efac;
}

.action-card.purple {
    background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%);
    border-color: #c4b5fd;
}

.action-card.orange {
    background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
    border-color: #fb923c;
}

.action-header {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
}

.action-icon {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
    color: white;
    font-size: 1rem;
}

.action-card.primary .action-icon {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
}

.action-card.success .action-icon {
    background: linear-gradient(135deg, #10b981, #059669);
}

.action-card.purple .action-icon {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.action-card.orange .action-icon {
    background: linear-gradient(135deg, #f97316, #ea580c);
}

.action-name {
    font-weight: 600;
    color: #2d3748;
    font-size: 1rem;
}

.action-description {
    color: #64748b;
    font-size: 0.875rem;
    margin-bottom: 0.75rem;
    text-align: left;
}

.action-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
    transition: all 0.2s;
}

.action-card.primary .action-badge {
    background: #bfdbfe;
    color: #1e40af;
}

.action-card.success .action-badge {
    background: #bbf7d0;
    color: #065f46;
}

.action-card.purple .action-badge {
    background: #e9d5ff;
    color: #581c87;
}

.action-card.orange .action-badge {
    background: #fed7aa;
    color: #9a3412;
}

.action-card:hover .action-badge {
    transform: scale(1.05);
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
    font-size: 0.875rem;
}

.btn-primary {
    background: linear-gradient(135deg, #6863fe, #905cea);
    color: white;
    box-shadow: 0 4px 6px rgba(79, 70, 229, 0.25);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #4338ca, #6d28d9);
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(79, 70, 229, 0.4);
}

.btn i {
    margin-right: 0.5rem;
}

/* Animations */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

@keyframes ping {
    0% { transform: scale(1); opacity: 1; }
    75%, 100% { transform: scale(2); opacity: 0; }
}

/* Responsive */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
    }
    
    .header-content h1 {
        font-size: 1.75rem;
    }
}
</style>

<div class="main-container">
    <div class="container">
        <!-- Alerts -->
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
        
        <!-- Header Section -->
        <div class="page-header">
            <div class="header-content">
                <h1><i class="fas fa-credit-card"></i> Gestión de Pagos</h1>
                <p class="subtitle">Administra y monitorea el estado de todas las suscripciones</p>
            </div>
        </div>
        <hr style="border: 1px solid #e2e8f0; margin-bottom: 2rem;">
        <!-- Stats Cards -->
        <div class="stats-grid">
            <!-- Suscripciones Activas -->
            <div class="stat-card success">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="text-right">
                        <div class="stat-number">{{ $countActivos }}</div>
                        <div class="stat-indicator"></div>
                    </div>
                </div>
                <h3 class="stat-title">Suscripciones Activas</h3>
                <p class="stat-description">Usuarios con pagos al día</p>
                <a href="{{ route('administrador.pagos.realizados') }}" class="btn btn-primary">
                    <i class="fas fa-eye"></i>
                    Ver detalles
                </a>
            </div>
            
            <!-- Pagos Pendientes -->
            <div class="stat-card warning">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="text-right">
                        <div class="stat-number">{{ $countPendientes }}</div>
                        <div class="stat-indicator"></div>
                    </div>
                </div>
                <h3 class="stat-title">Pagos Pendientes</h3>
                <p class="stat-description">Requieren atención inmediata</p>
                <a href="{{ route('administrador.pagos.pendientes-fisicos') }}" class="btn btn-primary">
                    <i class="fas fa-clock"></i>
                    Ver detalles
                </a>
            </div>
            
            <!-- Finalizados/Cancelados -->
            <div class="stat-card secondary">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="text-right">
                        <div class="stat-number">{{ $countFinalizados }}</div>
                        <div class="stat-indicator"></div>
                    </div>
                </div>
                <h3 class="stat-title">Finalizados/Cancelados</h3>
                <p class="stat-description">Suscripciones completadas</p>
                <a href="{{ route('administrador.pagos.finalizados') }}" class="btn btn-primary">
                    <i class="fas fa-archive"></i>
                    Ver detalles
                </a>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="quick-actions">
            <div class="actions-header">
                <div class="actions-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <div>
                    <h2 class="actions-title">Acciones Rápidas</h2>
                    <p class="actions-subtitle">Herramientas esenciales para la gestión de pagos</p>
                </div>
            </div>
            
            <div class="actions-grid">
                <div class="action-card primary">
                    <div class="action-header">
                        <div class="action-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="action-name">Nuevo Pago</span>
                    </div>
                    <p class="action-description">Registrar un nuevo pago manualmente</p>
                    <span class="action-badge">
                        <i class="fas fa-mouse-pointer"></i> Click para acceder
                    </span>
                </div>
                
             
                
                <div class="action-card purple">
                    <div class="action-header">
                        <div class="action-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <span class="action-name">Reportes</span>
                    </div>
                    <p class="action-description">Generar informes detallados</p>
                    <span class="action-badge">
                        <i class="fas fa-mouse-pointer"></i> Click para acceder
                    </span>
                </div>
                
              
            </div>
        </div>
    </div>
</div>

<script>
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

// Agregar interactividad a las action cards
document.querySelectorAll('.action-card').forEach(card => {
    card.addEventListener('click', function() {
        // Aquí puedes agregar la lógica para cada acción
        const actionName = this.querySelector('.action-name').textContent;
        console.log(`Acción seleccionada: ${actionName}`);
        
        // Ejemplo de feedback visual
        this.style.transform = 'scale(0.98)';
        setTimeout(() => {
            this.style.transform = '';
        }, 100);
    });
});
</script>

@endsection