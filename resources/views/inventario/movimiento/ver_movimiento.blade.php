@extends('dashboard')
@section('contenido')

    @foreach($movimientos['data'] as $movimiento)
    <div class="card-header">
        <div class="container-fluid p-0">
            <a href="{{ route('descargar_mov', ['id' => $movimiento['codigo']]) }}" class="btn btn-sm btn-danger float-end"><i data-feather="file-text"></i> Descargar PDF</a>
            <button class="btn btn-sm btn-primary float-end me-2" onclick="window.print()"><i data-feather="printer"></i> Imprimir</button>
        </div>
    </div>

    <div class="card-body print-area">
        <div class="container-fluid p-0">
            <center><h2 class="d-inline align-middle">Movimientos de Productos entre Sucursales</h2></center>
        </div>

        <p class="mt-4"><b>FECHA: </b>{{ $movimiento['fecha'] }}</p>
        <p><b>OBSERVACIONES: </b>{{ $movimiento['obs'] }}</p>
        <p><b>RESPONSABLE DE MOVIMIENTO: </b>{{ $movimiento['responsable'] }}</p>

        <div class="container mt-4">
            <div class="border-success px-3 pt-3" style="border: 1px solid">
                <h4>Informacion de Sucursal de Salida</h4>

                <div class="row mt-3">
                    <div class="col-5">
                        <p><b>SUCURSAL: </b>{{ $movimiento['s_salida'] }}</p>
                    </div>
                    <div class="col-7">
                        <p><b>DIRECCION: </b>{{ $movimiento['dir_salida'] }}</p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-5">
                        <p><b>TELEFONO: </b>{{ $movimiento['tel_salida'] }}</p>
                    </div>
                    <div class="col-7">
                        <p><b>ENCARGADO: </b>{{ $movimiento['encar_s_salida'] }}</p>
                    </div>
                </div>
            </div>

            <div class="border-danger mt-3 px-3 pt-3" style="border: 1px solid">
                <h4>Informacion de Sucursal de Entrada</h4>

                <div class="row mt-3">
                    <div class="col-5">
                        <p><b>SUCURSAL: </b>{{ $movimiento['s_entrada'] }}</p>
                    </div>
                    <div class="col-7">
                        <p><b>DIRECCION: </b>{{ $movimiento['dir_entrada'] }}</p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-5">
                        <p><b>TELEFONO: </b>{{ $movimiento['tel_entrada'] }}</p>
                    </div>
                    <div class="col-7">
                        <p><b>ENCARGADO: </b>{{ $movimiento['encar_s_entrada'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Tabla para mostrar los detalles del movimiento -->
            <div class="mt-4">
                <h4>Detalles del Movimiento</h4>
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered table-hover align-middle">
                        <thead style="font-size: 12px; background: #3B7DDD">
                            <tr class="text-white">
                                <th>Producto</th>
                                <th>Unidad de Medida</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 11px;">
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
            </div>
        </div>
    </div>
    @endforeach
    
    <div class="d-flex justify-content mb-3">
        <button type="button" class="btn btn-outline-dark btn-sm ml-3" onclick="window.history.back();">Cancelar</button>
    </div>

@push('scripts')
    <script>

    </script>
@endpush

@push('styles')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
            .print-area {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                margin: 0;
            }
        }
    </style>
@endpush

@stop
