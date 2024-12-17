@extends('dashboard')
@section('contenido')
    <?php $usuario = session('usuario_logueado'); ?>

    <input type="text" name="cod_empresa" value="{{ $usuario['data']['cod_empresa'] }}" hidden>

    <div class="card-header">
        <div class="container-fluid p-0">
            <label for="form-label" class="mr-3"><b>Rango de Fechas:</b></label>
            <input name="daterange" class="form-control d-inline align-middle fec">
        </div>
        <div class="row mt-3">
            <div class="col d-flex align-items-center">
                <label for="form-label" class="mr-3"><b>Seleccione su reporte:</b></label>
                <select name="buscar" class="form-select mr-5 sel">
                    <option value="1">Detalle Ventas</option>
                    <option value="2">Ventas Eliminadas</option>
                    <option value="3">Producto mas Vendidos</option>
                    <option value="4">Ventas por producto</option>
                    <option value="5">Ventas por Sucursal</option>
                    <option value="6">Cuadre de Cajas</option>
                </select>
                <button id="buscar" class="btn btn-success btn-color">Buscar</button>
            </div>
        </div>

        <div class="row mt-4 filtros">
            <div class="col d-flex align-items-center">
                <div class="form-group mr-5">
                    <label for="form-label"><b>Sucursal</b></label>
                    <select name="sucursal" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todas las sucursales</option>
                        @foreach ($sucursales['data'] as $sucursal)
                        <option value="{{ $sucursal['codigo'] }}">{{ $sucursal['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-5">
                    <label for="form-label"><b>Cliente</b></label>
                    <select name="cliente" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todos los clientes</option>
                        @foreach ($clientes['data'] as $cliente)
                        <option value="{{ $cliente['codigo'] }}">{{ $cliente['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-5">
                    <label for="form-label"><b>Metodo de Pago</b></label>
                    <select name="pago" class="selectpicker show-tick form-control" data-live-search="true">
                        <option value="" selected>Todos los Metodos</option>
                        <option value="1" >Efectivo</option>
                        <option value="2" >Tarjeta</option>
                        <option value="3" >Qr</option>
                    </select>
                </div>
                <div class="form-group mr-5">
                    <label for="form-label"><b>Productos</b></label>
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
            // Capturar el evento de cambio en el select "buscar"
            $('select[name="buscar"]').on('change', function () {
                let selectedValue = $(this).val();

                // Ocultar o mostrar los campos según el valor seleccionado
                switch (selectedValue) {
                    case '1':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="cliente"]').closest('.form-group').show();
                        $('select[name="pago"]').closest('.form-group').show();
                        $('select[name="producto"]').closest('.form-group').hide();
                        break;
                    case '2':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="cliente"]').closest('.form-group').show();
                        $('select[name="pago"]').closest('.form-group').show();
                        $('select[name="producto"]').closest('.form-group').hide();
                        break;
                    case '3':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="cliente"]').closest('.form-group').hide();
                        $('select[name="pago"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').hide();
                        break;
                    case '4':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="cliente"]').closest('.form-group').hide();
                        $('select[name="pago"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').show();
                        break;
                    case '5':
                        $('select[name="sucursal"]').closest('.form-group').hide();
                        $('select[name="cliente"]').closest('.form-group').hide();
                        $('select[name="pago"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').hide();
                        break;
                    case '6':
                        $('select[name="sucursal"]').closest('.form-group').show();
                        $('select[name="cliente"]').closest('.form-group').hide();
                        $('select[name="pago"]').closest('.form-group').hide();
                        $('select[name="producto"]').closest('.form-group').hide();
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
        let cliente = $('select[name="cliente"]').val();
        let tipo_pago = $('select[name="pago"]').val();
        let producto = $('select[name="producto"]').val();;
        let activo = 1;

        switch (buscar) {
            case '1':
                ventas(baseUrl, inicio, fin, cod_empresa, sucursal, cliente, tipo_pago, activo);
                break;
            case '2':
                activo = 0;
                ventas(baseUrl, inicio, fin, cod_empresa, sucursal, cliente, tipo_pago, activo);
                break;
            case '3':
                producto = '';
                producto_vendido(baseUrl, inicio, fin, cod_empresa, sucursal, producto);
                break;
            case '4':
                producto_vendido(baseUrl, inicio, fin, cod_empresa, sucursal, producto);
                break;
            case '5':
                ventas_sucursal(baseUrl, inicio, fin, cod_empresa);
                break;
            case '6':
                cierre_caja(baseUrl, inicio, fin, cod_empresa, sucursal);
                break;
            default:
                console.warn("Opción no válida");
                break;
        }



    });

    </script>


    <script>
        //Detale de venta
        function ventas(baseUrl, inicio, fin, cod_empresa, sucursal, cliente, tipo_pago, activo){
            // Enviar los datos mediante AJAX
            fetch(`${baseUrl}reporte/ventas.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                },
                body: JSON.stringify({
                    inicio: inicio,
                    fin: fin,
                    sucursal: sucursal,
                    cliente: cliente,
                    tipo_pago: tipo_pago,
                    empresa: cod_empresa,
                    activo: activo
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
                                    <th rowspan="2" style="align-content: center;"><center>NRO</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>CLIENTE</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>SUCURSAL</center></th>
                                    <th colspan="1" style="align-content: center;"><center>TOTAL</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>METODO DE PAGO</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>VENDEDOR</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>FECHA</center></th>
                                </tr>
                                <tr class="text-white">
                                    <th style="align-content: center;"><center>Ventas = ${totalVenta} Bs.</center></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px;">
                    `;

                    // Recorrer las ventas y crear filas dinámicamente
                    data.ventas.forEach(venta => {
                    tablaHTML += `
                    <tr>
                        <td><center>${venta.nro}</center></td>
                        <td>${venta.cliente}</td>
                        <td>${venta.sucursal}</td>
                        <td><center>${venta.total_venta}</center></td>
                        <td>${venta.tipo_pago}</td>
                        <td>${venta.vendedor}</td>
                        <td>${venta.fecha}</td>
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
        //Productos mas vendidos
        function producto_vendido(baseUrl, inicio, fin, cod_empresa, sucursal, producto){
            // Enviar los datos mediante AJAX
            fetch(`${baseUrl}reporte/producto_mas_vendido.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                },
                body: JSON.stringify({
                    inicio: inicio,
                    fin: fin,
                    sucursal: sucursal,
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

                    // Crear estructura HTML para la tabla
                    let tablaHTML = `
                    <div class="table-responsive">
                        <table id="tab" class="table table-sm table-striped table-bordered table-hover align-middle">
                            <thead class="bg-colorbase" style="font-size: 12px;">
                                <tr class="text-white">
                                    <th style="align-content: center;"><center>PRODUCTO</center></th>
                                    <th style="align-content: center;"><center>CANTIDAD</center></th>
                                    <th style="align-content: center;"><center>TOTAL BS.</center></th>
                                    <th style="align-content: center;"><center>SUCURSAL</center></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px;">
                    `;

                    // Recorrer las ventas y crear filas dinámicamente
                    data.ventas.forEach(venta => {
                    tablaHTML += `
                    <tr>
                        <td>${venta.producto}</td>
                        <td><center>${venta.total_cantidad}</center></td>
                        <td><center>${venta.total_monto}</center></td>
                        <td>${venta.sucursal}</td>
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
        //Productos mas vendidos
        function ventas_sucursal(baseUrl, inicio, fin, cod_empresa){
            // Enviar los datos mediante AJAX
            fetch(`${baseUrl}reporte/ventas_sucursal.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                },
                body: JSON.stringify({
                    inicio: inicio,
                    fin: fin,
                    empresa: cod_empresa
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
                                    <th rowspan="2" style="align-content: center;"><center>SUCURSAL</center></th>
                                    <th colspan="1" style="align-content: center;"><center>TOTAL BS.</center></th>
                                </tr>
                                <tr class="text-white">
                                    <th style="align-content: center;"><center>Ventas = ${totalVenta} Bs.</center></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px;">
                    `;

                    // Recorrer las ventas y crear filas dinámicamente
                    data.ventas.forEach(venta => {
                    tablaHTML += `
                    <tr>
                        <td>${venta.sucursal}</td>
                        <td><center>${venta.total}</center></td>
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

        function cierre_caja(baseUrl, inicio, fin, cod_empresa, sucursal){
            // Enviar los datos mediante AJAX
            fetch(`${baseUrl}reporte/cierre_arqueo.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Añadir token CSRF para seguridad
                },
                body: JSON.stringify({
                    inicio: inicio,
                    fin: fin,
                    empresa: cod_empresa,
                    sucursal: sucursal,
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
                                    <th rowspan="2" style="align-content: center;"><center>NRO</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>SUCURSAL</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>APERTURA</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>CIERRE</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>MONTO APERTURA</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>MONTO CIERRE</center></th>
                                    <th colspan="1" style="align-content: center;"><center>SOBRANTE / FALTANTE</center></th>
                                    <th rowspan="2" style="align-content: center;"><center>CANT. VENTAS</center></th>
                                </tr>
                                <tr class="text-white">
                                    <th style="align-content: center;"><center>Total = ${totalVenta} Bs.</center></th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 11px;">
                    `;

                    // Recorrer las ventas y crear filas dinámicamente
                    data.ventas.forEach(venta => {

                    tablaHTML += `
                    <tr>
                        <td>${venta.nro}</td>
                        <td>${venta.sucursal}</td>
                        <td>
                            <span>${venta.fecha_a}<br>
                            <b>${venta.hora_a}</b></span>
                        </td>
                        <td>
                            <span>${venta.fecha_c}<br>
                            <b style="color:#b10c1c">${venta.hora_c}</b></span>
                        </td>
                        <td><center>${venta.monto_a}</center></td>
                        <td><center>${venta.monto_c}</center></td>
                        <td><center>${venta.diferencia}</center></td>
                        <td><center>${venta.ventas}</center></td>
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

        b{
            color: #4CAF50;
        }

        .sel{
            max-width: 400px;
        }

        .filtros{
            border: 2px solid #4CAF50;
            padding: 10px 5px;
            border-radius: 5px;
        }

        .btn-color{
            background: #4CAF50;
        }

        @media (max-width: 768px) {
            .fec{
                width: 45%;
            }
        }
    </style>
@endpush
@stop
