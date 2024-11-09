@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <a class="btn btn-sm btn-primary float-end" href="{{ url('lote') }}">Volver</a>
            <h3 class="d-inline align-middle">LOTES DE {{ urldecode(request()->nombre) }}</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle" data-order-direction="desc">
                <thead class="bg-primary" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Fecha Vencimiento</th>
                        <th>Nro Lote</th>
                        <th>Sucursal</th>
                        <th>Cantidad</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($lotes['data'] as $lote)
                    <tr>
                        <td><b>{{ $lote['f_vencimiento']}}</b></td>
                        <td>{{ $lote['nro']}}</td>
                        <td>{{ $lote['sucursal']}}</td>
                        <td>{{ $lote['cantidad'] }} <b class="text-danger">({{ $lote['av'] }})</b></td>
                        <td>
                            <center>
                                <a data-bs-toggle="modal" data-bs-target="#editar{{ $lote['codigo'] }}" title="Editar">
                                    <i class="text-primary" data-feather="edit-2"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#eliminar{{ $lote['codigo'] }}" title="Eliminar">
                                    <i class="text-danger" data-feather="trash-2"></i>
                                </a>
                            </center>
                        </td>

                        <!--Modal Editar-->
                        <div class="modal fade" id="editar{{ $lote['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-primary">
                                        <h3 class="modal-title fs-5 text-white">Editar</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('editar_lote', ['id' => $lote['codigo']]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12 col-xs-12 mb-1">
                                                        <label for="form-label"><b>{{ $lote['sucursal'] }}</b></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Fecha Vencimiento</label>
                                                            <input type="date" name="f_vencimiento" class="form-control form-control-sm" min="{{ date('Y-m-d') }}" required value="{{ $lote['fecha'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Cantidad</label>
                                                            <input type="text" name="cantidad" class="form-control form-control-sm" disabled value="{{ $lote['cantidad'] }} ({{ $lote['av'] }})">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--Modal Eliminar-->
                        <div class="modal fade" id="eliminar{{ $lote['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Eliminar</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_lote', ['id' => $lote['codigo']]) }}" method="POST">
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
