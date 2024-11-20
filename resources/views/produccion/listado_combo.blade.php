@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <button class="btn btn-sm btn-success float-end" onclick="window.location.href='{{ route('nuevo_combo') }}'">Nuevo</button>
            <h3 class="d-inline align-middle">Listado de Combos</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                <thead class="bg-colorbase" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Producto</th>
                        <th>Nombre Receta</th>
                        <th>Categoria</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($combos['data'] as $combo)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/productos/' . $combo['img']) }}" class="rounded-circle" width="40" height="40">
                                <div class="ms-3">
                                    <b>{{ $combo['producto']}}</b>
                                </div>
                            </div>
                        </td>
                        <td>{{ $combo['nombre']}}</td>
                        <td>{{ $combo['categoria']}}</td>
                        <td>
                            <a href="{{ route('ver_combo', ['id' => $combo['codigo']]) }}" title="Ver" target="_blank">
                                <i class="text-primary" data-feather="eye"></i>
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#eliminar{{ $combo['codigo'] }}" title="Eliminar">
                                <i class="text-danger" data-feather="trash-2"></i>
                            </a>
                        </td>

                        <!--Modal Eliminar-->
                        <div class="modal fade" id="eliminar{{ $combo['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Eliminar - {{ $combo['nombre'] }}</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_combo', ['id' => $combo['codigo']]) }}" method="POST">
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
