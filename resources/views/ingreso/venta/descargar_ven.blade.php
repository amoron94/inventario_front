<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ public_path('img/photos/logo_digitaldev.jpg') }}" type="image/x-icon"/>
    <link href="{{public_path('css/radiobutton.css')}}" rel="stylesheet">
    <title>Orden de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            padding: 0 15px;
        }
        .card-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .card {
            flex: 1;
            margin: 0 10px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .text-success{
            color: #28a745
        }
        .border-success {
            border-color: #28a745;
        }
        .border-danger {
            border-color: #dc3545;
        }
        .card h4 {
            margin-top: 0;
        }
        .table-responsive {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #3B7DDD;
            color: white;
        }
        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    @foreach($ventas['data'] as $venta)
    <div class="header">
        <center>
            <img src="{{ public_path('img/empresa/' . $empresas['data']['img']) }}" alt="Empresa" class="img-pos"><br>
            <span><b>{{ $empresas['data']['nombre'] }}</b></span>
        </center>
        <h3>Orden de Venta Nº 00{{ $venta['nro'] }}</h3>
    </div>
    <div class="content">

        <p class="mt-4"><b>FECHA: </b>{{ $venta['fecha'] }}</p>
        <p><b>SUCURSAL: </b>{{ $venta['sucursal'] }}</p>
        <p><b>RESPONSABLE DE COMPRA: </b>{{ $venta['responsable'] }}</p>
        <p><b>TIPO DE PAGO: </b>{{ $venta['tipo_pago'] }}</p>
        <p><b>OBSERVACIONES: </b>{{ $venta['obs'] }}</p>

        <div class="card-container">
            <div class="card border-success">
                <h4 class="text-success">Datos del Cliente</h4>

                <span><b>{{ $venta['cliente'] }}</b></span><br>
                <span><b>TELEFONO: </b>{{ $venta['telefono'] }}</span><br>
                <span><b>Email: </b>{{ $venta['email'] }}</span>

            </div>
        </div>
        <!-- Tabla para mostrar los detalles del movimiento -->
        <div class="table-responsive">
            <h4>Detalles de la Venta</h4>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Unidad de Medida</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($venta['detalles'] as $detalle)
                        <tr>
                            <td>{{ $detalle['producto'] }}</td>
                            <td>{{ $detalle['medida'] }} <b>({{ $detalle['av'] }})</b></td>
                            <td>{{ $detalle['cantidad'] }}</td>
                            <td>{{ $detalle['precio'] }}</td>
                            <td>{{ $detalle['total'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot style="font-size: 12px; background: #a2c0eb">
                    <tr>
                        <td colspan="4" class="text-end text-dark"><span style="font-size: 18px"><b>Total a Cancelar</b></span></td>
                        <td class="text-dark"><span style="font-size: 18px"><b>{{ $venta['monto_total'] }} Bs.</b></span></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @endforeach

</body>
</html>
