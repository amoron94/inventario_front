@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <button class="btn btn-sm btn-success float-end" data-bs-toggle="modal" data-bs-target="#nuevoU">Nuevo</button>
            <h3 class="d-inline align-middle">Listado Unidad Medida</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                <thead class="bg-colorbase" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Descripcion</th>
                        <th>Abreviatura</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($u_medidas['data'] as $u_medida)
                    <tr>
                        <td>{{ $u_medida['descripcion']}}</td>
                        <td>{{ $u_medida['av']}}</td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#editarU{{ $u_medida['codigo'] }}" title="Editar">
                                <i class="text-primary" data-feather="edit-2"></i>
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#eliminarU{{ $u_medida['codigo'] }}" title="Eliminar">
                                <i class="text-danger" data-feather="trash-2"></i>
                            </a>
                        </td>

                        <!--Modal Editar-->
                        <div class="modal fade" id="editarU{{ $u_medida['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-primary">
                                        <h3 class="modal-title fs-5 text-white">Editar - {{ $u_medida['descripcion'] }}</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('editar_medida', ['id' => $u_medida['codigo']]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-9 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Descripcion</label>
                                                            <input type="text" name="descripcion" class="form-control form-control-sm" value="{{ $u_medida['descripcion'] }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Abreviatura</label>
                                                            <input type="text" name="av" class="form-control form-control-sm" maxlength="2" value="{{ $u_medida['av'] }}" required>
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
                        <div class="modal fade" id="eliminarU{{ $u_medida['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Eliminar - {{ $u_medida['descripcion'] }}</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_medida', ['id' => $u_medida['codigo']]) }}" method="POST">
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

    <!--Modal Nuevo-->
    <div class="modal fade" id="nuevoU" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-success">
                    <h3 class="modal-title fs-5 text-white" id="exampleModalLabel">Agregar Unidad de Medida</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guardar_medida') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-9 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Descripcion</label>
                                        <input type="text" name="descripcion" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Abreviatura</label>
                                        <input type="text" name="av" class="form-control form-control-sm" maxlength="2" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@push('scripts')
    <script>

    </script>
@endpush

@stop
