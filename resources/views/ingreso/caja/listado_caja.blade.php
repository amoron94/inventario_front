@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <h3 class="d-inline align-middle">Listado de Cierre y Arqueo de Cajas </h3>
            <br>
            <span class="text-danger"><b>Nota: Se vizualizan los cierres de los ultimos 3 meses</b></span>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle" data-order-direction="desc">
                <thead class="bg-colorbase" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Nro Caja</th>
                        <th>F. Apertura</th>
                        <th>F. Cierre</th>
                        <th>Sucursal</th>
                        <th>Usuario/Cajero</th>
                        <th>Monto Apertura</th>
                        <th>Monto Cierre</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($cajas['data'] as $caja)
                    <tr>
                        <td>{{ $caja['nro']}}</td>
                        <td>{{ $caja['fecha_a']}}</td>
                        <td>{{ $caja['fecha_c']}}</td>
                        <td>{{ $caja['sucursal']}}</td>
                        <td>{{ $caja['usuario']}}</td>
                        <td>{{ $caja['monto_a']}}</td>
                        <td>{{ $caja['monto_c']}}</td>
                        <td>
                            <center>
                                <a href="{{ route('descargar_caja', ['id' => $caja['codigo']]) }}" title="Imprimir" target="_blank">
                                    <i class="text-danger" data-feather="printer"></i>
                                </a>
                            </center>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@push('scripts')
    <script>

    </script>
@endpush

@stop
