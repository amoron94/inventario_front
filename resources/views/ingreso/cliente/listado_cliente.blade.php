@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <button class="btn btn-sm btn-success float-end" data-bs-toggle="modal" data-bs-target="#nuevo">Nuevo</button>
            <h3 class="d-inline align-middle">Listado de Cliente</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle" data-order-direction="asc">
                <thead class="bg-primary" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Sexo</th>
                        <th>F. Nacimiento</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($clientes['data'] as $cliente)
                    <tr>
                        <td><b>{{ $cliente['nombre']}}</b></td>
                        <td>{{ $cliente['telefono']}}</td>
                        <td>{{ $cliente['email']}}</td>
                        <td>
                            @if( $cliente['sexo'] == '1')
                                <span class="badge bg-primary rounded-3 fw-semibold" style="font-size: 10px;">Masculino</span>
                            @elseif($cliente['sexo'] == '2')
                                <span class="badge bg-warning rounded-3 fw-semibold" style="font-size: 10px;">Femenino</span>
                            @else
                                <span style="font-size: 10px;"></span>
                            @endif
                        </td>
                        <td>{{ $cliente['fecha']}}</td>
                        <td>
                            @if( $cliente['codigo'] != 1)
                            <center>
                                <a data-bs-toggle="modal" data-bs-target="#editar{{ $cliente['codigo'] }}" title="Editar">
                                    <i class="text-primary" data-feather="edit-2"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#eliminar{{ $cliente['codigo'] }}" title="Eliminar">
                                    <i class="text-danger" data-feather="trash-2"></i>
                                </a>
                            </center>
                            @endif
                        </td>

                        <!--Modal Editar-->
                        <div class="modal fade" id="editar{{ $cliente['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-primary">
                                        <h3 class="modal-title fs-5 text-white">Editar - {{ $cliente['nombre'] }}</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('editar_cliente', ['id' => $cliente['codigo']]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Nombre</label>
                                                            <input type="text" name="nombre" class="form-control form-control-sm" value="{{ $cliente['nombre'] }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Telefono</label>
                                                            <input type="number" name="telefono" class="form-control form-control-sm" value="{{ $cliente['telefono'] }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Correo</label>
                                                            <input type="email" name="email" class="form-control form-control-sm" value="{{ $cliente['email'] }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Sexo</label>
                                                            <select name="sexo" class="form-select form-select-sm">
                                                                @if($cliente['sexo'] == '1')
                                                                    <option value="1" selected>Masculino</option>
                                                                    <option value="2" >Femenino</option>
                                                                @elseif($cliente['sexo'] == '2')
                                                                    <option value="1" >Masculino</option>
                                                                    <option value="2" selected>Femenino</option>
                                                                @else
                                                                    <option value="" disabled selected>Seleccionar...</option>
                                                                    <option value="1" >Masculino</option>
                                                                    <option value="2" >Femenino</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">F. Nacimiento</label>
                                                            <input type="date" name="fecha" class="form-control form-control-sm" value="{{ $cliente['fecha1'] }}">
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
                        <div class="modal fade" id="eliminar{{ $cliente['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Eliminar - {{ $cliente['nombre'] }}</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_cliente', ['id' => $cliente['codigo']]) }}" method="POST">
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
    <div class="modal fade" id="nuevo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-success">
                    <h3 class="modal-title fs-5 text-white" id="exampleModalLabel">Agregar Cliente</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guardar_cliente') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Nombre</label>
                                        <input type="text" name="nombre" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Telefono</label>
                                        <input type="number" name="telefono" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Correo</label>
                                        <input type="email" name="email" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Sexo</label>
                                        <select name="sexo" class="form-select form-select-sm">
                                            <option value="" disabled selected>Seleccionar...</option>
                                            <option value="1" >Masculino</option>
                                            <option value="2" >Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">F. Nacimiento</label>
                                        <input type="date" name="fecha" class="form-control form-control-sm">
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
