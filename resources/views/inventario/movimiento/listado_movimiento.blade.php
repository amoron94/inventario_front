@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <button class="btn btn-sm btn-success float-end" onclick="window.location.href='{{ route('nuevo_movimiento') }}'">Nuevo</button>
            <h3 class="d-inline align-middle">Movimientos de Productos entre Sucursales</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle" data-order-direction="desc">
                <thead class="bg-colorbase" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Fecha Movimiento</th>
                        <th>Sucursal Salida</th>
                        <th>Sucursal Entrada</th>
                        <th>Observaciones</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($movimientos['data'] as $movimiento)
                    <tr>
                        <td><b>{{ $movimiento['fecha']}}</b></td>
                        <td>{{ $movimiento['s_salida']}}</td>
                        <td>{{ $movimiento['s_entrada']}}</td>
                        <td>{{ $movimiento['obs']}}</td>
                        <td>
                            <center>
                                <a href="{{ route('descargar_mov', ['id' => $movimiento['codigo']]) }}" title="Ver" target="_blank">
                                    <i class="text-primary" data-feather="eye"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#eliminar{{ $movimiento['codigo'] }}" title="Eliminar">
                                    <i class="text-danger" data-feather="trash-2"></i>
                                </a>
                            </center>
                        </td>

                        <!--Modal Eliminar-->
                        <div class="modal fade" id="eliminar{{ $movimiento['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Eliminar</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_movimiento', ['id' => $movimiento['codigo']]) }}" method="POST">
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
