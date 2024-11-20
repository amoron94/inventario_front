@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <button class="btn btn-sm btn-success float-end" data-bs-toggle="modal" data-bs-target="#nuevoS">Nuevo</button>
            <h3 class="d-inline align-middle">Listado Sucursal</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                <thead class="bg-colorbase" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Ciudad</th>
                        <th>Encargado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($sucursales['data'] as $sucursal)
                    <tr>
                        <td>{{ $sucursal['nombre']}}</td>
                        <td>{{ $sucursal['direccion']}}</td>
                        <td>{{ $sucursal['telefono']}}</td>
                        <td>{{ $sucursal['ciudad']}}</td>
                        <td>{{ $sucursal['encargado']}}</td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#editar{{ $sucursal['codigo'] }}" title="Editar">
                                <i class="text-primary" data-feather="edit-2"></i>
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#eliminar{{ $sucursal['codigo'] }}" title="Eliminar">
                                <i class="text-danger" data-feather="trash-2"></i>
                            </a>
                        </td>

                        <!--Modal Editar-->
                        <div class="modal fade" id="editar{{ $sucursal['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-primary">
                                        <h3 class="modal-title fs-5 text-white">Editar - {{ $sucursal['nombre'] }}</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('editar_sucursal', ['id' => $sucursal['codigo']]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Nombre de la Sucursal</label>
                                                            <input type="text" name="nombre" class="form-control form-control-sm" value="{{ $sucursal['nombre'] }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-7 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Encargado</label>
                                                            <input type="text" id="encargado-{{ $sucursal['codigo'] }}" name="encargado" value="{{ $sucursal['cod_encargado'] }}" hidden>
                                                            <select id="select-encargado-{{ $sucursal['codigo'] }}" class="selectpicker show-tick form-control form-control-sm" data-live-search="true">
                                                                @foreach ($encargados['data']  as $encargado)
                                                                    @if( $encargado['codigo'] == $sucursal['cod_encargado'] )
                                                                    <option value="{{ $encargado['codigo'] }}" selected>{{ $encargado['encargado']}}</option>
                                                                    @else
                                                                    <option value="{{ $encargado['codigo'] }}">{{ $encargado['encargado'] }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Telefono</label>
                                                            <input type="number" name="telefono" class="form-control form-control-sm" value="{{ $sucursal['telefono'] }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-7 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Direccion</label>
                                                            <input type="text" name="direccion" class="form-control form-control-sm" value="{{ $sucursal['direccion'] }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Ciudad</label>
                                                            <input type="text" name="ciudad" class="form-control form-control-sm" value="{{ $sucursal['ciudad'] }}" required>
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
                        <div class="modal fade" id="eliminar{{ $sucursal['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Eliminar - {{ $sucursal['nombre'] }}</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_sucursal', ['id' => $sucursal['codigo']]) }}" method="POST">
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
    <div class="modal fade" id="nuevoS" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-success">
                    <h3 class="modal-title fs-5 text-white" id="exampleModalLabel">Agregar Sucursal</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guardar_sucursal') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Nombre de la Sucursal</label>
                                        <input type="text" name="nombre" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-7 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Encargado</label>
                                        <select name="encargado" class="selectpicker show-tick form-control form-control-sm" data-live-search="true">
                                            @foreach ($encargados['data']  as $encargado)
                                            <option value="{{ $encargado['codigo'] }}">{{ $encargado['encargado'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Telefono</label>
                                        <input type="number" name="telefono" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-7 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Direccion</label>
                                        <input type="text" name="direccion" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Ciudad</label>
                                        <input type="text" name="ciudad" class="form-control form-control-sm" required>
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
        document.addEventListener("DOMContentLoaded", function() {
            @foreach($sucursales['data'] as $sucursal)
            document.getElementById('select-encargado-{{ $sucursal['codigo'] }}').addEventListener('change', function() {
                document.getElementById('encargado-{{ $sucursal['codigo'] }}').value = this.value;
            });
            @endforeach
        });
    </script>
@endpush

@stop
