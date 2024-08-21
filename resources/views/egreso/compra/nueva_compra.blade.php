@extends('dashboard')
@section('contenido')

    <?php $usuario = session('usuario_logueado'); ?>
    <div class="card-header">
        <h3 class="d-inline align-middle">Registrar Nueva Orden de Compra</h3>
    </div>

    <div class="card-body" style="margin-top: -20px;">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-5 col-xs-12">
                    <div class="form-group">
                        <label for="form-label">Proveedor</label>
                        <select name="proveedor" class="selectpicker show-tick form-control form-control-sm" data-live-search="true" required>
                            <option value="" disabled selected>Seleccionar...</option>
                            @foreach ($proveedores['data'] as $proveedor)
                            <option value="{{ $proveedor['codigo'] }}">{{ $proveedor['empresa'] }}</option>
                            @endforeach
                        </select>
                        <small id="tipo_proveedor" class="text-danger"></small>
                    </div>

                </div>
                <div class="col-lg-5 col-xs-12">
                    <div class="form-group">
                        <label for="form-label">Sucursal</label>
                        <select name="sucursal" class="selectpicker show-tick form-control form-control-sm" data-live-search="true" required>
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
                        <input type="date" name="fecha" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="form-group">
                        <label for="form-label">Observaciones</label>
                        <textarea id="observacion" name="observacion" class="form-control form-control-sm" rows="2" placeholder="Ingrese sus observaciones aquí"></textarea>
                    </div>
                </div>
            </div>

            <div class="border-success px-3 pt-1" style="border:2px solid">
                <h5 class="text-success"><b>Detalle de Productos</b></h5>

                <div class="row">
                    <div class="col-lg-4 col-xs-12">
                        <div class="form-group">
                            <label for="form-label">Producto</label>
                            <select name="producto" class="selectpicker show-tick form-control form-control-sm" data-live-search="true" disabled>
                                <option value="" disabled selected>Seleccionar...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-12">
                        <label for="form-label">Unidad</label>
                        <input type="text" name="cod_producto" class="form-control form-control-sm" hidden>
                        <input type="text" name="unidad" class="form-control form-control-sm" disabled>
                    </div>
                    <div class="col-lg-2 col-xs-12">
                        <label for="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control form-control-sm" step="0.01" min="0">
                    </div>
                    <div class="col-lg-2 col-xs-12">
                        <label for="form-label">Precio</label>
                        <input type="number" name="precio" class="form-control form-control-sm" step="0.01" min="0">
                    </div>
                    <div class="col-lg-2 col-xs-12" style="margin-top: 10px; text-align: center; align-content: center;">
                        <button type="button" class="btn btn-primary btn-sm" id="agregarProducto"><i data-feather="plus"></i> Agregar</button>
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
                                        <th style="width: 8%;" hidden>Codigo</th>
                                        <th>Producto</th>
                                        <th style="width: 15%">Unidad</th>
                                        <th style="width: 10%">Cantidad</th>
                                        <th style="width: 10%">Precio</th>
                                        <th style="width: 10%">Total</th>
                                        <th style="width: 10%">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 11px;">
                                </tbody>
                                <tfoot style="font-size: 12px; background: #a2c0eb">
                                    <tr>
                                        <td colspan="4" class="text-end text-dark"><span style="font-size: 18px"><b>Total a Cancelar</b></span></td>
                                        <td id="totalCancelar" class="text-dark"><span style="font-size: 18px"><b>0.00</b></span></td>
                                        <td class="text-dark"><span style="font-size: 18px"><b>Bs.</b></span></td>
                                    </tr>
                                </tfoot>
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
        // Actualizar el metodo de pago al seleccionar un proveedor
        document.querySelector('select[name="proveedor"]').addEventListener('change', function() {
            const proveedores = @json($proveedores['data']);
            const selectedProveedor = this.value;
            const proveedor = proveedores.find(p => p.codigo === selectedProveedor);

            if (proveedor) {
                if ( proveedor.tipo == 1 ){
                    document.getElementById('tipo_proveedor').textContent = `Metodo de pago: Efectivo`;
                }else{
                    document.getElementById('tipo_proveedor').textContent = `Metodo de pago: Tarjeta`;
                }

            } else {
                document.getElementById('tipo_proveedor').textContent = '';
            }
        });



        // Función para obtener los productos de una sucursal
        function obtenerProductos(sucursalId) {
            var url = `http://localhost/inv_backend/controlador/inventario/get_producto_sucursal.php?sucursal=${sucursalId}`;
            return fetch(url)
                .then(response => response.json())
                .then(data => data.data);
        }

        // Actualizar productos al cambiar la sucursal de salida
        document.querySelector('select[name="sucursal"]').addEventListener('change', function() {
            var sucursalId = this.value;
            var productoSelect = document.querySelector('select[name="producto"]');
            productoSelect.disabled = false;

            obtenerProductos(sucursalId).then(productos => {

                productoSelect.innerHTML = '<option value="" disabled selected>Seleccionar...</option>';

                productos.forEach(producto => {
                    productoSelect.innerHTML += `<option value="${producto.cod_producto}">${producto.producto}</option>`;
                });

                // Reinicializar el selectpicker
                $('.selectpicker').selectpicker('refresh');
            });
        });



        // Función para obtener la información de un producto
        function obtenerProductoInfo(sucursalId, productoId) {
            var url = `http://localhost/inv_backend/controlador/inventario/get_stock_prod_suc.php?sucursal=${sucursalId}&producto=${productoId}`;
            return fetch(url)
                .then(response => response.json())
                .then(data => {
                    return data.data.find(p => p.cod_producto == productoId);
                });
        }

        // Actualizar unidad y stock al seleccionar un producto
        document.querySelector('select[name="producto"]').addEventListener('change', function() {
            var productoId = this.value;
            var sucursalId = document.querySelector('select[name="sucursal"]').value;

            if (sucursalId && productoId) {
                obtenerProductoInfo(sucursalId, productoId).then(producto => {
                    if (producto) {
                        document.querySelector('input[name="unidad"]').value = producto.medida + ' (' + producto.av + ')';
                        document.querySelector('input[name="cod_producto"]').value = producto.cod_producto;
                    }
                });
            }
        });



        //agregar productos y cantidad a la tabla detalle
        document.getElementById('agregarProducto').addEventListener('click', function() {
            var codProductoInput = document.querySelector('input[name="cod_producto"]');
            var productoSelect = document.querySelector('select[name="producto"]');
            var unidadInput = document.querySelector('input[name="unidad"]');
            var cantidadInput = document.querySelector('input[name="cantidad"]');
            var precioInput = document.querySelector('input[name="precio"]');

            var cod_producto = codProductoInput.value;
            var producto = productoSelect.options[productoSelect.selectedIndex].text;
            var unidad = unidadInput.value;
            var cantidad = parseFloat(cantidadInput.value); // Convertir a número
            var precio = parseFloat(precioInput.value); // Convertir a número
            var total = cantidad * precio;

            if (cod_producto && producto && unidad && cantidad && precio) {
                var tableBody = document.querySelector('#detalle tbody');
                var filaExistente = Array.from(tableBody.querySelectorAll('tr')).find(fila => fila.querySelector('td:first-child').textContent === cod_producto);

                if (filaExistente) {
                    var cantidadExistente = parseFloat(filaExistente.querySelector('td:nth-child(4)').textContent);
                    var nuevoPrecio = Math.max(precio, parseFloat(filaExistente.querySelector('td:nth-child(5)').textContent));
                    cantidad += cantidadExistente;
                    filaExistente.querySelector('td:nth-child(4)').textContent = cantidad.toFixed(2);
                    filaExistente.querySelector('td:nth-child(5)').textContent = nuevoPrecio.toFixed(2);
                    filaExistente.querySelector('td:nth-child(6)').textContent = (cantidad * nuevoPrecio).toFixed(2);
                } else {
                    var fila = document.createElement('tr');
                    fila.innerHTML = `
                        <td hidden>${cod_producto}</td>
                        <td>${producto}</td>
                        <td>${unidad}</td>
                        <td>${cantidad.toFixed(2)}</td>
                        <td>${precio.toFixed(2)}</td>
                        <td>${total.toFixed(2)}</td>
                        <td>
                            <center>
                                <a class="eliminarProducto">
                                    <i class="align-middle text-danger" data-feather="trash-2"></i>
                                </a>
                            </center>
                        </td>
                    `;
                    tableBody.appendChild(fila);
                }

                actualizarTotalCancelar();
                feather.replace();

                // Limpiar campos
                productoSelect.value = '';
                unidadInput.value = '';
                cantidadInput.value = '';
                precioInput.value = '';
                codProductoInput.value = '';
                $('.selectpicker').selectpicker('refresh');

            } else {
                Swal.fire({
                    icon: "question",
                    title: "Por favor, llene todos los campos del Detalle",
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });

        // Eliminar fila de la tabla con event delegation
        document.querySelector('#detalle tbody').addEventListener('click', function(event) {
            if (event.target.closest('.eliminarProducto')) {
                var fila = event.target.closest('tr');
                fila.remove();
                actualizarTotalCancelar();
            }
        });

        function actualizarTotalCancelar() {
            var totalCancelar = 0;
            var tableBody = document.querySelector('#detalle tbody');
            tableBody.querySelectorAll('tr').forEach(fila => {
                totalCancelar += parseFloat(fila.querySelector('td:nth-child(6)').textContent);
            });
            document.getElementById('totalCancelar').innerHTML = `<span style="font-size: 18px"><b>${totalCancelar.toFixed(2)}</b></span>`;
        }



        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío normal del formulario

            // Capturar los valores del formulario
            var proveedor = document.querySelector('select[name="proveedor"]').value;
            var sucursal = document.querySelector('select[name="sucursal"]').value;
            var fecha = document.querySelector('input[name="fecha"]').value;
            var observaciones = document.querySelector('textarea[name="observacion"]').value;

            // Capturar el usuario responsable
            var usuario_responsable = `{{$usuario['data']['codigo']}}`;

            // Capturar los productos de la tabla
            var productos = [];
            var tableRows = document.querySelectorAll('#detalle tbody tr');

            tableRows.forEach(row => {
                var cod_producto = row.querySelector('td:nth-child(1)').innerText;
                var cantidad = parseFloat(row.querySelector('td:nth-child(4)').innerText);
                var precio = parseFloat(row.querySelector('td:nth-child(5)').innerText);
                productos.push({ cod_producto: cod_producto, cantidad: cantidad , precio: precio });
            });

            // Estructurar los datos a enviar
            var data = {
                proveedor: proveedor,
                sucursal: sucursal,
                fecha: fecha,
                observaciones: observaciones,
                productos: productos,
                usuario_responsable: usuario_responsable
            };

            // Enviar los datos con AJAX usando fetch
            fetch('http://localhost/inv_backend/controlador/egreso/agregar_compra.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value // Token CSRF para seguridad
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Compra guardada correctamente",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        // Recargar la página después de mostrar el mensaje de éxito
                        window.location.href = "{{ url('compras') }}";
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error al guardar la compra",
                        text: result.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: "error",
                    title: "Error en la solicitud",
                    text: "Ocurrió un error al enviar los datos",
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        });
    </script>
@endpush

@stop
