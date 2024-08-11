@extends('dashboard')
@section('contenido')

    <?php $usuario = session('usuario_logueado'); ?>
    <div class="card-header">
        <h3 class="d-inline align-middle">Registrar Movimiento de Productos</h3>
    </div>

    <div class="card-body" style="margin-top: -20px;">
        <form action="" method="POST" enctype="multipart/form-data">
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
                        <select name="s_entrada" class="form-select form-select-sm"  disabled required>
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
                        <input type="date" name="fecha" class="form-control form-control-sm"  value="{{ date('Y-m-d') }}" required>
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
                <h4 class="d-inline align-middle mt-2">Detalle de Productos</h4>
                <div class="row pt-2">
                    <div class="col-lg-4 col-xs-12">
                        <div class="form-group">
                            <label for="form-label">Producto</label>
                            <select name="producto" class="selectpicker form-control form-control-sm" data-live-search="true">
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
                        <label for="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control form-control-sm" step="0.01" min="0" disabled>
                    </div>
                    <div class="col-lg-2 col-xs-12">
                        <label for="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control form-control-sm" step="0.01" min="0">
                    </div>
                    <div class="col-lg-2 col-xs-12" style="margin-top: 10px;text-align: center;align-content: center;">
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
                                        <th style="width: 8%">Codigo</th>
                                        <th>Producto</th>
                                        <th style="width: 20%">Unidad</th>
                                        <th style="width: 15%">Cantidad</th>
                                        <th style="width: 10%">Eliminar</th>
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
            var sucursalEntradaSelect = document.querySelector('select[name="s_entrada"]');
            sucursalEntradaSelect.disabled = false;

            obtenerProductos(sucursalId).then(productos => {
                var productoSelect = document.querySelector('select[name="producto"]');
                productoSelect.innerHTML = '<option value="" disabled selected>Seleccionar...</option>';

                productos.forEach(producto => {
                    productoSelect.innerHTML += `<option value="${producto.cod_producto}">${producto.producto}</option>`;
                });

                // Reinicializar el selectpicker
                $('.selectpicker').selectpicker('refresh');
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
            var stockInput = document.querySelector('input[name="stock"]');

            var cod_producto = codProductoInput.value;
            var producto = productoSelect.options[productoSelect.selectedIndex].text;
            var unidad = unidadInput.value;
            var cantidad = parseFloat(cantidadInput.value); // Convertir a número
            var stock = parseFloat(stockInput.value); // Convertir a número

            if (cod_producto && producto && unidad && cantidad) {
                var tableBody = document.querySelector('#detalle tbody');
                var filaExistente = Array.from(tableBody.querySelectorAll('tr')).find(row => row.querySelector('td').innerText === cod_producto);

                if (filaExistente) {
                    // Si el producto ya existe en la tabla, actualizar la cantidad
                    var cantidadActualTd = filaExistente.querySelectorAll('td')[3];
                    var cantidadActual = parseFloat(cantidadActualTd.innerText);

                    if (cantidadActual + cantidad <= stock) {
                        cantidadActualTd.innerText = cantidadActual + cantidad;
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "La cantidad total supera al stock del producto",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                } else {
                    // Si el producto no existe en la tabla, agregar una nueva fila
                    if (cantidad <= stock) {
                        var newRow = `<tr>
                                        <td>${cod_producto}</td>
                                        <td>${producto}</td>
                                        <td>${unidad}</td>
                                        <td>${cantidad}</td>
                                        <td>
                                            <a class="eliminarProducto">
                                                <i class="align-middle text-danger" data-feather="trash-2"></i>
                                            </a>
                                        </td>
                                    </tr>`;

                        tableBody.insertAdjacentHTML('beforeend', newRow);
                        feather.replace();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "La cantidad supera al stock del producto",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                }

                // Limpiar los campos después de agregar
                productoSelect.value = "";
                unidadInput.value = "";
                stockInput.value = "";
                cantidadInput.value = "";

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
            }
        });



        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío normal del formulario

            // Capturar los valores del formulario
            var s_salida = document.querySelector('select[name="s_salida"]').value;
            var s_entrada = document.querySelector('select[name="s_entrada"]').value;
            var fecha = document.querySelector('input[name="fecha"]').value;
            var observaciones = document.querySelector('textarea[name="observaciones"]').value;

            // Capturar el usuario responsable
            var usuario_responsable = `{{$usuario['data']['codigo']}}`;

            // Capturar los productos de la tabla
            var productos = [];
            var tableRows = document.querySelectorAll('#detalle tbody tr');

            tableRows.forEach(row => {
                var cod_producto = row.querySelector('td:nth-child(1)').innerText;
                var cantidad = parseFloat(row.querySelector('td:nth-child(4)').innerText);
                productos.push({ cod_producto: cod_producto, cantidad: cantidad });
            });

            // Estructurar los datos a enviar
            var data = {
                s_salida: s_salida,
                s_entrada: s_entrada,
                fecha: fecha,
                observaciones: observaciones,
                productos: productos,
                usuario_responsable: usuario_responsable
            };

            // Enviar los datos con AJAX usando fetch
            fetch('http://localhost/inv_backend/controlador/inventario/movimiento_sucursal_prod.php', {
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
                        title: "Movimiento guardado correctamente",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        // Recargar la página después de mostrar el mensaje de éxito
                        window.location.href = "{{ url('movimiento_stock') }}";
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error al guardar el movimiento",
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

