<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Pago | PRODOVI Digital</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @include('a.css.cliente.planes')
</head>
<body>
    @include('componentes.navbar2')
    
    <div class="main-container">
        <div class="payment-status-container">
            <div class="status-header">
                <h1><i class="fas fa-clock"></i> Pago Pendiente</h1>
                <p>Tu suscripción está esperando aprobación</p>
            </div>
            
            <div class="status-card">
                <div class="status-icon pending">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                
                <div class="status-details">
                    <h2>Plan: {{ $suscripcion->plan->nombre }}</h2>
                    <p>Monto: {{ number_format($suscripcion->pagos->first()->monto) }} {{ $suscripcion->pagos->first()->moneda == 'BS' ? 'Bs' : '$' }}</p>
                    <p>Método: Pago Físico</p>
                    
                    @if($codigoPago)
                    <div class="payment-code">
                        <h3>Tu código de pago:</h3>
                        <div class="code-display">
                            {{ $codigoPago->codigo }}
                        </div>
                        <p class="code-instructions">
                            Preséntalo en nuestras oficinas para completar el pago
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="payment-instructions">
                <h3><i class="fas fa-info-circle"></i> Instrucciones para completar tu pago:</h3>
                <ol>
                    <li>Acude a nuestras oficinas con tu código de pago</li>
                    <li>Ubicación: Zona Miraflores, Av. Hugo Estrada, Edificio Olímpia #1354</li>
                    <li>Horario de atención: Lunes a Viernes de 9:00 a 17:00</li>
                    <li>Una vez aprobado, tu suscripción se activará automáticamente</li>
                </ol>
            </div>
            
            <div class="status-actions">
                <a href="{{ route('clientes.home') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Volver a planes
                </a>
                <button class="btn-print" onclick="window.print()">
                    <i class="fas fa-print"></i> Imprimir código
                </button>
            </div>
        </div>
    </div>
    
    @include('componentes.footer')
</body>
</html>

<style>
.payment-status-container {
    max-width: 800px;
    margin: 30px auto;
    padding: 20px;
}

.status-header {
    text-align: center;
    margin-bottom: 30px;
}

.status-header h1 {
    color: #f7f7f7;
    margin-bottom: 10px;
}

.status-card {
    background: rgba(230, 63, 63, 0.425);
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    padding: 30px;
    display: flex;
    align-items: center;
    gap: 30px;
    margin-bottom: 30px;
}

.status-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
}

.status-icon.pending {
    background-color: #7445baa2;
    color: #F59E0B;
}

.payment-code {
    margin-top: 20px;
    padding: 20px;
    background: #801f36;
    border-radius: 8px;
}

.code-display {
    font-family: monospace;
    font-size: 24px;
    font-weight: bold;
    letter-spacing: 2px;
    text-align: center;
    padding: 10px;
    background: rgb(124, 2, 2);
    border: 1px dashed #D1D5DB;
    margin: 10px 0;
}

.payment-instructions {
    background: #e99206;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
}

.payment-instructions ol {
    padding-left: 20px;
}

.payment-instructions li {
    margin-bottom: 10px;
}

.status-actions {
    display: flex;
    justify-content: space-between;
}

.btn-back, .btn-print {
    padding: 10px 20px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    font-weight: 500;
}

.btn-back {
    background: #E5E7EB;
    color: #4B5563;
}

.btn-print {
    background: #3B82F6;
    color: white;
}
</style>