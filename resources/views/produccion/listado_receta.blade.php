@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <button class="btn btn-sm btn-success float-end" onclick="window.location.href='{{ route('nueva_receta') }}'">Nuevo</button>
            <h3 class="d-inline align-middle">Listado Produccion de Recetas</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                <thead class="bg-primary" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Producto</th>
                        <th>Nombre Receta</th>
                        <th>Categoria</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($producciones['data'] as $produccion)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/productos/' . $produccion['img']) }}" class="rounded-circle" width="40" height="40">
                                <div class="ms-3">
                                    <b>{{ $produccion['producto']}}</b>
                                </div>
                            </div>
                        </td>
                        <td>{{ $produccion['nombre']}}</td>
                        <td>{{ $produccion['categoria']}}</td>
                        <td>
                            <a href="{{ route('ver_receta', ['id' => $produccion['codigo']]) }}" title="Ver" target="_blank">
                                <i class="text-primary" data-feather="eye"></i>
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#eliminar{{ $produccion['codigo'] }}" title="Eliminar">
                                <i class="text-danger" data-feather="trash-2"></i>
                            </a>
                        </td>

                        <!--Modal Eliminar-->
                        <div class="modal fade" id="eliminar{{ $produccion['codigo'] }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h3 class="modal-title fs-5 text-white">Eliminar - {{ $produccion['nombre'] }}</h3>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_receta', ['id' => $produccion['codigo']]) }}" method="POST">
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
