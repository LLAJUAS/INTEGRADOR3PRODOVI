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
            <th style="width: 15%;">Fecha / Hora</th>
            <th style="width: 15%;">Usuario / IP</th>
            <th style="width: 15%;">Acción / Recurso</th>
            <th style="width: 27%;">Valor Anterior</th>
            <th style="width: 28%;">Valor Nuevo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
            <td>
                {{ $log->user ? $log->user->name : 'Sistema' }}<br>
                <small>{{ $log->ip_address }}</small>
            </td>
            <td>
                <strong>{{ strtoupper($log->action) }}</strong><br>
                {{ class_basename($log->auditable_type) }} (#{{ $log->auditable_id }})
            </td>
            <td style="font-size: 8px;">
                @if($log->old_values)
                    @foreach($log->old_values as $key => $value)
                        <div><strong>{{ $key }}:</strong> {{ is_array($value) ? json_encode($value) : $value }}</div>
                    @endforeach
                @else
                    -
                @endif
            </td>
            <td style="font-size: 8px;">
                @if($log->new_values)
                    @foreach($log->new_values as $key => $value)
                        <div><strong>{{ $key }}:</strong> {{ is_array($value) ? json_encode($value) : $value }}</div>
                    @endforeach
                @else
                    -
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
