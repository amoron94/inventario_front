@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <button class="btn btn-sm btn-success float-end" onclick="window.location.href='{{ route('nueva_compra') }}'">Nuevo</button>
            <h3 class="d-inline align-middle">Listado de Compras</h3>
            <br>
            <span class="text-danger"><b>Nota: Se vizualizan las compras del año actual</b></span>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle" data-order-direction="desc">
                <thead class="bg-primary" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Orden</th>
                        <th>Proveedor</th>
                        <th>Almacen</th>
                        <th>Fecha</th>
                        <th>Total Bs.</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($compras['data'] as $compra)
                    <tr>
                        <td><b>00{{ $compra['nro']}}</b></td>
                        <td>{{ $compra['proveedor']}}</td>
                        <td>{{ $compra['sucursal']}}</td>
                        <td>{{ $compra['fecha']}}</td>
                        <td><b>{{ $compra['total_gasto']}}</b></td>
                        <td>
                            <center>
                                <a href="{{ route('descargar_comp', ['id' => $compra['codigo']]) }}" title="Ver" target="_blank">
                                    <i class="text-primary" data-feather="eye"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#eliminar{{ $compra['codigo'] }}" title="Eliminar">
                                    <i class="text-danger" data-feather="trash-2"></i>
                                </a>
                            </center>
                        </td>


                        <!--Modal Eliminar-->
                        <div class="modal fade" id="eliminar{{ $compra['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Eliminar</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_compra', ['id' => $compra['codigo']]) }}" method="POST">
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
