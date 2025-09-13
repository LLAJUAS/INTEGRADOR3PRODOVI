<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte de Campañas</title>
    <style>
        /* Estilos optimizados para PDF */
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 5px;
        }
        .header p {
            color: #7f8c8d;
            font-size: 14px;
        }
        .metrics-container {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .metric-box {
            display: table-cell;
            width: 48%;
            padding: 15px;
            margin-right: 2%;
            border-radius: 8px;
            vertical-align: top;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .metric-box:last-child {
            margin-right: 0;
        }
        .metric-title {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 5px;
        }
        .metric-value {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
        }
        .section-title {
            font-size: 18px;
            color: #2c3e50;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .chart-container {
            margin-bottom: 30px;
        }
        .chart-title {
            text-align: center;
            font-size: 16px;
            margin-bottom: 10px;
            color: #34495e;
        }
        .chart-image {
            width: 100%;
            height: 200px;
            background-color: #f9f9f9;
            border: 1px solid #eee;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #7f8c8d;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .report-date {
            text-align: right;
            font-size: 12px;
            color: #7f8c8d;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Campañas Publicitarias</h1>
        <p>Resumen de desempeño y métricas clave</p>
    </div>
    
    <div class="report-date">
        Generado el: {{ now()->format('d/m/Y H:i') }}
    </div>

    <!-- Primera fila de métricas -->
    <div class="metrics-container">
        <div class="metric-box" style="background-color: #f0f5ff;">
            <div class="metric-title">Campañas Activas</div>
            <div class="metric-value">1</div>
        </div>
        
        <div class="metric-box" style="background-color: #f8f0ff;">
            <div class="metric-title">Presupuesto Total</div>
            <div class="metric-value">800 Bs</div>
        </div>
    </div>

    <!-- Sección de gráficos -->
    <div>
        <div class="section-title">Resultados por Plataforma</div>
        
        <!-- Distribución del presupuesto -->
        <div class="chart-container">
            <div class="chart-title">Distribución del Presupuesto</div>
            <div class="chart-image">
                [Gráfico: Facebook (240 Bs) - 30% | Instagram (560 Bs) - 70%]
            </div>
            <table width="100%" style="border-collapse: collapse;">
                <tr>
                    <td width="50%" style="padding: 5px; border-bottom: 1px solid #eee;">Facebook</td>
                    <td width="50%" style="padding: 5px; border-bottom: 1px solid #eee; text-align: right;">240 Bs (30%)</td>
                </tr>
                <tr>
                    <td style="padding: 5px; border-bottom: 1px solid #eee;">Instagram</td>
                    <td style="padding: 5px; border-bottom: 1px solid #eee; text-align: right;">560 Bs (70%)</td>
                </tr>
                <tr>
                    <td style="padding: 5px; font-weight: bold;">Total</td>
                    <td style="padding: 5px; text-align: right; font-weight: bold;">800 Bs</td>
                </tr>
            </table>
        </div>
        
        <!-- Alcance e interacciones -->
        <div class="chart-container">
            <div class="chart-title">Alcance e Interacciones</div>
            <div class="chart-image">
                [Gráfico de barras: Facebook vs Instagram]
            </div>
            <table width="100%" style="border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f5f5f5;">
                        <th style="padding: 8px; text-align: left;">Métrica</th>
                        <th style="padding: 8px; text-align: right;">Facebook</th>
                        <th style="padding: 8px; text-align: right;">Instagram</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #eee;">Personas alcanzadas</td>
                        <td style="padding: 8px; border-bottom: 1px solid #eee; text-align: right;">500</td>
                        <td style="padding: 8px; border-bottom: 1px solid #eee; text-align: right;">800</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #eee;">Me gusta</td>
                        <td style="padding: 8px; border-bottom: 1px solid #eee; text-align: right;">20</td>
                        <td style="padding: 8px; border-bottom: 1px solid #eee; text-align: right;">100</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer">
        Reporte generado automáticamente por el Sistema de Gestión de Campañas
    </div>
</body>
</html>