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
            <th style="width: 20%;">Fecha y Hora</th>
            <th style="width: 15%;">Tipo</th>
            <th style="width: 65%;">Mensaje de Error</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log['datetime'] }}</td>
            <td style="text-align: center;">
                <strong>{{ $log['type'] }}</strong>
            </td>
            <td style="font-size: 9px;">
                {{ $log['message'] }}
                @if($log['file'] !== 'N/A')
                    <div style="color: #6b7280; margin-top: 4px; border-top: 1px solid #e5e7eb; padding-top: 2px;">
                        Archivo: {{ $log['file'] }} (Línea: {{ $log['line'] }})
                    </div>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
