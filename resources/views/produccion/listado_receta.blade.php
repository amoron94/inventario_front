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
                        <th>Nombre Receta</th>
                        <th>Producto</th>
                        <th>Categoria</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($producciones['data'] as $produccion)
                    <tr>
                        <td>{{ $produccion['nombre']}}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/productos/' . $produccion['img']) }}" class="rounded-circle" width="40" height="40">
                                <div class="ms-3">
                                    <b>{{ $produccion['producto']}}</b>
                                </div>
                            </div>
                        </td>
                        <td>{{ $produccion['categoria']}}</td>
                        <td>
                            <a href="{{ route('ver_receta', ['id' => $produccion['codigo']]) }}" title="Ver" target="_blank">
                                <i class="text-primary" data-feather="eye"></i>
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#eliminar{{ $produccion['codigo'] }}" title="Eliminar">
                                <i class="text-danger" data-feather="trash-2"></i>
                            </a>
                        </td>
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
