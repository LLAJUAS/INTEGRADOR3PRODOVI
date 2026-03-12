{{-- Resumen del Reporte --}}
@if(!empty($summary))
<table>
    <thead>
        <tr>
            <th colspan="4">Resumen del Reporte</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Total de Ingresos:</strong></td>
            <td>{{ $summary['total_income'] ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Plan Más Contratado:</strong></td>
            <td>{{ $summary['most_hired_plan'] ?? 'N/A' }} ({{ $summary['most_hired_plan_count'] ?? 0 }} contratos)</td>
        </tr>
        <tr>
            <td><strong>Total de Registros:</strong></td>
            <td>{{ $summary['total_records'] ?? 0 }}</td>
        </tr>
        @if(isset($summary['monthly_report']))
        <tr>
            <td><strong>Reporte del Mes:</strong></td>
            <td>{{ $summary['monthly_report'] }}</td>
        </tr>
        @endif
    </tbody>
</table>
<br>
@endif

{{-- Tabla de Datos --}}
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