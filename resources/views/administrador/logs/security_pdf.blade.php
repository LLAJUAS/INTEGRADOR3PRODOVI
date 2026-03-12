@extends('administrador.logs.pdf_template')

@section('chart')
@if(isset($chartBase64) && $chartBase64)
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ $chartBase64 }}" alt="Gráfico Estadístico" style="max-height: 250px; border-radius: 8px; border: 1px solid #d1d5db; padding: 10px; background: white;">
    </div>
@endif
@endsection

@section('table')
<table>
    <thead>
        <tr>
            <th style="width: 20%;">Fecha / Hora</th>
            <th style="width: 20%;">Usuario</th>
            <th style="width: 15%;">IP</th>
            <th style="width: 20%;">Evento</th>
            <th style="width: 25%;">Detalles</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
            <td>{{ $log->user ? $log->user->name : 'Desconocido' }}</td>
            <td>{{ $log->ip_address }}</td>
            <td style="text-align: center;">
                @php
                    $eventLabels = [
                        'login_success' => 'LOGUEO EXITOSO',
                        'login_failed' => 'LOGUEO FALLIDO',
                    ];
                    $label = $eventLabels[$log->event_type] ?? strtoupper(str_replace('_', ' ', $log->event_type));
                @endphp
                {{ $label }}
            </td>
            <td>
                @if($log->details)
                    <pre style="font-size: 8px; margin: 0;">{{ json_encode($log->details) }}</pre>
                @else
                    -
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
