<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Engagement Profesional - {{ $data['period_label'] ?? 'PRODOVI' }}</title>
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
        .texto-indigo { color: #4f46e5; }
        .texto-gris-500 { color: #6b7280; }
        .fondo-indigo-900 { background-color: #1e1b4b; }
        .fondo-gris-50 { background-color: #f9fafb; }
        
        /* Layout */
        .contenedor {
            padding: 40px;
        }
        
        /* Header */
        .cabecera-banda {
            background-color: #1e1b4b;
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
            color: #a5b4fc;
        }
        .generacion-fecha {
            text-align: right;
            font-size: 12px;
            vertical-align: bottom;
            color: #e0e7ff;
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
            width: 25%;
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
            font-size: 28px;
            font-weight: bold;
            color: #111827;
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

        /* Contenido Principal (Gráficos/Tablas) */
        .contenido-principal-tabla {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .contenido-tarjeta {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            vertical-align: top;
        }
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
        }
        .tabla-datos td {
            font-size: 13px;
            padding: 10px 5px;
            border-bottom: 1px solid #f3f4f6;
        }

        /* Barras de progreso */
        .progreso-contenedor {
            height: 6px;
            background-color: #e5e7eb;
            border-radius: 3px;
            width: 100%;
            margin-top: 10px;
            overflow: hidden;
        }
        .progreso-barra {
            height: 100%;
            border-radius: 3px;
        }

        /* Estilos demográficos */
        .demo-fila {
            margin-bottom: 15px;
        }
        .demo-etiqueta {
            font-size: 12px;
            color: #4b5563;
        }
        .demo-porcentaje {
            font-size: 12px;
            font-weight: bold;
            text-align: right;
            float: right;
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
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 0 8px 8px 0;
            font-size: 13px;
        }
    </style>
</head>
<body>

    <div class="cabecera-banda">
        <table class="cabecera-tabla">
            <tr>
                <td>
                    <img src="{{ public_path('imagenes/logoblanco.png') }}" style="height: 40px; width: auto;">
                    <div class="reporte-titulo">Análisis de Engagement - {{ $data['period_label'] ?? 'Consolidado' }}</div>
                </td>
                <td class="generacion-fecha">
                    Emitido el: {{ $fecha_generacion ?? date('d/m/Y') }}<br>
                </td>
            </tr>
        </table>
    </div>

    <div class="contenedor">
        
        <!-- KPIs Principales -->
        <div class="seccion-encabezado" style="margin-top: 0;">
            <div class="seccion-titulo">Métrica de Engagement Principal</div>
        </div>
        
        <table class="kpi-tabla">
            <tr>
                <!-- Engagement Rate -->
                <td class="kpi-tarjeta" style="width: 50%;">
                    <div class="kpi-etiqueta">Engagement Rate Promedio</div>
                    <div class="kpi-valor" style="font-size: 42px; color: #4f46e5;">{{ $data['engagement']['rate'] ?? '0.0%' }}</div>
                    <span class="tendencia-distintivo {{ (isset($data['engagement']['trend']) && $data['engagement']['trend'] === 'up') ? 'tendencia-alza' : 'tendencia-baja' }}">
                        {{ $data['engagement']['vs_previous'] ?? '0%' }} vs periodo anterior
                    </span>
                </td>
                
                <!-- Desglose Rápido -->
                <td style="width: 50%; vertical-align: top; padding-left: 20px;">
                    <div class="insight-box" style="margin-top: 0;">
                        <strong>Pico de Actividad:</strong> Los usuarios muestran un mayor nivel de respuesta entre las <strong>{{ $data['optimal_time']['range'] ?? 'No disponible' }}</strong>.
                    </div>
                    <div class="insight-box" style="border-left-color: #10b981; background-color: #ecfdf5; margin-bottom: 0;">
                        <strong>Demografía Clave:</strong> El segmento con mayor tasa de respuesta son <strong>Mujeres de 25-34 años</strong> ({{ $data['demographics']['female_25_34'] ?? 0 }}%).
                    </div>
                </td>
            </tr>
        </table>

        <!-- Interacciones Totales -->
        <div class="seccion-encabezado">
            <div class="seccion-titulo">Desglose de Interacciones Totales</div>
        </div>
        
        <table class="kpi-tabla">
            <tr>
                <td class="kpi-tarjeta">
                    <div class="kpi-etiqueta">Likes</div>
                    <div class="kpi-valor" style="font-size: 22px;">{{ number_format($data['interactions_breakdown']['likes'] ?? 0) }}</div>
                </td>
                <td class="kpi-tarjeta">
                    <div class="kpi-etiqueta">Comentarios</div>
                    <div class="kpi-valor" style="font-size: 22px;">{{ number_format($data['interactions_breakdown']['comments'] ?? 0) }}</div>
                </td>
                <td class="kpi-tarjeta">
                    <div class="kpi-etiqueta">Compartidos</div>
                    <div class="kpi-valor" style="font-size: 22px;">{{ number_format($data['interactions_breakdown']['shares'] ?? 0) }}</div>
                </td>
                <td class="kpi-tarjeta">
                    <div class="kpi-etiqueta">Guardados</div>
                    <div class="kpi-valor" style="font-size: 22px;">{{ number_format($data['interactions_breakdown']['saves'] ?? 0) }}</div>
                </td>
            </tr>
        </table>

        <!-- Detalle por Tipo y Plataforma -->
        <table class="contenido-principal-tabla">
            <tr>
                <td class="contenido-tarjeta" style="width: 60%; border-right: none;">
                    <div class="seccion-titulo" style="font-size: 13px; margin-bottom: 10px;">Efectividad por Tipo de Contenido</div>
                    <table class="tabla-datos">
                        <thead>
                            <tr>
                                <th>Formato</th>
                                <th style="text-align: center;">Eng. Rate</th>
                                <th style="text-align: right;">Interacciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['engagement_by_type'] ?? [] as $item)
                                <tr>
                                    <td style="font-weight: bold;">{{ $item['type'] }}</td>
                                    <td style="text-align: center;">{{ $item['rate'] }}</td>
                                    <td style="text-align: right;">{{ number_format($item['interactions']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
                <td class="contenido-tarjeta" style="width: 40%; background-color: #f9fafb;">
                    <div class="seccion-titulo" style="font-size: 13px; margin-bottom: 15px;">Rendimiento por Plataforma</div>
                    @foreach($data['engagement_by_platform'] ?? [] as $platform)
                        <div style="margin-bottom: 15px;">
                            <span style="font-size: 12px; color: #4b5563;">{{ $platform['platform'] }}</span>
                            <span style="float: right; font-size: 12px; font-weight: bold;">{{ $platform['rate'] }}</span>
                            <div class="progreso-contenedor">
                                @php
                                    $pRate = (float)str_replace('%', '', $platform['rate']);
                                    $maxRate = 10; // Normalizing for progress bar
                                    $width = min(($pRate / $maxRate) * 100, 100);
                                @endphp
                                <div class="progreso-barra" style="width: {{ $width }}%; background-color: {{ $platform['platform'] == 'Instagram' ? '#ec4899' : '#3b82f6' }};"></div>
                            </div>
                            <div style="font-size: 10px; margin-top: 4px;" class="{{ $platform['trend'] === 'up' ? 'tendencia-alza' : 'tendencia-baja' }}">
                                {{ $platform['trend'] === 'up' ? 'Tendencia al alza' : 'Tendencia a la baja' }}
                            </div>
                        </div>
                    @endforeach
                </td>
            </tr>
        </table>

        <!-- Insights de comportamiento -->
        <div class="seccion-encabezado">
            <div class="seccion-titulo">Interpretación Estratégica</div>
        </div>
        
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 100%; vertical-align: top; background-color: #f1f5f9; padding: 20px; border-radius: 8px;">
                    <div style="font-size: 14px; font-weight: bold; margin-bottom: 10px; color: #1e1b4b;">Análisis de Resultados</div>
                    <p style="font-size: 12px; color: #475569; line-height: 1.6; margin: 0;">
                        Los datos actuales muestran un engagement rate del {{ $data['engagement']['rate'] ?? '0.0%' }}, con un rendimiento destacado en el formato de contenido que genera mayor interacción. La audiencia de <strong>Mujeres de 25-34 años</strong> sigue siendo el motor principal de participación. Se recomienda enfocar los esfuerzos creativos en la franja horaria de <strong>{{ $data['optimal_time']['range'] ?? 'tarde' }}</strong> para maximizar el alcance orgánico y la interactividad, esperando un incremento del {{ $data['optimal_time']['engagement_boost'] ?? '0%' }} según los patrones observados.
                    </p>
                </td>
            </tr>
        </table>

    </div>

    <div class="pie-pagina">
        Este informe detallado ha sido estructurado y generado algorítmicamente para el análisis exclusivo de PRODOVI.<br>
        &copy; {{ date('Y') }} Marketing Estratégico. Todos los derechos reservados.
    </div>

</body>
</html>
