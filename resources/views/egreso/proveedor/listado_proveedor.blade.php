@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <button class="btn btn-sm btn-success float-end" data-bs-toggle="modal" data-bs-target="#nuevo">Nuevo</button>
            <h3 class="d-inline align-middle">Listado Proveedores</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                <thead class="bg-primary" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Empresa</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Direccion</th>
                        <th style="width: 10%">Contacto</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($proveedores['data'] as $proveedor)
                    <tr>
                        <td><b>{{ $proveedor['empresa']}}</b></td>
                        <td>{{ $proveedor['telefono']}}</td>
                        <td>{{ $proveedor['email']}}</td>
                        <td>{{ $proveedor['direccion']}}</td>
                        <td style="width: 22%">
                            <b>{{ $proveedor['nom_contacto']}}<br>
                            {{ $proveedor['tel_contacto']}}</b> - <b class="text-danger">{{ $proveedor['cargo_contacto']}}</b>
                        </td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#editar{{ $proveedor['codigo'] }}" title="Editar">
                                <i class="text-primary" data-feather="edit-2"></i>
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#eliminar{{ $proveedor['codigo'] }}" title="Eliminar">
                                <i class="text-danger" data-feather="trash-2"></i>
                            </a>
                        </td>

                        <!--Modal Editar-->
                        <div class="modal fade" id="editar{{ $proveedor['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-primary">
                                        <h3 class="modal-title fs-5 text-white">Editar</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('editar_proveedor', ['id' => $proveedor['codigo']]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-4 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Empresa</label>
                                                            <input type="text" name="empresa" class="form-control form-control-sm" value="{{ $proveedor['empresa'] }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Email</label>
                                                            <input type="email" name="email" class="form-control form-control-sm" value="{{ $proveedor['email'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Telefono</label>
                                                            <input type="number" name="telefono" class="form-control form-control-sm" value="{{ $proveedor['telefono'] }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Direccion</label>
                                                            <input type="text" name="direccion" class="form-control form-control-sm" value="{{ $proveedor['direccion'] }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Nit</label>
                                                            <input type="number" name="nit" class="form-control form-control-sm" value="{{ $proveedor['nit'] }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 col-xs-12">
                                                        <label for="form-label">Forma de Pago</label>
                                                        <center>
                                                            <div class="radio-img">
                                                                <input type="radio" id="efectivo{{ $proveedor['codigo'] }}" name="tipo" value="1"
                                                                {{ $proveedor['tipo'] == 1 ? 'checked' : '' }} required>
                                                                <label for="efectivo{{ $proveedor['codigo'] }}">
                                                                    <img src="{{asset('img/icons/dinero.png')}}" alt="Option 1" class="img-prov">
                                                                </label>
                                                                <span class="badge bg-success rounded-3 fw-semibold" style="font-size: 10px;">Efectivo</span>
                                                            </div>
                                                            <div class="radio-img">
                                                                <input type="radio" id="tarjeta{{ $proveedor['codigo'] }}" name="tipo" value="2"
                                                                {{ $proveedor['tipo'] == 2 ? 'checked' : '' }}>
                                                                <label for="tarjeta{{ $proveedor['codigo'] }}">
                                                                    <img src="{{asset('img/icons/tarjeta.png')}}" alt="Option 2" class="img-prov">
                                                                </label>
                                                                <span class="badge bg-success rounded-3 fw-semibold" style="font-size: 10px;">Tarjeta</span>
                                                            </div>
                                                        </center>
                                                    </div>
                                                    <div class="col-lg-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="form-label">Comentario</label>
                                                            <textarea name="comentario" class="form-control form-control-sm" rows="5" placeholder="Ingrese algun detalle extra">{{ $proveedor['comentario'] }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border-success px-3 pt-1" style="border:2px solid">
                                                    <h5 class="text-success">Informacion de Contacto</h5>

                                                    <div class="row">
                                                        <div class="col-lg-5 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="form-label">Nombre Completo</label>
                                                                <input type="text" name="contacto" class="form-control form-control-sm" value="{{ $proveedor['nom_contacto'] }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="form-label">Telefono</label>
                                                                <input type="number" name="telfcont" class="form-control form-control-sm" value="{{ $proveedor['tel_contacto'] }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="form-label">Cargo</label>
                                                                <input type="text" name="cargo" class="form-control form-control-sm" value="{{ $proveedor['cargo_contacto'] }}" required>
                                                            </div>
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
                        <div class="modal fade" id="eliminar{{ $proveedor['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Eliminar {{ $proveedor['empresa'] }}</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_proveedor', ['id' => $proveedor['codigo']]) }}" method="POST">
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
                    <h3 class="modal-title fs-5 text-white" id="exampleModalLabel">Agregar Proveedor</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guardar_proveedor') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Empresa</label>
                                        <input type="text" name="empresa" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Email</label>
                                        <input type="email" name="email" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Telefono</label>
                                        <input type="number" name="telefono" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Direccion</label>
                                        <input type="text" name="direccion" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Nit</label>
                                        <input type="number" name="nit" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-6 col-xs-12">
                                    <label for="form-label">Forma de Pago</label>
                                    <center>
                                        <div class="radio-img">
                                            <input type="radio" id="efectivo" name="tipo" value="1" required>
                                            <label for="efectivo">
                                                <img src="{{asset('img/icons/dinero.png')}}" alt="Option 1" class="img-prov">
                                            </label>
                                            <span class="badge bg-success rounded-3 fw-semibold" style="font-size: 10px;">Efectivo</span>
                                        </div>
                                        <div class="radio-img">
                                            <input type="radio" id="tarjeta" name="tipo" value="2">
                                            <label for="tarjeta">
                                                <img src="{{asset('img/icons/tarjeta.png')}}" alt="Option 2" class="img-prov">
                                            </label>
                                            <span class="badge bg-success rounded-3 fw-semibold" style="font-size: 10px;">Tarjeta</span>
                                        </div>
                                    </center>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="form-label">Comentario</label>
                                        <textarea name="comentario" class="form-control form-control-sm" rows="5" placeholder="Ingrese algun detalle extra"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="border-success px-3 pt-1" style="border:2px solid">
                                <h5 class="text-success">Informacion de Contacto</h5>

                                <div class="row">
                                    <div class="col-lg-5 col-xs-12">
                                        <div class="form-group">
                                            <label for="form-label">Nombre Completo</label>
                                            <input type="text" name="contacto" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-12">
                                        <div class="form-group">
                                            <label for="form-label">Telefono</label>
                                            <input type="number" name="telfcont" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="form-label">Cargo</label>
                                            <input type="text" name="cargo" class="form-control form-control-sm" required>
                                        </div>
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

