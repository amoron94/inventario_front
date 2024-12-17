<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ public_path('img/photos/logo_digitaldev.jpg') }}" type="image/x-icon"/>
    <link href="{{public_path('css/radiobutton.css')}}" rel="stylesheet">
    <title>Orden de Compra</title>
    <style>
        .textstyle {
            font-size: 12px;
        }
        .line-item {
            display: flex;
            justify-content: space-between;
        }
        .line-item span:last-child {
            margin-left: auto;
        }
        @media print {
            #recibo {
                position: absolute;
                left: 0;
                top: 0;
                width: 58mm; /* Ajusta el ancho según tu impresora térmica */
            }
        }
    </style>
</head>
<body id="recibo" style="width: 58mm;">
    <center><h4>CIERRE DE CAJA</h4></center>
    <?php $caja = $cajas['data']; ?>

    <div class="textstyle">
        <span>Almacen: {{ $caja['sucursal'] }}</span><br>
        <span>Encargado: {{ $caja['encargado'] }}</span><br>
        <span>Telefono: {{ $caja['telefono'] }}</span>
        <hr>
        <span>Usuario/Cajero: {{ $caja['usuario'] }}</span><br>
        <span>Fecha Apertura: {{ $caja['fecha_a'] }}</span><br>
        <span>Hora Apertura: {{ $caja['hora_a'] }}</span><br>
        <span>Fecha Cierre: {{ $caja['fecha_c'] }}</span><br>
        <span>Hora Cierre: {{ $caja['hora_c'] }}</span>

        <hr>
        <div class="line-item">
            <span>Monto Apertura: </span>
            <span>{{ $caja['monto_a'] }} Bs.</span>
        </div>
        <hr>
        <div class="line-item">
            <span>Total Efectivo: </span>
            <span>{{ $caja['total_contado'] }} Bs.</span>
        </div>
        <div class="line-item">
            <span>Total Tarjeta: </span>
            <span>{{ $caja['total_tarjeta'] }} Bs.</span>
        </div>
        <div class="line-item">
            <span>Total Qr: </span>
            <span>{{ $caja['total_qr'] }} Bs.</span>
        </div>
        <hr>
        <center>
            <span><b>MONTO RECAUDADO</b></span><br>
            <span><b>{{ $caja['total_recaudado'] }} Bs.</b></span>
        </center>
        <hr>
        <div class="line-item">
            <span>Total Esperado de Ventas: </span>
            <span>{{ $caja['total_sistema'] }} Bs.</span>
        </div>
        <div class="line-item">
            <span>Total en Caja (Arqueo): </span>
            <span>{{ $caja['monto_c'] }} Bs.</span>
        </div>
        <div class="line-item">
            <span>
                @if ($caja['diferencia'] == 0)
                    Sin Diferencia:
                @elseif ($caja['diferencia'] > 0)
                    Sobrante:
                @else
                    Faltante:
                @endif
            </span>
            <span>{{ $caja['diferencia'] }} Bs.</span>
        </div>
        <hr>
        <span>Comentarios:</span><br>
        <span>{{ $caja['obs'] }}</span>
    </div>

</body>
</html>
