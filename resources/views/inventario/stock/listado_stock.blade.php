@extends('dashboard')
@section('contenido')

    <div class="card-header">
        <div class="container-fluid p-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="d-inline align-middle">Stock de Productos</h3>
                </div>
                <div class="col-auto">
                    <form method="GET" action="{{ url('stock') }}" class="input-group">
                        <select name="suc" class="form-select form-select-sm mr-2">
                            <option value="" selected>Seleccionar Sucursales...</option>
                            @foreach ($sucursales['data'] as $sucursal)
                            <option value="{{ $sucursal['codigo'] }}" {{ request('suc') == $sucursal['codigo'] ? 'selected' : '' }}>
                                {{ $sucursal['nombre'] }}
                            </option>
                            @endforeach
                        </select>
                        <select name="tipo_p" class="form-select form-select-sm mr-2">
                            <option value="" selected>Seleccionar Tipo Prod...</option>
                            <option value="1" {{ request('tipo_p') == '1' ? 'selected' : '' }}>MATERIA PRIMA</option>
                            <option value="3" {{ request('tipo_p') == '3' ? 'selected' : '' }}>SEMITERMINADO</option>
                            <option value="2" {{ request('tipo_p') == '2' ? 'selected' : '' }}>PROD. TERMINADO</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-success">Filtrar Productos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <button id="edit-stock-btn" class="btn btn-sm btn-primary mb-1">Editar Stock de Productos</button>
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered table-hover align-middle">
                <thead class="bg-colorbase" style="font-size: 12px;">
                    <tr class="text-white">
                        <th><center><input type="checkbox" id="select-all"></center></th>
                        <th>Nombre</th>
                        <th>Sucursal</th>
                        <th>Tipo</th>
                        <th>Medida</th>
                        <th style="width: 100px">Stock</th>
                        <th style="width: 100px">Stock Minimo</th>
                    </tr>
                </thead>
                <tbody style="font-size: 11px;">
                    @foreach($stocks['data'] as $stock)
                    <tr>
                        <td><center><input type="checkbox" class="select-row"></center></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/productos/' . $stock['img']) }}" class="rounded-circle" width="30" height="30">
                                <div class="ms-3">
                                    <b>{{ $stock['producto']}}</b>
                                </div>
                            </div>
                        </td>
                        <td>{{ $stock['sucursal']}}</td>
                        <td>
                            @if( $stock['tipo'] == 'PRODUCTO TERMINADO')
                                <span class="badge bg-primary rounded-3 fw-semibold" style="font-size: 10px;">{{ $stock['tipo']}}</span>
                            @elseif($stock['tipo'] == 'SEMITERMINADO')
                                <span class="badge bg-success rounded-3 fw-semibold" style="font-size: 10px;">{{ $stock['tipo']}}</span>
                            @else
                                <span class="badge bg-warning rounded-3 fw-semibold" style="font-size: 10px;">{{ $stock['tipo']}}</span>
                            @endif
                        </td>
                        <td>{{ $stock['medida']}} <b>({{ $stock['av'] }})</b></td>
                        <td style="width: 100px">
                            <input type="number" name="stock[]" value="{{ number_format($stock['stock'], 2) }}" data-codigo="{{ $stock['codigo'] }}" class="form-control form-control-sm" required step="0.001" min="0" style="font-size: 11px;" disabled>
                        </td>
                        <td style="width: 100px">
                            <input type="number" name="stock_min[]" value="{{ $stock['stock_m'] }}" data-codigo="{{ $stock['codigo'] }}" class="form-control form-control-sm" step="0.001" min="0" style="font-size: 11px;" disabled>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@push('scripts')
    <script>
        // Pasar la URL base desde Blade a JavaScript
        var baseUrl = "{{ $baseUrl }}";

        document.getElementById('edit-stock-btn').addEventListener('click', function() {
            // Arreglo para almacenar los productos seleccionados
            let selectedProducts = [];

            // Iterar sobre cada fila de la tabla
            document.querySelectorAll('.select-row:checked').forEach(function(checkbox) {
                let row = checkbox.closest('tr');
                let stockInput = row.querySelector('input[name="stock[]"]');
                let stockMinInput = row.querySelector('input[name="stock_min[]"]');
                let codigo = stockInput.getAttribute('data-codigo');

                // Añadir el producto seleccionado con sus valores actualizados al arreglo
                selectedProducts.push({
                    codigo: codigo,
                    stock: stockInput.value,
                    stock_min: stockMinInput.value
                });
            });

            // Verificar si hay productos seleccionados
            if (selectedProducts.length > 0) {
                // Enviar los datos mediante AJAX
                fetch(`${baseUrl}inventario/editar_stock.php`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                    },
                    body: JSON.stringify({ productos: selectedProducts })
                })
                .then(response => response.json())
                .then(data => {
                    // Manejar la respuesta del servidor
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: 'Stock actualizado correctamente.',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            // Recargar la página después de mostrar el mensaje de éxito
                            window.location.href = "{{ url('stock') }}";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hubo un error al actualizar el stock',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en la conexion con la BD',
                        showConfirmButton: false,
                        timer: 2000
                    });
                });
            } else {
                Swal.fire({
                    icon: "question",
                    title: "Por favor, selecciona al menos un producto",
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });

        // Seleccionar el checkbox del encabezado
        const selectAllCheckbox = document.getElementById('select-all');
        const rowCheckboxes = document.querySelectorAll('.select-row');

        // Evento para seleccionar o deseleccionar todos los checkboxes
        selectAllCheckbox.addEventListener('change', function() {
            rowCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
                const row = checkbox.closest('tr');
                toggleInputs(row, checkbox.checked);
            });
        });

        // Evento para cada checkbox individual
        rowCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const row = checkbox.closest('tr');
                toggleInputs(row, checkbox.checked);
            });
        });

        // Función para habilitar o deshabilitar los campos de stock y stock mínimo
        function toggleInputs(row, isChecked) {
            const stockInput = row.querySelector('input[name="stock[]"]');
            const stockMinInput = row.querySelector('input[name="stock_min[]"]');
            stockInput.disabled = !isChecked;
            stockMinInput.disabled = !isChecked;
        }
    </script>
@endpush

@stop
