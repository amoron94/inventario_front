<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ public_path('img/photos/logo_digitaldev.jpg') }}" type="image/x-icon"/>
    <link href="{{public_path('css/radiobutton.css')}}" rel="stylesheet">
    <title>Clientes Eliminados</title>

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
            background-color: #4CAF50;
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

        <h3>Clientes eliminados</h3>
    </div>
    <span><b>Desde: {{ $inicio }}</b></span><br>
    <span><b>Hasta: {{ $fin }}</b></span>

    <div class="table-responsive">
        <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
            <thead class="bg-colorbase" style="font-size: 11px;">
                <tr class="text-white">
                    <th style="align-content: center;"><center>NOMBRE</center></th>
                    <th style="align-content: center;"><center>TELEFONO</center></th>
                    <th style="align-content: center;"><center>CORREO</center></th>
                    <th style="align-content: center;"><center>SEXO</center></th>
                    <th style="align-content: center;"><center>F. CUMPLEAÑOS</center></th>
                </tr>
            </thead>
            <tbody style="font-size: 10px;">
                @foreach($ventas['ventas'] as $venta)
                <tr>
                    <td>{{$venta['nombre']}}</td>
                    <td><center>{{$venta['telefono']}}</center></td>
                    <td><center>{{$venta['correo']}}</center></td>
                    <td>{{$venta['sexo']}}</td>
                    <td>{{$venta['fecha']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
