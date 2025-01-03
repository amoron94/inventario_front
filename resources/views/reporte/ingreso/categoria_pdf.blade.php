<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ public_path('img/photos/logo_digitaldev.jpg') }}" type="image/x-icon"/>
    <link href="{{public_path('css/radiobutton.css')}}" rel="stylesheet">
    <title>Ventas por Categoria</title>

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

        <h3>Ventas por Categoria</h3>
    </div>
    <span><b>Fecha Inicio: {{ $inicio }}</b></span><br>
    <span><b>Fecha Final: {{ $fin }}</b></span>

    <div class="table-responsive">
        <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
            <thead class="bg-colorbase" style="font-size: 11px;">
                <tr class="text-white">
                    <th style="align-content: center;"><center>PRODUCTO</center></th>
                    <th style="align-content: center;"><center>CANTIDAD</center></th>
                    <th style="align-content: center;"><center>TOTAL BS.</center></th>
                    <th style="align-content: center;"><center>SUCURSAL</center></th>
                </tr>
            </thead>
            <tbody style="font-size: 10px;">
                @foreach($ventas['ventas'] as $venta)
                <tr>
                    <td>{{$venta['categoria']}}</td>
                    <td><center>{{$venta['total_cantidad']}}</center></td>
                    <td><center>{{$venta['total_monto']}}</center></td>
                    <td>{{$venta['sucursal']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
