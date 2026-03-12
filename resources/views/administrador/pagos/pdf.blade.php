<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Pagos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        .summary {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
        }
        .summary h3 {
            margin-top: 0;
            color: #495057;
            text-align: center;
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            text-align: center;
        }
        .summary-item {
            background: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .summary-item strong {
            display: block;
            font-size: 1.5em;
            color: #007bff;
            margin-bottom: 5px;
        }
        .filters {
            margin-bottom: 20px;
            font-size: 12px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Pagos y Suscripciones</h1>
        <p>Generado el: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    {{-- Resumen Ejecutivo --}}
    @if(!empty($summary))
    <div class="summary">
        <h3>Resumen Ejecutivo</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <strong>{{ $summary['total_income'] }}</strong>
                <span>Total de Ingresos</span>
            </div>
            <div class="summary-item">
                <strong>{{ $summary['most_hired_plan'] }}</strong>
                <span>Plan Más Contratado ({{ $summary['most_hired_plan_count'] }})</span>
            </div>
            <div class="summary-item">
                <strong>{{ $summary['total_records'] }}</strong>
                <span>Total de Registros</span>
            </div>
        </div>
        @if(isset($summary['monthly_report']))
        <div style="text-align: center; margin-top: 15px;">
            <strong>Reporte del Mes: {{ $summary['monthly_report'] }}</strong>
        </div>
        @endif
    </div>
    @endif
    
    @if(!empty($filters))
    <div class="filters">
        <h4>Filtros aplicados:</h4>
        <ul>
            @if(!empty($filters['clientName']))
            <li><strong>Cliente:</strong> {{ $filters['clientName'] }}</li>
            @endif
            @if(!empty($filters['plan']))
            <li><strong>Plan:</strong> {{ App\Models\Plan::find($filters['plan'])->nombre ?? 'N/A' }}</li>
            @endif
            @if(!empty($filters['subscriptionStatus']))
            <li><strong>Estado:</strong> 
                @switch($filters['subscriptionStatus'])
                    @case('active') Activas @break
                    @case('completed') Completadas @break
                    @case('cancelled') Canceladas @break
                    @default Todos @endswitch
            </li>
            @endif
            @if(!empty($filters['startDate']))
            <li><strong>Fecha inicio:</strong> {{ $filters['startDate'] }}</li>
            @endif
            @if(!empty($filters['endDate']))
            <li><strong>Fecha fin:</strong> {{ $filters['endDate'] }}</li>
            @endif
        </ul>
    </div>
    @endif
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Plan</th>
                <th>Monto</th>
                <th>Tipo de Pago</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagos as $pago)
            <tr>
                <td>{{ $pago->id }}</td>
                <td>{{ $pago->usuario ? $pago->usuario->name : 'N/A' }}</td>
                <td>{{ $pago->plan ? $pago->plan->nombre : 'N/A' }}</td>
                <td>{{ $pago->monto }} {{ $pago->moneda }}</td>
                <td>{{ $pago->metodo === 'qr' ? 'QR' : 'Físico' }}</td>
                <td>{{ $pago->suscripcion ? $pago->suscripcion->fecha_inicio->format('d/m/Y') : 'N/A' }}</td>
                <td>{{ $pago->suscripcion ? $pago->suscripcion->fecha_fin->format('d/m/Y') : 'N/A' }}</td>
                <td>{{ $pago->suscripcion ? $pago->suscripcion->estado : 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total de registros: {{ count($pagos) }}</p>
        <p>© {{ date('Y') }} PRODOVI</p>
    </div>
</body>
</html>