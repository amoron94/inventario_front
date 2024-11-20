@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <h3 class="d-inline align-middle">Listado de Ventas</h3>
            <br>
            <span class="text-danger"><b>Nota: Se vizualizan las ventas del año actual</b></span>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle" data-order-direction="desc">
                <thead class="bg-colorbase" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Orden</th>
                        <th>Cliente</th>
                        <th>Almacen</th>
                        <th>Fecha</th>
                        <th>Tipo Pago</th>
                        <th>Total Bs.</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($ventas['data'] as $venta)
                    <tr>
                        <td><b>00{{ $venta['nro']}}</b></td>
                        <td>{{ $venta['cliente']}}</td>
                        <td>{{ $venta['sucursal']}}</td>
                        <td>{{ $venta['fecha']}}</td>
                        <td>
                            @if($venta['tipo_pago'] == 1)
                                <span class="badge bg-success rounded-3 fw-semibold" style="font-size: 10px;">Efectivo</span>
                            @elseif($venta['tipo_pago'] == 2)
                                <span class="badge bg-primary rounded-3 fw-semibold" style="font-size: 10px;">Tarjeta</span>
                            @else
                                <span class="badge bg-secondary rounded-3 fw-semibold" style="font-size: 10px;">Qr</span>
                            @endif
                        </td>
                        <td><b class="text-danger">{{ $venta['total_venta']}}</b></td>
                        <td>
                            <center>
                                <a href="{{ route('descargar_ven', ['id' => $venta['codigo']]) }}" title="Ver" target="_blank">
                                    <i class="text-primary" data-feather="eye"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#eliminar{{ $venta['codigo'] }}" title="Eliminar">
                                    <i class="text-danger" data-feather="trash-2"></i>
                                </a>
                            </center>
                        </td>

                        <!--Modal Eliminar-->
                        <div class="modal fade" id="eliminar{{ $venta['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Eliminar</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_venta', ['id' => $venta['codigo']]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12 col-xs-12">
                                                        <div class="form-group">
                                                            <h6>¿Estás seguro que quieres eliminar?</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

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
