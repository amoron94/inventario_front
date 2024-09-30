@extends('dashboard')
@section('contenido')

    <?php $usuario = session('usuario_logueado'); ?>
    <div class="card-header">
        <h3 class="d-inline align-middle">Registrar Receta</h3>
    </div>

    <div class="card-body" style="margin-top: -20px;">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8 col-xs-12">
                    <div class="form-group">
                        <label for="form-label">Nombre de la Receta</label>
                        <input type="text" name="nombre" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="form-group">
                        <label for="form-label">Producto</label>
                        <select name="producto_terminado" class="selectpicker show-tick form-control form-control-sm" data-live-search="true" required>
                            <option value="" disabled selected>Seleccionar...</option>
                            @foreach ($productos['data'] as $producto)
                            <option value="{{ $producto['codigo'] }}">{{ $producto['descripcion'] }}</option>
                            @endforeach
                        </select>
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

            <div class="container border-success pt-3" style="border: 1px solid ">
                <h4 class="d-inline align-middle">Seleccionar Materia Prima</h4>
                <div class="row pt-2">
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="form-label">Producto</label>
                            <select name="producto" class="selectpicker show-tick form-control form-control-sm" data-live-search="true">
                                <option value="" disabled selected>Seleccionar...</option>
                                @foreach ($m_primas['data'] as $m_prima)
                                <option value="{{ $m_prima['codigo'] }}">{{ $m_prima['descripcion'] }}</option>
                                @endforeach
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
                        <input type="number" name="cantidad" class="form-control form-control-sm" step="0.001" min="0">
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
                                        <th style="width: 8%" hidden>Codigo</th>
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
        // Pasar la URL base desde Blade a JavaScript
        var baseUrl = "{{ $baseUrl }}";

        const productos = @json($m_primas['data']);

        // Actualizar unidad al seleccionar un producto
        document.querySelector('select[name="producto"]').addEventListener('change', function() {
            var productoId = this.value;

            if (productoId) {
                // Buscar el producto seleccionado en el JSON
                const producto = productos.find(p => p.codigo === productoId);

                if (producto) {
                    document.querySelector('input[name="unidad"]').value = producto.medida + ' (' + producto.av + ')';
                    document.querySelector('input[name="cod_producto"]').value = producto.codigo;
                }
            }
        });


        //agregar productos y cantidad a la tabla detalle
        document.getElementById('agregarProducto').addEventListener('click', function() {
            var codProductoInput = document.querySelector('input[name="cod_producto"]');
            var productoSelect = document.querySelector('select[name="producto"]');
            var unidadInput = document.querySelector('input[name="unidad"]');
            var cantidadInput = document.querySelector('input[name="cantidad"]');


            var cod_producto = codProductoInput.value;
            var producto = productoSelect.options[productoSelect.selectedIndex].text;
            var unidad = unidadInput.value;
            var cantidad = parseFloat(cantidadInput.value); // Convertir a número


            if (cod_producto && producto && unidad && cantidad) {
                var tableBody = document.querySelector('#detalle tbody');
                var filaExistente = Array.from(tableBody.querySelectorAll('tr')).find(row => row.querySelector('td').innerText === cod_producto);

                if (filaExistente) {
                    // Si el producto ya existe en la tabla, actualizar la cantidad
                    var cantidadActualTd = filaExistente.querySelectorAll('td')[3];
                    var cantidadActual = parseFloat(cantidadActualTd.innerText);

                    cantidadActualTd.innerText = cantidadActual + cantidad;

                } else {
                    // Si el producto no existe en la tabla, agregar una nueva fila

                    var newRow = `<tr>
                                    <td hidden>${cod_producto}</td>
                                    <td>${producto}</td>
                                    <td>${unidad}</td>
                                    <td>${cantidad}</td>
                                    <td>
                                        <center>
                                        <a class="eliminarProducto">
                                            <i class="align-middle text-danger" data-feather="trash-2"></i>
                                        </a>
                                        </center>
                                    </td>
                                </tr>`;

                    tableBody.insertAdjacentHTML('beforeend', newRow);
                    feather.replace();
                }

                // Limpiar los campos después de agregar
                productoSelect.value = "";
                unidadInput.value = "";
                cantidadInput.value = "";
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
            }
        });



        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío normal del formulario

            // Capturar los valores del formulario
            var nombre = document.querySelector('input[name="nombre"]').value;
            var producto_terminado = document.querySelector('select[name="producto_terminado"]').value;
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
                nombre: nombre,
                producto_terminado: producto_terminado,
                observaciones: observaciones,
                productos: productos,
                usuario_responsable: usuario_responsable
            };

            // Enviar los datos con AJAX usando fetch
            fetch(`${baseUrl}produccion/agregar_receta.php`, {
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
                        title: "Receta creada correctamente",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        // Recargar la página después de mostrar el mensaje de éxito
                        window.location.href = "{{ url('produccion') }}";
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error al guardar la receta",
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
