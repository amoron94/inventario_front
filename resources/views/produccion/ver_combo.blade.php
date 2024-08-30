<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ public_path('img/photos/logo_digitaldev.jpg') }}" type="image/x-icon"/>
    <link href="{{public_path('css/radiobutton.css')}}" rel="stylesheet">
    <title>Ver Receta</title>
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
    </div>
    <div class="content">
        @foreach($combos['data'] as $combo)
        <center><p class="mt-4"><b>{{ $combo['nombre'] }}</b></p></center>
        <p><b>PRODUCTO TERMINADO: </b>{{ $combo['producto'] }}</p>
        <p><b>OBSERVACIONES: </b>{{ $combo['obs'] }}</p>
        <p><b>RESPONSABLE DE LA CREACION: </b>{{ $combo['responsable'] }}</p>

        <!-- Tabla para mostrar los detalles de la receta -->
        <div class="table-responsive">
            <h4>Detalles del Combo</h4>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Unidad de Medida</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($combo['detalles'] as $detalle)
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
