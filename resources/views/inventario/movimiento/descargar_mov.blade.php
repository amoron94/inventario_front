<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ public_path('img/photos/logo_digitaldev.jpg') }}" type="image/x-icon"/>
    <link href="{{public_path('css/radiobutton.css')}}" rel="stylesheet">
    <title>Movimientos de Productos entre Sucursales</title>
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
    <div class="header">
        <center>
            <img src="{{ public_path('img/empresa/' . $empresas['data']['img']) }}" alt="Empresa" class="img-pos"><br>
            <span><b>{{ $empresas['data']['nombre'] }}</b></span>
        </center>
        <h3>Movimientos de Productos entre Sucursales</h3>
    </div>
    <div class="content">
        @foreach($movimientos['data'] as $movimiento)
        <p class="mt-4"><b>FECHA: </b>{{ $movimiento['fecha'] }}</p>
        <p><b>OBSERVACIONES: </b>{{ $movimiento['obs'] }}</p>
        <p><b>RESPONSABLE DE MOVIMIENTO: </b>{{ $movimiento['responsable'] }}</p>

        <div class="card-container">
            <div class="card border-success">
                <h4>Informacion de Sucursal de Salida</h4>

                <span><b>SUCURSAL: </b>{{ $movimiento['s_salida'] }}</span><br>
                <span><b>DIRECCION: </b>{{ $movimiento['dir_salida'] }}</span><br>
                <span><b>TELEFONO: </b>{{ $movimiento['tel_salida'] }}</span><br>
                <span><b>ENCARGADO: </b>{{ $movimiento['encar_s_salida'] }}</span>
            </div>
            <br>
            <div class="card border-danger">
                <h4>Informacion de Sucursal de Entrada</h4>

                <span><b>SUCURSAL: </b>{{ $movimiento['s_entrada'] }}</span><br>
                <span><b>DIRECCION: </b>{{ $movimiento['dir_entrada'] }}</span><br>
                <span><b>TELEFONO: </b>{{ $movimiento['tel_entrada'] }}</span><br>
                <span><b>ENCARGADO: </b>{{ $movimiento['encar_s_entrada'] }}</span>
            </div>
        </div>

        <!-- Tabla para mostrar los detalles del movimiento -->
        <div class="table-responsive">
            <h4>Detalles del Movimiento</h4>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Unidad de Medida</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movimiento['detalles'] as $detalle)
                        <tr>
                            <td>{{ $detalle['producto'] }}</td>
                            <td>{{ $detalle['medida'] }} <b>({{ $detalle['av'] }})</b></td>
                            <td>{{ $detalle['cantidad'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
</body>
</html>
