@extends('dashboard')
@section('contenido')
    <?php $usuario = session('usuario_logueado'); ?>

    <input type="text" name="cod_empresa" value="{{ $usuario['data']['cod_empresa'] }}" hidden>

    <div class="card-header">
        <div class="container-fluid p-0">
            <label for="form-label" class="mr-3"><b class="b">Rango de Fechas:</b></label>
            <input name="daterange" class="form-control d-inline align-middle fec">
        </div>

        <div class="row mt-3">
            <div class="col d-flex align-items-center">
                <label for="form-label" class="mr-3"><b class="b">Seleccione su reporte:</b></label>
                <select name="buscar" class="form-select mr-5 sel">
                    <option value="1">Stock Actual</option>
                    <option value="2">Stock Critico</option>
                </select>
                <button id="buscar" class="btn btn-danger btn-color">Buscar</button>
            </div>
        </div>

        <div class="row mt-4 filtros">
            <div class="col d-flex align-items-center">
                <div class="form-group mr-5">
                    <label for="form-label"><b class="b">Sucursal</b></label>
                    <select name="sucursal" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todas las sucursales</option>
                        @foreach ($sucursales['data'] as $sucursal)
                        <option value="{{ $sucursal['codigo'] }}">{{ $sucursal['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-5">
                    <label for="form-label"><b class="b">Tipo Producto</b></label>
                    <select name="tipo" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todos los Metodos</option>
                        <option value="1" >MATERIA PRIMA</option>
                        <option value="3" >SEMITERMINADO</option>
                        <option value="2" >PRODUCTO TERMINADO</option>
                    </select>
                </div>
                <div class="form-group mr-5">
                    <label for="form-label"><b class="b">Productos</b></label>
                    <select name="producto" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todos los Productos</option>
                        @foreach ($productos['data'] as $productos)
                        <option value="{{ $productos['codigo'] }}">{{ $productos['descripcion'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div id="tablaResultados">
        </div>
    </div>

@push('scripts')
    <script>

        $(document).ready(function () {

            $('select[name="producto"]').closest('.form-group').hide();
            $('input[name="daterange"]').prop('disabled', true);
            // Capturar el evento de cambio en el select "buscar"
            $('select[name="buscar"]').on('change', function () {
                let selectedValue = $(this).val();

                // Ocultar o mostrar los campos según el valor seleccionado
                switch (selectedValue) {
                    case '1':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="tipo"]').closest('.form-group').show();
                        $('select[name="producto"]').closest('.form-group').hide();
                        $('input[name="daterange"]').prop('disabled', true);
                        break;
                    case '2':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="producto"]').closest('.form-group').show();
                        $('select[name="tipo"]').closest('.form-group').show();
                        $('input[name="daterange"]').prop('disabled', true);
                        break;
                }

            });

        });

        // Obtener el año actual y la fecha actual
        let inicio = moment().year() + '-01-01'; // Fecha inicial predeterminada: 1 de enero del año actual
        let fin = moment().format('YYYY-MM-DD'); // Fecha final predeterminada: Fecha actual

        $('input[name="daterange"]').daterangepicker({
            opens: 'center',
            startDate: moment(inicio, 'YYYY-MM-DD'), // Usa la fecha inicial predeterminada
            endDate: moment(fin, 'YYYY-MM-DD'), // Usa la fecha final predeterminada
            locale: {
                format: 'DD/MM/YYYY',  // Formato de fecha
                separator: " - ",  // Separador entre las fechas en el rango
                applyLabel: "Aplicar",  // Texto del botón de aplicar
                cancelLabel: "Cancelar",  // Texto del botón de cancelar
                fromLabel: "Desde",  // Texto "Desde" en el panel
                toLabel: "Hasta",  // Texto "Hasta" en el panel
                customRangeLabel: "Personalizado",  // Texto para el rango personalizado
                weekLabel: "Sem",  // Etiqueta para las semanas
                daysOfWeek: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],  // Días de la semana
                monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],  // Meses
                firstDay: 1  // Establecer Lunes como el primer día de la semana
            }
        }, function(start, end, label) {
            inicio = start.format('YYYY-MM-DD');
            fin = end.format('YYYY-MM-DD');
            console.log("Fechas seleccionadas: " + inicio + " a " + fin);
        });


        // Pasar la URL base desde Blade a JavaScript
        let baseUrl = "{{ $baseUrl }}";

        document.getElementById('buscar').addEventListener('click', function() {

            let buscar = $('select[name="buscar"]').val();

            let cod_empresa = $('input[name="cod_empresa"]').val();
            let sucursal = $('select[name="sucursal"]').val();
            let tipo = $('select[name="tipo"]').val();
            let producto = $('select[name="producto"]').val();;

            switch (buscar) {
                case '1':
                    stock(baseUrl, cod_empresa, sucursal, tipo);
                    break;
                case '2':
                    stock_minimo(baseUrl, cod_empresa, sucursal, tipo, producto);
                    break;
            }

        });

    </script>

    <script>
        //stock actual
        function stock(baseUrl, cod_empresa, sucursal, tipo){
            // Enviar los datos mediante AJAX
            fetch(`${baseUrl}reporte/stock_actual.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                },
                body: JSON.stringify({
                    sucursal: sucursal,
                    tipo: tipo,
                    empresa: cod_empresa,
                })
            })
            .then(response => response.json())
            .then(data => {
                // Manejar la respuesta del servidor
                if (data.success) {
                    // Referencia al contenedor de la tabla
                    const tablaResultados = document.getElementById('tablaResultados');
                    let totalVenta = data.total ? data.total : 0;
                    // Crear estructura HTML para la tabla
                    let tablaHTML = `
                    <div class="table-responsive">
                        <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                            <thead class="bg-colorbase" style="font-size: 12px;">
                                <tr class="text-white">
                                    <th style="align-content: center;"><center>PRODUCTO</center></th>
                                    <th style="align-content: center;"><center>SUCURSAL</center></th>
                                    <th style="align-content: center;"><center>TIPO PRODUCTO</center></th>
                                    <th style="align-content: center;"><center>MEDIDA</center></th>
                                    <th style="align-content: center;"><center>STOCK ACTUAL</center></th>
                                    <th style="align-content: center;"><center>STOCK MINIMO</center></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px;">
                    `;

                    // Recorrer las ventas y crear filas dinámicamente
                    data.ventas.forEach(venta => {
                    tablaHTML += `
                    <tr>
                        <td>${venta.producto}</td>
                        <td>${venta.sucursal}</td>
                        <td>${venta.tipo}</td>
                        <td>${venta.medida} (${venta.av})</td>
                        <td>${venta.stock}</td>
                        <td>${venta.stock_m}</td>
                    </tr>
                    `;
                    });

                    // Cerrar la tabla
                    tablaHTML += `
                            </tbody>
                        </table>
                    </div>
                    `;

                    // Inyectar la tabla en el contenedor
                    tablaResultados.innerHTML = tablaHTML;

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error al consultar el reporte',
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
        }
    </script>

    <script>
        //stock minimo
        function stock_minimo(baseUrl, cod_empresa, sucursal, tipo, producto){
            // Enviar los datos mediante AJAX
            fetch(`${baseUrl}reporte/stock_critico.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                },
                body: JSON.stringify({
                    sucursal: sucursal,
                    tipo: tipo,
                    empresa: cod_empresa,
                    producto: producto,
                })
            })
            .then(response => response.json())
            .then(data => {
                // Manejar la respuesta del servidor
                if (data.success) {
                    // Referencia al contenedor de la tabla
                    const tablaResultados = document.getElementById('tablaResultados');
                    let totalVenta = data.total ? data.total : 0;
                    // Crear estructura HTML para la tabla
                    let tablaHTML = `
                    <div class="table-responsive">
                        <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                            <thead class="bg-colorbase" style="font-size: 12px;">
                                <tr class="text-white">
                                    <th style="align-content: center;"><center>SUCURSAL</center></th>
                                    <th style="align-content: center;"><center>PRODUCTO</center></th>
                                    <th style="align-content: center;"><center>TIPO PRODUCTO</center></th>
                                    <th style="align-content: center;"><center>MEDIDA</center></th>
                                    <th style="align-content: center;"><center>STOCK ACTUAL</center></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px;">
                    `;

                    // Recorrer las ventas y crear filas dinámicamente
                    data.ventas.forEach(venta => {
                    tablaHTML += `
                    <tr>
                        <td>${venta.sucursal}</td>
                        <td>${venta.producto}</td>
                        <td>${venta.tipo}</td>
                        <td>${venta.medida} (${venta.av})</td>
                        <td>${venta.stock}</td>
                    </tr>
                    `;
                    });

                    // Cerrar la tabla
                    tablaHTML += `
                            </tbody>
                        </table>
                    </div>
                    `;

                    // Inyectar la tabla en el contenedor
                    tablaResultados.innerHTML = tablaHTML;

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error al consultar el reporte',
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
        }
    </script>
@endpush

@push('styles')
    <style>
        .fec{
            width: 19%;
        }

        .b{
            color: #b10c1c;
        }

        .sel{
            max-width: 400px;
        }

        .filtros{
            border: 2px solid #b10c1c;
            padding: 10px 5px;
            border-radius: 5px;
        }

        .btn-color{
            background: #b10c1c;
        }

        @media (max-width: 768px) {
            .fec{
                width: 45%;
            }
        }
    </style>
@endpush
@stop
