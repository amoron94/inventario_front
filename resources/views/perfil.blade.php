@extends('dashboard')
@section('contenido')

    <div class="card-body">
        <div class="row" >
            <div class="col-sm-5 col-12" style="align-content: center">
                <center>
                    <img src="{{ asset('img/usuario/' . $perfil['data']['img']) }}" alt="Img-Perfil" class="img-fluid rounded-circle mb-2" width="230" height="230">
                    <h3 class="mt-3 text-primary"><strong>{{ $perfil['data']['nombre'] }} {{ $perfil['data']['apellido_p'] }} {{ $perfil['data']['apellido_m'] }}</strong></h3>
                </center>
                <center>
                    <a href="https://www.facebook.com/<?php echo $perfil['data']['facebook']; ?>" target="_blank" class="badge bg-primary me-1 my-1"><i class="text-light align-middle" data-feather="facebook"></i></a>
                    <a href="https://www.instagram.com/<?php echo $perfil['data']['instagram']; ?>" target="_blank" class="badge bg-danger me-1 my-1"><i class="text-light align-middle" data-feather="instagram"></i></a>
                </center>
                <center class="mt-3">
                    <button class="btn btn-sm btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#nuevo">Cambiar Contraseña</button>
                </center>
            </div>
            <div class="col-sm-7 col-12">
                <form action="{{ route('editar_perfil', ['id' => $perfil['data']['codigo']]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-xs-12 mt-2">
                                <label for="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control form-control-sm" value="{{ $perfil['data']['nombre'] }}" required>
                            </div>
                            <div class="col-lg-4 col-xs-12 mt-2">
                                <label for="form-label">Apellido Paterno</label>
                                <input type="text" name="apellido_p" class="form-control form-control-sm" value="{{ $perfil['data']['apellido_p'] }}" required>
                            </div>
                            <div class="col-lg-4 col-xs-12 mt-2">
                                <label for="form-label">Apellido Materno</label>
                                <input type="text" name="apellido_m" class="form-control form-control-sm" value="{{ $perfil['data']['apellido_m'] }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-xs-12 mt-2">
                                <label for="form-label">Email</label>
                                <input type="email" name="email" class="form-control form-control-sm" value="{{ $perfil['data']['email'] }}" required>
                            </div>
                            <div class="col-lg-4 col-xs-12 mt-2">
                                <label for="form-label">Telefono</label>
                                <input type="number" name="telefono" class="form-control form-control-sm" value="{{ $perfil['data']['telefono'] }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 mt-2">
                                <label for="form-label">Direccion</label>
                                <input type="text" name="direccion" class="form-control form-control-sm" value="{{ $perfil['data']['direccion'] }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 mt-2">
                                <label for="form-label">Imagen de Perfil</label>
                                <input type="file" name="img" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 mt-2">
                                <label for="form-label">Facebbok</label>
                                <input type="text" name="facebook" class="form-control form-control-sm" value="{{ $perfil['data']['facebook'] }}" placeholder="/">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 mt-2">
                                <label for="form-label">Instagram</label>
                                <input type="text" name="instagram" class="form-control form-control-sm" value="{{ $perfil['data']['instagram'] }}" placeholder="@">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm float-end mt-3">Guardar Datos</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!--Modal Nuevo-->
    <div class="modal fade" id="nuevo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h3 class="modal-title fs-5 text-white" id="exampleModalLabel">Cambiar Contraseña</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cambiar_pass', ['id' => $perfil['data']['codigo']]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-xs-12 mt-2">
                                    <label for="form-label">Contraseña Actual</label>
                                    <input type="password" name="pass1" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12 mt-2">
                                    <label for="form-label">Nueva Contraseña</label>
                                    <input type="password" name="pass2" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12 mt-2">
                                    <label for="form-label">Repetir Contraseña</label>
                                    <input type="password" name="pass3" class="form-control form-control-sm" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
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
