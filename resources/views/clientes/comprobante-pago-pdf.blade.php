<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Factura - PRODOVI</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        /* --- ESTILOS GENERALES --- */
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 40px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
        }

        /* --- ENCABEZADO --- */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .company-details img {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .company-details .name {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .company-details .address {
            font-size: 14px;
            color: #777;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h1 {
            margin: 0;
            font-size: 25px;
            color: #0056b3;
            font-weight: 700;
        }

        .invoice-title p {
            margin: 5px 0 0;
            font-size: 16px;
            color: #555;
        }

        /* --- BLOQUES DE INFORMACIÓN --- */
        .info-blocks {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            gap: 20px;
        }

        .info-block {
            width: 48%;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            border-left: 4px solid #0056b3;
        }

        .info-block h3 {
            margin-top: 0;
            font-size: 18px;
            color: #0056b3;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .info-block .row {
            margin-bottom: 8px;
            font-size: 15px;
        }

        .info-block .row strong {
            display: inline-block;
            width: 120px;
            color: #555;
        }

        /* --- TABLA DE DETALLES --- */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th {
            background-color: #0056b3;
            color: #fff;
            text-align: left;
            padding: 12px 15px;
            font-weight: 700;
        }

        .items-table td {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
            vertical-align: top;
        }

        .items-table .text-right {
            text-align: right;
        }

        .items-table .item-name {
            font-weight: bold;
        }

        /* --- TOTALES --- */
        .totals {
            text-align: right;
            margin-bottom: 40px;
        }

        .totals p {
            margin: 5px 0;
            font-size: 16px;
        }

        .totals .grand-total {
            font-size: 24px;
            font-weight: 700;
            color: #0056b3;
            border-top: 2px solid #333;
            padding-top: 10px;
            margin-top: 10px;
        }

       

      
        .info-blocks{
            display: flex;
          
            margin-bottom: 40px;
            
        }

    </style>
</head>
<body>

    <div class="invoice-box">
        <header class="header">
            <div class="company-details">
                <!-- Puedes reemplazar esto con una etiqueta <img> para tu logo -->
                <img src="{{ public_path('imagenes/logonegro.png') }}" alt="Logo de PRODOVI"> 
                
                <div class="address">
                     Zona Miraflores, Stadium Av. Hugo Estrada , Edificio Olímpia # 1354, lado Banco Sol y Karaoke Love City, Piso 1 Oficina 3, La Paz, Bolivia<br>
                    Teléfono: +591 79561365<br>
                    Email: info@prodovi.com
                </div>
            </div>
            <div class="invoice-title">
                <h1>COMPROBANTE DE PAGO</h1>
               <p><strong>N° de Comprobante:</strong> {{ $comprobante->numero_formateado }}</p>
            </div>
        </header>

        <main>
            <div class="info-blocks">
                <div class="info-block">
                    <h3>Información de la Factura</h3>
                    <div class="row"><strong>Fecha Emisión:</strong> {{ $pago->created_at->format('d/m/Y') }}</div>
                    <div class="row"><strong>Fecha Pago:</strong> {{ $pago->fecha_pago ? $pago->fecha_pago->format('d/m/Y') : 'N/A' }}</div>
                    <div class="row"><strong>Método Pago:</strong> {{ ucfirst($pago->metodo) }}</div>
                    @if($pago->fecha_aprobacion)
                    <div class="row"><strong>Fecha Aprobación:</strong> {{ $pago->fecha_aprobacion->format('d/m/Y H:i') }}</div>
                    @endif
                </div>
                <div class="info-block">
                    <h3> Datos del Cliente</h3>
                    <div class="row"><strong>Nombre:</strong> {{ $pago->usuario->name }}</div>
                    <div class="row"><strong>Email:</strong> {{ $pago->usuario->email }}</div>
                    <div class="row"><strong>Estado Pago:</strong> {{ ucfirst($pago->estado) }}</div>
                </div>
            </div>

            <section>
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th class="text-right">Precio Unitario</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="item-name">
                                {{ $pago->plan->nombre }}
                                <br>
                                <small style="color:#777;">{{ $pago->plan->descripcion ?? 'Servicio de suscripción' }}</small>
                            </td>
                            <td class="text-right">{{ $pago->moneda }} {{ number_format($pago->monto, 2) }}</td>
                            <td class="text-right">{{ $pago->moneda }} {{ number_format($pago->monto, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <div class="totals">
                <p><strong>Sub-total:</strong> {{ $pago->moneda }} {{ number_format($pago->monto, 2) }}</p>
               
                <p class="grand-total"><strong>Total a Pagar:</strong> {{ $pago->moneda }} {{ number_format($pago->monto, 2) }}</p>
            </div>
        </main>

       

      
    </div>

</body>
</html>