@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <h3 class="d-inline align-middle">Registrar Movimiento de Productos</h3>
    </div>

    <div class="card-body" style="margin-top: -20px;">
        <form action="{{ route('guardar_producto') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-5 col-xs-12">
                    <div class="form-group">
                        <label for="form-label">Sucursal de Salida</label>
                        <select name="s_salida" class="form-select form-select-sm" required>
                            <option value="" disabled selected>Seleccionar...</option>
                            @foreach ($sucursales['data'] as $sucursal)
                            <option value="{{ $sucursal['codigo'] }}">{{ $sucursal['nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-5 col-xs-12">
                    <div class="form-group">
                        <label for="form-label">Sucursal de Entrada</label>
                        <select name="s_entrada" class="form-select form-select-sm" required>
                            <option value="" disabled selected>Seleccionar...</option>
                            @foreach ($sucursales['data'] as $sucursal)
                            <option value="{{ $sucursal['codigo'] }}">{{ $sucursal['nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-xs-12">
                    <div class="form-group">
                        <label for="form-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control form-control-sm">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">
                        <label for="form-label">Observaciones</label>
                        <textarea id="observaciones" name="observaciones" class="form-control form-control-sm" rows="2" placeholder="Ingrese sus observaciones aquí"></textarea>
                    </div>
                </div>
            </div>

            <div class="container border-success" style="border: 1px solid ">
                <div class="row pt-3">
                    <div class="col-lg-4 col-xs-12">
                        <div class="form-group">
                            <label for="form-label">Producto</label>
                            <select name="producto" class="form-select form-select-sm" data-live-search="true" required>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-12">
                        <label for="form-label">Unidad</label>
                        <input type="text" name="unidad" class="form-control form-control-sm" disabled>
                    </div>
                    <div class="col-lg-2 col-xs-12">
                        <label for="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control form-control-sm" step="0.01" min="0" disabled>
                    </div>
                    <div class="col-lg-2 col-xs-12">
                        <label for="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control form-control-sm" step="0.01" min="0">
                    </div>
                    <div class="col-lg-2 col-xs-12" style="margin-top: 10px;text-align: center;align-content: center;">
                        <button type="submit" class="btn btn-primary btn-sm"><i data-feather="plus"></i> Agregar</button>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-lg-1 col-xs-12">
                    </div>
                    <div class="col-lg-10 col-xs-12">
                        <div class="table-responsive">
                            <table id="detalle" class="table table-sm table-striped table-bordered table-hover align-middle">
                                <thead class="bg-primary" style="font-size: 12px;">
                                    <tr class="text-white">
                                        <th>Producto</th>
                                        <th style="width: 20%">Unidad</th>
                                        <th style="width: 15%">Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 11px;">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-1 col-xs-12">
                    </div>

                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="button" class="btn btn-outline-dark btn-sm me-2" onclick="window.history.back();">Cancelar</button>
                <button type="submit" class="btn btn-success btn-sm">Guardar</button>
            </div>
        </form>
    </div>


@push('scripts')
    <script>
        // Función para obtener los productos de una sucursal
        function obtenerProductos(sucursalId) {
            var url = `http://localhost/inv_backend/controlador/inventario/get_producto_sucursal.php?sucursal=${sucursalId}`;
            return fetch(url)
                .then(response => response.json())
                .then(data => data.data);
        }

        // Función para obtener la información de un producto
        function obtenerProductoInfo(sucursalId, productoId) {
            var url = `http://localhost/inv_backend/controlador/inventario/get_stock_prod_suc.php?sucursal=${sucursalId}&producto=${productoId}`;
            return fetch(url)
                .then(response => response.json())
                .then(data => {
                    return data.data.find(p => p.cod_producto == productoId);
                });
        }

        // Actualizar productos al cambiar la sucursal de salida
        document.querySelector('select[name="s_salida"]').addEventListener('change', function() {
            var sucursalId = this.value;

            obtenerProductos(sucursalId).then(productos => {
                var productoSelect = document.querySelector('select[name="producto"]');
                productoSelect.innerHTML = '<option value="" disabled selected>Seleccionar...</option>';

                productos.forEach(producto => {
                    productoSelect.innerHTML += `<option value="${producto.cod_producto}">${producto.producto}</option>`;
                });
            });
        });

        // Actualizar unidad y stock al seleccionar un producto
        document.querySelector('select[name="producto"]').addEventListener('change', function() {
            var productoId = this.value;
            var sucursalId = document.querySelector('select[name="s_salida"]').value;

            if (sucursalId && productoId) {
                obtenerProductoInfo(sucursalId, productoId).then(producto => {
                    if (producto) {
                        document.querySelector('input[name="unidad"]').value = producto.medida + ' (' + producto.av + ')';
                        document.querySelector('input[name="stock"]').value = producto.stock;
                    }
                });
            }
        });
    </script>
@endpush

@stop

