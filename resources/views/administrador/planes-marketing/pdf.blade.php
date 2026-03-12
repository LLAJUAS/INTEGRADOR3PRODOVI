<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Plan de Marketing - {{ $planMarketing->empresa->nombre_empresa }}</title>
    <style>
        /* =============================
           CONFIGURACIÓN REAL DEL PDF
           ============================= */
        @page {
            size: A4;
            margin-top: 4cm;
            margin-bottom: 4cm;
            margin-left: 2.5cm;
            margin-right: 2.5cm;
        }

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }

        /* ========================================
           MEMBRETE FULL-BLEED QUE LLENA TODA LA HOJA
           ======================================== */
        .bleed {
            position: fixed;
            top: -1cm;       /* se sale del margen superior */
            left: -2.5cm;    /* se sale del margen izquierdo */
            right: -2.5cm;   /* se sale del margen derecho */
            bottom: -1cm;    /* se sale del margen inferior */

            background-image: url("{{ public_path('imagenes/MEMBRETADO.png') }}");
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover; /* llena toda la hoja */
            z-index: -1; /* queda detrás del contenido */
        }

        /* ========================================
           CONTENIDO INTERNO (DENTRO DE LOS MÁRGENES)
           ======================================== */
        .container {
            position: relative;
            z-index: 1;
            padding: 50px;
            background-color: rgba(255,255,255,0.92);
            border-radius: 8px;
        }

        /* ----------- ESTILO DE PORTADA ---------- */
        .header {
            background-color: #6b46c1;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 25px;
            font-weight: bold;
        }

        .header h2 {
            margin: 0;
            margin-top: 5px;
            font-size: 16px;
            font-weight: 300;
        }

        .header-info {
            margin-top: 15px;
            font-size: 14px;
        }

        /* ----------- CONTENIDO ----------- */
        .content {
            padding: 50px;
        }

        .section {
            margin-top: 20px;
            margin-bottom: 30px;
            page-break-inside: avoid;
        }

        .section h2 {
            font-size: 20px;
            color: #1f2937;
            border-bottom: 2px solid #6b46c1;
            padding-bottom: 6px;
            margin-bottom: 12px;
            page-break-after: avoid;
        }

        .section-content p {
            margin-bottom: 10px;
            line-height: 1.5;
            page-break-inside: avoid;
        }

        .section-content ul {
            margin: 10px 0;
            padding-left: 20px;
            page-break-inside: avoid;
        }

        .section-content li {
            margin-bottom: 5px;
        }

        .section-content h3 {
            font-size: 16px;
            margin-top: 20px;
            color: #2d3748;
        }

        /* ----------- PIE DE PÁGINA ----------- */
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 35px;
            color: #6b7280;
        }
        .footer img {
            max-width: 120px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <!-- MEMBRETE FULL BLEED PARA TODAS LAS PÁGINAS -->
    <div class="bleed"></div>

    <!-- CONTENIDO REAL -->
    <div class="container">

        <!-- PORTADA -->
        <div class="header">
            <h1>Plan de Marketing</h1>
            <h2>{{ $planMarketing->empresa->nombre_empresa }}</h2>

            <div class="header-info">
                {{ $planMarketing->suscripcion->plan->nombre }} • 
                {{ $planMarketing->created_at->format('d/m/Y') }}
            </div>
        </div>

        <!-- CONTENIDO PARSEADO -->
        <div class="content">
            @php
                $contenidoCompleto = $planMarketing->contenido;
                $partes = preg_split('/^##\s+(.+)$/m', $contenidoCompleto, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
                $seccionesParseadas = [];

                for ($i = 0; $i < count($partes); $i += 2) {
                    if (isset($partes[$i+1])) {
                        $titulo = trim($partes[$i]);
                        $contenido = trim($partes[$i+1]);

                        $contenidoHtml = $contenido;

                        $contenidoHtml = preg_replace('/^-{3,}\s*$/m', '', $contenidoHtml);
                        $contenidoHtml = preg_replace('/^###\s+(.+)$/m', '<strong>$1</strong>', $contenidoHtml);
                        $contenidoHtml = preg_replace('/(^- .+$(\r?\n)?)+/m', '<ul>$0</ul>', $contenidoHtml);
                        $contenidoHtml = preg_replace('/^- (.+)$/m', '<li>$1</li>', $contenidoHtml);
                        $contenidoHtml = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $contenidoHtml);

                        $lineas = explode("\n", $contenidoHtml);
                        $nuevoContenido = '';

                        foreach ($lineas as $linea) {
                            $lineaLimpia = trim($linea);
                            if (!$lineaLimpia) continue;

                            if (strpos($lineaLimpia, '<') !== 0) {
                                $nuevoContenido .= "<p>$lineaLimpia</p>";
                            } else {
                                $nuevoContenido .= $linea . "\n";
                            }
                        }

                        $seccionesParseadas[] = [
                            'titulo' => $titulo,
                            'contenido' => $nuevoContenido
                        ];
                    }
                }
            @endphp

            @foreach($seccionesParseadas as $seccion)
                <div class="section">
                    <h2>{{ $seccion['titulo'] }}</h2>
                    <div class="section-content">
                        {!! $seccion['contenido'] !!}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- PIE -->
        <div class="footer">
            <img src="{{ public_path('imagenes/logonegro.png') }}" alt="Logo de PRODOVI"> 
            <p>Plan generado para: {{ $planMarketing->empresa->nombre_empresa }}</p>
            <p>Fecha de generación: {{ $planMarketing->created_at->format('d/m/Y H:i') }}</p>
        </div>

    </div>

</body>
</html>
