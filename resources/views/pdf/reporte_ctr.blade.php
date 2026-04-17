<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de CTR por Plataforma - {{ $data['period_label'] ?? 'PRODOVI' }}</title>
    <style>
        /* Tipografía y general */
        @page {
            margin: 0cm 0cm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1f2937;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        /* Colores y Utilidades */
        .texto-verde { color: #059669; }
        .texto-gris-500 { color: #6b7280; }
        .fondo-indigo-900 { background-color: #1e1b4b; }
        .fondo-gris-50 { background-color: #f9fafb; }
        
        /* Layout */
        .contenedor {
            padding: 40px;
        }
        
        /* Header */
        .cabecera-banda {
            background-color: #065f46; /* Verde oscuro para CTR */
            color: white;
            padding: 30px 40px;
            width: 100%;
        }
        .cabecera-tabla {
            width: 100%;
            border-collapse: collapse;
        }
        .agencia-nombre {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .reporte-titulo {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 5px;
            color: #a7f3d0;
        }
        .generacion-fecha {
            text-align: right;
            font-size: 12px;
            vertical-align: bottom;
            color: #ecfdf5;
            padding-right: 80px;
        }

        /* Secciones */
        .seccion-encabezado {
            border-bottom: 2px solid #e5e7eb;
            margin-top: 30px;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .seccion-titulo {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            color: #374151;
            letter-spacing: 1px;
        }

        /* Cuadrícula de KPIs */
        .kpi-tabla {
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px 0;
            margin-left: -10px;
            margin-right: -10px;
        }
        .kpi-tarjeta {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            width: 50%;
            text-align: left;
        }
        .kpi-etiqueta {
            font-size: 11px;
            font-weight: bold;
            color: #6b7280;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .kpi-valor {
            font-size: 42px;
            font-weight: bold;
            color: #059669;
            margin: 5px 0;
        }
        .tendencia-distintivo {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }
        .tendencia-alza {
            background-color: #d1fae5;
            color: #065f46;
        }
        .tendencia-baja {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Tabla de Datos */
        .tabla-datos {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }
        .tabla-datos th {
            text-align: left;
            font-size: 11px;
            color: #6b7280;
            text-transform: uppercase;
            border-bottom: 1px solid #e5e7eb;
            padding: 8px 5px;
            background-color: #f9fafb;
        }
        .tabla-datos td {
            font-size: 13px;
            padding: 12px 5px;
            border-bottom: 1px solid #f3f4f6;
        }

        /* Footer */
        .pie-pagina {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            background-color: #f9fafb;
            padding: 20px 40px;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
        }

        .insight-box {
            background-color: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 0 8px 8px 0;
            font-size: 13px;
        }

        .formula-box {
            background-color: #f8fafc;
            border: 1px dashed #cbd5e1;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }
        .formula-text {
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            color: #334155;
        }
    </style>
</head>
<body>

    <div class="cabecera-banda">
        <table class="cabecera-tabla">
            <tr>
                <td>
                    <img src="{{ public_path('imagenes/logoblanco.png') }}" style="height: 40px; width: auto;">
                    <div class="reporte-titulo">Reporte de CTR por Plataforma</div>
                </td>
                <td class="generacion-fecha">
                    Emitido el: {{ $fecha_generacion ?? date('d/m/Y') }}<br>
                    Período: {{ $data['period_label'] ?? 'General' }}
                </td>
            </tr>
        </table>
    </div>

    <div class="contenedor">
        
        <div class="seccion-encabezado" style="margin-top: 0;">
            <div class="seccion-titulo">Descripción del Reporte</div>
        </div>
        <p style="font-size: 13px; line-height: 1.6; color: #4b5563;">
            Este reporte compara el rendimiento de las campañas publicitarias entre Facebook e Instagram utilizando la métrica <strong>CTR (Click Through Rate)</strong>. El CTR mide el porcentaje de usuarios que hicieron clic en un anuncio en relación con el número total de impresiones.
        </p>

        <div class="formula-box">
            <div class="kpi-etiqueta" style="margin-bottom: 5px;">Fórmula utilizada</div>
            <div class="formula-text">CTR = (Clics / Impresiones) * 100</div>
        </div>

        <!-- KPI Principal -->
        <table class="kpi-tabla">
            <tr>
                <td class="kpi-tarjeta">
                    <div class="kpi-etiqueta">CTR Promedio del Período</div>
                    <div class="kpi-valor">{{ $data['conversion']['rate'] ?? '0.0%' }}</div>
                    <span class="tendencia-distintivo {{ ($data['conversion']['trend'] ?? 'up') === 'up' ? 'tendencia-alza' : 'tendencia-baja' }}">
                        {{ $data['conversion']['vs_previous'] ?? '0%' }} vs {{ $data['period_label'] ?? 'anterior' }}
                    </span>
                </td>
                <td style="vertical-align: top; padding-left: 20px;">
                    <div class="insight-box">
                        <strong>Análisis Automático:</strong>
                        @php
                            $fbMetrics = collect($data['conversion']['platform_metrics'] ?? [])->firstWhere('platform', 'Facebook');
                            $igMetrics = collect($data['conversion']['platform_metrics'] ?? [])->firstWhere('platform', 'Instagram');
                            $mejorPlataforma = ($fbMetrics['ctr'] ?? 0) > ($igMetrics['ctr'] ?? 0) ? 'Facebook' : 'Instagram';
                            $mejorCTR = ($fbMetrics['ctr'] ?? 0) > ($igMetrics['ctr'] ?? 0) ? ($fbMetrics['ctr'] ?? 0) : ($igMetrics['ctr'] ?? 0);
                        @endphp
                        La plataforma con mejor rendimiento de clics es <strong>{{ $mejorPlataforma }}</strong> con un CTR del <strong>{{ $mejorCTR }}%</strong>. 
                        Esto indica una mayor relevancia de los anuncios para la audiencia en esta red social.
                    </div>
                </td>
            </tr>
        </table>

        <!-- Tabla Comparativa -->
        <div class="seccion-encabezado">
            <div class="seccion-titulo">Comparativa por Plataforma</div>
        </div>
        
        <table class="tabla-datos">
            <thead>
                <tr>
                    <th>Plataforma</th>
                    <th style="text-align: right;">Impresiones</th>
                    <th style="text-align: right;">Clics</th>
                    <th style="text-align: right;">CTR (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['conversion']['platform_metrics'] ?? [] as $metric)
                    <tr>
                        <td style="font-weight: bold;">{{ $metric['platform'] }}</td>
                        <td style="text-align: right;">{{ number_format($metric['impressions']) }}</td>
                        <td style="text-align: right;">{{ number_format($metric['clicks']) }}</td>
                        <td style="text-align: right; color: #059669; font-weight: bold;">{{ number_format($metric['ctr'], 2) }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Espacio para notas -->
        <div class="seccion-encabezado" style="margin-top: 40px;">
            <div class="seccion-titulo">Interpretación y Recomendaciones</div>
        </div>
        <div style="background-color: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
            <p style="font-size: 12px; color: #475569; line-height: 1.6; margin: 0;">
                Un CTR alto es un indicador de que el contenido creativo y la segmentación están alineados con los intereses del usuario. 
                Se recomienda observar los formatos que están impulsando el CTR en <strong>{{ $mejorPlataforma }}</strong> y replicar los elementos exitosos (llamadas a la acción, estilo visual, copy) en las demás plataformas para optimizar el presupuesto publicitario.
            </p>
        </div>

    </div>

    <div class="pie-pagina">
        Este informe de rendimiento ha sido generado automáticamente para el análisis de PRODOVI.<br>
        &copy; {{ date('Y') }} Marketing Digital Inteligente.
    </div>

</body>
</html>
