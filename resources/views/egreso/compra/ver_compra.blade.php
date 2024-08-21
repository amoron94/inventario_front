@extends('dashboard')
@section('contenido')

    @foreach($gastos['data'] as $gasto)
    <div class="card-header">
        <div class="container-fluid p-0">
            <a href="{{ route('descargar_comp', ['id' => $gasto['codigo']]) }}" class="btn btn-sm btn-danger float-end"><i data-feather="file-text"></i> Descargar PDF</a>
            <button class="btn btn-sm btn-primary float-end me-2" onclick="window.print()"><i data-feather="printer"></i> Imprimir</button>
        </div>
    </div>

    <div class="card-body print-area">
        <div class="container-fluid p-0">
            <center><h2 class="d-inline align-middle">Orden de Compra Nº {{ $gasto['nro'] }}</h2></center>
        </div>

        <p class="mt-4"><b>FECHA: </b>{{ $gasto['fecha'] }}</p>
        <p><b>SUCURSAL: </b>{{ $gasto['sucursal'] }}</p>
        <p><b>RESPONSABLE DE COMPRA: </b>{{ $gasto['responsable'] }}</p>
        <p><b>OBSERVACIONES: </b>{{ $gasto['obs'] }}</p>

        <div class="container mt-4">
            <div class="border-success p-3" style="border: 1px solid">
                <h4 class="text-success">Datos del Proveedor</h4>

                <div class="row mt-3">
                    <div class="col-7">
                        <span><b>{{ $gasto['proveedor'] }}</b></span><br>
                        <span><b>TELEFONO: </b>{{ $gasto['telefono'] }}</span><br>

                    </div>
                    <div class="col-5">
                        <br>
                        <span><b>NIT: </b>{{ $gasto['nit'] }}</span><br>

                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-12">
                        <span><b>DIRECCION: </b>{{ $gasto['direccion'] }}</span>
                    </div>
                </div>

                <hr>

                <div class="row mt-3">
                    <div class="col-12">
                        <h4 class="text-success">Contacto</h4>
                        <span><b>NOMBRE: </b>{{ $gasto['contacto'] }}</span><br>
                        <span><b>TELF: </b>{{ $gasto['telf_cont'] }}</span><br>
                    </div>
                </div>
            </div>


            <!-- Tabla para mostrar los detalles del movimiento -->
            <div class="mt-4">
                <h4>Detalle de Compra</h4>
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered table-hover align-middle">
                        <thead style="font-size: 12px; background: #3B7DDD">
                            <tr class="text-white">
                                <th>Producto</th>
                                <th>Unidad de Medida</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 11px;">
                            @foreach($gasto['detalles'] as $detalle)
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
                                <td class="text-dark"><span style="font-size: 18px"><b>{{ $gasto['monto_total'] }} Bs.</b></span></td>
                            </tr>
                        </tfoot>
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
