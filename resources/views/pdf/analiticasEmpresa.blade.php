<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Rendimiento Digital - {{ $data['period_label'] ?? 'PRODOVI' }}</title>
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
    </style>
</head>
<body>

    <div class="cabecera-banda">
        <table class="cabecera-tabla">
            <tr>
                <td>
                    <img src="{{ public_path('imagenes/logoblanco.png') }}" style="height: 40px; width: auto;">
                    <div class="reporte-titulo">Reporte de Analíticas - {{ $data['period_label'] ?? 'Consolidado' }}</div>
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
            <div class="seccion-titulo">Resultados de Alto Nivel</div>
        </div>
        
        <table class="kpi-tabla">
            <tr>
                <!-- Engagement Rate -->
                <td class="kpi-tarjeta">
                    <div class="kpi-etiqueta">Engagement</div>
                    <div class="kpi-valor">{{ $data['engagement']['rate'] ?? 'N/A' }}</div>
                    <span class="tendencia-distintivo {{ (isset($data['engagement']['trend']) && $data['engagement']['trend'] === 'up') ? 'tendencia-alza' : 'tendencia-baja' }}">
                        {{ (isset($data['engagement']['trend']) && $data['engagement']['trend'] === 'up') ? '' : '' }} {{ $data['engagement']['vs_previous'] ?? '' }}
                    </span>
                </td>
                
                <!-- Reach -->
                <td class="kpi-tarjeta">
                    <div class="kpi-etiqueta">Alcance Total</div>
                    <div class="kpi-valor">{{ $data['reach']['total'] ?? 'N/A' }}</div>
                    <span class="tendencia-distintivo {{ (isset($data['reach']['trend']) && $data['reach']['trend'] === 'up') ? 'tendencia-alza' : 'tendencia-baja' }}">
                        {{ (isset($data['reach']['trend']) && $data['reach']['trend'] === 'up') ? '' : '' }} {{ $data['reach']['vs_previous'] ?? '' }}
                    </span>
                </td>
                
                <!-- Followers -->
                <td class="kpi-tarjeta">
                    <div class="kpi-etiqueta">Seguidores</div>
                    <div class="kpi-valor">{{ $data['followers']['new'] ?? 'N/A' }}</div>
                    <span class="tendencia-distintivo {{ (isset($data['followers']['trend']) && $data['followers']['trend'] === 'up') ? 'tendencia-alza' : 'tendencia-baja' }}">
                        {{ (isset($data['followers']['trend']) && $data['followers']['trend'] === 'up') ? '' : '' }} {{ $data['followers']['vs_previous'] ?? '' }}
                    </span>
                </td>
                
                <!-- Conversion -->
                <td class="kpi-tarjeta">
                    <div class="kpi-etiqueta">Conversión</div>
                    <div class="kpi-valor">{{ $data['conversion']['rate'] ?? 'N/A' }}</div>
                    <span class="tendencia-distintivo {{ (isset($data['conversion']['trend']) && $data['conversion']['trend'] === 'up') ? 'tendencia-alza' : 'tendencia-baja' }}">
                        {{ (isset($data['conversion']['trend']) && $data['conversion']['trend'] === 'up') ? '' : '' }} {{ $data['conversion']['vs_previous'] ?? '' }}
                    </span>
                </td>
            </tr>
        </table>

        <!-- Detalle de Seguimiento y Distribución -->
        <table class="contenido-principal-tabla">
            <tr>
                <td class="contenido-tarjeta" style="width: 65%; border-right: none;">
                    <div class="seccion-titulo" style="font-size: 13px; margin-bottom: 10px;">Crecimiento Segmentado</div>
                    <table class="tabla-datos">
                        <thead>
                            <tr>
                                <th>Periodo</th>
                                <th style="text-align: center;">Facebook</th>
                                <th style="text-align: center;">Instagram</th>
                                <th style="text-align: right;">Crecimiento Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data['followers']['growth_labels']))
                                @foreach($data['followers']['growth_labels'] as $index => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td style="text-align: center;">{{ $data['followers']['growth_facebook'][$index] ?? 0 }}</td>
                                        <td style="text-align: center;">{{ $data['followers']['growth_instagram'][$index] ?? 0 }}</td>
                                        <td style="text-align: right; font-weight: bold;">+{{ ($data['followers']['growth_facebook'][$index] ?? 0) + ($data['followers']['growth_instagram'][$index] ?? 0) }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </td>
                <td class="contenido-tarjeta" style="width: 35%; background-color: #f9fafb;">
                    <div class="seccion-titulo" style="font-size: 13px; margin-bottom: 20px;">Participación</div>
                    <div style="margin-bottom: 25px;">
                        <span style="font-size: 12px; color: #4b5563;">Facebook Ads & Social</span>
                        <span style="float: right; font-size: 12px; font-weight: bold;">{{ $data['distribution']['platform']['facebook'] ?? 0 }}%</span>
                        <div class="progreso-contenedor">
                            <div class="progreso-barra" style="width: {{ $data['distribution']['platform']['facebook'] ?? 0 }}%; background-color: #3b82f6;"></div>
                        </div>
                    </div>
                    <div style="margin-bottom: 25px;">
                        <span style="font-size: 12px; color: #4b5563;">Instagram Feed & Stories</span>
                        <span style="float: right; font-size: 12px; font-weight: bold;">{{ $data['distribution']['platform']['instagram'] ?? 0 }}%</span>
                        <div class="progreso-contenedor">
                            <div class="progreso-barra" style="width: {{ $data['distribution']['platform']['instagram'] ?? 0 }}%; background-color: #ec4899;"></div>
                        </div>
                    </div>
                    
                    <div style="background-color: white; border: 1px dashed #cbd5e1; padding: 15px; border-radius: 6px; margin-top: 30px;">
                        <div style="font-size: 10px; font-weight: bold; color: #4b5563; margin-bottom: 8px; text-transform: uppercase;">Mejor Momento</div>
                        <div style="font-size: 15px; font-weight: bold; color: #1e1b4b;">{{ $data['optimal_time']['range'] ?? '15:00 - 18:00' }}</div>
                        <div style="font-size: 11px; color: #6b7280; margin-top: 4px;">{{ $data['optimal_time']['engagement_boost'] ?? '+25%' }} más interacción esperado.</div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Demografía -->
        <div class="seccion-encabezado">
            <div class="seccion-titulo">Análisis de Audiencia Principal</div>
        </div>
        
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 48%; vertical-align: top; padding-right: 20px;">
                    <div class="demo-fila">
                        <span class="demo-etiqueta">Mujeres de 25-34 años (Core)</span>
                        <span class="demo-porcentaje">{{ $data['demographics']['female_25_34'] ?? 0 }}%</span>
                        <div class="progreso-contenedor"><div class="progreso-barra" style="width: {{ $data['demographics']['female_25_34'] ?? 0 }}%; background-color: #f472b6;"></div></div>
                    </div>
                    <div class="demo-fila">
                        <span class="demo-etiqueta">Hombres de 25-34 años</span>
                        <span class="demo-porcentaje">{{ $data['demographics']['male_25_34'] ?? 0 }}%</span>
                        <div class="progreso-contenedor"><div class="progreso-barra" style="width: {{ $data['demographics']['male_25_34'] ?? 0 }}%; background-color: #60a5fa;"></div></div>
                    </div>
                </td>
                <td style="width: 4%; border-left: 1px solid #f3f4f6;"></td>
                <td style="width: 48%; vertical-align: top; background-color: #f1f5f9; padding: 20px; border-radius: 8px;">
                    <div style="font-size: 14px; font-weight: bold; margin-bottom: 10px; color: #1e1b4b;">Interpretación de Datos</div>
                    <p style="font-size: 12px; color: #475569; line-height: 1.6; margin: 0;">
                        Los datos reflejan una sólida tracción en el segmento de 25-34 años. Se recomienda ajustar el tono visual hacia narrativas de estilo de vida para capitalizar el engagement de {{ $data['demographics']['female_25_34'] ?? 0 }}% en la audiencia femenina, optimizando las publicaciones para la franja de {{ $data['optimal_time']['range'] ?? 'tarde' }}.
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