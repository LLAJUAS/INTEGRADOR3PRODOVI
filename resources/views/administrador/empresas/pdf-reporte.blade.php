<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte Ejecutivo - {{ $empresa->nombre_empresa }}</title>
    <style>
        /* --- ESTILOS COMPATIBLES CON DOMPDF --- */
        
        /* Fuente y cuerpo */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }
        
        /* Contenedor principal */
        .container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }
        
        /* Portada - Usando color sólido en lugar de degradado */
        .header {
            background-color: #4f46e5; /* Un azul sólido en lugar del degradado */
            color: white;
            padding: 40px;
            text-align: center;
            border-bottom: 4px solid #312e81; /* Un borde más oscuro para dar profundidad */
        }
        
        .header h1 {
            font-size: 32px;
            margin: 0 0 10px 0;
            font-weight: bold;
        }
        
        .header h2 {
            font-family: sans-serif;
            font-size: 24px;
            font-weight: 300;
            margin: 0;
        }
        
        .header-info {
            font-size: 14px;
            margin-top: 20px;
            opacity: 0.9;
        }
        
        /* Contenido */
        .content {
            padding: 40px;
        }
        
        .section {
            margin-bottom: 30px;
            page-break-inside: avoid; /* Evita que una sección se corte entre páginas */
        }
        
        .section h2 {
            font-size: 20px;
            color: #1f2937;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }
        
        .section-content {
            white-space: pre-wrap;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 14px;
            text-align: left;
        }
        
        /* Pie de página */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
        
        /* Para listas si las hay en el contenido */
        ul, ol {
            margin: 10px 0;
            padding-left: 30px;
        }
        
        li {
            margin-bottom: 5px;
        }
        
        /* Para texto en negrita si lo hay */
        strong {
            font-weight: bold;
        }
        
        /* Saltos de página entre secciones si es necesario */
        .page-break {
            page-break-after: always;
        }
            .footer img {
            max-width: 120px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Portada -->
        <div class="header">
            <h1>Reporte Ejecutivo</h1>
            <h2>{{ $empresa->nombre_empresa }}</h2>
            <div class="header-info">
                {{ $empresa->tipo_empresa }} • {{ now()->format('d/m/Y') }}
            </div>
        </div>

        <!-- Contenido del reporte -->
        <div class="content">
            @foreach($secciones as $index => $seccion)
                <div class="section">
                    <h2>{{ $seccion['titulo'] }}</h2>
                    <div class="section-content">{{ $seccion['contenido'] }}</div>
                </div>
                
                {{-- Opcional: Añadir un salto de página después de ciertas secciones --}}
                @if($index == 1) <!-- Después de la segunda sección -->
                    <div class="page-break"></div>
                @endif
            @endforeach
        </div>

        <!-- Pie de página -->
        <div class="footer">
            <img src="{{ public_path('imagenes/logonegro.png') }}" alt="Logo de PRODOVI"> 

            <p>Fecha de generación: {{ now()->format('d/m/Y H:i') }}</p>
        </div>
    </div>
</body>
</html>