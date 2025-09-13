<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Analíticas - Semanal</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #6366F1;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #1E3A8A;
            margin-bottom: 5px;
        }
        .header p {
            color: #6B7280;
        }
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }
        .metric-card {
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            padding: 15px;
            background-color: #F9FAFB;
        }
        .metric-title {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 10px;
        }
        .metric-value {
            font-size: 24px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 5px;
        }
        .metric-change {
            display: inline-flex;
            align-items: center;
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 12px;
        }
        .positive {
            background-color: #D1FAE5;
            color: #065F46;
        }
        .negative {
            background-color: #FEE2E2;
            color: #991B1B;
        }
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }
        .chart-container {
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            padding: 15px;
            background-color: white;
        }
        .chart-title {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 15px;
        }
        .secondary-metrics {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        .secondary-card {
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            padding: 15px;
            background-color: white;
        }
        .progress-bar {
            height: 8px;
            background-color: #E5E7EB;
            border-radius: 4px;
            margin-top: 5px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 4px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .table th, .table td {
            padding: 8px 12px;
            text-align: left;
            border-bottom: 1px solid #E5E7EB;
        }
        .table th {
            background-color: #F3F4F6;
            font-weight: 600;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #6B7280;
            border-top: 1px solid #E5E7EB;
            padding-top: 15px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }
        .flex {
            display: flex;
        }
        .items-center {
            align-items: center;
        }
        .justify-between {
            justify-content: space-between;
        }
        .space-y-2 > * + * {
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Informe de Analíticas - Semanal</h1>
        <p>Generado el {{ $fecha_generacion ?? now()->format('d/m/Y H:i') }}</p>
    </div>

    <!-- Primera fila de métricas -->
    <div class="metrics-grid">
        <!-- Engagement Rate -->
        <div class="metric-card">
            <div class="metric-title">Tasa de Engagement</div>
            <div class="metric-value">5.1%</div>
            <span class="metric-change positive">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                </svg>
                8.5%
            </span>
            <div class="metric-comparison">vs semana anterior</div>
        </div>

        <!-- Alcance Total -->
        <div class="metric-card">
            <div class="metric-title">Alcance Total</div>
            <div class="metric-value">12.8K</div>
            <span class="metric-change positive">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                </svg>
                6.7%
            </span>
            <div class="metric-comparison">vs semana anterior</div>
        </div>

        <!-- Nuevos Seguidores -->
        <div class="metric-card">
            <div class="metric-title">Nuevos Seguidores</div>
            <div class="metric-value">142</div>
            <span class="metric-change positive">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                </svg>
                4.4%
            </span>
            <div class="metric-comparison">vs semana anterior</div>
            <div style="margin-top: 10px;">
                <div style="display: flex; justify-content: space-between; font-size: 12px; color: #6B7280;">
                    <span>Facebook: 85</span>
                    <span>Instagram: 57</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 60%; background-color: #3B82F6;"></div>
                </div>
            </div>
        </div>

        <!-- Tasa de Conversión -->
        <div class="metric-card">
            <div class="metric-title">Tasa de Conversión</div>
            <div class="metric-value">3.5%</div>
            <span class="metric-change negative">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1v-5a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586l-4.293-4.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd"/>
                </svg>
                0.9%
            </span>
            <div class="metric-comparison">vs semana anterior</div>
        </div>
    </div>

    <!-- Segunda fila - Gráficos principales -->
    <div class="charts-grid">
        <!-- Crecimiento de seguidores -->
        <div class="chart-container">
            <div class="chart-title">Crecimiento de Seguidores (7 días)</div>
            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                <span class="badge" style="background-color: #E0E7FF; color: #4338CA;">Facebook</span>
                <span class="badge" style="background-color: #FCE7F3; color: #BE185D;">Instagram</span>
            </div>
            
            <!-- Tabla de datos -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Facebook</th>
                        <th>Instagram</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lunes</td>
                        <td>320</td>
                        <td>210</td>
                        <td>530</td>
                    </tr>
                    <tr>
                        <td>Martes</td>
                        <td>325</td>
                        <td>212</td>
                        <td>537</td>
                    </tr>
                    <tr>
                        <td>Miércoles</td>
                        <td>330</td>
                        <td>213</td>
                        <td>543</td>
                    </tr>
                    <tr>
                        <td>Jueves</td>
                        <td>332</td>
                        <td>215</td>
                        <td>547</td>
                    </tr>
                    <tr>
                        <td>Viernes</td>
                        <td>335</td>
                        <td>217</td>
                        <td>552</td>
                    </tr>
                    <tr>
                        <td>Sábado</td>
                        <td>338</td>
                        <td>218</td>
                        <td>556</td>
                    </tr>
                    <tr>
                        <td>Domingo</td>
                        <td>340</td>
                        <td>220</td>
                        <td>560</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Distribución de engagement -->
        <div class="chart-container">
            <div class="chart-title">Distribución de Engagement</div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <span style="font-size: 14px; color: #6B7280;">Por Plataforma</span>
            </div>
            
            <!-- Datos de distribución -->
            <div style="margin-top: 20px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                    <span style="font-size: 13px;">
                        <span style="display: inline-block; width: 10px; height: 10px; background-color: #3B82F6; margin-right: 8px;"></span>
                        Facebook
                    </span>
                    <span style="font-weight: 500;">58%</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                    <span style="font-size: 13px;">
                        <span style="display: inline-block; width: 10px; height: 10px; background-color: #EC4899; margin-right: 8px;"></span>
                        Instagram
                    </span>
                    <span style="font-weight: 500;">42%</span>
                </div>
            </div>
            
            <!-- Distribución por hora del día -->
            <div style="margin-top: 30px;">
                <div class="chart-title" style="font-size: 16px; margin-bottom: 15px;">Por Hora del Día</div>
                <div style="margin-bottom: 10px;">
                    <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 5px;">
                        <span>6-9</span>
                        <span>5%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 5%; background-color: #6366F1;"></div>
                    </div>
                </div>
                <div style="margin-bottom: 10px;">
                    <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 5px;">
                        <span>9-12</span>
                        <span>15%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 15%; background-color: #8B5CF6;"></div>
                    </div>
                </div>
                <div style="margin-bottom: 10px;">
                    <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 5px;">
                        <span>12-15</span>
                        <span>20%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 20%; background-color: #EC4899;"></div>
                    </div>
                </div>
                <div style="margin-bottom: 10px;">
                    <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 5px;">
                        <span>15-18</span>
                        <span>35%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 35%; background-color: #F59E0B;"></div>
                    </div>
                </div>
                <div style="margin-bottom: 10px;">
                    <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 5px;">
                        <span>18-21</span>
                        <span>15%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 15%; background-color: #10B981;"></div>
                    </div>
                </div>
                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 5px;">
                        <span>21-24</span>
                        <span>10%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 10%; background-color: #3B82F6;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tercera fila - Métricas secundarias -->
    <div class="secondary-metrics">
        <!-- Horario óptimo -->
        <div class="secondary-card">
            <div class="chart-title">Horario Óptimo</div>
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                <div style="background-color: #FEF3C7; padding: 8px; border-radius: 8px; margin-right: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#D97706">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <div style="font-weight: 500; color: #111827;">Mejor hora para publicar</div>
                    <div style="font-size: 12px; color: #6B7280;">Basado en datos de engagement</div>
                </div>
            </div>
            <div style="background-color: #F3F4F6; padding: 12px; border-radius: 8px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span style="font-size: 14px; font-weight: 500;">16:00 - 17:00</span>
                    <span class="badge" style="background-color: #E0E7FF; color: #4338CA;">+28% engagement</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 68%; background-color: #4F46E5;"></div>
                </div>
            </div>
        </div>

        <!-- Demografía -->
        <div class="secondary-card">
            <div class="chart-title">Audiencia Principal</div>
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                <div style="background-color: #FCE7F3; padding: 8px; border-radius: 8px; margin-right: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#BE185D">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <div style="font-weight: 500; color: #111827;">Perfil Demográfico</div>
                    <div style="font-size: 12px; color: #6B7280;">Segmento más comprometido</div>
                </div>
            </div>
            
            <div class="space-y-2">
                <div>
                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                        <span>Mujeres 25-34</span>
                        <span>45%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 45%; background-color: #EC4899;"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                        <span>Hombres 25-34</span>
                        <span>30%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 30%; background-color: #3B82F6;"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                        <span>Mujeres 18-24</span>
                        <span>18%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 18%; background-color: #8B5CF6;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p>Informe generado automáticamente por el Sistema de Analíticas</p>
        <p>© {{ date('Y') }} PRODOVI. Todos los derechos reservados.</p>
    </div>
</body>
</html>