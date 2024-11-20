@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <button class="btn btn-sm btn-success float-end" data-bs-toggle="modal" data-bs-target="#nuevo">Nuevo</button>
            <h3 class="d-inline align-middle">Listado Usuario</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                <thead class="bg-colorbase" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Tipo</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Redes Sociales</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($usuarios['data'] as $usuario)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/usuario/' . $usuario['img']) }}" class="rounded-circle" width="40" height="40">
                                <div class="ms-3">
                                    <b>{{ $usuario['usuario']}}</b>
                                </div>
                            </div>
                        </td>
                        <td>{{ $usuario['email']}}</td>
                        <td>
                            @if($usuario['cod_tipo'] == 1)
                            <span class="badge bg-danger rounded-3 fw-semibold" style="font-size: 10px;">{{ $usuario['tipo']}}</span>
                            @elseif($usuario['cod_tipo'] == 2)
                            <span class="badge bg-primary rounded-3 fw-semibold" style="font-size: 10px;">{{ $usuario['tipo']}}</span>
                            @else
                            <span class="badge bg-success rounded-3 fw-semibold" style="font-size: 10px;">{{ $usuario['tipo']}}</span>
                            @endif
                        </td>
                        <td>{{ $usuario['direccion']}}</td>
                        <td>{{ $usuario['telefono']}}</td>
                        <td>
                            <center>
                                <a href="https://www.facebook.com/<?php echo $usuario['facebook']; ?>" target="_blank" class="badge bg-primary me-1 my-1"><i class="text-light align-middle" data-feather="facebook"></i></a>
                                <a href="https://www.instagram.com/<?php echo $usuario['instagram']; ?>" target="_blank" class="badge bg-danger me-1 my-1"><i class="text-light align-middle" data-feather="instagram"></i></a>
                            </center>
                        </td>
                        <td>
                            @if($usuario['cod_tipo'] != 1)
                            <a data-bs-toggle="modal" data-bs-target="#editar{{ $usuario['codigo'] }}" title="Editar">
                                <i class="text-primary" data-feather="edit-2"></i>
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#eliminar{{ $usuario['codigo'] }}" title="Eliminar">
                                <i class="text-danger" data-feather="trash-2"></i>
                            </a>
                            @endif
                        </td>

                        <!--Modal Editar-->
                        <div class="modal fade" id="editar{{ $usuario['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-primary">
                                        <h3 class="modal-title fs-5 text-white">Editar - {{ $usuario['usuario'] }}</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('editar_usuario', ['id' => $usuario['codigo']]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-4 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Nombre</label>
                                                            <input type="text" name="nombre" class="form-control form-control-sm" value="{{ $usuario['nombre']}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Apellido Paterno</label>
                                                            <input type="text" name="apellido_p" class="form-control form-control-sm" value="{{ $usuario['apellido_p']}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Apellido Materno</label>
                                                            <input type="text" name="apellido_m" class="form-control form-control-sm" value="{{ $usuario['apellido_m']}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Correo Electronico</label>
                                                            <input type="email" name="correo" class="form-control form-control-sm" value="{{ $usuario['email']}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Direccion</label>
                                                            <input type="text" name="direccion" class="form-control form-control-sm" value="{{ $usuario['direccion']}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Cambiar de Imagen</label>
                                                            <input type="file" name="img" class="form-control form-control-sm" accept="image/*">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Telefono</label>
                                                            <input type="number" name="telefono" class="form-control form-control-sm" accept="image/*" value="{{ $usuario['telefono']}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Tipo Usuario</label>
                                                            <select name="tipo" class="show-tick form-select form-select-sm" data-live-search="true" required>
                                                                @if($usuario['cod_tipo'] == 2)
                                                                <option value="2" selected>ENCARGADO</option>
                                                                <option value="3" >CAJERO</option>
                                                                @else
                                                                <option value="2" >ENCARGADO</option>
                                                                <option value="3" selected>CAJERO</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-xs-12">
                                                        <center>
                                                            <img src="{{ asset('img/usuario/' . $usuario['img']) }}" alt="img-producto" class="img-fluid rounded-3" width="200" height="200"/>
                                                        </center>
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
                        <div class="modal fade" id="eliminar{{ $usuario['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Eliminar - {{ $usuario['usuario'] }}</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_usuario', ['id' => $usuario['codigo']]) }}" method="POST">
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
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-success">
                    <h3 class="modal-title fs-5 text-white" id="exampleModalLabel">Agregar Usuario</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guardar_usuario') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Nombre</label>
                                        <input type="text" name="nombre" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Apellido Paterno</label>
                                        <input type="text" name="apellido_p" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Apellido Materno</label>
                                        <input type="text" name="apellido_m" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Correo Electronico</label>
                                        <input type="email" name="correo" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Direccion</label>
                                        <input type="text" name="direccion" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Contraseña</label>
                                        <div style="position: relative;">
                                            <input type="password" id="contra" name="contra" class="form-control form-control-sm" required>
                                            <i class="ti ti-eye-off" id="togglePassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;color: black;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Telefono</label>
                                        <input type="number" name="telefono" class="form-control form-control-sm" accept="image/*" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Tipo Usuario</label>
                                        <select name="tipo" class="show-tick form-select form-select-sm" data-live-search="true" required>
                                            <option value="" disabled selected>Seleccionar...</option>
                                            <option value="2">ENCARGADO</option>
                                            <option value="3">CAJERO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Imagen del Usuario</label>
                                        <input type="file" name="img" class="form-control form-control-sm" accept="image/*" required>
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
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#contra');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute using getAttribute() method
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the eye / eye slash icon
            this.classList.toggle('ti-eye-off');
            this.classList.toggle('ti-eye');
        });
    </script>
@endpush

@stop
