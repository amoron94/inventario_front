@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <button class="btn btn-sm btn-success float-end" onclick="window.location.href='{{ route('nuevo_movimiento') }}'">Nuevo</button>
            <h3 class="d-inline align-middle">Movimientos de Productos entre Sucursales</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                <thead class="bg-primary" style="font-size: 12px;">
                    <tr class="text-white">
                        <th>Sucursal Salida</th>
                        <th>Sucursal Entrada</th>
                        <th>Fecha Movimiento</th>
                        <th>Observaciones</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                </tbody>
            </table>
        </div>
    </div>

@push('scripts')
    <script>

    </script>
@endpush

@stop
