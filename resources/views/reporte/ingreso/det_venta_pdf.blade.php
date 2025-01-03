<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ public_path('img/photos/logo_digitaldev.jpg') }}" type="image/x-icon"/>
    <link href="{{public_path('css/radiobutton.css')}}" rel="stylesheet">
    <title>Detalle de Ventas</title>

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
        @if($activo == 1)
            <h3>Detalle de Ventas</h3>
        @else
            <h3>Ventas Eliminadas</h3>
        @endif
    </div>
    <span><b>Fecha Inicio: {{ $inicio }}</b></span><br>
    <span><b>Fecha Final: {{ $fin }}</b></span>
    <div class="table-responsive">
        <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
            <thead class="bg-colorbase" style="font-size: 11px;">
                <tr class="text-white">
                    <th rowspan="2" style="align-content: center;"><center>NRO</center></th>
                    <th rowspan="2" style="align-content: center;"><center>CLIENTE</center></th>
                    <th rowspan="2" style="align-content: center;"><center>SUCURSAL</center></th>
                    <th colspan="1" style="align-content: center;"><center>TOTAL</center></th>
                    <th rowspan="2" style="align-content: center;"><center>METODO DE PAGO</center></th>
                    <th rowspan="2" style="align-content: center;"><center>VENDEDOR</center></th>
                    <th rowspan="2" style="align-content: center;"><center>FECHA</center></th>
                </tr>
                <tr class="text-white">
                    <th style="align-content: center;"><center>Total {{$ventas['total']}} Bs.</center></th>
                </tr>
            </thead>
            <tbody style="font-size: 10px;">
                @foreach($ventas['ventas'] as $venta)
                <tr>
                    <td><center>{{$venta['nro']}}</center></td>
                    <td>{{$venta['cliente']}}</td>
                    <td>{{$venta['sucursal']}}</td>
                    <td><center>{{$venta['total_venta']}}</center></td>
                    <td>{{$venta['tipo_pago']}}</td>
                    <td>{{$venta['vendedor']}}</td>
                    <td>{{$venta['fecha']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
